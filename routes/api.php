<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/vlogin','FrontendController@vlogin');
Route::get('/listType','FrontendController@listType');
Route::post('/describe','FrontendController@describe');

Route::post('/createTicket','FrontendController@createTicket');
Route::post('/fetchTicket','FrontendController@fetchTicket');
Route::post('/fetchTicketByTicketNumber','FrontendController@fetchTicketByTicketNumber');
Route::post('/fetchTicketByProductName','FrontendController@fetchTicketByProductName');
Route::post('/verifyDealer','FrontendController@verifyDealer');
Route::post('/documentupload','FrontendController@documentupload');

Route::post('/webhook','WebhookController@handleWebhook');
Route::post('/product','FrontendController@fetchProduct');
Route::post('/organisation','FrontendController@fetchOrg');

Route::post('/botgowebhook','BotgoWebhookController@handleWebhook')->middleware('cors');
Route::post("botgoContactQuery",'BotgoWebhookController@botgoContactQuery')->middleware('cors');

Route::post('/webhooktest/{version?}','WebhookTestController@handleWebhook')->middleware('cors');
Route::post('/webhookfordemo','WebhookDemoController@handleWebhook')->middleware('cors');

Route::post("botgoFormSubmitTest",'WebhookTestController@botgoFormSubmitTest')->middleware('cors');
Route::post("updateTicketFormVerify",'WebhookTestController@updateTicketFormVerify')->middleware('cors');
Route::post("botgoCreateTicketSubmit",'WebhookTestController@botgoCreateTicketSubmit')->middleware('cors');
Route::post("fetchTicketComments",'WebhookTestController@fetchTicketComments')->middleware('cors');
Route::post("handleActionAddCommentToTicket",'WebhookTestController@handleActionAddCommentToTicket')->middleware('cors');

Route::get('/demo/vlogin','DemoController@vlogin');
Route::get('/demo/listType','DemoController@listType');
Route::post('/demo/describe','DemoController@describe');
Route::post('/demo/createTicket','DemoController@createTicket');
Route::post('/demo/fetchTicket','DemoController@fetchTicket');
Route::post('/demo/verifyDealer','DemoController@verifyDealer');
Route::post('/demo/documentupload','DemoController@documentupload');
Route::post('/demo/webhook','WebhookController@handleWebhook');
Route::post('/demo/product','DemoController@fetchProduct');
Route::post('/demo/organisation','DemoController@fetchOrg');


Route::post("/demo/botgoFormSubmitTest",'WebhookDemoController@botgoFormSubmitTest')->middleware('cors');
Route::post("/demo/botgoCreateTicketSubmit",'WebhookDemoController@botgoCreateTicketSubmit')->middleware('cors');
Route::post('/demo/fetchTicketByTicketNumber','DemoController@fetchTicketByTicketNumber');


/*
|
|--------------------------------------------------------------------------
| VTIGER GLOBTIER LEADS FROM Routes
|--------------------------------------------------------------------------
|
*/ 


Route::get("list-type","VtigerLeadController@listType");
Route::get("get-fields","VtigerLeadController@describe");
Route::post("registerlead","VtigerLeadController@registerlead");



Route::post("kiafeedback","VtigerLeadController@kiafeedback");

Route::post("kiafeedbackTicket","VtigerLeadController@kiafeedbackTicket");

Route::post("vecvfeedback","VtigerLeadController@vecvfeedback");

Route::post("vecvfeedbacknew","VtigerLeadController@vecvfeedbacknew");

Route::get("getFeedbackDetails/{gid}","VtigerLeadController@getFeedbackDetails");

Route::post("importCustomerAction","VtigerLeadController@importCustomerAction")->middleware('cors');

Route::post("importProposedSolution","VtigerLeadController@importProposedSolution")->middleware('cors');
