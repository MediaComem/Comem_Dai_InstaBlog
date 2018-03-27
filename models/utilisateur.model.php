<?php

class Utilisateur {
  private static $table = 'UTILR';

  /**
   * Récupère tous les enregistrements des utilisateurs depuis la base de données et les retourne en tant qu'array.
   * Si aucun utilisateur n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les utilisateurs présents dans la BD.
   */
  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM ' . self::$table);

    if ($req->execute()) {
      return $req->fetchAll();
    }
    return array();
  }

  /**
   * Valide que les données contenues dans $inputs respectent les contraintes relatives à un utilisateur.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $inputs - Un tableau contenant toutes les valeurs du nouvel Utilisateur à créer
   */
  public static function validate(array $inputs) {
    // TODO
  }
}