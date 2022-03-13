<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tender;
class TypeWork extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_of_work',
        'lan',
        'ar_id'
    ];

    public function tender(){
        return $this->hasMany('App\Tender');
    }
}
