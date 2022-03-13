<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TenderController;
use App\Http\Controllers\Api\ProviderInformationController;
use App\Http\Controllers\Api\TypeWorkController;
use App\Http\Controllers\Api\chatController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\ReviewController;
/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'middleware' => 'api' , 'prefix' => 'auth' ] , function() {
    Route::post('/register' , [AuthController::class , 'register']);
    Route::post('/login' , [AuthController::class , 'login']);
    Route::post('/logout' , [AuthController::class , 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});
// start provider information
    Route::get('/allProvider',[ProviderInformationController::class,'allProvider']);
    Route::get('/providerDetails/{provider_id}/{user_id}',[ ProviderInformationController::class ,'providerDetails']);

// end provider information 
// start work type
    Route::get('/typeWork/{lan}' , [TypeWorkController::class , 'typeWork']);
// end work type

//start tender 
    Route::post('/sendSpecificTender/{user_id}' , [TenderController::class ,'sendSpecificTender']);
    Route::get('/startTender/{user_id}' , [TenderController::class ,'startTender']);
    Route::post('/sendTender' , [TenderController::class ,'sendTender']);
    Route::get('/allTenders/{user_id}' , [TenderController::class ,'allTenders']);
    Route::post('/sendInterested/{provider_id}/{tender_id}' ,[TenderController::class , 'sendInterested']);
    Route::get('/allInterested/{user_id}/{tender_id}' , [TenderController::class ,'allInterested']);
    Route::get('/connected/{interested_id}' , [TenderController::class ,'connected']);
    Route::get('/tendersConnected/{provider_id}' , [TenderController::class ,'tendersConnected']);
    Route::get('/closeDealByUser/{tender_id}/{user_id}' , [TenderController::class ,'closeDealByUser']);
    Route::get('/closeDealByProvider/{tender_id}/{user_id}' , [TenderController::class ,'closeDealByProvider']);
    Route::get('/removeInterested/{provider_id}/{tender_id}' , [TenderController::class ,'removeInterested']);
//end tender 

// start chat 
    Route::post('/sendMessage' ,[chatController::class , 'sendMessage']);
//end chat 

// start Package 
    Route::get('/allPackage/{lan}' ,[PackageController::class , 'allPackage']);
    Route::post('/chargePackage/{user_id}' ,[PackageController::class , 'chargePackage']);
//end Package 
// start Review 
Route::post('/addReview' ,[ReviewController::class , 'addReview']);
Route::get('/userReview/{user_id}' ,[ReviewController::class , 'userReview']);
Route::get('/deleteReview/{review_id}',[ReviewController::class , 'deleteReview']);
//end Review 