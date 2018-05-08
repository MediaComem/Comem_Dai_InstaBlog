<?php

require_once('utilisateur.model.php');
require_once('groupe.model.php');

class Membre {
  
  private static $table = 'MBRE';

  /**
   * Récupère tous les enregistrements des membres depuis la base de données et les retourne en tant qu'array.
   * Si aucun membre n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les membres présents dans la BD.
   */
  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM '.self::$table.' ORDER BY NoGrpe');

    if ($req->execute()) {
      return $req->fetchAll();
    }
    return null;
  }

  /**
   * Récupère un membre grâce au groupe et à l'utilisateur.
   * Si le membre existe, il est retourné sous la forme d'un objet correspondant à la ligne dans la BD.
   * Sinon la méthode retourne null
   * @param {Object} $groupe - Un groupe existant
   * @param {Object} $utilisateur - Un utilisateur existant
   * @return {Object|Null}
   */
  public static function find($groupe, $utilisateur) {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM ' . self::$table . ' WHERE NoGrpe = :noGrpe AND NoUtilr = :noUtilr');
    
    if ($req->execute([':noGrpe' => $groupe->No, ':noUtilr' => $utilisateur->No])) {
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
      "INSERT INTO ".self::$table." (NoGrpe, NoUtilr)
      VALUES (:noGrpe, :noUtilr)";
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
   * Valide que les données contenues dans $values respectent les contraintes relatives à un membre.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouveau membre à créer
   */
  public static function validate(array $values) {
    $errors = [];

    // Groupe existant
    $groupe = Groupe::find($values[':noGrpe']);
    if (empty($groupe)) array_push($errors, "Le groupe indiqué n'existe pas.");

    // Utilisateur existant
    $utilisateur = Utilisateur::find($values[':noUtilr']);
    if (empty($utilisateur)) array_push($errors, "L'utilisateur indiqué n'existe pas.");

    // Membre inexistant
    if (!empty($groupe) and !empty($utilisateur)) {
      $membre = self::find($groupe, $utilisateur);
      if (!empty($membre)) array_push($errors, "Cet utilisateur est déjà membre de ce groupe.");
    }

    return $errors;
  }
  
  /**
   * Nettoie le contenu du tableau des membres obtenu lors de l'envoi d'un formulaire d'ajout d'un nouveau groupe
   * Ce nettoyage va surtout supprimer du tableau les éventuels membres en double et ceux qui sont "vides" (non saisies dans l'IHM).
   * @param {Array} $data - Un tableau de tableaux contenant des numéros d'utilisateurs
   * @return {Array} - Le tableau initial moins les éventuels doublons
   */
  public static function cleanData($membres) {
    // Garder une simple liste des numéros d'utilisateurs déjà présents
    $list = [];
    // Boucler sur tous les membres présents dans le tableau
    foreach ($membres as $key => $membre) {
      // Regarder si le noUtilr du membre en cours est déjà présent dans la liste des numéros d'utilisateurs
      // ou bien s'il est vide (parce que le champ n'a pas été rempli dans l'IHM)
      if (empty($membre[':noUtilr']) or in_array($membre[':noUtilr'], $list)) {
        // Si c'est le cas, alors on supprime le membre en cours du tableau complet des membres
        unset($membres[$key]);
      } else {
        // Si ce n'est pas le cas, c'est que c'est la première fois qu'on rencontre ce numéro d'utilisateur
        // Dans ce cas, on ajoute le numéro à la liste des numéros d'utilisateur
        // Ainsi, si on le rencontre à nouveau par la suite, il ne sera pas repris en compte
        array_push($list, $membre[':noUtilr']);
      }
    }
    // On retourne le tableau complet des membres nettoyés
    return $membres;
  }
}