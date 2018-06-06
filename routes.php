<?php

// $router ->define ([
//
//
// ]);

$router->get('', 'pages/index.php');
$router->get('messageboard', 'pages/messageboard.php');
$router->get('fileboard', 'pages/fileboard.php');
$router->get('about', 'pages/about.php');
$router->get('archive', 'pages/archive.php');
$router->get('specialthanks', 'pages/specialthanks.php');
$router->get('thanks', 'pages/thanks.php');
$router->get('pages/storage/messages.txt', 'pages/storage/messages.txt');
$router->get('signup', 'pages/signup.php');
$router->get('profile', 'pages/profile.php');
$router->get('ajax', 'pages/ajax/ajax.php');

$router->post('archive', 'pages/archive.php');
$router->post('profile', 'pages/profile.php');
$router->post('login', 'pages/constants/login.php');
$router->post('feedback', 'core/feedback.php');
$router->post('fileboard', 'pages/fileboard.php');
$router->post('signup', 'pages/signup.php');
$router->post('options', 'pages/constants/options.php');
$router->post('messageboard', 'pages/messageboard.php');
