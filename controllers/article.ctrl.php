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
      // Tableau des valeurs pour l'article
      'article' => [
        ':titre' => empty($_POST['titre']) ? null : $_POST['titre'],
        ':chapeau' => empty($_POST['chapeau']) ? null : $_POST['chapeau'],
        ':contenu' => empty($_POST['contenu']) ? null : $_POST['contenu'],
        // Date création à générer au moment de la sauvegarde de l'article
        ':datePublication' => empty($_POST['datePublication']) ? null : $_POST['datePublication'],
        ':dateFinPublication' => empty($_POST['dateFinPublication']) ? null : $_POST['dateFinPublication']
      ],
      // Arrays
      'historique' => empty($_POST['historique']) ? null : $_POST['historique'],
      'classifications' => empty($_POST['classification']) ? null : $_POST['classification']
    ];

    $errors = Article::validate($values);

    if (!empty($errors)) {
      flash('errors', $errors);
      flash('values', $values);
      return moveTo('/article/create');
    }

    // Puisqu'on va créer plusieurs objets en même temps, on doit commencer une transaction sur la base de donnée
    option('db_conn')->beginTransaction();

    try {
      Article::createOne($values);
      // Si on arrive jusqu'à cette ligne, c'est que toutes les créations se font correctement
      // Du coup, on "valide" toutes les opérations effectuées sur la base de données
      option('db_conn')->commit();
      flash('success', "Article créé !");
      return moveTo('/article');
    } catch (Exception $e) {
      // Si on capte la moindre erreur, c'est qu'une des opérations n'a pas été
      // Dans ce cas, on annule tout ce qu'on a tenté de faire depuis le début de la transaction
      option('db_conn')->rollback();
      flash('error', "Erreur lors de la publication du nouvel article...");
      flash('values', $values);
      return moveTo('/article/create');
    }
  }

}
