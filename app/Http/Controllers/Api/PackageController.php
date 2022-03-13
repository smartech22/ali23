<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\TypeWork;
use App\Models\TenderInterested;
use App\Models\Notification;
use App\Models\User;
use App\Models\Package;
class PackageController extends Controller
{
    public function allPackage($lan){
        $packages = Package::where('lan',$lan)->get();
        return response()->json([
            'status'  =>'200',
            'details' => $packages 
        ]);
    }
    public function chargePackage(Request $request ,$user_id){
        $package = Package::where('id',$request->package_id)->first();
        $user = User::where('id',$user_id)->first();
        $user->rest_of_package = $user->rest_of_package + $package->price ;
        $user->save();
        return response()->json([
            'status' => '200',
            'details'=> 'charged successfully'
        ]);
    }
}
