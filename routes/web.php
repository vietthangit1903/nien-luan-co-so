<?php

use App\Http\Controllers\Admin\AdminLectureController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Auth\LectureAuthController;
use App\Http\Controllers\LectureController;
use Illuminate\Support\Facades\Route;
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
    Route::get('/lecture', [AdminLectureController::class, 'ShowLectureList'])->name('admin.showLectureList');
    Route::get('/lecture/create', [AdminLectureController::class, 'ShowCreateLecture'])->name('admin.createLectureView');
    Route::post('/lecture/create', [AdminLectureController::class, 'CreateLecture'])->name('admin.createLecture');
    Route::get('/lecture/edit', [AdminLectureController::class, 'UpdateLectureInfoView'])->name('admin.updateLectureView');
    Route::post('/lecture/edit', [AdminLectureController::class, 'UpdateLecture'])->name('admin.updateLecture');
    Route::post('/lecture/delete', [AdminLectureController::class, 'DeleteLecture'])->name('admin.deleteLecture');
});

Route::get('/lecture/login', [LectureAuthController::class, 'ShowLoginForm'])->name('LectureLoginView');
Route::post('/lecture/login', [LectureAuthController::class, 'Login'])->name('LectureLogin');

Route::prefix('lecture')->middleware('auth:lecture')->group(function () {
    Route::post('/logout', [LectureAuthController::class, 'Logout'])->name('LectureLogout');
    Route::get('/change_password', [LectureAuthController::class, 'ShowChangePassword'])->name('LectureChangePassword');
    Route::post('/change_password', [LectureAuthController::class, 'ChangePassword']);

    Route::view('/profile', 'lecture.lectureProfile')->name('LectureProfile');
    Route::view('/profile/update', 'lecture.lectureUpdateProfile')->name('LectureUpdateProfile');
    Route::post('/profile/update', [LectureController::class, 'UpdateLecture']);
});
