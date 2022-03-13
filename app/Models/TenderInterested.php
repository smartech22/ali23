<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderInterested extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'tender_id',
        'user_id',
        'status',
        'offer',
        'accept_user',
        'accept_provider',
    ];
}
