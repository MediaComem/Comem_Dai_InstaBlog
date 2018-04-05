<?php

require_once('models/media.model.php');

class MediaCtrl {
  
  /**
   * Affiche l'intégralité des médias présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les médias en utilisant la classe Media, et les envoies dans la page HTML
    set('medias', Media::all());
    // Construit la page HTML et la retourne au navigateur
    return render('media/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouvel utilisateur
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('media/create.html.php');
  }

  /**
   * Enregistre en base de données un nouveau media.
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
    return moveTo('/media/create');
  }

}
