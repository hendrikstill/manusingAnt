<?php
session_start();
include_once('./lib/Manusing.php');

$manusing = Manusing::getInstance();

Classloader::getInstance()->loadPlugin("Login");
Login::getInstance();

$manusing->run();



?>