<?php

namespace App\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;

class chatController extends Controller
{
    public function sendMessage(Request $request){
        $data = [
            'user_id'     => $request->user_id,
            'provider_id' => $request->provider_id,
            'message'     => $request->message,
        ];
        $chat = Chat::create($data);
        return response()->json([
            'status' => '200',
            'details'=> $chat
        ]);
    }
    public function allCollectionChat($user_id){
        // $ids = DB::table('clients_campaigns')
        //     ->where('user_id', $request->user_id)
        //     ->get(['company_id', 'campaign_id']);

        // if ($ids->notEmpty()) {
        //     $companyNames = Company::whereIn('id', $ids->pluck('company_id'))
        //         ->pluck('name');
        //     $campaignNames = Campaign::whereIn('id', $ids->pluck('campaign_id'))
        //         ->pluck('name');
        // }
        $collection = Chat::where('user_id',$user_id)->get();
    }
}
