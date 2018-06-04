<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('searchuser/{username}', 'SearchController@getSearchedUser');


Route::get('searcresult/{query}', 'SearchController@getSearchedData');

Route::get('search/all', 'SearchController@index');

Route::get('suggest/{query}', 'SearchController@getSearchedSuggestions');

Route::get('suggestcompany/{query}', 'SearchController@companySearchSuggestion');