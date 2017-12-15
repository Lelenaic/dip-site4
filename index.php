<?php
ini_set('date.timezone', 'Europe/Paris');
require 'vendor/autoload.php';
include 'Database.php';

$m = new Mustache_Engine(array(
'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/templates'),
));

$tasks = \Database::query("select id,message,created_at,done from tasks");
// loads template from `views/hello_world.mustache` and renders it.
echo $m->render('list',compact('tasks'));