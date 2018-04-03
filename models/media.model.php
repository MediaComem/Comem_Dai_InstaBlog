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
    return array();
  }
  
  public static function createOne($inputs) {
    $db = option('db_conn');
    $request =
      'INSERT INTO '.self::$table.' (DateCreation, Url, Stockage)
      VALUES(:dateCreation, :url, :stockage)';
    $req = $db->prepare($request);
    
    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $inputs
    if ($req->execute($inputs)) {
      return true;
    } else {
      throw new Exception("Erreur lors de l'ajout du nouveau média !");
    }
  }
  
  /**
   * Valide que les données contenues dans $inputs respectent les contraintes relatives à un média.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $inputs - Un tableau contenant toutes les valeurs du nouveau Média à créer
   */
  public static function validate(array $inputs) {
    $errors = [];
    // Date de création antérieure à aujourd'hui
    // URL commence par "/" ou "X:\" si stockage Interne, et "http://" ou "https://" si stockage externe
    if ($inputs[':stockage'] === "interne") {
      if (strpos($inputs[':url'], "/") !== 0 and strpos($inputs[':url'], ":\\") !== 1) array_push($errors, "Pour un stockage interne, l'url doit commencer par \"/\" ou une lettre de lecteur comme \"C:\\\" ou \"D:\\\".");
    } elseif ($inputs[':stockage'] === 'externe') {
      if (strpos($inputs['url'], "http://") !== 0 and strpos($inputs['url'], "https://") !== 0) array_push($errors, "Pour un stockage externe, l'url doit commencer par \"http://\" ou \"https://\".");
    }

    return $errors;
  }
}