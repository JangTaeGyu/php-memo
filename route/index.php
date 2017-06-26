<?php

$app = new \Route;

$app->get('/', 'MemoController@index');
$app->get('/memo/create', ['uses' => 'MemoController@create', 'auth' => true]);
$app->post('/memo/store', ['uses' => 'MemoController@store', 'auth' => true]);
$app->get('/memo/view', 'MemoController@view');

$app->get('/auth/login', ['uses' => 'AuthController@login', 'auth' => false]);
$app->post('/auth/login/process', ['uses' => 'AuthController@loginProcess', 'auth' => false]);
$app->get('/auth/logout', ['uses' => 'AuthController@logout', 'auth' => true]);

$app->get('/join/signup', ['uses' => 'JoinController@signup', 'auth' => false]);
$app->post('/join/signup/process', ['uses' => 'JoinController@signupProcess', 'auth' => false]);

$app->run();
