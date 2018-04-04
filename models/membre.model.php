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
    } else {
      halt($req->errorInfo()[2]);
    }
    return array();
  }

  /**
   * Valide que les données contenues dans $values respectent les contraintes relatives à un membre.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouveau membre à créer
   */
  public static function validate(array $values) {
    // TODO
  }
}