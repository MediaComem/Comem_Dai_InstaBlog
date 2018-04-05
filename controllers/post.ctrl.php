<?php

require_once('models/post.model.php');

class PostCtrl {
  
  /**
   * Affiche l'intégralité des posts présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les posts en utilisant la classe Post, et les envoies dans la page HTML
    set('posts', Post::all());
    // Construit la page HTML et la retourne au navigateur
    return render('post/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouveau post
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('post/create.html.php');
  }

  /**
   * Enregistre en base de données un nouveau post.
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
    return moveTo('/post/create');
  }

}
