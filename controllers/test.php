<?php

require_once('models/articlepublicitaire.php');

class ArticlePublicitaireOrchestrateur {
  public function index() {
    echo "Hello World";
  }

  public function show($name, $value) {
    set('name', $name);
    set('value', $value);
    set('articles', ArticlePublicitaireModel::all());
    return html('test/show.html.php');
  }

  public function showForm() {
    return html('test/form.html.php');
  }

  public function analyze() {
    $inputs = [
      "name" => $_POST["name"],
      "pass" => $_POST["pass"],
      "remember" => filter_has_var(INPUT_POST, 'remember') ? $_POST["remember"] : ""
    ];
    
    $errors = ArticlePublicitaireModel::validate($inputs);

    if (empty($errors)) {
      flash('success', "Tout est nice.");
      return header('Location: ?/form_test');
    } else {
      flash('errors', $errors);
      flash('inputs', $inputs);
      return header('Location: ?/form_test');
    }
  }
}
