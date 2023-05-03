<?php

function initialisation(){
  global $Grille, $Masque;
  $Grille = array();
  $Masque = array();
  for ($i=0; $i<9; $i++){
    for ($j=0; $j<9; $j++){
      $Grille[$i][$j] = 0;
      $Masque[$i][$j] = 1;
    }
  }
}

function generer_grille(){
  global $Grille, $Masque;
  initialisation();
  for ($i=0; $i<9; $i++){
    for ($j=0; $j<9; $j++){
      if (mt_rand(1,10) > 5) { // 50% de chance de placer un chiffre
        for ($k=1; $k<=9; $k++){
          if (verifier_ligne($i, $k) && verifier_colonne($j, $k) && verifier_region($i, $j, $k)) {
            $Grille[$i][$j] = $k;
            $Masque[$i][$j] = 0;
            break;
          }
        }
      }
    }
  }
}

function verifier_ligne($ligne, $valeur){
  global $Grille;
  for ($j=0; $j<9; $j++){
    if ($Grille[$ligne][$j] == $valeur){
      return false;
    }
  }
  return true;
}

function verifier_colonne($colonne, $valeur){
  global $Grille;
  for ($i=0; $i<9; $i++){
    if ($Grille[$i][$colonne] == $valeur){
      return false;
    }
  }
  return true;
}

function verifier_region($ligne, $colonne, $valeur){
  global $Grille;
  $region_ligne = floor($ligne/3)*3;
  $region_colonne = floor($colonne/3)*3;
  for ($i=$region_ligne; $i<$region_ligne+3; $i++){
    for ($j=$region_colonne; $j<$region_colonne+3; $j++){
      if ($Grille[$i][$j] == $valeur){
        return false;
      }
    }
  }
  return true;
}

generer_grille();

// Afficher la grille générée
for ($i=0; $i<9; $i++){
  for ($j=0; $j<9; $j++){
    echo $Grille[$i][$j] . " ";
  }
  echo "\n";
}

?>