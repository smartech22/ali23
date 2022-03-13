<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoomImage;
class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_wall',
        'room_hight',
        'room_color',
        'furnished',
        'tender_id'
    ];

    public function roomImage(){
        return $this->hasMany('App\RoomImage');
    }
}
