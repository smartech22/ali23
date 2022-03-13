<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\TypeWork;
use App\Models\User;
use App\Models\TenderInterested;
class TenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function allTender(){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'gr'){ $lan = '2';};
        $tenders = Tender::all();
        $tender_details = [];
        foreach($tenders as $tender){
            $user = User::where('id',$tender->user_id)->first();
            if($lan == '1'){
                $type_work = TypeWork::where('id',$tender->type_of_work_en)->first();
            }else{
                $type_work = TypeWork::where('id',$tender->type_of_work_gr)->first();
            }
            $final = array('tender'=>$tender,'user'=>$user,'type_work'=>$type_work);
            array_push($tender_details,$final);
        }
        return view('dashboard.tender.all-tender',compact('tender_details'));
    }
    public function connectedTenders(){
        $connected_tenders = TenderInterested::where('status','connected')->get();
        $connected_details = [];
        foreach($connected_tenders as $connected_tender){
            $provider = User::where('id',$connected_tender->provider_id)->first();
            $user = User::where('id',$connected_tender->user_id)->first();
            $tender = Tender::where('id',$connected_tender->tender_id)->first();
            $final = array('provider'=>$provider,'user'=>$user,'tender'=>$tender,'connected_tender'=>$connected_tender);
            array_push($connected_details ,$final);
        }
        // dd($connected_details);
        return view('dashboard.tender.connected-tender',compact('connected_details'));
    }
}
