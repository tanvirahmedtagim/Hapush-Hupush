<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Middleware\Admin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/admin')->group(function(){
    Route::match(['get','post'],'login',[AdminController::class,'login']);
    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard',[AdminController::class,'dashboard']);
        Route::match(['get','post'],'update-password',[AdminController::class,'updatePassword']);
        Route::match(['get','post'],'update-details',[AdminController::class,'updateDetails']);
        Route::post('check-current-password',[AdminController::class,'checkCurrentPassword']);
        Route::get('logout',[AdminController::class,'logout']);

        //Partner
        Route::resources([
        'prefer' => PreferController::class,
        'contact' => ContactController::class,
        'logo' => LogoController::class,
        'about' => AboutController::class,
        'category' => CategoryController::class,
        'partner' => PartnerController::class,
        'slider' => SliderController::class,
        // 'booking' => BookingController::class
    ]);




    });

});
