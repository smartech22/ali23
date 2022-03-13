<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tender;
class TenderImage extends Model
{
    use HasFactory;
    protected $fillable = ['tender_id','image'];

    public function tenders() {
        return $this->belongTo('App\Tender');
    }
}
