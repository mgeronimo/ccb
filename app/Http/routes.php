<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['middleware' => 'auth', 'uses' => 'DashboardController@index']);
Route::get('dashboard', 'DashboardController@index');
//Route::get('/admin', 'DashboardAdminController@index');

Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::get('confirm', function () {
    return view('confirm');
});
/*
/*
 * ---------- Registration Routes
 */
Route::get('register/confirm/{token}', 'RegistrationController@confirmEmail');
Route::post('register/confirm/{token}', 'RegistrationController@confirmRegister');
Route::get('register/confirm/{token}', 'RegistrationController@confirmEmail');
Route::get('register/confirm/public/{token}', 'RegistrationController@confirmPublic');


/*
 * ---------- Redirects to the dashboard with message when group creation was cancelled
 */
Route::get('cancel-add', function(){
	return redirect('/')->with('message', 'Addition of group cancelled.');
});
Route::get('cancel-adddept', function(){
	return redirect('/')->with('message', 'Addition of department cancelled.');
});
/*
 * ----------Registration Routes
 */
Route::get('register/confirm/{token}', 'RegistrationController@confirmEmail');

/*
 * ----------User Routes
 */
Route::get('users', 'UserController@index');
Route::get('add-user', 'UserController@create');
Route::post('add-user', 'UserController@store');
Route::get('users/delete/{id}', 'UserController@destroy');


/*
 * ----------Department Routes
 */
Route::get('departments', 'DepartmentController@index');
Route::get('departments/delete/{id}', 'DepartmentController@destroy');
Route::get('departments/edit/{id}', 'DepartmentController@edit');
Route::post('update-dept', 'DepartmentController@update');
Route::get('cancel-update-dept', function(){
	return redirect('/departments')->with('message', 'Editing department cancelled.');
});

/*
 * ---------- Group Routes
 */
/*Route::get('groups', 'GroupController@index');
Route::get('addgroup', 'GroupController@addGroup');
Route::post('addgroup', 'GroupController@storeGroup');
Route::get('group/{id}', 'GroupController@show');
Route::get('group/{id}/add-agent', 'GroupController@addAgent');
Route::post('group/{id}/add-agent', 'GroupController@saveAddedAgent');
Route::get('validateGroup', 'GroupController@validateGroup');
Route::get('validateSupervisorAgent/{counter}', 'GroupController@validateSupervisorAgent');
Route::get('group/delete/{id}', 'GroupController@destroy');
Route::get('group/edit/{id}', 'GroupController@edit');
Route::post('update-group', 'GroupController@update');
Route::get('cancel-update-group', function(){
	return redirect('/groups')->with('message', 'Editing group cancelled.');
});*/


/*
 * ---------- Agent/User Routes
 */
Route::get('agent/delete/{id}', 'AgentController@delete');
Route::get('email', function(){
	return view('emails.verification');
});
Route::get('users/update/{id}', 'UserController@edit');
Route::post('update-user', 'UserController@update');
Route::get('cancel-update-user', function(){
	return redirect('/users')->with('message', 'Editing user cancelled.');
});

/*
 * ---------- Department Routes
 */
Route::get('adddept', 'DashboardAdminController@show');
Route::post('adddept', 'DashboardAdminController@addDept');
Route::get('validateDepartment', 'DashboardAdminController@validateDepartment');
Route::get('validateDeptRep', 'DashboardAdminController@validateDeptRep');

/*
 * ---------- Ticket Routes
 */
Route::get('tickets', 'TicketController@index');
//Route::get('tickets/{id}',['middleware' => 'notassign_agent', 'uses'=> 'TicketController@show']);
Route::get('tickets/{id}','TicketController@show');
Route::get('tickets/{id}/assign/{agentid}', 'TicketController@assign');
Route::get('tickets/{id}/status/{statid}', 'TicketController@changeStatus');
Route::get('unassigned-tickets', 'TicketController@unassignedTickets');
Route::get('in-process-tickets', 'TicketController@inProcessTickets');
Route::get('pending-tickets', 'TicketController@pendingTickets');
Route::get('closed-tickets', 'TicketController@closedTickets');

/*
 * ---------- Comment Routes
 */
Route::post('add-comment/{id}', 'CommentController@store');

/*
 * Announcement Routes
 */
Route::get('announcements', 'AnnouncementController@allAnnouncements'); 
Route::get('add-announcement', 'DashboardAdminController@announcement'); 
Route::get('announcements/{id}', 'AnnouncementController@show');
Route::post('announcement', [ 		
 	'as' => 'annoucement', 'uses' => 'DashboardAdminController@saveAnnouncement']); 
Route::get('cancel-announcement', function(){
	return redirect('/announcements')->with('message', 'Adding announcement cancelled.');
});
Route::post('draftAnnouncement', 'DashboardAdminController@draftAnnouncement');
Route::get('announcements/delete/{id}', 'AnnouncementController@delete');
Route::get('announcements/edit/{id}', 'AnnouncementController@edit');
Route::post('update-announcement', ['as' => 'update-announcement', 'uses' => 'AnnouncementController@update']);
Route::post('draftEditedAnnouncement', 'AnnouncementController@draftEditedAnnouncement');
Route::get('cancel-edit-announcement', function(){
	return redirect('/announcements')->with('message', 'Editing announcement cancelled.');
});

/*
 * OAuth Route
 */
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});


/*
 * API Routes
 */
Route::group(['prefix' => 'api/v1'], function(){
	Route::get('userinfo', 'UserApiController@show');
	Route::post('register', 'UserApiController@store');
	Route::post('new-ticket', 'TicketApiController@store');
	Route::get('agencies', 'DepartmentApiController@index');
	Route::get('ticket-list', 'TicketApiController@index');
	Route::get('comments/{id}', 'CommentController@index');
	Route::post('add-comment/{id}', 'CommentController@storeFromApp');
	Route::get('cancel-ticket/{id}', 'TicketApiController@cancelTicket');
	Route::get('announcements', 'AnnouncementController@index');
});

