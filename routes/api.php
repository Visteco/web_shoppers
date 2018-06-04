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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::get('/my-network', 'API\HomeController@showMyNetwork');*/

Route::post('login/{social}', 'API\LoginController@doLogin');
 
/*Route::get('/my-network', 'API\HomeController@showMyNetwork');*/

Route::any('/dopost','API\PostController@createPost');

Route::any('/uploadfile/{type}/{id}','API\PostController@uploadfile');

Route::any('/my-network', 'API\HomeController@showMyNetworkPost');

Route::any('/all-comments/{id}', 'API\PostController@getAllComments');

Route::any('register', 'API\RegisterController@doRegister');

Route::post('forgotpassword','API\RegisterController@forgotPassword');
//Route::post('resetuserpassword','API\RegisterController@resetUserPassword');
// Route::post('forgotpassword','API\UserController@forgotPassword');


Route::any('company/profile','API\CompanyController@index');

Route::any('follow/{followto}/{id}', 'API\FollowController@doFollow');
Route::any('dofollowcompany/{followto}', 'API\FollowController@doFollowCompany');


/* ********************* USER PROFILE ******************************** */
Route::any('user/info', 'API\UserController@UserBasicInfo');
Route::any('user/followers', 'API\UserController@getFollowers');
Route::any('user/followings', 'API\UserController@getFollowings');
Route::any('/userProfile', 'API\UserController@updateUserProfileInfo');
Route::any('user/profile', 'API\UserController@index');

Route::any('/settings/resetpassword', 'API\UserSettingsController@resetPassword');
Route::any('/settings/privacySetting', 'API\UserSettingsController@privacySetting');
Route::any('/settings/socialLinksSetting', 'API\UserSettingsController@socialLinkSetting');
Route::any('/settings/mobileSetting', 'API\UserSettingsController@mobileSetting');
Route::any('user/settings', 'API\UserSettingsController@index');

Route::any('/settings/blockUserList/', 'API\UserSettingsController@listForBlockUser');
Route::any('/settings/blockUser/', 'API\UserSettingsController@blockUser');
Route::any('/settings/blockedUserList/', 'API\UserSettingsController@blockedusersss');
Route::any('/user/myprofilepic','API\UserController@chngPics');
Route::any('/upusrbgimage','API\UserController@uploadImg');
Route::any('/settings/unblock/', 'API\UserSettingsController@unblockUser');
/* ********************* USER PROFILE ******************************** */



include 'companyprofile.php';


Route::get('getbusinesscard',"VcardController@getBusinessCards");

Route::get('getusercard',"VcardController@getUserCards");

//**************AdBoard Start*******************
Route::any('/adboard', 'API\AdsManagerController@store');
Route::any('/addslist', 'API\AdsManagerController@getMyAds');
Route::any('user/deleteAds', 'API\AdsManagerController@destroyMyAds');
Route::any('user/updateAds/', 'API\AdsManagerController@update');
Route::any('/adboardUpdate', 'API\AdsManagerController@updateSave');
//**************AdBoard End*******************

Route::get('getbusinesscard',"VcardController@getBusinessCards");

Route::get('getusercard',"VcardController@getUserCards");

Route::any('shareusercard',"API\VcardController@shareUserCard");

Route::any('sharebusinesscard',"API\VcardController@shareBusinessCard");

Route::any('getbusinesscard',"API\VcardController@getBusinessCards");

Route::any('getusercard',"API\VcardController@getUserCards");

Route::any('aprvusercard',"API\VcardController@approveUserCards");

Route::any('aprvbusinesscard',"API\VcardController@approveBusinessCards");

Route::any('suggestedusers',"API\VcardController@suggestedUsers");

Route::any('suggestedcompanies',"API\VcardController@suggestedCompanies");

Route::any('rejectcompanycard',"API\VcardController@rejectCompanyCard");

Route::any('rejectusercard',"API\VcardController@rejectUserCard");
