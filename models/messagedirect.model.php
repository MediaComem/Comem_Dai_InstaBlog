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
    } else {
      halt($req->errorInfo()[2]);
    }
    return array();
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
      "INSERT INTO ".self::$table." (No, NoUtilrEmetteur, NoUtilrRecepteur, Titre, Contenu, RepondANo, RepondANoUtilr)
      VALUES (:no, :noUtilrEmetteur, :noUtilrRecepteur, :titre, :contenu, :repondANo, :repondANoUtilr)";
    $req = $db->prepare($request);

    // Génération du numéro de message direct selon l'émetteur
    $values[':no'] = MessageDirect::nextNumberFor($values[':noUtilrEmetteur']);

    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $values
    if ($req->execute($values)) {
      return true;
    } else {
      throw new Exception("Erreur lors de l'ajout du nouvel utilisateur !");
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

    // Émetteur et récepteur différents
    if ($values[':noUtilrEmetteur'] === $values[':noUtilrRecepteur']) array_push($errors, "L'émetteur et le récepteur doivent être des utilisateurs différents.");

    // Existence de l'émetteur
    $emetteur = Utilisateur::find($values[':noUtilrEmetteur']);
    if (empty($emetteur)) array_push($errors, "Utilisateur émetteur inexistant.");

    // Existence du récepteur
    $recepteur = Utilisateur::find($values[':noUtilrRecepteur']);
    if (empty($recepteur)) array_push($errors, "Utilisateur récepteur inexistant.");

    // Si Répond à...
    // Les deux doivent être présents
    if (!empty($values[':repondANo']) and empty($values[':repondANoUtilr'])) {
      array_push($errors, "Le numéro utilisateur de l'émetteur du message auquel répondre est obligatoire si le numéro de ce message est présent.");
    } else if (empty($values[':repondANo']) and !empty($values[':repondANoUtilr'])) {
      array_push($errors, "Le numéro du message auquel répondre est obligatoire si le numéro utilisateur de l'émetteur de ce message est présent.");
    } else if (!empty($values[':repondANo']) and !empty($values[':repondANoUtilr'])) {
      // ... Existence du message précédent
      $message = self::find($values[':repondANo'], $values[':repondANoUtilr']);
      if (empty($message)) {
        array_push($errors, "Impossible de répondre à un message inexistant.");
      // Correspondance entre émetteur et récepteur du message auquel on répond
      } else if ($message->NoUtilrRecepteur !== $values[':noUtilrEmetteur'] or $message->NoUtilrEmetteur !== $values[':noUtilrRecepteur']) {
        array_push($errors, "Impossible de répondre au message indiqué (il ne fait pas partie de la conversation entre les utilisateurs indiqués).");
      }
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
    $req = $db->prepare("SELECT MAX(No) + 1 AS nextNo FROM ".self::$table." WHERE NoUtilrEmetteur = :noUtilr");
    
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