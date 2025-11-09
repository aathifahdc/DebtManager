<?php

namespace App\Models;

use App\Traits\EncryptsData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory, EncryptsData;

    protected $fillable = [
        'user_id',
        'debtor_name',
        'amount',
        'description',
        'due_date',
        'status',
    ];

    protected $encrypted = [
        'debtor_name',
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
