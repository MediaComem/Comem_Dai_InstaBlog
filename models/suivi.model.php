<?php

class Suivi {

  private static $table = 'SUIVI';

  /**
   * Récupère tous les enregistrements des suivis depuis la base de données et les retourne en tant qu'array.
   * Si aucun suivi n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les suivis présents dans la BD.
   */
  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM '.self::$table);

    if ($req->execute()) {
      return $req->fetchAll();
    }
    return null;
  }

}