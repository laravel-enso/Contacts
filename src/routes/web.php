<?php

Route::group([
    'namespace'  => 'LaravelEnso\ContactPersons\app\Http\Controllers',
    'middleware' => ['web', 'auth', 'core'],
], function () {
    Route::group(['prefix' => 'administration/contactPersons', 'as' => 'administration.contactPersons.'], function () {
        Route::get('initTable', 'ContactPersonController@initTable')->name('initTable');
        Route::get('getTableData', 'ContactPersonController@getTableData')->name('getTableData');
        Route::get('exportExcel', 'ContactPersonController@exportExcel')->name('exportExcel');
    });

    Route::group(['prefix' => 'administration', 'as' => 'administration.'], function () {
        Route::resource('contactPersons', 'ContactPersonController');
    });
});
