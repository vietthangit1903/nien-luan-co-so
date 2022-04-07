<?php

use App\Http\Controllers\Admin\SubjectController;
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
    Route::get('/subject', [SubjectController::class, 'ShowSubject'])->name('admin.showSubject');
    Route::post('/subject', [SubjectController::class, 'AddSubject'])->name('admin.addSubject');
    
    Route::get('/subject/edit', [SubjectController::class, 'ShowEditSubject'])->name('admin.showEditSubject');
    Route::post('/subject/edit', [SubjectController::class, 'EditSubject'])->name('admin.editSubject');

    Route::post('/subject/delete', [SubjectController::class, 'DeleteSubject'])->name('admin.deleteSubject');
});
