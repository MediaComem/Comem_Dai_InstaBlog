<?php

require_once('models/groupe.model.php');

class GroupeCtrl {

  /**
   * Affiche l'intégralité des groupes présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les groupes en utilisant la classe Groupe, et les envoies dans la page HTML
    set('groupes', Groupe::all());
    // Construit la page HTML et la retourne au navigateur
    return render('groupe/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouveau groupe
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('groupe/create.html.php');
  }

  /**
   * Enregistre en base de données un nouveau groupe.
   * Vérifie auparavant que les valeurs reçues depuis HTML sont correctes, compte tenu des diverses contraintes.
   */
  public static function store() {

    $values = [
      'groupe' => [
        ':nom' => empty($_POST['nom']) ? null : $_POST['nom'],
        ':description' => empty($_POST['description']) ? null : $_POST['description'],
        ':administrateur' => empty($_POST['administrateur']) ? null : $_POST['administrateur'],
        // DateCreation à générer lors de la création du groupe
      ],
      // Arrays
      'membres' => empty($_POST['membres']) ? null : $_POST['membres']
    ];

    // Suppressions des numéro de membre en double et de deux ayant une valeurr vide.
    $values['membres'] = cleanArray($values['membres']);

    $errors = Groupe::validate($values);

    if (!empty($errors)) {
      flash('errors', $errors);
      flash('values', $values);
      return moveTo('/groupe/create');
    }

    // Puisqu'on va devoir créer plusieurs enregistrements dans la BD, il faut une transaction
    $db = option('db_conn');
    $db->beginTransaction();

    try {
      Groupe::createOne($values);
      $db->commit();
      flash('success', "Groupe créé et membres ajoutés !");
      return moveTo('/groupe');
    } catch (Exception $e) {
      $db->rollback();
      flash('error', "Erreur lors de la création du groupe...");
      flash('values', $values);
      return moveTo('/groupe/create');
    }
  }

}
