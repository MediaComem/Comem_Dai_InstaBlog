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

/* --- Chargement de Limonade --- */
require_once 'lib/limonade.php';

/* --- Charge la configuration utilisateur --- */
option('ibConf', include('config.php'));

/* --- Configuration de Limonade --- */
function configure() {
  // Indique à Limonade que nous utilisons des fichiers de contrôleurs et où ils sont placés, afin qu'il les charge tout seul
  option('controllers_dir', dirname(__FILE__).'/controllers');
  // Indique à Limonade où sont situés les fichiers qui servent à générer les vues (les pages HTML, donc)
  option('views_dir', dirname(__FILE__).'/views');

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
  layout('layouts/master.html.php');
}

/* --- Inclusion des routes --- */
require_once('routes.php');

/* --- Démarrage de l'application --- */
run();
