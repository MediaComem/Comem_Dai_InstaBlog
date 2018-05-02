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

    $values = [
      ':noUtilrEmetteur' => empty($_POST['noUtilrEmetteur']) ? null : $_POST['noUtilrEmetteur'],
      ':noUtilrRecepteur' => empty($_POST['noUtilrRecepteur']) ? null : $_POST['noUtilrRecepteur'],
      ':titre' => empty($_POST['titre']) ? null : $_POST['titre'],
      ':contenu' => empty($_POST['contenu']) ? null : $_POST['contenu']
    ];

    $errors = MessageDirect::validate($values);

    if (!empty($errors)) {
      flash('errors', $errors);
      flash('values', $values);
      return moveTo('/messagedirect/create');
    }

    try {
      MessageDirect::createOne($values);
      flash('success', "Message envoyé !");
      return moveTo('/messagedirect');
    } catch(Exception $e) {
      flash('error', "Erreur lors de l'envoi du message...");
      flash('values', $values);
      return moveTo('/messagedirect/create');
    }
  }

}
