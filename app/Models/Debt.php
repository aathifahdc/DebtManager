<?php

namespace App\Models;

use App\Traits\EncryptsData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory, EncryptsData;

    protected $fillable = [
        'user_id',
        'creditor_name',
        'amount',
        'description',
        'due_date',
        'status',
    ];

    protected $encrypted = [
        'creditor_name',
        'description',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}