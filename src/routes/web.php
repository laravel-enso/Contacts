<?php

Route::middleware(['web', 'auth', 'core'])
    ->namespace('LaravelEnso\ContactPersons\app\Http\Controllers')
    ->group(function () {
        Route::prefix('administration/contactPersons')->as('administration.contactPersons.')
            ->group(function () {
                Route::get('initTable', 'ContactPersonController@initTable')
                    ->name('initTable');
                Route::get('getTableData', 'ContactPersonController@getTableData')
                    ->name('getTableData');
                Route::get('exportExcel', 'ContactPersonController@exportExcel')
                    ->name('exportExcel');
            });

        Route::prefix('administration')->as('administration.')
            ->group(function () {
                Route::resource('contactPersons', 'ContactPersonController', ['except' => ['show']]);
            });
    });
