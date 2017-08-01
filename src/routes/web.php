<?php

Route::middleware(['web', 'auth', 'core'])
    ->namespace('LaravelEnso\Contacts\app\Http\Controllers')
    ->group(function () {
        Route::prefix('core')->as('core.')
            ->group(function () {
                Route::prefix('contacts')->as('contacts.')
                    ->group(function () {
                        Route::get('list', 'ContactTableController@index')
                            ->name('list');
                        Route::get('initTable', 'ContactTableController@initTable')
                            ->name('initTable');
                        Route::get('getTableData', 'ContactTableController@getTableData')
                            ->name('getTableData');
                        Route::get('exportExcel', 'ContactTableController@exportExcel')
                            ->name('exportExcel');
                    });

                Route::resource('contacts', 'ContactController', ['except' => ['show', 'edit', 'create']]);
            });
    });
