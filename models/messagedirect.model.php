<?php

require_once('utilisateur.model.php');

class MessageDirect {
  private static $table = 'MESSDIR';

  /**
   * Récupère tous les enregistrements des messages directs depuis la base de données et les retourne en tant qu'array.
   * Si aucun message direct n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les messages directs présents dans la BD.
   */
  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM '.self::$table.' ORDER BY NoUtilrEmetteur, No');

    if ($req->execute()) {
      return $req->fetchAll();
    }
    return null;
  }

  /**
   * Récupère un message direct grâce à son numéro et au numéro utilisateur de son émetteur.
   * Si le message direct existe, il est retourné sous la forme d'un objet correspondant à la ligne dans la BD.
   * Sinon la méthode retourne null
   * @param {Number} $no - Le numéro du message direct à retrouver.
   * @param {Number} $noUtilr - Le numéro utilisateur de l'émetteur du message à retrouver.
   * @return {Object|Null}
   */
  public static function find($no, $noUtilr) {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM ' . self::$table . ' WHERE No = :no AND NoUtilrEmetteur = :noUtilr');
    
    if ($req->execute([':no' => $no, ':noUtilr' => $noUtilr])) {
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
      "INSERT INTO ".self::$table." (No, NoUtilrEmetteur, NoUtilrRecepteur, Titre, Contenu)
      VALUES (:no, :noUtilrEmetteur, :noUtilrRecepteur, :titre, :contenu)";
    $req = $db->prepare($request);

    // Génération du numéro de message direct selon l'émetteur
    $values[':no'] = self::nextNumberFor($values[':noUtilrEmetteur']);

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
   * Valide que les données contenues dans $values respectent les contraintes relatives à un message direct.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouveau message direct à créer
   */
  public static function validate(array $values) {
    $errors = [];

    // Existence de l'émetteur
    $emetteur = Utilisateur::find($values[':noUtilrEmetteur']);
    if (empty($emetteur)) array_push($errors, "Utilisateur émetteur inexistant.");

    // Existence du récepteur
    $recepteur = Utilisateur::find($values[':noUtilrRecepteur']);
    if (empty($recepteur)) array_push($errors, "Utilisateur récepteur inexistant.");

    // Émetteur et récepteur différents
    if (is_object($emetteur) and is_object($recepteur) and $emetteur == $recepteur) {
      array_push($errors, "L'émetteur et le récepteur doivent être des utilisateurs différents.");
    }

    return $errors;
  }

  /**
   * Retourne le prochain numéro valide d'un message direct pour l'utilisateur identifié par $noUtilr
   * @param {Number} $noUtilr - Le numéro d'un utilisateur existant
   * @return {Number}
   */
  public static function nextNumberFor($noUtilr) {
    $db = option('db_conn');
    // L'idée est de récupérer le plus grand numéro de post pour l'utilisateur indiqué
    $req = $db->prepare("SELECT MAX(No) AS nextNo FROM ".self::$table." WHERE NoUtilrEmetteur = :noUtilr");
    
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