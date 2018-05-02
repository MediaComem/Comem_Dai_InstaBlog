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
      ':noUtilr' => empty($_POST['noUtilr']) ? null : $_POST['noUtilr'],
      ':datePublication' => empty($_POST['datePublication']) ? null : $_POST['datePublication'],
      ':type' => empty($_POST['type']) ? null : $_POST['type'],
      ':texte' => empty($_POST['texte']) ? null : $_POST['texte'],
    ];

    $errors = Post::validate($values);

    if (!empty($errors)) {
      flash('errors', $errors);
      flash('values', $values);
      return moveTo('/post/create');
    }

    try {
      Post::createOne($values);
      flash('success', "Nouveau post créé !");
      return moveTo('/post');
    } catch (Exception $e) {
      flash('error', "Erreur lors de la publication du nouveau post...");
      flash('values', $values);
      return moveTo('/post/create');
    }
  }

}
