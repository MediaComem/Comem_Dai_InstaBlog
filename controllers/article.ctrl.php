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

    $inputs = [
      'titre' => filter_has_var(INPUT_POST, 'titre') ? $_POST['titre'] : null,
      'chapeau' => filter_has_var(INPUT_POST, 'chapeau') ? $_POST['chapeau'] : null,
      'contenu' => filter_has_var(INPUT_POST, 'contenu') ? $_POST['contenu'] : null,
      'dateCreation' => filter_has_var(INPUT_POST, 'dateCreation') ? $_POST['dateCreation'] : null,
      'datePublication' => filter_has_var(INPUT_POST, 'datePublication') ? $_POST['datePublication'] : null,
      'dateFinPublication' => filter_has_var(INPUT_POST, 'dateFinPublication') ? $_POST['dateFinPublication'] : null,
      // Arrays
      'historique' => filter_has_var(INPUT_POST, 'historique') ? $_POST['historique'] : null,
      'themes' => filter_has_var(INPUT_POST, 'themes') ? $_POST['themes'] : null
    ];
    
    // Le deuxième paramètre sera disponible dans la vue
    flash('info', 'Fonctionnalité à implémenter !');
    // Les valeurs saisies par l'utilisateur seront disponibles dans la vue
    flash('inputs', $inputs);
    // Redirige l'utilisateur sur le formulaire de création.
    return moveTo('/article/create');
  }

}
