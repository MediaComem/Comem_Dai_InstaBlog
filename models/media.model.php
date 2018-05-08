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
      // Si un problème est survenu lors de l'exécution de la requête
      // On lance une exception avec le message d'erreur de l'exécution ratée
      throw new Exception($req->errorInfo()[2]);
    }
  }

}