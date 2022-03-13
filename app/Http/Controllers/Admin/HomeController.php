<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon;
use Validator;
use App\Models\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::all();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.index',compact('status_notification','notifications'));
    }
    
    // get notifications
    public function notifications(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $all_notification = Notification::where('lan',$lan)->get();
        $status_notification = 1;
        foreach($all_notification as $notification){
            $notification->status = 1;
            $notification->save();
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.notification',compact('notifications','status_notification','all_notification'));
    }
    public function deleteNotification($not_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notification = Notification::where('id',$not_id)->first();
        $notification->delete();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
    public function myAdmins(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $admins = Admin::all();
        return view('dashboard.admins',compact('notifications','status_notification','admins'));
    }
    public function addAdmin(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $admin =  Admin::create([
            'name'          => $request['name'],
            'email'         => $request['email'],
            'password'      => Hash::make($request['password']),
        ]);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','Added successfully');
        }else{
            return redirect()->back()->with('message','تم الإضافة بنجاح');
        }
    }
    public function deleteAdmin($admin_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $admins = Admin::all();
        if(count($admins) == 1){
            if($app_lan == 'en'){
                return redirect()->back()->with('message','there must be at least one admin');
            }else{
                return redirect()->back()->with('message','يجب ان يبقى على الأقل أدمن واحد');
            }
        }else{
            $admin = Admin::where('id',$admin_id)->first();
            $admin->delete();
            if($app_lan == 'en'){
                return redirect()->back()->with('message','deleted successfully');
            }else{
                return redirect()->back()->with('message','تم الحذف بنجاح');
            }
        }
    }
    public function updateAdmin(Request $request,$admin_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $admin = Admin::where('id',$admin_id)->first();

        if ($admin->email != $request->email) {
            $simular_email = Admin::where('email',$request->email)->get();
            if (count($simular_email) > 0) {
                return response()->json(['message' => 'email has taken']);
            }   
        }
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'password'  => ['required', 'string', 'min:6'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $data = [
            'name'          => $request['name'],
            'email'         => $request['email'],
            'password'      => Hash::make($request['password']),
        ];
        $admin->update();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated successfully');
        }else{
            return redirect()->back()->with('message','تم التعديل بنجاح');
        }
    }
    public function sendNotifications(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $providers = User::where('type','provider')->where('status','1')->get();
        return view('dashboard.send-notification',compact('notifications','status_notification','providers'));
    }
    public function sendTextNotification(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [
            'provider'        => ['required'],
            'notification_ar' => ['required'],
            'notification_en' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $users = User::all();
        if($request->user_id == 0){
            foreach($users as $user){
                $data_ar = [
                    'notification' => $request->notification_ar,
                    'sender'       => '0',
                    'user_id'      => $user->id,
                    'lan'          => '1',
                    'status'       => '1',
                    'type'         => '5',
                ];
                $notification_ar = Notification::create($data_ar);
                $data_en = [
                    'notification' => $request->notification_en,
                    'sender'       => '0',
                    'user_id'      => $user->id,
                    'lan'          => '1',
                    'status'       => '1',
                    'type'         => '5',
                    'ar_id'        => $notification_ar->id
                ];
                $notification_en = Notification::create($data_en);
            }
        }else{
            $data_ar = [
                'notification' => $request->notification_ar,
                'sender'       => '0',
                'user_id'      => $request->provider,
                'lan'          => '1',
                'status'       => '1',
                'type'         => '5',
            ];
            $notification_ar = Notification::create($data_ar);
            $data_en = [
                'notification' => $request->notification_en,
                'sender'       => '0',
                'user_id'     => $request->provider,
                'lan'          => '1',
                'status'       => '1',
                'type'         => '5',
                'ar_id'        => $notification_ar->id
            ];
            $notification_en = Notification::create($data_en);
        }
        if($app_lan == 'en'){
            return redirect()->back()->with('message','added successfully');
        }else{
            return redirect()->back()->with('message','تم الإضافة بنجاح');
        }
    }

}