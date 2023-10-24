<?php

use App\Http\Controllers\API\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']); 

//get a specific student

Route::get('/students/{id}',[StudentController::class,'show']);

//edit a student info
 Route::get('students/{id}/edit',[StudentController::class,'edit']);
 Route::put('students/{id}/edit',[StudentController::class,'update']);

 //delete
 Route::delete('students/{id}/delete',[StudentController::class,'destroy']);