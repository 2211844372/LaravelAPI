<?php

use App\Http\Controllers\CollegeController;
use Illuminate\Support\Facades\Route;

// الرابط هدا هو اللي حتفتحي بيه البيانات
Route::get('/colleges', [CollegeController::class, 'indexApi']);