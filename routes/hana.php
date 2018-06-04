<?php


//**************AdBoard Start*******************
Route::post('/adboard', 'AdsManagerController@store');
Route::get('user/deleteAds/{id}', 'AdsManagerController@destroyMyAds');
Route::get('user/updateAds/{id}', 'AdsManagerController@update');
Route::post('adboardUpdate/{id}', 'AdsManagerController@updateSave');
//**************AdBoard End*******************


//**************Wallet Start*******************
Route::get('/payment', 'WalletController@paymentForm');
Route::get('/makePayment', 'WalletController@makePaymentForm');
Route::post('/creditPayment','WalletController@creditPayment');

//**************Wallet End*******************
//
//**************User Profile Start*******************
Route::post('/user/myprofilepic','UserController@chngPics');
Route::post('upusrbgimage', 'UserController@uploadImg');
Route::post('/userProfile', 'UserController@updateUserProfileInfo');
Route::get('user/followers/{id}/{all}', 'UserController@getFollowers');
Route::get('user/followings/{id}/{all}', 'UserController@getFollowings');
Route::get('/galleryImages/{imageType}', 'UserController@galleryImages');
Route::get('/galleryFolder', 'UserController@galleryFolder');
//**************User Profile End*******************

//**************Company Profile Start*******************
Route::get('company/followers/{id}/{all}', 'CompanyController@getCompanyFollowers');
Route::get('company/followings/{id}/{all}', 'CompanyController@getCompanyFollowings');
Route::post('company/jobs', 'CompanyController@addJobs');
//**************Company Profile End*******************

//**************User Setting Section Start*******************
Route::post('/settings/resetpassword','UserSettingsController@resetPassword');
Route::post('/settings/privacySetting','UserSettingsController@privacySetting');
Route::post('/settings/socialLinksSetting','UserSettingsController@socialLinkSetting');
Route::post('/settings/mobileSetting','UserSettingsController@mobileSetting');
Route::post('/settings/blockSetting','UserSettingsController@blockUserSetting');
Route::get('/settings/blockUsernames/{uname}', 'UserSettingsController@listForBlockUser');
Route::get('/settings/blockListReady/{id}', 'UserSettingsController@blockUser');
Route::get('/settings/unblock/{id}', 'UserSettingsController@unblockUser');
//**************User Setting Section End*******************

//**************Company Setting Section Start***************
Route::get('company/settings', 'CompanySettingsController@index');
//**************Company Setting Section End***************

//**************Forgot Password Section Start*******************
Route::post('/forgotpassword','UserController@forgotPassword');
Route::get('/verifyuserforpaswrd','UserController@validateToken');
Route::get('/showpasform','UserController@showPasForm');
Route::post('/savenewpas','UserController@saveNewPassword');
//**************Forgot Password Section End*******************