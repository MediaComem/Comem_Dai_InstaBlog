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

/**
 * Nettoie un tableau de tableaux de numéros en supprimant les éléments vides ou contenant un numéro en doublon.
 *
 * @param {Array} $data - Un tableau de tableaux contenant des numéros identifiants
 * @return {Array} - Le tableau initial moins les éventuels doublons
 */
function cleanArray($array) {
  $list = [];

  foreach($array as $number => $item) {
    foreach($item as $key => $value) {
      if (empty($value) or in_array($value, $list)) {
        unset($array[$number]);
      } else {
        array_push($list, $value);
      }
    }
  }

  return $array;
}
