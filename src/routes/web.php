<?php

Route::group(['namespace' => 'LaravelEnso\ContactPersons\app\Http\Controllers', 'middleware' => ['web', 'auth', 'core']], function () {
    Route::group(['prefix' => 'administration/contactPersons', 'as' => 'administration.contactPersons.'], function () {
        Route::get('initTable', 'ContactPersonsController@initTable')->name('initTable');
        Route::get('getTableData', 'ContactPersonsController@getTableData')->name('getTableData');
        Route::get('getOptionsList', 'ContactPersonsController@getOptionsList')->name('getOptionsList');
    });

    Route::group(['prefix' => 'administration', 'as' => 'administration.'], function () {
        Route::resource('contactPersons', 'ContactPersonsController');
    });
});
