<?php

class Article {
  private static $table = 'ARTIC';

  /**
   * Récupère tous les enregistrements des articles depuis la base de données et les retourne en tant qu'array.
   * Si aucun article n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les articles présents dans la BD.
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