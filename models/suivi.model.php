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
    } else {
      halt($req->errorInfo()[2]);
    }
    return array();
  }

  /**
   * Valide que les données contenues dans $values respectent les contraintes relatives à un suivi.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouveau suivi à créer
   */
  public static function validate(array $values) {
    // TODO
  }
}