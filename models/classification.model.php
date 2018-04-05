<?php

class Classification {

  private static $table = "CLASS";

  /**
   * Créer une nouvelle entrée dans la base de données avec les valeurs présentes dans $values.
   * @param {Array} $values - L'ensemble des valeurs du nouvel enregistrement
   */
  public static function createOne($values) {
    $db = option('db_conn');

    $request = 
      "INSERT INTO ".self::$table." (NoTheme, NoArtic)
      VALUES (:noTheme, :noArtic)";
    $req = $db->prepare($request);

    // PDO va remplacer les placeholder par les bonnes valeurs tirées de $values
    if ($req->execute($values)) {
      return true;
    } else {
      // Si un problème est survenu lors de l'exécution de la requête
      // On lance une exception avec le message d'erreur de l'exécution ratée
      throw new Exception($req->errorInfo()[2]);
    }
  }

  /**
   * Nettoie le contenu du tableau des classification obtenu lors de l'envoi d'un formulaire d'ajout d'un nouvel article
   * Ce nettoyage va surtout supprimer du tableau les éventuels thèmes en double et ceux qui sont "vides" (non saisis dans l'IHM).
   * @param {Array} $data - Un tableau de tableaux contenant des numéros de thèmes
   * @return {Array} - Le tableau initial moins les éventuels doublons
   */
  public static function cleanData($classifications) {
    // Garder une simple liste des numéros de thèmes déjà présents
    $list = [];
    // Boucler sur toutes les classifications présentes dans le tableau
    foreach ($classifications as $key => $classification) {
      // Regarder si le noTheme de la classification en cours est déjà présent dans la liste des numéros de thèmes
      // ou bien s'il est vide (parce que le champ n'a pas été rempli dans l'IHM)
      if (empty($classification[':noTheme']) or in_array($classification[':noTheme'], $list)) {
        // Si c'est le cas, alors on supprime la classification en cours du tableau complet des classifications
        unset($classifications[$key]);
      } else {
        // Si ce n'est pas le cas, c'est que c'est la première fois qu'on rencontre ce numéro de thème
        // Dans ce cas, on ajoute le numéro à la liste des numéros de thèmes
        // Ainsi, si on le rencontre à nouveau par la suite, il ne sera pas repris en compte
        array_push($list, $classification[':noTheme']);
      }
    }
    // On retourne le tableau complet des classifications nettoyés
    return $classifications;
  }
}