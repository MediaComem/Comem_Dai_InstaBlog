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
    $inputs = [
      'numero' => filter_has_var(INPUT_POST, 'numero') ? $_POST['numero'] : null,
      'dateCreation' => filter_has_var(INPUT_POST, 'dateCreation') ? $_POST['dateCreation'] : null,
      'url' => filter_has_var(INPUT_POST, 'url') ? $_POST['url'] : null,
      'stockage' => filter_has_var(INPUT_POST, 'stockage') ? $_POST['stockage'] : null,
    ];
    
    dd($inputs);
  }

}
