<?php

require_once('historiquearticle.model.php');

class Article {
  private static $table = 'ARTIC';

  /**
   * Récupère tous les enregistrements des articles depuis la base de données et les retourne en tant qu'array.
   * Si aucun article n'existe, le tableau retourné est vide.
   * @return {Array} - Un array contenant tous les articles présents dans la BD.
   */
  public static function all() {
    $db = option('db_conn');
    $req = $db->prepare('SELECT * FROM '.self::$table);

    if ($req->execute()) {
      return $req->fetchAll();
    } else {
      halt($req->errorInfo()[2]);
    }
    return array();
  }

  /**
   * Créer une nouvelle entrée dans la base de données avec les valeurs présentes dans $values.
   * @param {Array} $values - L'ensemble des valeurs du nouvel enregistrement
   */
  public static function createOne($values) {
    $db = option('db_conn');

    $request = 
      "INSERT INTO ".self::$table." (Titre, Chapeau, Contenu, DateCreation, DatePublication, DateFinPublication)
      VALUES (:titre, :chapeau, :contenu, :dateCreation, :datePublication, :dateFinPublication)";
    $req = $db->prepare($request);

    // Génération de la date de création
    $values['article'][':dateCreation'] = date('Y-m-d');

    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $values
    if ($req->execute($values['article'])) {
      $historique = $values['historique'];
      // On ajoute dans le tableau des valeurs de l'historique l'id du nouvel article créé
      $historique[':noArtic'] = $db->lastInsertId();
      // On essaie de créer le nouvel historique pour le nouvel article
      // Si une erreur survient, la méthode HistoriqueArticle::createOne lèvera une erreur qui sera interceptée par le try/catch du contrôleur
      HistoriqueArticle::createOne($historique);
      return true;
    } else {
      throw new Exception($req->errorInfo()[2]);
    }
  }


  /**
   * Valide que les données contenues dans $values respectent les contraintes relatives à un article.
   * Retourne un tableau contenant les messages d'erreurs à afficher en cas de problèmes.
   * Si aucun problème n'est détecté, retourne NULL.
   * @param {Array} $values - Un tableau contenant toutes les valeurs du nouvel article à créer
   */
  public static function validate(array $values) {
    $errors = [];

    // Date de publication supérieure ou égale à la date du jour
    $date = new DateTime($values['article'][':datePublication']);
    $today = new DateTime(date('Y-m-d'));
    if ($date < $today) array_push($errors, "La date du ".$values[':datePublication']." n'est pas valide comme date de publication.");

    // Si présente, la date de fin de publication est supérieure ou égale à la date de publication
    if (!empty($values['article'][':dateFinPublication'])) {
      $dateFin = new DateTime($values['article'][':dateFinPublication']);
      if ($dateFin <= $date) array_push($errors, "La date de fin de publication doit être postérieure à la date de publication.");
    }

    // NoUtilr de historique existe
    $user = Utilisateur::find($values['historique'][':noUtilr']);
    if (empty($user)) array_push($errors, "Utilisateur inexistant.");

    // Tous les thèmes présentes existent (À vérifier)

    return $errors;
  }
}