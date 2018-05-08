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

    $values = [
      ':pseudo' => empty($_POST['pseudo']) ? null : $_POST['pseudo'],
      ':nom' => empty($_POST['nom']) ? null : $_POST['nom'],
      ':prenom' => empty($_POST['prenom']) ? null : $_POST['prenom'],
      ':dateNaissance' => empty($_POST['dateNaissance']) ? null : $_POST['dateNaissance'],
      ':email' => empty($_POST['email']) ? null : $_POST['email'],
      ':telephone' => empty($_POST['telephone']) ? null : $_POST['telephone'],
      ':sexe' => empty($_POST['sexe']) ? null : $_POST['sexe']
    ];

    $errors = Utilisateur::validate($values);
    
    // Si le tableau des erreurs n'est pas vide...
    if (!empty($errors)) {
      // Les messages d'erreur seront disponibles dans la vue
      flash('errors', $errors);
      // Les valeurs saisies par l'utilisateur seront disponibles dans la vue
      flash('values', $values);
      // Redirige l'utilisateur sur le formulaire de création.
      return moveTo('/utilisateur/create');
    // Sinon, c'est que tout est bon !
    }
    
    try {
      Utilisateur::createOne($values);
      // Le deuxième paramètre sera disponible dans la vue
      flash('success', "Nouvel utilisateur ".$values[':pseudo']." créé !");
      // Redirige l'utilisateur sur le formulaire de création.
      return moveTo('/utilisateur');
    } catch(Exception $e) {
      // Le message de l'erreur sera disponible dans la vue
      flash('error', "Erreur lors de la création du nouvel utilisateur...");
      // Les valeurs saisies par l'utilisateur seront disponibles dans la vue
      flash('values', $values);
      // Redirige l'utilisateur sur le formulaire de création.
      return moveTo('/utilisateur/create');
    }
  }

}
