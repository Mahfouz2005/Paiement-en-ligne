<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiements extends Model
{
    /** @use HasFactory<\Database\Factories\PaiementsFactory> */
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'reference',
        'amount',
        'currency',
        'status',
        'phone',
        'email',
        'response_data'
    ];
    protected $casts = [
    'response_data' => 'array',
];
}
