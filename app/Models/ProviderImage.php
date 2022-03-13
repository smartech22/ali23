<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'front_ID_photo',
        'back_ID_photo',
        'back_craft_card_photo',
        'front_craft_card_photo',
    ];
}
