<?php
require 'vendor/autoload.php';

$app = new App(true);

$app->initLayout('Centered');

$m = new Model\User($app->db);
$m->load($_SESSION['user_id']);

$app->add('CRUD')->setModel($m->ref('Friends'));
$app->add('CRUD')->setModel($m->ref('Loans'));
$app->add('CRUD')->setModel($m->ref('Repayments'));