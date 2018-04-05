<?php

require_once('models/article.model.php');

class ArticleCtrl {
  
  /**
   * Affiche l'intégralité des articles présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les articles en utilisant la classe Article, et les envoies dans la page HTML
    set('articles', Article::all());
    // Construit la page HTML et la retourne au navigateur
    return render('article/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouvel article
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('article/create.html.php');
  }

  /**
   * Enregistre en base de données un nouvel article.
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
    return moveTo('/article/create');
  }

}
