<?php

require_once('utilisateur.model.php');

class Suivi {
  private static $table = 'SUIVI';

  /**
   * Récupère tous les enregistrements des suivis depuis la base de données et les retourne en tant qu'array.
   * Si aucun suivi n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les suivis présents dans la BD.
   */
  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM '.self::$table);

    if ($req->execute()) {
      return $req->fetchAll();
    }
    return null;
  }

  /**
   * Récupère un suivi grâce à ses deux utilisateurs.
   * Si le suivi existe, il est retourné sous la forme d'un objet correspondant à la ligne dans la BD.
   * Sinon la méthode retourne null
   * @param {Object} $utilSuivi - Un utilisateur existant
   * @param {Object} $utilSuiveur - Un utilisateur existant
   * @return {Object|Null}
   */
  public static function find($utilSuivi, $utilSuiveur) {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM ' . self::$table . ' WHERE EstSuiviParNoUtilr = :noSuivi AND SuitNoUtilr = :noSuiveur');
    
    if ($req->execute([':noSuivi' => $utilSuivi->No, ':noSuiveur' => $utilSuiveur->No])) {
      return $req->fetch(PDO::FETCH_OBJ);
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
      "INSERT INTO ".self::$table." (EstSuiviParNoUtilr, SuitNoUtilr)
      VALUES (:estSuiviParNoUtilr, :suitNoUtilr)";
    $req = $db->prepare($request);

    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $values
    if ($req->execute($values)) {
      return true;
    } else {
      // Si un problème est survenu lors de l'exécution de la requête
      // On lance une exception avec le message d'erreur de l'exécution ratée
      throw new Exception($req->errorInfo()[2]);
    }
  }
  
  /**
   * Valide que les données contenues dans $values respectent les contraintes relatives à un suivi.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouveau suivi à créer
   */
  public static function validate(array $values) {
    $errors = [];

    // Pas les mêmes utilisateurs
    if ($values[':estSuiviParNoUtilr'] === $values[':suitNoUtilr']) array_push($errors, "Un utilisateur ne peut pas se suivre lui-même.");

    // Utilisateur suivi existe
    $utilSuivi = Utilisateur::find($values[':estSuiviParNoUtilr']);
    if (empty($utilSuivi)) array_push($errors, "L'utilisateur suivi n'existe pas.");

    // Utilisateur suiveur existe
    $utilSuiveur = Utilisateur::find($values[':suitNoUtilr']);
    if (empty($utilSuiveur)) array_push($errors, "L'utilisateur suiveur n'existe pas.");
    
    // Suivi n'existe pas déjà
    if (!empty($utilSuiveur) and !empty($utilSuivi)) {
      $suivi = self::find($utilSuivi, $utilSuiveur);
      if (!empty($suivi)) array_push($errors, "Ces deux utilisateurs se suivent déjà.");
    }

    return $errors;
  }
}