<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
class ReviewController extends Controller
{
    public function addReview(Request $request){
        $data = [
            'user_id'     => $request->user_id,
            'provider_id' => $request->provider_id,
            'comment'     => $request->comment,
            'rate'        => $request->rate,
        ];
        Review::create($data);
        return redirect()->json([
            'status' => '200',
            'details'=> 'added successfully'
        ]);
    }
    public function userReview($user_id){
        $reviews = Review::where('provider_id',$user_id)->get();
        $review_details = [];
        foreach($reviews as $review){
            $user = User::where('id',$review->user_id)->first();
            $final = array('review'=>$review,'user'=>$user);
            array_push($review_details,$final);
        }
        return response()->json([
            'status' => '200',
            'details'=> $review_details
        ]);
    }
    public function deleteReview($review_id){
        $review = Review::where('id',$review_id)->first();
        $review->delete();
        return response()->json([
            'status' => '200',
            'details' => 'deleted successfully'
        ]);
    }
}