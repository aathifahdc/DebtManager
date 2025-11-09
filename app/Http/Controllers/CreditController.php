<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $credits = Auth::user()->credits()->latest()->paginate(10);
        return view('credits.index', compact('credits'));
    }

    public function create()
    {
        return view('credits.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'debtor_name' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0.01',
                'description' => 'nullable|string|max:500',
                'due_date' => 'nullable|date|after_or_equal:today',
                'status' => 'required|in:pending,received,overdue',
            ]);

            Auth::user()->credits()->create($validated);

            return redirect('/credits')->with('success', 'Credit record created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create credit record.');
        }
    }

    public function edit(Credit $credit)
    {
        $this->authorize('update', $credit);
        return view('credits.edit', compact('credit'));
    }

    public function update(Request $request, Credit $credit)
    {
        try {
            $this->authorize('update', $credit);

            $validated = $request->validate([
                'debtor_name' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0.01',
                'description' => 'nullable|string|max:500',
                'due_date' => 'nullable|date|after_or_equal:today',
                'status' => 'required|in:pending,received,overdue',
            ]);

            $credit->update($validated);

            return redirect('/credits')->with('success', 'Credit record updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update credit record.');
        }
    }

    public function destroy(Credit $credit)
    {
        try {
            $this->authorize('delete', $credit);
            $credit->delete();

            return redirect('/credits')->with('success', 'Credit record deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete credit record.');
        }
    }
}
