<?php

require_once('utilisateur.model.php');

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
      // Si un problème est survenu lors de l'exécution de la requête
      // On lance une exception avec le message d'erreur de l'exécution ratée
      throw new Exception($req->errorInfo()[2]);
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

    return $errors;
  }

  /**
   * Retourne le prochain numéro valide d'un post pour l'utilisateur identifié par $noUtilr
   * @param {Number} $noUtilr - Le numéro d'un utilisateur existant
   * @return {Number}
   */
  public static function nextNumberFor($noUtilr) {
    $db = option('db_conn');
    // L'idée est de récupérer le plus grand numéro de post pour l'utilisateur indiqué
    $req = $db->prepare("SELECT MAX(No) + 1 AS nextNo FROM ".self::$table." WHERE NoUtilr = :noUtilr");
    
    if ($req->execute([':noUtilr' => $noUtilr])) {
      // Le résultat est retourné sous la forme d'un objet avec une propriété du même nom que l'alias : nextNo.
      $result = $req->fetch(PDO::FETCH_OBJ);
      // Si la propriété nextNo de l'objet result est vide, c'est qu'il s'agit du premier post pour cet utilisateur
      // Dans ce cas, on doit juste retourner 1 manuellement.
      // Si la propriété possède une valeur, il nous faut y faire + 1 pour avoir la nouvelle valeur
      return empty($result->nextNo) ? 1 : $result->nextNo + 1;
    } else {
      // Si un problème est survenu lors de l'exécution de la requête
      // On lance une exception avec le message d'erreur de l'exécution ratée
      throw new Exception($req->errorInfo()[2]);
    }
  }
}