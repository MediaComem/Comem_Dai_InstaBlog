<?php

class ArticlePublicitaireModel {

  private static $table = 'articlepublicitaire';

  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM ' . self::$table);

    if ($req->execute()) {
      return $req->fetchAll();
    }
    return array();
  }
  
}
