<?php

$app = new \Route;

$app->get('/', 'MemoController@index');
$app->get('/memo/create', ['uses' => 'MemoController@create', 'auth' => true]);
$app->post('/memo/store', ['uses' => 'MemoController@store', 'auth' => true]);
$app->get('/memo/view', 'MemoController@view');

$app->get('/auth/login', 'AuthController@login');
$app->post('/auth/login/process', 'AuthController@loginProcess');
$app->get('/auth/logout', 'AuthController@logout');

$app->get('/join/signup', 'JoinController@signup');
$app->post('/join/signup/process', 'JoinController@signupProcess');

$app->run();
