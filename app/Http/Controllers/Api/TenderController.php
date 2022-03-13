<?php

namespace App\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\TypeWork;
use App\Models\Room;
use App\Models\TenderInterested;
use App\Models\Notification;
use App\Models\User;
use Validator;
use Image;
class TenderController extends Controller
{
    public function sendSpecificTender(Request $request,$user_id){
        $type_work = TypeWork::find($request->type_of_work);
        if($type_work->ar_id == null){
            $type_en = TypeWork::where('id',$type_work->id)->first();
            $type_gr = TypeWork::where('ar_id',$type_en->id)->first();
        }else{
            $type_gr = TypeWork::where('id',$type_work->id)->first();
            $type_en = TypeWork::where('id',$type_gr->ar_id)->first();
        }
        $validator = Validator::make($request->all(), [
            'text'        => ['required'],
            'space'       => ['required'],
            'location'    => ['required'],
            'time'        => ['required'],
            'price'       => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $tender =  Tender::create([
            'user_id'         => $user_id,
            'text'            => $request['text'],
            'space'           => $request['space'],
            'location'        => $request['location'],
            'time'            => $request['text'],
            'price'           => $request['price'],
            'type_of_work_en' => $type_en->id,
            'type_of_work_gr' => $type_gr->id,
            'status'          => 'available',
            'specifec'        => $request->provider_id
        ]);
        return response()->json([
            'status' => '200',
            'details' => $tender
        ]);
    }
    public function startTender($user_id){
        $tender = new Tender ;
        $tender->user_id = $user_id;
        $status->user_id = 'Draft';
        $tender->save(); 
        return response()->json([
            'status'  => '200',
            'details' => $tender,
        ]);
    }
    public function sendTender(Request $request){
        $type_work = TypeWork::find($request->type_of_work);
        // return response()->json($type_work);
        if($type_work->ar_id == null){
            $type_en = TypeWork::where('id',$type_work->id)->first();
            $type_gr = TypeWork::where('ar_id',$type_en->id)->first();
        }else{
            $type_gr = TypeWork::where('id',$type_work->id)->first();
            $type_en = TypeWork::where('id',$type_gr->ar_id)->first();
        }
        $validator = Validator::make($request->all(), [
            'text'        => ['required'],
            'space'       => ['required'],
            'location'    => ['required'],
            'time'        => ['required'],
            'price'       => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $tender = Tender::find($request->tender_id);
        $data = [
            'text'            => $request['text'],
            'space'           => $request['space'],
            'location'        => $request['location'],
            'time'            => $request['text'],
            'price'           => $request['price'],
            'type_of_work_en' => $type_en->id,
            'type_of_work_gr' => $type_gr->id,
            'status'          => 'available'
        ];
        $tender->update($data);
        
        return response()->json([
            'status' => '200',
            'details' => $tender
        ]);
    }
    public function storeRoom(Request $request){
        $validator = Validator::make($request->all(), [
            'room_wall'     => ['required'],
            'room_hight'    => ['required'],
            'room_color'    => ['required'],
            'furnished'     => ['required'],
            'tender_id'     => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        } 
        $room = Room::create([
            'room_wall'     => $request['room_wall'],
            'room_hight'    => $request['room_hight'],
            'room_color'    => $request['room_color'],
            'furnished'     => $request['furnished'],
            'tender_id'     => $request['tender_id'],
        ]);
        return response()->json([
            'status' => '200',
            'details' => $room
        ]);
    }
    public function allTenders($user_id){
        $tenders = Tender::where('status','available')->where('specifec','0')->orWhere('specifec',$user_id)->get();
        return response()->json([
            'status' => '200',
            'details' => $tenders
        ]);
    }
    public function sendInterested(Request $request,$provider_id,$tender_id){
        $tender = Tender::find($tender_id);
        $data = [
            'provider_id' => $provider_id,
            'tender_id'   => $tender_id,
            'user_id'     => $tender->user_id,
            'status'      => 'interested',
            'offer'       => $request->offer
        ];
        TenderInterested::create($data);
        return response()->json([
            'status' => '200',
            'details'=> 'added successfully'
        ]);
    }
    public function removeInterested($provider_id,$tender_id){
        $tender_interested = TenderInterested::where('provider_id',$provider_id)->where('tender_id',$tender_id)->first();
        $tender_interested->delete();
        return response()->json([
            'status' => '200',
            'details' =>'deleted successfully'
        ]);

    }
    public function allInterested($user_id,$tender_id){
        $interested = TenderInterested::where('user_id',$user_id)->where('tender_id',$tender_id)->get();
        return response()->json([
            'status' => '200',
            'details'=> $interested
        ]);
    }
    public function connected($interested_id){
        $Tender_interested = TenderInterested::find($interested_id);
        $Tender_interested->status = 'connected';
        $Tender_interested->save();
        $data_en = [
            'notification' => 'your offer has been accepted',
            'user_id'      => $Tender_interested->user_id,
            'status'       => '0',
            'lan'          => '1'
        ];
        $notification_en = Notification::create($data_en);
        $data_gr = [
            'notification' => 'your offer has been accepted',
            'user_id'      => $Tender_interested->user_id,
            'status'       => '0',
            'ar_id'        => $notification_en->id,
            'lan'          => '2'
        ];
        $notification_gr = Notification::create($data_gr);
        return response()->json([
            'status' => '200',
            'details'=> 'connected successfully'
        ]);
    }
    public function tendersConnected($provider_id){
        $tenders_connected = TenderInterested::where('provider_id',$provider_id)->where('status','connected')->get();
        return response()->json([
            'status' => '200',
            'details'=> $tenders_connected
        ]);
    }
    public function closeDealByUser($tender_id,$user_id){
        $tender_interisted = TenderInterested::where('tender_id',$tender_id)->first();
        $tender_interisted->accept_user = 1;
        $tender_interisted->save();        
        if($tender_interisted->accept_user == 1 && $tender_interisted->accept_provider == 1){
            $tender_interisted->status = 'deal';
            $tender_interisted->save();

            $tender = Tender::where('id',$tender_interisted->tender_id)->first();
            $tender->status = 'deal';

            $space = $tender->space;
            if($space < 30){
                $tender->app_earning = 12;
                $user = User::where('id',$tender->user_id)->first();
                $result = $user->rest_of_package - 12 ;
                if($result < 0){
                    return response()->json([
                        'message' => 'الباقة لا تكفي اشحن رصيدك وحاول مجددا',
                        'data'    => $user->rest_of_package
                    ]);
                }
                $user->rest_of_package = $result;
                $user->save();
            }elseif($space >= 30 && $space < 50){
                $tender->app_earning = 20;
                $user = User::where('id',$tender->user_id)->first();
                $result = $user->rest_of_package - 20 ;
                if($result < 0){
                    return response()->json([
                        'message' => 'الباقة لا تكفي اشحن رصيدك وحاول مجددا',
                        'data'    => $user->rest_of_package
                    ]);
                }
                $user->rest_of_package = $result;
                $user->save();
            }elseif($space >= 50){
                $tender->app_earning = 35;
                $user = User::where('id',$tender->user_id)->first();
                $result = $user->rest_of_package - 35 ;
                if($result < 0){
                    return response()->json([
                        'message' => 'الباقة لا تكفي اشحن رصيدك وحاول مجددا',
                        'data'    => $user->rest_of_package
                    ]);
                }
                $user->rest_of_package = $result;
                $user->save();
            }
            $tender->save();
        }


        return response()->json([
            'status' => '200',
            'details'=> 'accepted successfully'
        ]);  
    }
    public function closeDealByProvider($tender_id,$provider_id){
        $tender_interisted = TenderInterested::where('tender_id',$tender_id)->first();
        $tender_interisted->accept_provider = 1;
        $tender_interisted->save();
        if($tender_interisted->accept_user == 1 && $tender_interisted->accept_provider == 1){
            $tender_interisted->status = 'deal';
            $tender_interisted->save();

            $tender = Tender::where('id',$tender_interisted->tender_id)->first();
            $tender->status = 'deal';

            $space = $tender->space;
            if($space < 30){
                $tender->app_earning = 12;
                $user = User::where('id',$tender->user_id)->first();
                $result = $user->rest_of_package - 12 ;
                if($result < 0){
                    return response()->json([
                        'message' => 'الباقة لا تكفي اشحن رصيدك وحاول مجددا',
                        'data'    => $user->rest_of_package
                    ]);
                }
                $user->rest_of_package = $result;
                $user->save();
            }elseif($space >= 30 && $space < 50){
                $tender->app_earning = 20;
                $user = User::where('id',$tender->user_id)->first();
                $result = $user->rest_of_package - 20 ;
                if($result < 0){
                    return response()->json([
                        'message' => 'الباقة لا تكفي اشحن رصيدك وحاول مجددا',
                        'data'    => $user->rest_of_package
                    ]);
                }
                $user->rest_of_package = $result;
                $user->save();
            }elseif($space >= 50){
                $tender->app_earning = 35;
                $user = User::where('id',$tender->user_id)->first();
                $result = $user->rest_of_package - 35 ;
                if($result < 0){
                    return response()->json([
                        'message' => 'الباقة لا تكفي اشحن رصيدك وحاول مجددا',
                        'data'    => $user->rest_of_package
                    ]);
                }
                $user->rest_of_package = $result;
                $user->save();
            }
            $tender->save();
        }
        return response()->json([
            'status' => '200',
            'details'=> 'accepted successfully'
        ]);  
    }
}
