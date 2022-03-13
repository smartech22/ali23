<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Models\User;
use App\Models\TypeWork;
use App\Models\Package;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function allUser(){
        $users = User::where('type','user')->get();
        return view('dashboard.user.all-user',compact('users'));
    }
    public function edituser($user_id){
        $user = User::find($user_id);
        return view('dashboard.user.edit-user',compact('user'));
    }
    public function updateUser(Request $request , $user_id){
        $user = User::find($user_id);
        $data = [
            'name'                   => $request['name'],
            'mobile'                 => $request['mobile'],
            'address'                => $request->address,
        ];
        $user->update($data);
        return redirect()->back();
    }
    public function allprovider(){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        $providers = User::where('type','provider')->where('status','1')->get();
        $provider_details = [];
        foreach($providers as $provider){
            if($lan == '1'){
                $package = Package::where('id',$provider->package_id)->first();
            }else{
                $package = Package::where('id',$provider->package_id)->first();
            }
            $final = array('provider'=>$provider,'package'=>$package);
            array_push($provider_details,$final);
            
        }
        return view('dashboard.provider.all-provider',compact('provider_details'));
    }
    public function requestProvider(){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        $providers = User::where('type','provider')->where('status','0')->get();
        $provider_details = [];
        foreach($providers as $provider){
            if($lan == '1'){
                $package = Package::where('id',$provider->package_id)->first();
            }else{
                $package = Package::where('id',$provider->package_id)->first();
            }
            $final = array('provider'=>$provider,'package'=>$package);
            array_push($provider_details,$final);
            
        }
        return view('dashboard.provider.request-provider',compact('provider_details'));
    }
    public function acceptProvider(Request $request,$provider_id) {
        $provider = User::find($provider_id);
        $provider->status = '1';
        $provider->save();
        $package  = Package::where('id',$provider->package_id);
        $data = [
            'name'                   => $provider->name,
            'email'                  => $provider->email,
            'subject'                => 'Your information has been accepted as a service provider',
            'mobile'                 => $provider->mobile,
            'address'                => $provider->address,
            'cr_number'              => $provider->cr_number,
            'experience_certificate' => $provider->experience_certificate,
            'business_license'       => $provider->business_license,
            'bank_account_number'    => $provider->bank_account_number,
            'company_link'           => $provider->company_link,
            'package'                => $package->name
        ];
        Mail::send('mail.email', $data, function($message) use ($data) {
           $message->to($provider->email, 'Message from website')->subject
              ($data['subject']);
           $message->from($data['email'], $data['name']);
        });
        
      return response()->json('accepted successfully');
    }
    public function editProvider($provider_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $provider = User::where('id',$provider_id)->first();
        $package = Package::where('id',$provider->package_id)->first();
        return view('dashboard.provider.edit-provider',compact('provider'));
    }
    public function blockProvider($provider_id){
        $provider = User::where('id',$provider_id)->first();
        $provider->status = '2';
        $provider->save();
        return redirect()->back();
    }
    public function activeProvider($provider_id){
        $provider = User::where('id',$provider_id)->first();
        $provider->status = '1';
        $provider->save();
        return redirect()->back();
    }
    public function blockedProviders(){
        $providers = User::where('type','provider')->where('status','2')->get();
        return view('dashboard.provider.blocked-provider',compact('providers'));
    }
    
}
