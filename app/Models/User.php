<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function debts()
    {
        return $this->hasMany(Debt::class);
    }

    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    public function getTotalDebts()
    {
        return $this->debts()->sum('amount');
    }

    public function getTotalCredits()
    {
        return $this->credits()->sum('amount');
    }

    public function getTotalDebtsPaid()
    {
        return $this->debts()->where('status', 'paid')->sum('amount');
    }

    public function getTotalCreditsReceived()
    {
        return $this->credits()->where('status', 'received')->sum('amount');
    }
}
