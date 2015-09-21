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

Route::get('/', 'DashboardController@index');
//Route::get('dashboard', 'DashboardController@index');
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
 * ---------- Group Routes
 */
Route::get('addgroup', 'GroupController@index');
Route::post('addgroup', 'GroupController@storegroup');
Route::get('group/{id}', 'GroupController@show');
Route::get('group/{id}/add-agent', 'GroupController@addAgent');
Route::post('group/{id}/add-agent', 'GroupController@saveAddedAgent');
Route::get('validateGroup', 'GroupController@validateGroup');
Route::get('validateSupervisorAgent/{counter}', 'GroupController@validateSupervisorAgent');


/*
 * ---------- Agent Routes
 */
Route::get('agent/delete/{id}', 'AgentController@delete');
Route::get('email', function(){
	return view('emails.verification');
});
/*
 * ---------- Department Routes
 */
Route::get('adddept', 'DashboardAdminController@show');
Route::post('adddept', 'DashboardAdminController@addDept');
Route::get('validateDepartment', 'DashboardAdminController@validateDepartment');
Route::get('validateDeptRep', 'DashboardAdminController@validateDeptRep');
Route::post('admin/flash', function (){
    Session::flash('message.' . Input::get('status'), Input::get('message') );
    return ['status' => Input::get('status'), 'message'=> Input::get('message')];
});


/*
 * ---------- Ticket Routes
 */
Route::get('tickets', 'TicketController@index');
Route::get('tickets/{id}', 'TicketController@show');
Route::get('tickets/{id}/assign/{agentid}', 'TicketController@assign');


/*Route::controllers([
	'auth' 		=> 'Auth\AuthController',
	'password'	=> 'Auth\PasswordController'
]);*/

/*
OAuth Routes
 */

/*Route::post('login', function(){
	$credentials = app()->make('request')->input("credentials");
    return App\Auth\Proxy::attemptLogin($credentials);
});

Route::post('refresh-token', function() {
    return App\Auth\Proxy::attemptRefresh();
});*/

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['prefix' => 'api/v1'], function(){
	Route::get('userinfo', 'UserApiController@show');
	Route::post('register', 'UserApiController@store');
	Route::post('new-ticket', 'TicketApiController@store');
	Route::get('agencies', 'DepartmentApiController@index');
});

/*
 * --------angular routes
 */ 

