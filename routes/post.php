<?php

Route::get('strchecklink', 'PostController@checkStringForLink');

Route::post('dopost', 'PostController@createPost');

Route::get('loadmore', 'PostController@loadMorePost');

Route::post('docmnt', 'PostController@doCmntToPost');

Route::post('docmntreply', 'PostController@doCommentReply');

Route::get('delcmnt/{id}', 'PostController@deleteComment');


Route::get('delrp/{id}', 'PostController@deleteReply');

Route::post('doupdatecmnt', 'PostController@updateCmntToPost');

Route::post('updaterply', 'PostController@updateReply');

Route::get('changetype/{postid}/{status}', 'PostController@changePostStatus');

Route::get('delpost/{id}', 'PostController@deletePost');

Route::get('sharepost/{postid}/{status}', 'PostController@sharePost');

Route::get('like/{id}/{type}', 'PostController@likeObject');

Route::get('getlikedusers/{id}/{type}', 'PostController@getLikedUsers');

Route::get('followuser/{id}', 'FollowController@doFollow');

Route::get('followcompany/{id}', 'FollowController@doFollowCompany');

Route::get('showpost/{id}','PostController@showSinglePost');

Route::get('getmorecomments/{postId}','PostController@loadMoreComments');

Route::get('dobookmark/{postId}','PostController@doBookMark');

Route::get('undobookmark/{postId}','PostController@unDoBookMark');

Route::get('getallreplies/{postId}/{cmntId}','PostController@viewAllReplies');

Route::get('getgalleryimages/{type}/{id}','CompanyController@getGalleriesImages');

Route::get('getgallery/{id}','CompanyController@getGallery');