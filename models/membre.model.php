<?php

class Membre {
  
  private static $table = 'MBRE';

  /**
   * Récupère tous les enregistrements des membres depuis la base de données et les retourne en tant qu'array.
   * Si aucun membre n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les membres présents dans la BD.
   */
  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM '.self::$table.' ORDER BY NoGrpe');

    if ($req->execute()) {
      return $req->fetchAll();
    }
    return null;
  }

}