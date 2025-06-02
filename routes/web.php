<?php

use App\Http\Controllers\ActivityPlanController;
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

Route::get('/talent-directory', function () {
    return view('formlead');
});

Route::post('logout','ActivityFrontController@logout');
Route::get('sendFeedback/{activity_id}/{attendie_id}', 'FeedbackController@sendMsG')->name('sendFeedback');

Route::get('attendance_form/{id}', 'ActivityPlanController@showAttendanceForm');
Route::post('attendance_submit', 'ActivityPlanController@attendanceSubmit');
Route::post('feedback_submit', 'FeedbackController@submitFeedback')->name('feedback_submit');

Route::post('loginCheck','ActivityFrontController@loginAuthentication');
Route::get('login', "ActivityFrontController@adminLogin")->name('login');
Route::get('sendFeedback/{activity_id}/{attendie_id}', 'FeedbackController@sendMsG')->name('sendFeedback');
Route::post('feedback_submit', 'FeedbackController@submitFeedback')->name('feedback_submit');

// Attendie feedback
Route::get('/activity/attendance-feeback', 'ActivityPlanController@activityAttendanceFeedback');
Route::get('/activity/ticket-feedback', 'ActivityPlanController@activityTicketFeedback');
Route::get('activity/attendance-feeback/export', 'ActivityPlanController@activityAttendanceFeedbackExport');
// export feedback from
Route::get('/activity/export-feeback', 'ActivityPlanController@exportFeedbackForm')->name('export-feeback');
Route::post('/activity/export-feeback', 'ActivityPlanController@exportFeedbackPost')->name('export-feeback-post');


Route::get('/attendie-feedback/{activity_id}', 'ActivityPlanController@attendieFeedback');
Route::get('/attendie-feedback/questions/{activity_id}/{attendi_id}', 'ActivityPlanController@questions');

// active deavtivate users
Route::get('/active-deactive-trainer/{id}', 'TrainerController@actDeact');


Route::get('/markedStatus', function(){
  return view('activity.attendence_marked_already');
});

Route::get('/recievedStatus', function(){
  return view('activity.attendence_recieved');
});

Route::get('/feedbackSubmitAlready', function(){
   return view('feedback.feedback_submitted_already');
})->name('feedbackSubmitAlready');

Route::get('feedbackRecievedStatus', function(){
    return view('feedback.feedback_recieved');
})->name('feedbackRecievedStatus');

Route::group(['middleware' =>  ['web','checkLogin']], function () {

Route::get('/dashboard',function(){
	return view('home');
});
Route::get('profile','ActivityFrontController@getProfile');
Route::post('profileUpdate','ActivityFrontController@profileUpdate');
Route::post('changePassword','ActivityFrontController@changePassword');
Route::get('change-password',function(){
  return view('profile.changePassword');	
});
Route::get('activity_details_update/{id}','ActivityPlanController@activity_details_update');
Route::post('activityUpdate','ActivityPlanController@activityUpdate');
Route::post('add_dealer','ActivityPlanController@add_dealer');
Route::resource('trainers', 'TrainerController');
Route::get('trainersTable','TrainerController@trainersTable');
Route::resource('activity', 'ActivityPlanController');
Route::resource('dealers', 'ActivityDealerController');
Route::get('activityTable','ActivityPlanController@activityTable');
Route::post('file-upload-batch','ActivityPlanController@fileUploadBatch');
Route::post('fetch_docs','ActivityPlanController@fetch_docs');
Route::post('file-delete/{file_type}/{activity_id}/{file_name}','ActivityPlanController@file_delete');
Route::get('activity_details_view/{id}','ActivityPlanController@activity_details_view');
Route::get('Questions', 'QuestionController@index');
Route::get('Questions/create', 'QuestionController@create');
Route::post('Questions/store', 'QuestionController@store');
Route::get('Questions/edit/{id}', 'QuestionController@edit')->name('questions.edit');
Route::post('Questions/update/{id}', 'QuestionController@update');
Route::get('Questions/delete/{id}', 'QuestionController@delete')->name('questions.delete');
Route::post('EndTraining', 'FeedbackController@SendSmsToUser');
});


