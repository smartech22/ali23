<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeWork;
use App\Models\Notification;
use Validator;
class TypeWorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function allTypeWork(){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        $types = TypeWork::where('lan',$lan)->get();
        $types_lan = TypeWork::all();
        return view('dashboard.type-work.all-type-work',compact('types','types_lan'));
        
    }
    // public function showAddWork(){
    //     return view('dashboard.type-work.add-work-type');
    // }
    public function storeWorkType(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [
            'type_of_work_en'=> ['required'],
            'type_of_work_gr'=> ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $data_en = [
            'type_of_work'=>$request->type_of_work_en,
            'lan' => 1,
            
        ];
        $data_en = TypeWork::create($data_en);
        $data_gr = [
            'type_of_work'=>$request->type_of_work_gr,
            'lan' => 2,
            'ar_id' => $data_en->id
        ];
        $data_en = TypeWork::create($data_gr);
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        if($lan == 1){
            return redirect()->back()->with('message','added successfully');
        }else{
            return redirect()->back()->with('message','added successfully');
        }
        
    }
    // public function editWorkType($type_id){
    //     $app_lan = app()->getLocale();
    //     if($app_lan == 'en'){ $lan = '1';};
    //     if($app_lan == 'gr'){ $lan = '2';};
    //     if($lan == '1'){
    //         $type_en = TypeWork::where('id',$type_id)->first();
    //         $type_gr = TypeWork::where('ar_id',$type_en->id)->first();
    //     }else{
    //         $type_gr = TypeWork::where('ar_id',$type_id)->first();
    //         $type_en = TypeWork::where('id',$type_gr->ar_id)->first();
    //     }
    //     if($lan == '1'){
    //         return view('dashboard.type-work.edit-work-type',compact('type_en','type_gr'));
    //     }else{
    //         return view('dashboard.type-work.edit-work-type',compact('type_en','type_gr'));
    //     }
    // }
    public function updateWorkType(Request $request ,$type_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        if($lan == '1'){
            $type_en = TypeWork::where('id',$type_id)->first();
            $type_gr = TypeWork::where('ar_id',$type_en->id)->first();
        }else{
            $type_gr = TypeWork::where('id',$type_id)->first();
            $type_en = TypeWork::where('id',$type_gr->ar_id)->first();
        }
        $data_en = [
            'type_of_work'=>$request->type_of_work_en,
            'lan' => 1,
            
        ];
        $data_gr = [
            'type_of_work'=>$request->type_of_work_gr,
            'lan' => 2,
        ];
        $type_en->update($data_en);
        $type_gr->update($data_gr);
        if($lan == '1'){
            return redirect()->back()->with('message','updated successfully');
        }else{
            return redirect()->back()->with('message','updated successfully');
        }
    }
    public function deleteTypeWork($type_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        if($lan == '1'){
            $type_en = TypeWork::where('id',$type_id)->first();
            $type_gr = TypeWork::where('ar_id',$type_en->id)->first();
        }else{
            $type_gr = TypeWork::where('id',$type_id)->first();
            $type_en = TypeWork::where('id',$type_gr->ar_id)->first();
        }
        $type_en->delete();
        $type_gr->delete();
        return redirect()->back(); 
    }
}
