<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','namespace'=>'admin'],function(){
    Route::resource('/dashboard','DashboardController');
    Route::resource('/about','AboutController');
    Route::post('/about_edit','AboutController@editAbout')->name('edit_about');

    Route::resource('/skill','SkillController');
    Route::post('skill_edit','SkillController@editSkill')->name('edit_skill');

    Route::resource('/service','ServiceController');
    Route::post('service_edit','ServiceController@editService')->name('edit_service');

    Route::resource('/contact','ContactController');
    Route::post('contact_edit','ContactController@editContact')->name('edit_contact');
    
});
