<?php

namespace App\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\TypeWork;
class TypeWorkController extends Controller
{
    public function typeWork($lan){
        $types = TypeWork::where('lan',$lan)->get();
        return response()->json([
            'status' => '200',
            'details'=> $types
        ]);
    }
}
