<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => '/register'], function (Router $router) {
    $router->bind('RegisterForm', function ($id) {
        return app('Modules\Register\Repositories\FormRepository')->find($id);
    });
    $router->post('forms/rates', [
        'as'         => 'admin.register.form.rates',
        'uses'       => 'FormController@rates',
        'middleware' => 'can:register.forms.edit'
    ]);
    $router->get('forms', [
        'as'         => 'admin.register.form.index',
        'uses'       => 'FormController@index',
        'middleware' => 'can:register.forms.index'
    ]);
    $router->get('forms/create', [
        'as'         => 'admin.register.form.create',
        'uses'       => 'FormController@create',
        'middleware' => 'can:register.forms.create'
    ]);
    $router->post('forms', [
        'as'         => 'admin.register.form.store',
        'uses'       => 'FormController@store',
        'middleware' => 'can:register.forms.create'
    ]);
    $router->get('forms/{RegisterForm}/edit', [
        'as'         => 'admin.register.form.edit',
        'uses'       => 'FormController@edit',
        'middleware' => 'can:register.forms.edit'
    ]);
    $router->put('forms/{RegisterForm}', [
        'as'         => 'admin.register.form.update',
        'uses'       => 'FormController@update',
        'middleware' => 'can:register.forms.edit'
    ]);
    $router->delete('forms/{RegisterForm}', [
        'as'         => 'admin.register.form.destroy',
        'uses'       => 'FormController@destroy',
        'middleware' => 'can:register.forms.destroy'
    ]);
    $router->bind('registerCollateral', function ($id) {
        return app('Modules\Register\Repositories\CollateralRepository')->find($id);
    });
    $router->get('collaterals', [
        'as'         => 'admin.register.collateral.index',
        'uses'       => 'CollateralController@index',
        'middleware' => 'can:register.collaterals.index'
    ]);
    $router->get('collaterals/create', [
        'as'         => 'admin.register.collateral.create',
        'uses'       => 'CollateralController@create',
        'middleware' => 'can:register.collaterals.create'
    ]);
    $router->post('collaterals', [
        'as'         => 'admin.register.collateral.store',
        'uses'       => 'CollateralController@store',
        'middleware' => 'can:register.collaterals.create'
    ]);
    $router->get('collaterals/{registerCollateral}/edit', [
        'as'         => 'admin.register.collateral.edit',
        'uses'       => 'CollateralController@edit',
        'middleware' => 'can:register.collaterals.edit'
    ]);
    $router->put('collaterals/{registerCollateral}', [
        'as'         => 'admin.register.collateral.update',
        'uses'       => 'CollateralController@update',
        'middleware' => 'can:register.collaterals.edit'
    ]);
    $router->delete('collaterals/{registerCollateral}', [
        'as'         => 'admin.register.collateral.destroy',
        'uses'       => 'CollateralController@destroy',
        'middleware' => 'can:register.collaterals.destroy'
    ]);
    $router->bind('registerFile', function ($id) {
        return app('Modules\Register\Repositories\FileRepository')->find($id);
    });
    $router->get('files', [
        'as'         => 'admin.register.file.index',
        'uses'       => 'FileController@index',
        'middleware' => 'can:register.files.index'
    ]);
    $router->get('files/create', [
        'as'         => 'admin.register.file.create',
        'uses'       => 'FileController@create',
        'middleware' => 'can:register.files.create'
    ]);
    $router->post('files', [
        'as'         => 'admin.register.file.store',
        'uses'       => 'FileController@store',
        'middleware' => 'can:register.files.create'
    ]);
    $router->get('files/{registerFile}/edit', [
        'as'         => 'admin.register.file.edit',
        'uses'       => 'FileController@edit',
        'middleware' => 'can:register.files.edit'
    ]);
    $router->put('files/{registerFile}', [
        'as'         => 'admin.register.file.update',
        'uses'       => 'FileController@update',
        'middleware' => 'can:register.files.edit'
    ]);
    $router->delete('files/{registerFile}', [
        'as'         => 'admin.register.file.destroy',
        'uses'       => 'FileController@destroy',
        'middleware' => 'can:register.files.destroy'
    ]);
// append


});
