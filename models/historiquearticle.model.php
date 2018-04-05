<?php

class HistoriqueArticle {

  private static $table = 'HISART';

  /**
   * Créer une nouvelle entrée dans la base de données avec les valeurs présentes dans $values.
   * @param {Array} $values - L'ensemble des valeurs du nouvel enregistrement
   */
  public static function createOne($values) {
    $db = option('db_conn');

    $request = 
      "INSERT INTO ".self::$table." (NoUtilr, Date, Heure, Statut, NoArtic)
      VALUES (:noUtilr, :date, :heure, :statut, :noArtic)";
    $req = $db->prepare($request);

    // Génération de la date
    $values[':date'] = date('Y-m-d');
    // Génération de l'heure
    $values[':heure'] = date('H:i:s');

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