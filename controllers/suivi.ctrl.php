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
      'estSuiviParNoUtilr' => empty($_POST['estSuiviParNoUtilr']) ? null : $_POST['estSuiviParNoUtilr'],
      'suitNoUtilr' => filter_has_var(INPUT_POST, 'suitNoUtilr') ? $_POST['suitNoUtilr'] : null,
    ];
    
    // Le deuxième paramètre sera disponible dans la vue
    flash('info', 'Fonctionnalité à implémenter !');
    // Les valeurs saisies par l'utilisateur seront disponibles dans la vue
    flash('inputs', $values);
    // Redirige l'utilisateur sur le formulaire de création.
    return moveTo('/suivi/create');
  }

}
