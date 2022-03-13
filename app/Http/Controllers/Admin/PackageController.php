<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function allPackage(){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        $packages = Package::where('lan',$lan)->get();
        return view('dashboard.package.all-package',compact('packages'));
    }
    public function showAddPackage(){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        if($lan == '1'){
            return view('dashboard.package.add-package-en');
        }else{
            return view('dashboard.package.add-package-gr');
        }
    }
    public function addPackage(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        $data_en = [
            'name'=>$request->name_en,
            'price'=>$request->price_en,
            'lan'=>'1'
        ];
        $package_ar = Package::create($data_en);
        $data_gr = [
            'name'=>$request->name_gr,
            'price'=>$request->price_gr,
            'lan'=>'2',
            'ar_id'=>$package_ar->id,
        ];
        $package_en = Package::create($data_gr);
        if($lan == '1'){
            return redirect()->back()->with('message','added successfully');
        }else{
            return redirect()->back()->with('message','added successfully');
        }
    }
    public function editPackage($pac_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        if($lan == '1'){
            $package_en = Package::where('lan','1')->where('id',$pac_id)->first();
            $package_gr = Package::where('lan','2')->where('id',$package_en->id)->first();
        }else{
            $package_gr = Package::where('lan','2')->where('id',$pac_id)->first();
            $package_en = Package::where('lan','1')->where('id',$package_gr->ar_id)->first();
        }
        if($lan == '1'){
            return view('dashboard.package.edit-package-en',compact('package_gr','package_en'));
        }else{
            return view('dashboard.package.edit-package-gr',compact('package_gr','package_en'));
        }
    }
    public function updatePackage(Request $request,$pac_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        if($lan == '1'){
            $package_en = Package::where('lan','1')->where('id',$pac_id)->first();
            $package_gr = Package::where('lan','2')->where('id',$package_en->id)->first();
        }else{
            $package_gr = Package::where('lan','2')->where('id',$pac_id)->first();
            $package_en = Package::where('lan','1')->where('id',$package_en->ar_id)->first();
        }
        $data_en = [
            'name'=>$request->name_en,
            'price'=>$request->price_en,
            'lan'=>'1'
        ];
        $data_gr = [
            'name'=>$request->name_gr,
            'price'=>$request->price_gr,
            'lan'=>'2',
            'ar_id'=>$data_en->id,
        ];
        $package_en->update($data_en);
        $package_gr->update($data_gr);
        if($lan == '1'){
            return redirect()->back()->with('message','update successfully');
        }else{
            return redirect()->back()->with('message','added successfully');
        }
        
    }
    public function deletePackage($pac_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        if($lan == '1'){
            $package_en = Package::where('lan','1')->where('id',$pac_id)->first();
            $package_gr = Package::where('lan','2')->where('id',$package_en->id)->first();
        }else{
            $package_gr = Package::where('lan','2')->where('id',$pac_id)->first();
            $package_en = Package::where('lan','1')->where('id',$package_gr->ar_id)->first();
        }
        $package_en->delete();
        $package_gr->delete();
        return redirect()->back();
    }
}
