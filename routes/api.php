<?php

use App\Http\Controllers\CollegeController;
use Illuminate\Support\Facades\Route;

// الرابط هدا هو اللي حتفتحي بيه البيانات
Route::get('/colleges', [CollegeController::class, 'indexApi']);

Route::post('/colleges', [CollegeController::class, 'store']);       // للإضافة
Route::put('/colleges/{id}', [CollegeController::class, 'update']);   // للتعديل
Route::delete('/colleges/{id}', [CollegeController::class, 'destroy']); // للحذف