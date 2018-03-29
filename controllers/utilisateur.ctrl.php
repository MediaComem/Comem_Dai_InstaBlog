<?php

require_once('models/utilisateur.model.php');

class UtilisateurCtrl {
  
  /**
   * Affiche l'intégralité des utilisateurs présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les utilisateurs en utilisant la classe Utilisateur, et les envoies dans la page HTML
    set('users', Utilisateur::all());
    // Construit la page HTML et la retourne au navigateur
    return render('utilisateur/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouvel utilisateur
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('utilisateur/create.html.php');
  }

  /**
   * Enregistre en base de données un nouvel utilisateur.
   * Vérifie auparavant que les valeurs reçues depuis HTML sont correctes, compte tenu des diverses contraintes.
   */
  public static function store() {
    $inputs = [
      'pseudo' => filter_has_var(INPUT_POST, 'pseudo') ? $_POST['pseudo'] : null,
      'nom' => filter_has_var(INPUT_POST, 'nom') ? $_POST['nom'] : null,
      'prenom' => filter_has_var(INPUT_POST, 'prenom') ? $_POST['prenom'] : null,
      'dateNaissance' => filter_has_var(INPUT_POST, 'dateNaissance') ? $_POST['dateNaissance'] : null,
      'email' => filter_has_var(INPUT_POST, 'email') ? $_POST['email'] : null,
      'telephone' => empty($_POST['telephone']) ? null : $_POST['telephone'],
      'sexe' => empty($_POST['sexe']) ? null : $_POST['sexe']
    ];
    
    // Le deuxième paramètre sera disponible dans la vue
    flash('info', 'Fonctionnalité à implémenter !');
    // Les valeurs saisies par l'utilisateur seront disponibles dans la vue
    flash('inputs', $inputs);
    // Redirige l'utilisateur sur le formulaire de création.
    return moveTo('/utilisateur/create');
  }

}
