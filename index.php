<?php

/* --- Chargement de Limonade --- */
require_once 'lib/limonade.php';

function dump($value) {
  echo "<pre>";
  print_r($value);
  echo "</pre>";
}

/* --- Configuration de Limonade --- */
function configure() {
  option('controllers_dir', dirname(__FILE__).'/controllers');
  option('views_dir', dirname(__FILE__).'/views');

  $user = 'root';
  $pass = 'root';
  try {
    $dbh = new PDO('mysql:host=localhost;dbname=mdt_assurance', $user, $pass);
  } catch (PDOException $e) {
    halt("Connexion failed: ".$e);
  }
  option('db_conn', $dbh);
}

/* --- Définition du layout principal --- */
function before() {
  layout('layouts/main.html.php');
}

/* --- Inclusion des routes --- */
require_once('routes.php');

/* --- Démarrage de l'application --- */
run();