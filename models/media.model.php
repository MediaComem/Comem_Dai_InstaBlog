<?php

class Media {
  private static $table = 'MEDIA';

  /**
   * Récupère tous les enregistrements des médias depuis la base de données et les retourne en tant qu'array.
   * Si aucun média n'existe, le tableau retourné est vide.
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
  
  /**
   * Créer une nouvelle entrée dans la base de données avec les valeurs présentes dans $values.
   * @param {Array} $values - L'ensemble des valeurs du nouvel enregistrement
   */
  public static function createOne($values) {
    $db = option('db_conn');
    $request =
      'INSERT INTO '.self::$table.' (DateCreation, Url, Stockage)
      VALUES(:dateCreation, :url, :stockage)';
    $req = $db->prepare($request);
    
    // Ajout de la date du jour comme DateCreation
    $values[':dateCreation'] = date('Y-m-d');

    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $values
    if ($req->execute($values)) {
      return true;
    } else {
      throw new Exception("Erreur lors de l'ajout du nouveau média !");
    }
  }
  
  /**
   * Valide que les données contenues dans $values respectent les contraintes relatives à un média.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouveau Média à créer
   */
  public static function validate(array $values) {
    $errors = [];

    // URL commence par "/" ou "X:" si stockage Interne, et "http://" ou "https://" si stockage externe
    if ($values[':stockage'] === "interne" and !preg_match("#^(/|[A-Z]:)#", $values[':url'])) {
      array_push($errors, "Pour un stockage interne, l'url doit commencer par \"/\" ou une lettre de lecteur comme \"C:\" ou \"D:\".");
    } elseif ($values[':stockage'] === 'externe' and !preg_match("#^(http://|https://)#", $values[':url'])) {
      array_push($errors, "Pour un stockage externe, l'url doit commencer par \"http://\" ou \"https://\".");
    }

    return $errors;
  }
}