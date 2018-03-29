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

    $inputs = [
      'no' => filter_has_var(INPUT_POST, 'no') ? $_POST['no'] : null,
      'noUtilr' => filter_has_var(INPUT_POST, 'noUtilr') ? $_POST['noUtilr'] : null,
      'dateCreation' => filter_has_var(INPUT_POST, 'dateCreation') ? $_POST['dateCreation'] : null,
      'datePublication' => filter_has_var(INPUT_POST, 'datePublication') ? $_POST['datePublication'] : null,
      'type' => filter_has_var(INPUT_POST, 'type') ? $_POST['type'] : null,
      'texte' => filter_has_var(INPUT_POST, 'texte') ? $_POST['texte'] : null,
      'noPosGPS' => filter_has_var(INPUT_POST, 'noPosGPS') ? $_POST['noPosGPS'] : null,
      'noGrpe' => filter_has_var(INPUT_POST, 'noGrpe') ? $_POST['noGrpe'] : null,
    ];
    
    // Le deuxième paramètre sera disponible dans la vue
    flash('info', 'Fonctionnalité à implémenter !');
    // Les valeurs saisies par l'utilisateur seront disponibles dans la vue
    flash('inputs', $inputs);
    // Redirige l'utilisateur sur le formulaire de création.
    return moveTo('/post/create');
  }

}
