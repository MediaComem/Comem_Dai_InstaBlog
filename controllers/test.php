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
    return render('test/show.html.php');
  }
}
