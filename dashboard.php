<?php

require 'vendor/autoload.php';

$app = new App(true);

$app->auth = $app->add(new \atk4\login\Auth([
    'hasPreferences' => true, // do not show Preferences page/form
    'pageDashboard' => 'dashboard', // name of the page, where user arrives after login
    'pageExit' => 'index', // where to send user after logout
]));
$app->auth->setModel(new Model\User($app->db));

// check that the user is logged-in
if (!$app->auth->user->loaded()) {
    $app->add([new \atk4\login\LoginForm(), 'auth'=>$app->auth]);
  }

//display Friends, Loans and Repayments for logged in user
$app->add('CRUD')->setModel(new Model\Friend($app->db));
$app->add('CRUD')->setModel(new Model\Loan($app->db));
$app->add('CRUD')->setModel(new Model\Repayment($app->db));
