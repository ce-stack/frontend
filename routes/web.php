<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\MobileAuthController;
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


Route::get('/verify-phone-number', [MobileAuthController::class, 'showVerificationForm'])->name('verify-phone-number-form');

Route::post('/verify-phone-number', [MobileAuthController::class, 'verifyPhoneNumber'])->name('verify-phone-number');

Route::get('/verify-code', [MobileAuthController::class, 'showVerificationCodeForm'])->name('verify-code-form');

Route::post('/verify-code', [MobileAuthController::class, 'verifyPhoneNumberAndCode'])->name('verify-phone-number-and-code');


Route::post('/upload-image', [ImageController::class, 'uploadImage']);
Route::put('/approve-image/{id}', [ImageController::class, 'approveImage']);


