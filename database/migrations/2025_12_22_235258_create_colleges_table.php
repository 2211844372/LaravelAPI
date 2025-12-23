<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('colleges', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // اسم الكلية
        $table->text('description')->nullable(); // وصف مختصر للكلية
        $table->string('icon')->default('fas fa-university'); // أيقونة الكلية للتصميم
        $table->integer('founded_year')->nullable(); // سنة التأسيس
        $table->string('dean_name')->nullable(); // اسم عميد الكلية
        $table->string('email')->nullable(); // البريد الإلكتروني للكلية
        $table->timestamps(); // يسجل وقت الإضافة والتعديل تلقائياً
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
