<?php

require 'vendor/autoload.php';

$app = new App();

if (!$app->auth->user->loaded()) {
    $app->redirect(['login']);
  }

$col = $app->add('Columns');

$friend_id = $app->stickyGet('friend_id');
$friend = $app->auth->user->ref('Friends')->load($friend_id);

// $msg = $app->add(['Message', 'Loans to ' . $friend['first_name'] . ' ' . $friend['last_name'], 'info']);

$c1 = $col->addColumn(4);
$friendsTemplate = $c1->add(['defaultTemplate'=>'./friends-cards.html']);
$friendsTemplate->template->set($friend);
$friendsTemplate->template->del('button');

$c2 = $col->addColumn(6);
$c2->add(['Header', 'Loans']);
$c2->add('Table')->setModel($friend->ref("Loans"));

$c3 = $col->addColumn(6);
$c3->add(['Header', 'Payments']);
$c3->add('Table')->setModel($friend->ref("Repayments"));

$c1->add(['Button', 'My Dashboard', 'primary fluid'])->link(['dashboard']);
// $c1->add(['Button', 'Logout', 'primary'])->link(['logout']);