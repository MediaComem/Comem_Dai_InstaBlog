<?php

class PositionGPS {

  private static $table = 'POSGPS';

  /**
   * Récupère une position GPS grâce à son numéro.
   * Si la position GPS existe, elle est retournée sous la forme d'un objet correspondant à la ligne dans la BD.
   * Sinon la méthode retourne null
   * @param {Number} $no - Le numéro de la position GPS à retrouver.
   * @return {Object|Null}
   */
  public static function find($no) {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM ' . self::$table . ' WHERE no = :no');
    
    if ($req->execute([':no' => $no])) {
      return $req->fetch(PDO::FETCH_OBJ);
    }
    return null;
  }

}