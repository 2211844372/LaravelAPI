<?php
use App\Http\Controllers\CollegeController;
use Illuminate\Support\Facades\Route;

// 1. رابط الصفحة الرئيسية (Home)
Route::get('/', function () {
    return view('home'); 
});

// 2. رابط صفحة إدارة الكليات (هذا اللي تبيه يفتح صفحة الـ Vue)
Route::get('/manage', [CollegeController::class, 'index']);

// 3. أي روابط أخرى (زي الإحصائيات لو عندك ملف StatsController)
// Route::get('/api/stats', [StatsController::class, 'index']);