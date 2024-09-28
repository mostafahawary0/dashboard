<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\NewsController;



 
Route::get('/login' , [AuthController::class,'login'])->name('login');
Route::post('/login' , [AuthController::class,'loginpost'])->name('login.post');
Route::get('/logout' , [AuthController::class,'logout'])->name('logout');


Route::get('languageConvert/{locale}',function($locale){

    if(in_array($locale,['en', 'ar','fr'])){
     session()->put('locale',$locale);
    }

    return redirect()->back();
    
})->name('languageConvert');


Route::prefix('dashboard')->group(function(){
    Route::group(['middleware' => 'auth'], function(){
     
Route::get('/' , [HomeController::class,'home'])->name('home');

Route::resource('/section' , SectionController::class);
Route::resource('/section' , SectionController::class);
Route::resource('/permissions' , PermissionsController::class);
Route::delete('/destroyOnePermissions/{id}' , [PermissionsController::class,'destroyOne'])->name('permissions.destroyOne');
Route::post('/updateAllPermissions/{uuid}' , [PermissionsController::class,'updateAll'])->name('permissions.updateAll');
Route::resource('/users' , UsersController::class);
Route::post('/registration' , [UsersController::class,'registrationpost'])->name('registration.post');
Route::post('/password' , [UsersController::class,'updatePass'])->name('update.password');
Route::get('/password' , [UsersController::class,'password'])->name('password');
Route::resource('/news' , NewsController::class);
Route::get('/section_news/{id}' , [NewsController::class,'news'])->name('news');
Route::get('/create_news/{id}' , [NewsController::class,'create_news'])->name('create.news');
Route::get('/news', [NewsController::class, 'search'])->name('news.search');
    });
      

});