<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/core')->as('core.')
    ->namespace('LaravelEnso\Contacts\app\Http\Controllers')
    ->group(function () {
        Route::prefix('contacts')->as('contacts.')
            ->group(function () {
                Route::get('initTable', 'ContactTableController@init')
                    ->name('initTable');
                Route::get('getTableData', 'ContactTableController@data')
                    ->name('getTableData');
                Route::get('exportExcel', 'ContactTableController@excel')
                    ->name('exportExcel');

                Route::get('{contact}/edit', 'ContactController@getEditForm')
                    ->name('edit');
                Route::get('create', 'ContactController@getCreateForm')
                    ->name('create');

                Route::get('list', 'ContactController@list')
                    ->name('list');
            });

        Route::resource('contacts', 'ContactController', ['except' => ['show', 'create', 'edit']]);
    });
