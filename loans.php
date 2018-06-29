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
$friendsTemplate->template->del('multi');
$friendsTemplate->template->del('button');

$buttons = $c1->add(['ui'=>'fluid buttons']);
$buttons->add(['Button', null, 'primary basic', 'icon'=>'left arrow'])->link(['dashboard']);
$delButton = $buttons->add(['Button', null, 'negative basic', 'icon'=>'trash']);

$delButton->on('click', function() use ($friend, $app){
  $name = $friend['first_name'].' '.$friend['last_name'];
  $friend->delete();
  return $app->jsRedirect(['dashboard', 'message'=>'Your friend ' . $name . ' was deleted']);
});

function addCol($col, $friend, $label, $action, $default=50){
  $c = $col->addColumn(6);
  $c->add(['Header', $label]);
  $t = $c->add('Table')->setModel($friend->ref($label));

  $field = $c->add(['FormField\Money', $default, 'fluid']);
  $fieldAction = $field->addAction([$action, 'primary']);
  $fieldAction->on('click', function($js, $amount) use ($friend, $label) {
    $friend->ref($label)->save(['date'=>date("Y-m-d"),'amount'=>$amount]);
    return $friend->app->jsRedirect([]);
  }, [$field->jsInput()->val()]);
}
addCol($col, $friend, 'Loans', 'Loan');
addCol($col, $friend, 'Repayments', 'Repay', $friend['owed']);
