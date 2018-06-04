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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/my-network', 'HomeController@showMyNetwork');

Route::post('guest/dologin', 'LoginController@doLogin');

Route::get('user/logout', 'LoginController@doLogout');

Route::get('user/settings', 'UserSettingsController@index');

Route::get('user/wallet', 'WalletController@index');

Route::get('user/profile', 'UserController@index');

Route::get('company/profile', 'CompanyController@index');

Route::get('user/jobs', 'JobsController@index');

Route::get('user/jobdetail/{id}', 'JobsController@jobDetail');

Route::get('user/directory', 'DirectoryController@index');

Route::get('user/allnotification', 'NotificationController@index');

Route::get('user/allmessages', 'NotificationController@index');

Route::get('user/followers', 'FollowController@userFollowers');

Route::get('user/followings', 'FollowController@userFollowings');

Route::get('company/followers', 'FollowController@companyFollowers');

Route::get('company/followings', 'FollowController@companyFollowings');

Route::get('company/services', 'ServiceController@index');

Route::get('company/servicedetail/{id}', 'ServiceController@serviceDetail');

Route::any('resetpassword','UserController@resetPassword');
Route::post('createresetpassword/{id}','UserController@createResetPassword');

Route::any('/getUserDetails','HomeController@getUserData');

/*
Routes for facebook redirect and callback
*/
Route::get('auth/facebook', ['as'=>'auth/facebook','uses'=>'Auth\LoginController@redirectToProvider']);
Route::get('auth/facebook/callback',['as'=>'auth/facebook/callback','uses'=>
	'Auth\LoginController@handleProviderCallback']);

/*Routes For Google */
Route::get('auth/google', ['as'=>'auth/google','uses'=>'Auth\LoginController@redirectToGoogleProvider']);

Route::get('auth/google/callback',['as'=>'auth/google/callback','uses'=>
	'Auth\LoginController@handleGoogleProviderCallback']);







Route::post('user/register', 'RegisterController@doRegister');
Route::get('forgot-password', 'UserController@forgot_password');
Route::post('sendpasswordmail', 'UserController@forgotPassword');

Route::get('testmail/{email}','RegisterController@sendMailToVerification');

Route::get('activate/{token}/{uid}','RegisterController@verifyAndRedirect');


/****************************************************************************************/

Route::get('showcompany/{id}','CompanyController@redirectToName');


Route::get('shareusercard',"VcardController@shareUserCard");

Route::get('sharebusinesscard',"VcardController@shareBusinessCard");

Route::get('getbusinesscard',"VcardController@getBusinessCards");

Route::get('getusercard',"VcardController@getUserCards");

/*****************************************************************************************/

Route::get('user/profile/{id}',"UserController@showUserProfile");


Route::get('service/showadd',"ServiceController@showAddService");


Route::get('service/edit/{id}',"ServiceController@editService");


Route::get('service/delete/{id}',"ServiceController@deleteService");


Route::get('receipt-safe/',"PageController@recieptSafe");
Route::get('how-it-works/',"PageController@howItWorks");
Route::get('about/',"PageController@about");
Route::get('help/',"PageController@help");
Route::get('terms-and-conditions/',"PageController@termsAndConditions");
