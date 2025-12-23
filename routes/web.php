<?php
use App\Http\Controllers\CollegeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/stats', [StatsController::class, 'index']);
Route::get('/', function () {
    return view('home'); // اسم الملف home.blade.php
});



 Route::get('/manage', [CollegeController::class, 'index']);