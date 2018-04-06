<?php 

/**
 * Permet d'afficher le contenu d'une variable correctement sur le navigateur de l'utilisateur
 * et d'arrêter l'exécution du script PHP.
 * @param $value - La valeur à afficher
 */
function dd($value) {
  echo "<pre>";
  print_r($value);
  echo "</pre>";
  die();
}

/**
 * Permet de rediriger l'utilisateur vers une autre route de l'application
 * @param $path - La route vers laquelle rediriger l'utilisateur.
 */
function moveTo($path) {
  return Header('Location: ?' . $path);
}
