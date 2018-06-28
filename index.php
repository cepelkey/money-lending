<?php
require 'vendor/autoload.php';

$app = new App();

$layout = $app->add('Columns');
$c1 = $layout->addColumn(4);
$c2 = $layout->addColumn(12);

$m = $c1->add(['Menu', 'vertical fluid']);
$m->addItem('New User Registration', ['register']);
$m->addItem('User Login', ['login']);
$m->addItem("Admin", ['admin']);

$c2->add(['Message', 'Welcome to the Money Lending App!', 'info'])
    ->text->addParagraph('This application is designed for allowing friends to track borrowed money!');
