<?php

class Post {
  private static $table = 'POST';

  /**
   * Récupère tous les enregistrements des posts depuis la base de données et les retourne en tant qu'array.
   * Si aucun post n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les médias présents dans la BD.
   */
  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM ' . self::$table);

    if ($req->execute()) {
      return $req->fetchAll();
    }
    return null;
  }

}