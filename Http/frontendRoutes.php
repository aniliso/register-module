<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' =>''], function (Router $router) {
    $router->get(LaravelLocalization::transRoute('register::routes.register.step-1'), [
        'as'   => 'register.form.step-1',
        'uses' => 'PublicController@step1'
    ]);
    $router->post(LaravelLocalization::transRoute('register::routes.register.step-1'), [
        'as'   => 'register.form.step-1.put',
        'uses' => 'PublicController@postStep1'
    ]);
    $router->get(LaravelLocalization::transRoute('register::routes.register.step-2'), [
        'as'   => 'register.form.step-2',
        'uses' => 'PublicController@step2'
    ]);
    $router->post(LaravelLocalization::transRoute('register::routes.register.step-2'), [
        'as'   => 'register.form.step-2.put',
        'uses' => 'PublicController@postStep2'
    ]);
    $router->get(LaravelLocalization::transRoute('register::routes.register.step-3'), [
        'as'   => 'register.form.step-3',
        'uses' => 'PublicController@step3'
    ]);
    $router->post(LaravelLocalization::transRoute('register::routes.register.step-3'), [
        'as'   => 'register.form.step-3.put',
        'uses' => 'PublicController@postStep3'
    ]);
    $router->get(LaravelLocalization::transRoute('register::routes.register.step-4'), [
        'as'   => 'register.form.step-4',
        'uses' => 'PublicController@step4'
    ]);
    $router->get(LaravelLocalization::transRoute('register::routes.register.step-5'), [
        'as'   => 'register.form.step-5',
        'uses' => 'PublicController@step5'
    ]);
    $router->post(LaravelLocalization::transRoute('register::routes.register.step-5'), [
        'as'   => 'register.form.step-5.put',
        'uses' => 'PublicController@postStep5'
    ]);
    $router->get(LaravelLocalization::transRoute('register::routes.register.finish'), [
        'as'   => 'register.form.finish',
        'uses' => 'PublicController@finish'
    ]);
    $router->post(LaravelLocalization::transRoute('register::routes.register.upload'), [
        'as'   => 'register.form.upload',
        'uses' => 'PublicController@upload'
    ]);
    $router->post(LaravelLocalization::transRoute('register::routes.register.remove'), [
        'as'   => 'register.form.remove',
        'uses' => 'PublicController@remove'
    ]);
    $router->get(LaravelLocalization::transRoute('register::routes.register.files'), [
        'as'   => 'register.form.files',
        'uses' => 'PublicController@files'
    ]);
});