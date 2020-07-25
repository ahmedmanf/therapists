<?php

use App\Therapist;
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

Route::get('/', 'HomePageController@index')->name('index');
Route::get('/therapist', 'TherapistController@ajax')->name('therapist');
Route::get('/therapist/{therapist}', 'TherapistController@show');
Route::post('/reserve', 'ReservationController@reserve')->name('reserve');

/**
 * auth routes
 */
Auth::routes();
/** Dashboard routes */

Route::group(
    ['middleware' => 'auth'],
    function() {
        Route::prefix('dashboard')->group(function () {
            /** list therapist view */
            Route::get('therapists', 'TherapistController@list')->name('therapists');
            /** search in therapist */
            Route::post('therapists', 'TherapistController@search')->name('therapists_search');
            /** add therapist save */
            Route::post('therapist/add', 'TherapistController@store')->name('therapists_add');
            /** update therapist view */
            Route::get('therapists/{therapist}/edit', 'TherapistController@edit')->name('therapists_edit');
            /** add therapist save */
            Route::patch('therapist/{therapist}/edit', 'TherapistController@update')->name('therapists_update');
            /** delete therapist */
            Route::delete('therapists/{therapist}', 'TherapistController@destroy')->name('therapists_destroy');
            /** list reservations requests */
            Route::get('reservations', 'ReservationController@list')->name('reservations');
            /** search in reservations */
            Route::post('reservations', 'ReservationController@list')->name('reservations_search');
            /** delete reservations */
            Route::delete('reservations/{reservation}', 'ReservationController@destroy')->name('reservations_destroy');
        });
    }
);

