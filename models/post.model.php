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
    return array();
  }

  /**
   * Valide que les données contenues dans $values respectent les contraintes relatives à un post.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouveau Post à créer
   */
  public static function validate(array $values) {
    // TODO
  }
}