<?php
// affiche les erreurs
error_reporting(E_ALL);

require_once('../vendor/Autoloader.php');

Autoloader::register();

$dispatcher = new Dispatcher();
