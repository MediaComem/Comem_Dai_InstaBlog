<?php

require_once('models/users.model.php');

class UsersOrch {
  
  /**
   * Affiche l'intégralité des utilisateurs présents dans la base de données
   */
  public static function index() {
    // Va chercher tous les utilisateurs en utilisant la classe Users, et les envoies dans la page HTML
    set('users', Users::all());
    // Construit la page HTML et la retourne au navigateur
    return render('users/index.html.php');
  }

  /**
   * Affiche le formulaire permettant de créer un nouvel utilisateur
   */
  public static function create() {
    // Construit la page HTML et la retourne au navigateur
    return render('users/create.html.php');
  }

}
