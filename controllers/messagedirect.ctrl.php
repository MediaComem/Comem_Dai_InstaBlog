<?php

require_once('models/messagedirect.model.php');

class MessageDirectCtrl {
  
  /**
   * Affiche l'intégralité des messages directs présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les messages directs en utilisant la classe MessageDirect, et les envoies dans la page HTML
    set('messagesDirects', MessageDirect::all());
    // Construit la page HTML et la retourne au navigateur
    return render('messagedirect/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouveau message direct
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('messagedirect/create.html.php');
  }

  /**
   * Enregistre en base de données un nouveau message direct.
   * Vérifie auparavant que les valeurs reçues depuis HTML sont correctes, compte tenu des diverses contraintes.
   */
  public static function store() {

    $inputs = [
      'no' => filter_has_var(INPUT_POST, 'no') ? $_POST['no'] : null,
      'noUtilrEmetteur' => filter_has_var(INPUT_POST, 'noUtilrEmetteur') ? $_POST['noUtilrEmetteur'] : null,
      'noUtilrRecepteur' => filter_has_var(INPUT_POST, 'noUtilrRecepteur') ? $_POST['noUtilrRecepteur'] : null,
      'titre' => filter_has_var(INPUT_POST, 'titre') ? $_POST['titre'] : null,
      'contenu' => filter_has_var(INPUT_POST, 'contenu') ? $_POST['contenu'] : null,
      'repondANo' => filter_has_var(INPUT_POST, 'repondANo') ? $_POST['repondANo'] : null,
      'repondANoUtilr' => filter_has_var(INPUT_POST, 'repondANoUtilr') ? $_POST['repondANoUtilr'] : null
    ];
    
    // Le deuxième paramètre sera disponible dans la vue
    flash('info', 'Fonctionnalité à implémenter !');
    // Les valeurs saisies par l'utilisateur seront disponibles dans la vue
    flash('inputs', $inputs);
    // Redirige l'utilisateur sur le formulaire de création.
    return moveTo('/messagedirect/create');
  }

}
