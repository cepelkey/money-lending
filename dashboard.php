<?php

require 'vendor/autoload.php';

$app = new App();

if (!$app->auth->user->loaded()) {
    $app->redirect(['login']);
  }
$msg = $app->add(['Message', 'Welcome to the user page for the money lending app', 'info']);
$msg->add('Text')->set($app->auth->user['name']);


$friends = $app->add(['Lister', 'defaultTemplate'=>'./friends-cards.html']);
$friends->setModel($app->auth->user->ref('Friends'));

/*
//$model = new Model\Friend($app->db);
//$model->addCondition('users_id', $app->auth->user->id);

$table = $app->add('Table');
$table->setModel($app->auth->user->ref('Friends'));
$table->addDecorator('first_name', ['Link', ['loans'], ['friend_id'=>'id']]);
$table->addDecorator('last_name', ['Link', ['loans'], ['friend_id'=>'id']]);
*/

$app->add(['Button', 'Logout'])->link(['logout']);