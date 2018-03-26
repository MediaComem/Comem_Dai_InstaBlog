<?php

class Users {
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
}