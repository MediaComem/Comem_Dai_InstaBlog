<?php

require_once('models/messagedirect.model.php');

class MessageDirectCtrl {
  
  /**
   * Affiche l'intégralité des messages directs présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les messages directs en utilisant la classe MessageDirect, et les envoies dans la page HTML
    set('messagesDirects', MessageDirect::all());
    // Construit la page HTML et la retourne au navigateur
    return render('messagedirect/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouveau message direct
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('messagedirect/create.html.php');
  }

  /**
   * Enregistre en base de données un nouveau message direct.
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
    return moveTo('/messagedirect/create');
  }

}
