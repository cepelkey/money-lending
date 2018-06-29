<?php

require 'vendor/autoload.php';

$app = new App();

if (!$app->auth->user->loaded()) {
    $app->redirect(['login']);
  }

if (isset($_GET['message'])) {
  $msg = $app->add(['Message', $_GET['message'], 'red']);
  $msg->add(['View','Dismiss'])->link([]);
};

$newFriendButton = $app->add(['Button', 'Add New Friend', 'big primary']);
$modal = $app->add('Modal');
$newFriendButton->on('click', $modal->show());

$friends = $app->add(['Lister', 'defaultTemplate'=>'./friends-cards.html']);

$form = $modal->add('Form');
$form->setModel($app->auth->user->ref('Friends'));
$form->onSubmit(function($form) use ($modal, $friends) {
  $form->model->save();
  return [
    $form->jsReload(),
    $friends->jsReload(),
    $modal->hide()
  ];
});

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