<?php

/* --- Chargement de Limonade --- */
require_once 'lib/limonade.php';

function dd($value) {
  echo "<pre>";
  print_r($value);
  echo "</pre>";
  die();
}

/* --- Charge la configuration utilisateur --- */
option('ibConf', include('config.php'));

/* --- Configuration de Limonade --- */
function configure() {
  option('controllers_dir', dirname(__FILE__).'/controllers');
  option('views_dir', dirname(__FILE__).'/views');

  try {
    $dbh = new PDO('mysql:host='.option('ibConf')['DB_HOST'].';dbname='.option('ibConf')['DB_NAME'], option('ibConf')['DB_USER'], option('ibConf')['DB_PASS']);
  } catch (PDOException $e) {
    halt("Connexion failed: ".$e);
  }
  option('db_conn', $dbh);
}

/* --- Définition du layout principal --- */
function before() {
  layout('layouts/master.html.php');
}

/* --- Inclusion des routes --- */
require_once('routes.php');

/* --- Démarrage de l'application --- */
run();