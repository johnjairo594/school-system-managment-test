<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/subject/{subjectId}', [\App\Http\Controllers\GradeController::class, 'showStudentGrades'])->name('subject.show');
    Route::get('/subject/teacher/{studentId}', [\App\Http\Controllers\GradeController::class, 'showTeacherGrades'])->name('subjects.teacher.show');
    Route::delete('/delete-grades/{gradeId}', [\App\Http\Controllers\GradeController::class, 'destroy'])->name('grades.destroy');
    Route::put('/grades/{gradeId}', [\App\Http\Controllers\GradeController::class, 'update'])->name('grades.update');
    Route::post('/grades', [\App\Http\Controllers\GradeController::class, 'create'])->name('grades.create');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
