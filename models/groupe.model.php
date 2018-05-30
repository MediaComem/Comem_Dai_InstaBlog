<?php

require_once('utilisateur.model.php');
require_once('membre.model.php');

class Groupe {
  private static $table = 'GRPE';

  /**
   * Récupère tous les enregistrements des groupes depuis la base de données et les retourne en tant qu'array.
   * Si aucun groupe n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les groupes présents dans la BD.
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
   * Récupère un groupe grâce à son numéro.
   * Si le groupe existe, il est retourné sous la forme d'un objet correspondant à la ligne dans la BD.
   * Sinon la méthode retourne null
   * @param {Number} $no - Le numéro du groupe à retrouver.
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
      "INSERT INTO ".self::$table." (Nom, Description, DateCreation, Administrateur)
      VALUES (:nom, :description, :dateCreation, :administrateur)";
    $req = $db->prepare($request);

    // Génération de la date de création
    $values['groupe'][':dateCreation'] = date('Y-m-d');

    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $values
    if ($req->execute($values['groupe'])) {
      // On récupère dans notre tableau de valeur du groupe la valeur de son numéro (puisqu'on va la réutiliser juste après)
      $values['groupe'][':no'] = $db->lastInsertId();
      // On essaie de créer les membres...
      foreach($membres as $key => $membre) {
        // On n'oublie pas d'ajouter le numéro du groupe nouvellement créé pour chaque membre
        $membre[':noGrpe'] = $values['groupe'][':no'];
        // On peut, enfin, crééer le membre
        // À nouveau, si une erreur survient à n'importe quel moment, la transaction va tout annuler
        Membre::createOne($membre);
      }
      return true;
    } else {
      // Si un problème est survenu lors de l'exécution de la requête
      // On lance une exception avec le message d'erreur de l'exécution ratée
      throw new Exception($req->errorInfo()[2]);
    }
  }

  /**
   * Valide que les données contenues dans $values respectent les contraintes relatives à un groupe.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouveau groupe à créer
   */
  public static function validate(array $values) {
    $errors = [];

    // Existence de l'administrateur
    $admin = Utilisateur::find($values['groupe'][':administrateur']);
    if (empty($admin)) array_push($errors, "L'administrateur indiqué n'existe pas.");

    // Va servir pour savoir si l'administrateur indiqué fait parti des membres à ajouter
    $adminFound = false;

    // Boucler sur tous les utilisateurs à ajouter comme membre
    foreach ($values['membres'] as $key => $membre) {
      // Si le membre en cours a le même id que celui de l'admin indiqué, alors c'est bon, on l'a trouvé
      if ($membre[':noUtilr'] === $values['groupe'][':administrateur']) $adminFound = true;

      // Existence de tous les membres
      $utilisateur = Utilisateur::find($membre[':noUtilr']);
      if (empty($utilisateur)) array_push($errors, "L'utilisateur ".$key." n'existe pas.");
    }

    // Si $adminFound est toujours sur false, c'est que l'administrateur indiqué ne fait pas partie des membres à ajouter
    if (!$adminFound) array_push($errors, "L'administrateur doit être un des membres du groupe.");

    return $errors;
  }
}