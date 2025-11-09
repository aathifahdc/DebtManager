<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtController extends Controller
{

    public function index()
    {
        $debts = Auth::user()->debts()->latest()->paginate(10);
        return view('debts.index', compact('debts'));
    }

    public function create()
    {
        return view('debts.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'creditor_name' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0.01',
                'description' => 'nullable|string|max:500',
                'due_date' => 'nullable|date|after_or_equal:today',
                'status' => 'required|in:pending,paid,overdue',
            ]);

            Auth::user()->debts()->create($validated);

            return redirect('/debts')->with('success', 'Debt record created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create debt record.');
        }
    }

    public function edit(Debt $debt)
    {
        $this->authorize('update', $debt);
        return view('debts.edit', compact('debt'));
    }

    public function update(Request $request, Debt $debt)
    {
        try {
            $this->authorize('update', $debt);

            $validated = $request->validate([
                'creditor_name' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0.01',
                'description' => 'nullable|string|max:500',
                'due_date' => 'nullable|date|after_or_equal:today',
                'status' => 'required|in:pending,paid,overdue',
            ]);

            $debt->update($validated);

            return redirect('/debts')->with('success', 'Debt record updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update debt record.');
        }
    }

    public function destroy(Debt $debt)
    {
        try {
            $this->authorize('delete', $debt);
            $debt->delete();

            return redirect('/debts')->with('success', 'Debt record deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete debt record.');
        }
    }
}
