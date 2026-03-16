<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('course_code');
            $table->string('course_title');
            $table->integer('credit_hours');
            $table->string('grade');       // A, A-, B+, B, etc.
            $table->string('term');        // e.g. Fall 2023, Spring 2024
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};