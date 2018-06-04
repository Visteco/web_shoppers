<?php

Route::post('company/update', 'CompanyController@updateCompanyProfile');

Route::post('company/updateprofile', 'CompanyController@uploadProfilePic');

Route::post('company/updatecover', 'CompanyController@uploadCoverPic');

Route::get('/{id}', 'CompanyController@showCompany');

Route::get('company/services','ServiceController@index');

Route::get('approve/{id}','CompanyController@approveRequest');

Route::post('company/createservice','ServiceController@createService');



Route::get('applytothejob/{postedby}/{jobid}',"JobsController@ApplyToTheJob");


Route::get('jobs/searchjobs',"JobsController@searchJobs");