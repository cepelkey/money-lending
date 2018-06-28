<?php
require 'vendor/autoload.php';

$app = new App(true);
$app->initLayout('Centered');

$form = $app->add('Form');
$form->setModel(new Model\User($app->db), ['name', 'password']);
$form->onSubmit(function($form) {
  $m = new User($this->db);
     $m->tryLoadBy('name', $form->model['name']);
     if ($m['password'] != $form->model['password']) {
         return [$form->error['name','Incorrect name or password!'],
                 $form->error['password','Incorrect name or password!']];
     } else {
       $_SESSION['user_id'] = $m['id'];
       return new \atk4\ui\jsExpression('document.location="overview.php"');
     }
});