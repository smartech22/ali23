<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TenderImage;
use App\Models\TypeWork;
class Tender extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'text',
        'space',
        'location',
        'time',
        'price',
        'type_of_work_en',
        'type_of_work_gr',
        'specifec',
        'app_earning',
    ];

    public function tenderImage(){
        return $this->hasMany('App\TenderImage');
    }
    public function typeWork() {
        return $this->belongTo('App\TypeWork');
    }
}
