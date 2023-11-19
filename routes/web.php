<?php

use App\Http\Controllers\FeedbackController;
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

Route::get('/', [FeedbackController::class, 'index']);
Route::group(['middleware' => 'throttle:3000,240'], function (){
    Route::post('/', [FeedbackController::class, 'store'])->name('feedback.store');
});
