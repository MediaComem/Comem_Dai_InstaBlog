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
      // TODO
    ];

    /**
     * Le code suivant est à supprimer lorsque vous écrirez votre code
     **/

    // Le message sera affiché dans la page HTML
    flash('info', "Fonctionnalité à implémenter !");
    // Les valeurs saisies par l'utilisateur seront affichées dans le formulaire HTML
    flash('values', $values);
    // Par défaut, on retourne sur la page du formulaire d'ajout
    return moveTo('/suivi/create');
  }

}
