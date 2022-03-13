<?php
// admin controller
  use Illuminate\Support\Facades\Route;
  use App\Http\Controllers\Admin\HomeController;
  use App\Http\Controllers\Admin\TenderController;
  use App\Http\Controllers\Admin\Auth\LoginController;
  use App\Http\Controllers\Admin\PackageController;
  use App\Http\Controllers\Admin\TypeWorkController;
  use App\Http\Controllers\Admin\UserController;
// end admin controller 
//front controller  

use App\Http\Controllers\Auth\LoginFrontController;

//end front controller 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::namespace("Admin")->prefix('admin')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('admin.home');

    Route::namespace('Auth')->group(function(){
      Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login');
      Route::post('/login',[LoginController::class,'login']);
      Route::post('/logout',[LoginController::class,'logout'])->name('admin.logout');
    });
      Route::get('/myAdmins',[HomeController::class,'myAdmins']);
      Route::get('/deleteAdmin/{admin_id}',[HomeController::class,'deleteAdmin']);
      Route::post('/addAdmin',[HomeController::class,'addAdmin']);
      Route::post('/updateAdmin/{admin_id}',[HomeController::class,'updateAdmin']);
      // start  index
        Route::get('/index',[IndexController::class,'carsReport']);
      //end user
      // start user
        Route::get('/allUser',[UserController::class,'allUser']);
        Route::get('/edituser/{user_id}',[UserController::class,'edituser']);
        Route::post('/updateUser/{user_id}',[UserController::class,'updateUser']);
      //end user 
      // start provider
        Route::get('/allprovider',[UserController::class,'allprovider']);
        Route::get('/requestProvider',[UserController::class,'requestProvider']);
        Route::get('/acceptProvider',[UserController::class,'acceptProvider']);
        Route::get('/editProvider/{provider_id}',[UserController::class,'editProvider']);
        Route::post('/updateProvider/{provider_id}',[UserController::class,'updateProvider']);
        Route::get('/blockProvider/{provider_id}',[UserController::class,'blockProvider']);
        Route::get('/activeProvider/{provider_id}',[UserController::class,'activeProvider']);
        Route::get('/blockedProviders',[UserController::class,'blockedProviders']);
      //end provider 

      // start Package
        Route::get('/allPackage',[PackageController::class,'allPackage']);
        Route::get('/showAddPackage',[PackageController::class,'showAddPackage']);
        Route::post('/addPackage',[PackageController::class,'addPackage']);
        Route::get('/editPackage/{pac_id}',[PackageController::class,'editPackage']);
        Route::post('/updatePackage/{pac_id}',[PackageController::class,'updatePackage']);
        Route::get('/deletePackage/{pac_id}',[PackageController::class,'deletePackage']);
      //end Package 

      // start Tender
        Route::get('/allTender',[TenderController::class,'allTender']);
        Route::get('/connectedTenders',[TenderController::class,'connectedTenders']);
      //end Tender 

      // start TypeWork
        Route::get('/allTypeWork',[TypeWorkController::class,'allTypeWork']);
        Route::post('/storeWorkType',[TypeWorkController::class,'storeWorkType']);
        Route::get('/editWorkType/{type_id}',[TypeWorkController::class,'editWorkType']);
        Route::post('/updateWorkType/{type_id}',[TypeWorkController::class,'updateWorkType']);
        Route::get('/deleteTypeWork/{type_id}',[TypeWorkController::class,'deleteTypeWork']);
      //end TypeWork 

      // notifications 
        Route::get('/notifications',[HomeController::class,'notifications']);
        Route::get('/deleteNotification/{not_id}',[HomeController::class,'deleteNotification']);
        Route::get('/sendNotifications',[HomeController::class,'sendNotifications']);
        Route::post('/sendTextNotification',[HomeController::class,'sendTextNotification']);
      // notifications 

      
});
Route::get('/change-language/{locale}', function ($locale) {
  App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});
