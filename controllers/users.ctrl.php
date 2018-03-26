<?php

require_once('models/users.model.php');

class UsersOrch {
  public static function index() {
    set('users', Users::all());
    return render('users/index.html.php');
  }

  public static function create() {
    set('test', "éàèèöüäöüç");
    return render('users/create.html.php');
  }
}