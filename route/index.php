<?php

$app = new \Route;

$app->get('/', 'MainController@index');

$app->run();
