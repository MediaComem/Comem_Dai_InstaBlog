<?php

/**
 * Permet d'afficher le contenu d'une variable correctement sur le navigateur de l'utilisateur
 * et d'arrêter l'exécution du script PHP.
 * @param $value - La valeur à afficher
 */
function dd($value) {
  echo "<pre>";
  print_r($value);
  echo "</pre>";
  die();
}

/**
 * Permet de rediriger l'utilisateur vers une autre route de l'application
 * @param $path - La route vers laquelle rediriger l'utilisateur.
 */
function moveTo($path) {
  return Header('Location: ?' . $path);
}

/* --- Chargement de Limonade --- */
require_once 'lib/limonade.php';

/* --- Charge la configuration utilisateur --- */
option('ibConf', include('config.php'));

/* --- Configuration de Limonade --- */
function configure() {

  // Tente de se connecter à la base de données MySQL en utilisant PDO
  try {
    $dbh = new PDO('mysql:host='.option('ibConf')['DB_HOST'].';dbname='.option('ibConf')['DB_NAME'],
      option('ibConf')['DB_USER'],
      option('ibConf')['DB_PASS'],
      array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
  } catch (PDOException $e) {
    halt("Connexion failed: ".$e);
  }
  // Sauve la connexion à la BD pour la réutiliser à d'autres endroits
  option('db_conn', $dbh);
}

/* --- Définition du layout principal --- */
function before() {
  // Toutes les pages générées utliseront le layout "master"
  // Ce dernier contient la navigation et le footer.
  layout('layouts/master.html.php');
}

/* --- Inclusion des routes --- */
require_once('routes.php');

/* --- Démarrage de l'application --- */
run();
