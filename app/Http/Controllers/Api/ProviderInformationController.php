<?php

namespace App\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TenderInterested;
use App\Models\ProviderImage;
use App\Models\Notification;
class ProviderInformationController extends Controller
{
    public function allProvider(){
        $providers = User::where('type','provider')->where('status','1')->get();
        return response()->json([
            'status'  =>'200',
            'details' =>$providers
        ], 200);
    }
    public function providerDetails($provider_id,$user_id){
        $provider = User::find($provider_id)->first();
        $provider_images = ProviderImage::where('provider_id',$provider_id)->first();
        $connected = TenderInterested::where('user_id',$user_id)->where('provider_id',$provider_id)->where('status','connected')->first();
        if($connected == null){
            return response()->json([
                'status'  =>'200',
                'provider_nume' =>$provider->name,
                'image' =>$provider->image,
                'business_license'=>$provider->business_license,
                'experience_certificate'=>$provider->experience_certificate,
                'address'=>$provider->address
            ], 200);
        }else{
            return response()->json([
                'status'  =>'200',
                'provider' =>$provider,
                'provider_images' =>$provider_images,
            ], 200);
        }

    }   
}
