<?php

class MessageDirect {
  
  private static $table = 'MESSDIR';

  /**
   * Récupère tous les enregistrements des messages directs depuis la base de données et les retourne en tant qu'array.
   * Si aucun message direct n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les messages directs présents dans la BD.
   */
  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM '.self::$table.' ORDER BY NoUtilrEmetteur, No');

    if ($req->execute()) {
      return $req->fetchAll();
    }
    return null;
  }

}