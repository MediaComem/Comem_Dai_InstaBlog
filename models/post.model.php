<?php

require_once('positiongps.model.php');

class Post {
  private static $table = 'POST';

  /**
   * Récupère tous les enregistrements des posts depuis la base de données et les retourne en tant qu'array.
   * Si aucun post n'existe, le tableau retourné est vide.
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
      "INSERT INTO ".self::$table." (No, NoUtilr, DateCreation, DatePublication, Type, Texte, NoPosGPS, NoGrpe)
      VALUES (:no, :noUtilr, :dateCreation, :datePublication, :type, :texte, :noPosGPS, :noGrpe)";
    $req = $db->prepare($request);

    // Générer le numéro du post en fonction du numéro utilisateur
    $values[':no'] = self::nextNumberFor($values[':noUtilr']);
    // Générer la date de création du post
    $values[':dateCreation'] = date('Y-m-d');
    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $values
    if ($req->execute($values)) {
      return true;
    } else {
      throw new Exception("Erreur lors de l'ajout du nouveau post !");
    }
  }

  /**
   * Valide que les données contenues dans $values respectent les contraintes relatives à un post.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouveau Post à créer
   */
  public static function validate(array $values) {
    $errors = [];

    // Date de publication égale ou supérieure à aujourd'hui
    $today = new DateTime(date('Y-m-d'));
    $date = new DateTime($values[':datePublication']);
    if ($date < $today) array_push($errors, "La date du ".$values[':datePublication']." n'est pas valable comme date de publication.");

    // Utilisateur existant
    $user = Utilisateur::find($values[':noUtilr']);
    if (empty($user)) array_push($errors, "L'utilisateur indiqué n'existe pas.");

    // Si Position GPS, alors existante
    if (!empty($values[':noPosGPS'])) {
      $posGPS = PositionGPS::find($values[':noPosGPS']);
      if (empty($posGPS)) array_push($errors, "La position GPS indiquée n'existe pas.");
    }

    // Si Groupe...
    if (!empty($values[':noGrpe'])) {
      // ... alors pas de type "Story"
      if ($values[':type'] === "stories") array_push($errors, "Impossible de publier un post de type \"Story\" dans un groupe.");
      // ... alors groupe existant
      $groupe = Groupe::find($values[':noGrpe']);
      if (empty($groupe)) array_push($errors, "Le groupe indiqué n'existe pas.");
    }

    return $errors;
  }

  /**
   * Retourne le prochain numéro valide d'un post pour l'utilisateur identifié par $noUtilr
   * @param {Number} $noUtilr - Le numéro d'un utilisateur existant
   * @return {Number}
   */
  public static function nextNumberFor($noUtilr) {
    $db = option('db_conn');
    $req = $db->prepare("SELECT MAX(No) + 1 AS nextNo FROM ".self::$table." WHERE NoUtilr = :noUtilr");
    
    if ($req->execute([':noUtilr' => $noUtilr])) {
      // Le résultat est retourné sous la forme d'un objet avec une propriété du même nom que l'alias : nextNo.
      $result = $req->fetch(PDO::FETCH_OBJ);
      // On ne retourne que le numéro, pas l'objet complet.
      return $result->nextNo;
    } else {
      throw new Exception("Erreur lors de l'ajout du nouveau post !");
    }
  }
}