<?php
require 'vendor/autoload.php';

$app = new App();

$app->auth->logout();
$app->redirect(['index']);