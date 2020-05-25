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
    if(Auth::check()){
        return redirect()->route('home');
    }
    return view('welcome');
});

Route::get('/informations', function () {
    return view('infos');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/authenticated-user', 'AuthenticatedUserController@fetch');

Route::get('/getJobs', 'JobController@index');

Route::get('/getPractitioners', 'PracticionnerController@index');

Route::post('/getPractitionerItems', 'PracticionnerController@getItem');

Route::post('/getSelectedPractitioner', 'PracticionnerController@getPractitionner');

Route::post('/updateProfile', 'ProfileController@update');

Route::post('/updateTheme', 'ProfileController@updateTheme');

Route::post('/addComment', 'CommentController@store');

Route::post('/image/store', 'ImageController@store');

Route::post('/createSchedule', 'ScheduleController@store');

Route::post('/getMyAppointments', 'AppointmentController@myAppointments');

Route::post('/createAppointment', 'AppointmentController@store');

Route::post('/deleteAppointment', 'AppointmentController@destroy');

Route::post('/getMyScheduleAppointments', 'AppointmentController@index');



