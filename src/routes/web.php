<?php

Route::middleware(['web', 'auth', 'core'])
    ->namespace('LaravelEnso\Contacts\app\Http\Controllers')
    ->group(function () {
        Route::prefix('administration/contacts')->as('administration.contacts.')
            ->group(function () {
                Route::get('initTable', 'ContactsTableController@initTable')
                    ->name('initTable');
                Route::get('getTableData', 'ContactsTableController@getTableData')
                    ->name('getTableData');
                Route::get('exportExcel', 'ContactsTableController@exportExcel')
                    ->name('exportExcel');
            });

        Route::prefix('administration')->as('administration.')
            ->group(function () {
                Route::resource('contacts', 'ContactController', ['except' => ['show']]);
            });
    });
