<?php

require_once('historiquearticle.model.php');
require_once('theme.model.php');
require_once('classification.model.php');
require_once('utilisateur.model.php');

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
      "INSERT INTO ".self::$table." (Titre, Chapeau, Contenu, DateCreation, DatePublication, DateFinPublication)
      VALUES (:titre, :chapeau, :contenu, :dateCreation, :datePublication, :dateFinPublication)";
    $req = $db->prepare($request);

    // Génération de la date de création
    $values['article'][':dateCreation'] = date('Y-m-d');

    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $values
    if ($req->execute($values['article'])) {
      // On récupère dans notre tableau de valeur d'article la valeur de son numéro (puisqu'on va la réutiliser juste après)
      $values['article'][':no'] = $db->lastInsertId();
      // On ajoute dans le tableau des valeurs de l'historique l'id du nouvel article créé
      $values['historique'][':noArtic'] = $values['article'][':no'];
      // On essaie de créer le nouvel historique pour le nouvel article
      // Si une erreur survient, la méthode HistoriqueArticle::createOne lèvera une erreur qui sera interceptée par le try/catch du contrôleur
      HistoriqueArticle::createOne($values['historique']);
      // On va ensuite essayer de créer les classification...
      // Mais avant... il faut "nettoyer" le tableau des classifications (enlever celles en double ou vide par exemple)...
      // On stocke ce tableau nettoyé dans une nouvelle variable pour en faire une copie (on ne voudrait pas trop toucher au tableau des values)
      $classifications = Classification::cleanData($values['classifications']);
      // Avec notre tableau tout propre, on peut boucler sur chaque classification pour la créer.
      foreach($classifications as $key => $classification) {
        // On n'oublie pas d'ajouter le numéro de l'article nouvellement créé pour chaque classification
        $classification[':noArtic'] = $values['article'][':no'];
        // On peut, enfin, crééer la classification
        // À nouveau, si une erreur survient à n'importe quel moment, la transaction va tout annuler
        Classification::createOne($classification);
      }
      return true;
    } else {
      // Si un problème est survenu lors de l'exécution de la requête
      // On lance une exception avec le message d'erreur de l'exécution ratée
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
    if ($date < $today) array_push($errors, "La date du ".$values['article'][':datePublication']." n'est pas valide comme date de publication.");

    // Si présente, la date de fin de publication est supérieure ou égale à la date de publication
    if (!empty($values['article'][':dateFinPublication'])) {
      $dateFin = new DateTime($values['article'][':dateFinPublication']);
      if ($dateFin <= $date) array_push($errors, "La date de fin de publication doit être postérieure à la date de publication.");
    }

    // NoUtilr de historique existe
    $user = Utilisateur::find($values['historique'][':noUtilr']);
    if (empty($user)) array_push($errors, "Utilisateur inexistant.");

    // Boucler sur tous les themes pour vérifier que...
    foreach ($values['classifications'] as $key => $classification) {
      // ...tous les thèmes présents (ceux non-vides, donc) existent
      if (!empty($classification[':noTheme'])) {
        $theme = Theme::find($classification[':noTheme']);
        if (empty($theme)) array_push($errors, "Thème ".$key." inexistant.");
      }
    }

    return $errors;
  }

}