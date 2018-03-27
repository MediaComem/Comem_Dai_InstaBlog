<?php

class MessageDirect {
  private static $table = 'messdir';

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
    } else {
      halt($req->errorInfo()[2]);
    }
    return array();
  }

  /**
   * Valide que les données contenues dans $inputs respectent les contraintes relatives à un message direct.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $inputs - Un tableau contenant toutes les valeurs du nouveau message direct à créer
   */
  public static function validate(array $inputs) {
    // TODO
  }
}