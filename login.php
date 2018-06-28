<?php
require 'vendor/autoload.php';

$app = new App(true);

$app->auth = $app->add(new \atk4\login\Auth([
    'hasPreferences' => true, // do not show Preferences page/form
    'pageDashboard' => 'dashboard', // name of the page, where user arrives after login
    'pageExit' => 'index', // where to send user after logout
]));
$app->auth->setModel(new Model\User($app->db));
