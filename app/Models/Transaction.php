<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent_id',
        'agent_name',
        'transaction_name',
        'transaction_details',
        'bill_details'
    ];
}
