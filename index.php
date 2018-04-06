<?php

/* --- Chargement de Limonade --- */
require_once('lib/limonade.php');

/* --- Configuration de Limonade --- */
function configure() {

  /* --- Charge la configuration utilisateur --- */
  $ibConfig = include('config.php');

  // Tentative de connexion à la base de données MySQL en utilisant PDO
  try {
    $db = new PDO('mysql:host='.$ibConfig['DB_HOST'].';dbname='.$ibConfig['DB_NAME'],
    $ibConfig['DB_USER'],
    $ibConfig['DB_PASS'],
    array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
  } catch (PDOException $e) {
    halt("Connexion failed: ".$e);
  }
  // Sauvegarde de la connexion à la BD pour la réutiliser à d'autres endroits de l'application
  option('db_conn', $db);
}

/* --- Définition du layout principal --- */
function before() {
  // Toutes les pages générées utliseront le layout "master"
  // Ce dernier contient notamment la navigation et le footer.
  layout('layouts/master.html.php');
}

/* --- Chargement des routes --- */
require_once('routes.php');

/* --- Chargement des fonctions utilitaires personnalisées --- */
require_once('lib/utils.php');

/* --- Démarrage de l'application --- */
run();
