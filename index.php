<?php
session_start();

error_reporting(E_ALL | E_STRICT);    
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

require 'Controleur/Routeur.php';

$routeur = new Routeur();
$routeur->routerRequete();