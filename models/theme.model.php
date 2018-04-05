<?php

class Theme {

  private static $table = "THEME";

  /**
   * Récupère un theme grâce à son numéro identifiant.
   * Si le thème existe, il est retourné sous la forme d'un objet correspondant à la ligne dans la BD.
   * Sinon la méthode retourne null
   * @param {Number} $no - Le numéro d'un thème existant
   * @return {Object|Null}
   */
  public static function find($no) {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM ' . self::$table . ' WHERE No = :no');
    
    if ($req->execute([':no' => $no])) {
      return $req->fetch(PDO::FETCH_OBJ);
    }
    return null;
  }
}