<?php

class Utilisateur {
  private static $table = 'UTILR';

  /**
   * Récupère tous les enregistrements des utilisateurs depuis la base de données et les retourne en tant qu'array.
   * Si aucun utilisateur n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les utilisateurs présents dans la BD.
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
   * Récupère un utilisateur grâce à son pseudo (qui est censé être unique dans toute la BD).
   * Si l'utilisateur existe, il est retourné sous la forme d'un objet correspondant à la ligne dans la BD.
   * Sinon la méthode retourne null
   * @param {String} $pseudo - Le pseudo de l'utilisateur à retrouver.
   * @return {Object|Null}
   */
  public static function findByPseudo($pseudo) {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM ' . self::$table . ' WHERE pseudo = :pseudo');
    
    if ($req->execute([':pseudo' => $pseudo])) {
      return $req->fetch(PDO::FETCH_OBJ);
    }
    return null;
  }

  /**
   * Récupère un utilisateur grâce à son numéro.
   * Si l'utilisateur existe, il est retourné sous la forme d'un objet correspondant à la ligne dans la BD.
   * Sinon la méthode retourne null
   * @param {Number} $no - Le numéro de l'utilisateur à retrouver.
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
  
  /**
   * Créer une nouvelle entrée dans la base de données avec les valeurs présentes dans $values.
   * @param {Array} $values - L'ensemble des valeurs du nouvel enregistrement
   */
  public static function createOne($values) {
    $db = option('db_conn');

    $request = 
      "INSERT INTO ".self::$table." (Pseudo, Email, Nom, Prenom, DateNaissance, Telephone, Sexe)
      VALUES (:pseudo, :email, :nom, :prenom, :dateNaissance, :telephone, :sexe)";
    $req = $db->prepare($request);

    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $values
    if ($req->execute($values)) {
      return true;
    } else {
      throw new Exception("Erreur lors de l'ajout du nouvel utilisateur !");
    }
  }

  /**
   * Valide que les données contenues dans $values respectent les contraintes relatives à un utilisateur.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouvel Utilisateur à créer
   */
  public static function validate(array $values) {
    $errors = [];

    // Pseudo déjà existant
    $user = Utilisateur::findByPseudo($values[':pseudo']);
    // Si $user n'est pas vide, c'est que le pseudo existe déjà en BD, donc ça ne joue pas
    if (!empty($user)) array_push($errors, "Le pseudo \"".$values[':pseudo']."\" est déjà utilisé.");
    
    // Date de naissance dans le passé
    // Convertion de l'input en objet Date
    $date = new DateTime($values[':dateNaissance']);
    // Génération d'un objet à la date d'aujourd'hui
    $today = new DateTime(date('Y-m-d'));
    // Si la date de l'input est plus grande ou égale à la date d'aujourd'hui, ça ne joue pas
    if ($date >= $today) array_push($errors, "La date du ".$values[':dateNaissance']." n'est pas valide comme date de naissance.");

    return $errors;
  }
}