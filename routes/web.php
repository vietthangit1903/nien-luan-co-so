<?php

use App\Http\Controllers\Admin\AdminLectureController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Auth\LectureAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\StudentController;
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


Route::prefix('admin')->middleware(['auth:lecture', 'isAdmin'])->group(function () {
    Route::view('/', 'admin.admin')->name('admin.home');
    
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

    // Semester Route
    Route::get('/semester', [SemesterController::class, 'ShowSemesterList'])->name('admin.showSemester');
    Route::get('/semester/edit', [SemesterController::class, 'ShowEditSemester'])->name('admin.editSemester');
    Route::post('/semester/edit', [SemesterController::class, 'EditSemester']);

    // Student Route
    Route::get('/student', [AdminStudentController::class, 'ShowStudentList'])->name('admin.studentList');
    Route::get('/student/edit', [AdminStudentController::class, 'UpdateStudentInfoView'])->name('admin.updateStudent');
    Route::post('/student/edit', [AdminStudentController::class, 'UpdateStudent']);
    Route::post('/student/delete', [AdminStudentController::class, 'DeleteStudent'])->name('admin.deleteStudent');

});

// Lecture public route
Route::get('/lecture/login', [LectureAuthController::class, 'ShowLoginForm'])->name('LectureLoginView');
Route::post('/lecture/login', [LectureAuthController::class, 'Login'])->name('LectureLogin');

// Authenticated Lecture route
Route::prefix('lecture')->middleware('auth:lecture')->group(function () {
    Route::post('/logout', [LectureAuthController::class, 'Logout'])->name('LectureLogout');
    Route::get('/change_password', [LectureAuthController::class, 'ShowChangePassword'])->name('LectureChangePassword');
    Route::post('/change_password', [LectureAuthController::class, 'ChangePassword']);

    Route::view('/profile', 'lecture.lectureProfile')->name('LectureProfile');
    Route::view('/profile/update', 'lecture.lectureUpdateProfile')->name('LectureUpdateProfile');
    Route::post('/profile/update', [LectureController::class, 'UpdateLecture']);

    Route::view('/', 'lecture.lecturePage')->name('LecturePage');

    Route::get('/add_topic', [LectureController::class, 'AddTopicView'])->name('lecture.addTopic');
    Route::post('/add_topic', [LectureController::class, 'AddTopic']);

    Route::get('/topic_list', [LectureController::class, 'TopicList'])->name('lecture.topicList');

    Route::get('/topic/edit', [LectureController::class, 'GetEditTopic'])->name('lecture.editTopic');
    Route::post('/topic/edit', [LectureController::class, 'EditTopic']);
    Route::post('/topic/delete', [LectureController::class, 'DeleteTopic'])->name('lecture.deleteTopic');
    Route::get('/topic/detail', [LectureController::class, 'TopicDetail'])->name('lecture.topicDetail');

    Route::get('/topic/progress_report', [LectureController::class, 'GetProgressReport'])->name('lecture.progressReport');

    Route::get('/topic/report', [LectureController::class, 'GetReport'])->name('lecture.report');
    Route::get('/topic/report-download', [LectureController::class, 'DownloadReport'])->name('lecture.downloadReport');
    
    Route::get('/topic/evaluation', [LectureController::class, 'Evaluation'])->name('lecture.evaluation');
    Route::post('/topic/evaluation', [LectureController::class, 'SaveEvaluation']);

    Route::post('/topic/edit-evaluation', [LectureController::class, 'SaveEditEvaluation'])->name('lecture.editEvaluation');




});

// Student public route
Route::get('/student/register', [StudentAuthController::class, 'ShowRegisterForm'])->name('student.registerStudent');
Route::post('/student/register', [StudentAuthController::class, 'RegisterStudent']);

Route::get('/student/login', [StudentAuthController::class, 'ShowLoginForm'])->name('student.studentLogin');
Route::post('/student/login', [StudentAuthController::class, 'Login']);

// Authenticated Student Route

Route::prefix('student')->middleware('auth:student')->group(function(){
    Route::post('/logout', [StudentAuthController::class, 'Logout'])->name('studentLogout');

    Route::get('/change_password', [StudentAuthController::class, 'ShowChangePassword'])->name('StudentChangePassword');
    Route::post('/change_password', [StudentAuthController::class, 'ChangePassword']);

    Route::view('/profile', 'student.studentProfile')->name('StudentProfile');
    Route::view('/profile/update', 'student.studentUpdateProfile')->name('StudentUpdateProfile');
    Route::post('/profile/update', [StudentController::class, 'UpdateStudent']);

    Route::view('/', 'student.studentPage')->name('StudentPage');

    Route::get('topic/register', [StudentController::class, 'GetRegisterTopic'])->name('student.registerTopic');
    Route::post('topic/register', [StudentController::class, 'RegisterTopic']);
    Route::post('topic/cancel-register', [StudentController::class, 'CancelRegisterTopic'])->name('student.cancelRegisterTopic');

    Route::get('/topic_list', [StudentController::class, 'TopicList'])->name('student.topicList');

    Route::get('/progress_port', [StudentController::class, 'GetProgressReport'])->name('student.progressReport');
    Route::post('/progress_port', [StudentController::class, 'SaveProgressReport']);
    Route::post('/progress_port/delete', [StudentController::class, 'DeleteProgressReport'])->name('student.deleteProgressReport');

    Route::get('/report', [StudentController::class, 'ShowUploadReport'])->name('student.report');
    Route::post('/upload-report', [StudentController::class, 'UploadReport'])->name('student.uploadReport');

    Route::post('report/cancel-report-submission', [StudentController::class, 'CancelReportSubmission'])->name('student.cancelReportSubmission');

    Route::get('/evaluation', [StudentController::class, 'GetEvaluation'])->name('student.getEvaluation');

});
