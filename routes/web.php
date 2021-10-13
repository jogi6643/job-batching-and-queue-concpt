<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
Route::get('/', function () {
    
    return view('welcome');
});
Route::get('/upload',function () {
return view('upload-file');
});
Route::post('/upload',[SalesController::class,'upload']);
Route::get('/batch',[SalesController::class,'batch']);
Route::get('/batch/in-progress', [SalesController::class, 'batchInProgress']);
