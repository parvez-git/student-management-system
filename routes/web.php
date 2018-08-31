<?php


Route::get('/', 'LoginController@getLogin')->name('/');
Route::post('/login', 'LoginController@postLogin')->name('login');
Route::post('/logout', 'LoginController@getLogout')->name('logout');


Route::get('/nopermission', function(){
  return view('layouts.nopermission');
});

Route::group(['middleware' => ['authen','roles']], function(){

  Route::get('/profile', [
    'as'  => 'profile.index',
    'uses'=> 'ProfileController@index'
  ]);

  Route::get('/dashboard', [
    'as'    => 'dashboard',
    'uses'  => 'DashboardController@dashboard'
  ]);

  Route::get('/dashboard/chart', [
    'as'    => 'dashboard.chart',
    'uses'  => 'DashboardController@dashboardChart'
  ]);

  Route::get('/dashboard/transaction', [
    'as'    => 'dashboard.transaction',
    'uses'  => 'DashboardController@dashboardTransaction'
  ]);

  Route::get('/student', [
    'as'    => 'student.index',
    'uses'  => 'StudentController@allStudent'
  ]);

});

// ADMIN
Route::group(['middleware' => ['authen','roles'], 'roles' => ['admin']], function(){

  // GENERAL SETTINGS
  Route::get('/settings/general', [
    'as'    => 'settings.general',
    'uses'  => 'DashboardController@settingsForm'
  ]);
  Route::post('/settings/general', [
    'as'    => 'settings.store',
    'uses'  => 'DashboardController@settingsStore'
  ]);


  // MANAGE COURSE
  Route::get('/manage/course', [
    'as'    => 'manage.course',
    'uses'  => 'CourseController@manageCourse'
  ]);

  Route::post('/manage/course/academic', [
    'as'    => 'course.academic',
    'uses'  => 'CourseController@courseAcademic'
  ]);

  Route::post('/manage/course/program', [
    'as'    => 'course.program',
    'uses'  => 'CourseController@courseProgram'
  ]);

  Route::get('/manage/course/level-get', [
    'as'    => 'course.levelget',
    'uses'  => 'CourseController@courseGetLevel'
  ]);
  Route::get('/manage/course/program-get', [
    'as'    => 'course.programget',
    'uses'  => 'CourseController@courseProgramOnLevel'
  ]);
  Route::post('/manage/course/level', [
    'as'    => 'course.level',
    'uses'  => 'CourseController@courseLevel'
  ]);

  Route::post('/manage/course/shift', [
    'as'    => 'course.shift',
    'uses'  => 'CourseController@courseShift'
  ]);

  Route::post('/manage/course/time', [
    'as'    => 'course.time',
    'uses'  => 'CourseController@courseTime'
  ]);

  Route::post('/manage/course/batch', [
    'as'    => 'course.batch',
    'uses'  => 'CourseController@courseBatch'
  ]);

  Route::post('/manage/course/group', [
    'as'    => 'course.group',
    'uses'  => 'CourseController@courseGroup'
  ]);

  Route::post('/manage/course', [
    'as'    => 'course.store',
    'uses'  => 'CourseController@myClass'
  ]);

  Route::get('/manage/course/info', [
    'as'    => 'course.index',
    'uses'  => 'CourseController@showClassInfo'
  ]);

  Route::get('/manage/course/edit', [
    'as'    => 'course.edit',
    'uses'  => 'CourseController@editCourse'
  ]);

  Route::post('/manage/course/update', [
    'as'    => 'course.update',
    'uses'  => 'CourseController@updateCourse'
  ]);

  Route::post('/manage/course/delete', [
    'as'    => 'course.delete',
    'uses'  => 'CourseController@deleteCourse'
  ]);

  // COURSE STUDENT
  Route::get('/course/student', [
    'as'    => 'course.student',
    'uses'  => 'CourseController@courseStudent'
  ]);
  Route::get('/course/student/list', [
    'as'    => 'course.student.list',
    'uses'  => 'CourseController@courseStudentTable'
  ]);


  /* ============ STUDENT REGISTRATION ============ */

  // Route::get('/student', [
  //   'as'    => 'student.index',
  //   'uses'  => 'StudentController@allStudent'
  // ]);

  Route::get('/student/show', [
    'as'    => 'student.show',
    'uses'  => 'StudentController@showStudent'
  ]);

  Route::get('/student/registration', [
    'as'    => 'student.create',
    'uses'  => 'StudentController@createStudent'
  ]);

  Route::post('/student/registration', [
    'as'    => 'student.store',
    'uses'  => 'StudentController@storeStudent'
  ]);

  Route::post('/student/update', [
    'as'    => 'student.update',
    'uses'  => 'StudentController@updateStudent'
  ]);

  Route::post('/student/delete', [
    'as'    => 'student.delete',
    'uses'  => 'StudentController@deleteStudent'
  ]);

  // POPUP COURSE TABLE
  Route::get('/student/course/info', [
    'as'    => 'student.courses',
    'uses'  => 'StudentController@showCourseInfo'
  ]);


  /* ================ FEES ================ */

  // COURSE FEES
  Route::get('/course/list', [
    'as'    => 'fees.course.list',
    'uses'  => 'FeeController@courseList'
  ]);

  Route::get('/course/fees/add', [
    'as'    => 'fees.course.add',
    'uses'  => 'FeeController@addCourseFees'
  ]);

  Route::post('/course/fees/add', [
    'as'    => 'fees.course.store',
    'uses'  => 'FeeController@storeCourseFees'
  ]);


  // STUDENT FEES
  Route::get('/student/fees/add', [
    'as'    => 'fees.add',
    'uses'  => 'FeeController@addFees'
  ]);

  Route::get('/student/fees/show', [
    'as'    => 'fees.show',
    'uses'  => 'FeeController@showFees'
  ]);

  Route::post('/student/fees/store', [
    'as'    => 'fees.store',
    'uses'  => 'FeeController@storeFees'
  ]);

  Route::get('/student/fees/course', [
    'as'    => 'fees.course',
    'uses'  => 'FeeController@courseFees'
  ]);

  Route::post('/student/fees/transaction/delete', [
    'as'    => 'fees.transaction.delete',
    'uses'  => 'FeeController@transactionDelete'
  ]);

  // PRINT RECEIPT
  Route::get('/student/fees/receipt/{id}', [
    'as'    => 'fees.receipt',
    'uses'  => 'FeeController@printFeesReceipt'
  ]);


});
