<?php

require_once('models/membre.model.php');

class MembreCtrl {
  
  /**
   * Affiche l'intégralité des membres présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les membres en utilisant la classe Membre, et les envoies dans la page HTML
    set('membres', Membre::all());
    // Construit la page HTML et la retourne au navigateur
    return render('membre/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouveau membre
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('membre/create.html.php');
  }

  /**
   * Enregistre en base de données un nouveau membre.
   * Vérifie auparavant que les valeurs reçues depuis HTML sont correctes, compte tenu des diverses contraintes.
   */
  public static function store() {

    $values = [
      ':noGrpe' => empty($_POST['noGrpe']) ? null : $_POST['noGrpe'],
      ':noUtilr' => empty($_POST['noUtilr']) ? null : $_POST['noUtilr']
    ];

    $errors = Membre::validate($values);

    if (!empty($errors)) {
      flash('errors', $errors);
      flash('values', $values);
      return moveTo('/membre/create');
    }

    try {
      Membre::createOne($values);
      flash('success', "Membre ajouté !");
      return moveTo('/membre');
    } catch (Exception $e) {
      flash('error', "Erreur lors de l'ajout du nouveau membre...");
      flash('values', $values);
      return moveTo('/membre/create');
    }
  }

}
