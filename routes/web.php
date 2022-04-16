<?php

use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Auth\LectureAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');


Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.admin');
    // Subject Route
    Route::get('/subject', [SubjectController::class, 'ShowSubject'])->name('admin.showSubject');
    Route::post('/subject', [SubjectController::class, 'AddSubject'])->name('admin.addSubject');
    
    Route::get('/subject/edit', [SubjectController::class, 'ShowEditSubject'])->name('admin.showEditSubject');
    Route::post('/subject/edit', [SubjectController::class, 'EditSubject'])->name('admin.editSubject');

    Route::post('/subject/delete', [SubjectController::class, 'DeleteSubject'])->name('admin.deleteSubject');

    // Role Route
    Route::get('/role', [RoleController::class, 'ShowRole'])->name('admin.showRole');
    Route::post('/role', [RoleController::class, 'AddRole'])->name('admin.addRole');

    Route::get('/role/edit', [RoleController::class, 'ShowEditRole'])->name('admin.showEditRole');
    Route::post('/role/edit', [RoleController::class, 'EditRole'])->name('admin.editRole');

    Route::post('/role/delete', [RoleController::class, 'DeleteRole'])->name('admin.deleteRole');


    // Lecture Route
    Route::get('/lecture', [LectureController::class, 'ShowLectureList'])->name('admin.showLectureList');
    Route::get('/lecture/create', [LectureController::class, 'ShowCreateLecture'])->name('admin.createLectureView');
    Route::post('/lecture/create', [LectureController::class, 'CreateLecture'])->name('admin.createLecture');
    Route::get('/lecture/edit', [LectureController::class, 'UpdateLectureInfoView'])->name('admin.updateLectureView');
    Route::post('/lecture/edit', [LectureController::class, 'UpdateLecture'])->name('admin.updateLecture');
    Route::post('/lecture/delete', [LectureController::class, 'DeleteLecture'])->name('admin.deleteLecture');

});

Route::view('/lecture/login', 'lecture.lectureLogin')->name('LectureLoginView');
Route::post('/lecture/login', [LectureAuthController::class, 'Login'])->name('LectureLogin');
Route::post('/lecture/logout', [LectureAuthController::class, 'Logout'])->name('LectureLogout');

Route::prefix('lecture')->middleware('auth:lecture')->group(function(){
    Route::view('/profile', 'lecture.lectureProfile')->name('LectureProfile');
});
