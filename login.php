<?php
require 'vendor/autoload.php';

$app = new App();

$app->add([new \atk4\login\LoginForm(), 'auth'=>$app->auth]);
