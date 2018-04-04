<?php

require_once('models/suivi.model.php');

class SuiviCtrl {
  
  /**
   * Affiche l'intégralité des suivis présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les suivis en utilisant la classe Suivi, et les envoies dans la page HTML
    set('suivis', Suivi::all());
    // Construit la page HTML et la retourne au navigateur
    return render('suivi/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouveau suivi
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('suivi/create.html.php');
  }

  /**
   * Enregistre en base de données un nouveau suivi.
   * Vérifie auparavant que les valeurs reçues depuis HTML sont correctes, compte tenu des diverses contraintes.
   */
  public static function store() {

    $values = [
      ':estSuiviParNoUtilr' => empty($_POST['estSuiviParNoUtilr']) ? null : $_POST['estSuiviParNoUtilr'],
      ':suitNoUtilr' => empty($_POST['suitNoUtilr']) ? null : $_POST['suitNoUtilr']
    ];

    $errors = Suivi::validate($values);

    if (!empty($errors)) {
      flash('errors', $errors);
      flash('values', $values);
      return moveTo('/suivi/create');
    }

    try {
      Suivi::createOne($values);
      flash('success', "Suivi enregistré !");
      return moveTo('/suivi');
    } catch (Exception $e) {
      flash('error', "Erreur lors de l'enregistrement du suivi...");
      flash('values', $values);
      return moveTo('/suivi/create');
    }
  }

}
