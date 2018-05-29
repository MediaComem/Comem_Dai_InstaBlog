<?php

class HistoriqueArticle {

  private static $table = 'HISART';

  /**
   * Créer une nouvelle entrée dans la base de données avec les valeurs présentes dans $data.
   * @param {Array} $data - L'ensemble des valeurs du nouvel enregistrement
   */
  public static function createOne($data) {
    $db = option('db_conn');

    $request =
      "INSERT INTO ".self::$table." (NoUtilr, Date, Heure, Statut, NoArtic)
      VALUES (:noUtilr, :date, :heure, :statut, :noArtic)";
    $req = $db->prepare($request);

    // Génération de la date
    $data[':date'] = date('Y-m-d');
    // Génération de l'heure
    $data[':heure'] = date('H:i:s');

    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $data
    if ($req->execute($data)) {
      return true;
    } else {
      // Si un problème est survenu lors de l'exécution de la requête
      // On lance une exception avec le message d'erreur de l'exécution ratée
      throw new Exception($req->errorInfo()[2]);
    }
  }
}