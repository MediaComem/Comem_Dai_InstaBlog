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

  public static function validate(array $inputs) {
    $errors = [];

    // Validation du "name"
    if (empty($inputs["name"])) array_push($errors, "Le nom est obligatoire !");
    if (empty($inputs["remember"])) array_push($errors, 'Cliquez sur "Remember" !');
    if (empty($inputs["pass"])) array_push($errors, "Le mot de passe est obligatoire !");

    return $errors;
  }
}
