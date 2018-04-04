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
      ':dateCreation' => empty($_POST['dateCreation']) ? null : $_POST['dateCreation'],
      ':url' => empty($_POST['url']) ? null : $_POST['url'],
      ':stockage' => empty($_POST['stockage']) ? null : $_POST['stockage']
    ];

    $errors = Media::validate($values);

    if (!empty($errors)) {
      flash('errors', $errors);
      flash('inputs', $values);
      return moveTo('/media/create');
    }
    
    try {
      Media::createOne($values);
      flash('success', "Le média a bien été créé !");
      return moveTo('/media');
    } catch(Exception $e) {
      flash('error', "Erreur lors de l'ajout du nouveau média !");
      flash('inputs', $values);
      moveTo('/media/create');
    }
  }

}
