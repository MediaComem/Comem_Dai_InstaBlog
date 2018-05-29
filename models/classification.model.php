<?php

class Classification {

  private static $table = "CLASS";

  /**
   * Créer une nouvelle entrée dans la base de données avec les valeurs présentes dans $data.
   * @param {Array} $data - L'ensemble des valeurs du nouvel enregistrement
   */
  public static function createOne($data) {
    $db = option('db_conn');

    $request =
      "INSERT INTO ".self::$table." (NoTheme, NoArtic)
      VALUES (:noTheme, :noArtic)";
    $req = $db->prepare($request);

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
