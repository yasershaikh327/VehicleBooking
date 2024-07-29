<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home');
});

Route::get('/Index', function () {
    return view('Home'); 
});

Route::get('/Vehicles', function () {
    return view('Vehicles'); 
});

Route::get('/DateRented', function () {
    return view('DateRented'); 
});

Route::get('/test-db', function () {
    try {
        \DB::connection()->getPdo();
        return 'Database connection is successful!';
    } catch (\Exception $e) {
        return 'Database connection failed: ' . $e->getMessage();
    }
});


Route::post('/submit-form', [UserController::class, 'submitForm'])->name('submit.form');
// web.php or api.php
Route::get('/home/getVehicles/{type}/{carType?}', [UserController::class, 'getVehicles']);
//Route::get('/home/vehicles/{type}/{carType?}', [UserController::class, 'getVehicles']);


// routes/web.php or routes/api.php
Route::post('/home/submitSelection', [UserController::class, 'submitSelection']);
//Route::post('/store', [UserController::class, 'store'])->name('store.booking');
Route::post('/store', [UserController::class, 'store'])->name('store');

Route::get('/home/cartypes', [UserController::class, 'getCarTypes']);



