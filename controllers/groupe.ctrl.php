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
    return moveTo('/groupe/create');
  }

}
