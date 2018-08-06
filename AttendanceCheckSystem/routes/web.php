<?php

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


Route::get('/teacher','TeacherController@redirectToLogin');
Route::get('/teacher/login', 'TeacherController@showLoginForm')->name('login');
Route::post('/teacher/login', 'TeacherController@login');
Route::get('/teacher/logout',['middleware' => 'auth','uses' => 'TeacherController@logout']);

Route::get('/teacher/classesListActive',['middleware' => 'auth','uses' => 'TeacherController@classesListActive']);
Route::get('/teacher/classesListFinished',['middleware' => 'auth','uses' => 'TeacherController@classesListFinished']);
Route::get('/teacher/classSessionList/{id}',['middleware' => 'auth','uses' => 'TeacherController@classSessionList']);

Route::get('/teacher/sessionEdit/{id}',['middleware' => 'auth','uses' => 'TeacherController@showEditSessionForm']);
Route::post('/teacher/sessionEdit/{id}',['middleware' => 'auth','uses' => 'TeacherController@editSession']);

Route::get('/teacher/sessionNew/{classId}',['middleware' => 'auth','uses' => 'TeacherController@showNewSessionForm']);
Route::post('/teacher/sessionNew/{classId}',['middleware' => 'auth','uses' => 'TeacherController@newSession']);

Route::get('/teacher/sessionDelete/{id}',['middleware' => 'auth','uses' => 'TeacherController@deleteSession']);

Route::get('/teacher/attendanceSession/{id}',['middleware' => 'auth','uses' => 'TeacherController@showAttendanceSessionForm']);
Route::post('/teacher/attendanceSession/{id}',['middleware' => 'auth','uses' => 'TeacherController@attendanceSession']);

Route::get('/teacher/attendanceSessionEdit/{id}',['middleware' => 'auth','uses' => 'TeacherController@showAttendanceSessionEditForm']);
Route::post('/teacher/attendanceSessionEdit/{id}',['middleware' => 'auth','uses' => 'TeacherController@attendanceSessionEdit']);

Route::get('/teacher/classActivate/{id}',['middleware' => 'auth','uses' => 'TeacherController@activateClass']);
Route::get('/teacher/classDeactivate/{id}',['middleware' => 'auth','uses' => 'TeacherController@deactivateClass']);




//Route::get('/teacher/signup', 'TeacherController@signup');



////////////////////////////admin/////////////////////////////
Route::get('/admin','AdminController@redirectToLogin');
Route::get('/admin/login', 'AdminController@showLoginForm');
Route::post('/admin/login', 'AdminController@login');
Route::get('/admin/logout',['middleware' => 'admin','uses' => 'AdminController@logout']);

Route::get('/admin/teacherNew',['middleware' => 'admin','uses' => 'AdminController@showNewTeacherForm']);
Route::post('/admin/teacherNew',['middleware' => 'admin','uses' => 'AdminController@newTeacher']);
Route::get('/admin/teacherEdit/{id}',['middleware' => 'admin','uses' => 'AdminController@showEditTeacherForm']);
Route::post('/admin/teacherEdit/{id}',['middleware' => 'admin','uses' => 'AdminController@editTeacher']);
Route::get('/admin/teacherList',['middleware' => 'admin','uses' => 'AdminController@showTeachersList']);
Route::get('/admin/teacherClassesList/{id}',['middleware' => 'admin','uses' => 'AdminController@showTeacherClassesList']);
Route::get('/admin/teacherDelete/{id}',['middleware' => 'admin','uses' => 'AdminController@deleteTeacher']);

Route::get('/admin/studentNew',['middleware' => 'admin','uses' => 'AdminController@showNewStudentForm']);
Route::post('/admin/studentNew',['middleware' => 'admin','uses' => 'AdminController@newStudent']);
Route::get('/admin/studentEdit/{id}',['middleware' => 'admin','uses' => 'AdminController@showEditStudentForm']);
Route::post('/admin/studentEdit/{id}',['middleware' => 'admin','uses' => 'AdminController@editStudent']);
Route::get('/admin/studentList',['middleware' => 'admin','uses' => 'AdminController@showStudentsList']);
Route::get('/admin/studentClassesList/{id}',['middleware' => 'admin','uses' => 'AdminController@showStudentClassesList']);
Route::get('/admin/studentDelete/{id}',['middleware' => 'admin','uses' => 'AdminController@deleteStudent']);

Route::get('/admin/classNew',['middleware' => 'admin','uses' => 'AdminController@showNewClassForm']);
Route::post('/admin/classNew',['middleware' => 'admin','uses' => 'AdminController@newClass']);
Route::get('/admin/classEdit/{id}',['middleware' => 'admin','uses' => 'AdminController@showEditClassForm']);
Route::post('/admin/classEdit/{id}',['middleware' => 'admin','uses' => 'AdminController@editClass']);
Route::get('/admin/classActives',['middleware' => 'admin','uses' => 'AdminController@showActiveClasses']);
Route::get('/admin/classFinished',['middleware' => 'admin','uses' => 'AdminController@showFinishedClasses']);
Route::get('/admin/classStudentsList/{id}',['middleware' => 'admin','uses' => 'AdminController@showClassStudentsList']);
Route::get('/admin/classActivate/{id}',['middleware' => 'admin','uses' => 'AdminController@activateClass']);
Route::get('/admin/classDeactivate/{id}',['middleware' => 'admin','uses' => 'AdminController@deactivateClass']);
Route::get('/admin/classRemoveStudent/{classId}/{studentId}',['middleware' => 'admin','uses' => 'AdminController@removeStudentFromClass']);
Route::get('/admin/classDelete/{id}',['middleware' => 'admin','uses' => 'AdminController@deleteClass']);
Route::get('/admin/classSessionList/{id}',['middleware' => 'admin','uses' => 'AdminController@showClassSessionList']);
Route::get('/admin/sessionAttendanceList/{id}',['middleware' => 'admin','uses' => 'AdminController@showSessionAttendancesList']);
Route::get('/admin/sessionCreateExcel/{id}',['middleware' => 'admin','uses' => 'AdminController@createSessionExcel']);
Route::get('/admin/studentClassCreateExcel/{classId}/{studentId}',['middleware' => 'admin','uses' => 'AdminController@createStudentClassExcel']);



//Route::get('/admin/signup', 'AdminController@signup');


Route::get('/createSessions','CronJobController@createSessions');
