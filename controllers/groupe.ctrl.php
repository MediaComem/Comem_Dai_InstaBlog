<?php

require_once('models/groupe.model.php');

class GroupeCtrl {
  
  /**
   * Affiche l'intégralité des groupes présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les groupes en utilisant la classe Groupe, et les envoies dans la page HTML
    set('groupes', Groupe::all());
    // Construit la page HTML et la retourne au navigateur
    return render('groupe/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouveau groupe
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('groupe/create.html.php');
  }

  /**
   * Enregistre en base de données un nouveau groupe.
   * Vérifie auparavant que les valeurs reçues depuis HTML sont correctes, compte tenu des diverses contraintes.
   */
  public static function store() {

    $inputs = [
      'nom' => empty($_POST['nom']) ? null : $_POST['nom'],
      'description' => filter_has_var(INPUT_POST, 'description') ? $_POST['description'] : null,
      'dateCreation' => filter_has_var(INPUT_POST, 'dateCreation') ? $_POST['dateCreation'] : null,
      'administrateur' => filter_has_var(INPUT_POST, 'administrateur') ? $_POST['administrateur'] : null,
      // Arrays
      'membres' => filter_has_var(INPUT_POST, 'membres') ? $_POST['membres'] : null
    ];
    
    // Le deuxième paramètre sera disponible dans la vue
    flash('info', 'Fonctionnalité à implémenter !');
    // Les valeurs saisies par l'utilisateur seront disponibles dans la vue
    flash('inputs', $inputs);
    // Redirige l'utilisateur sur le formulaire de création.
    return moveTo('/groupe/create');
  }

}
