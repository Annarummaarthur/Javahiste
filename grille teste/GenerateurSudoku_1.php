<?php
/* module SUDOKU PHP: fichier "GenerateurSudoku_1.php"
+------------------------------------------------------------------------------+
| Tedheu 2010 (issu de la version TT 19 septembre 2006)                        |
| mise � jour le 24 janvier 2010                                               |
| Synth�se de grilles pour jeu de sudoku, version 1 (fr)                       |
| Passage des donn�es en variables JavaScript: result, Grille(9x9) ,Masque(9x9)|
| Utiliser ce fichier comme un fichier JavaScript externe :                    |
| <SCRIPT language="JavaScript" src="http://..../modulesudoku.php"><\/SCRIPT>  |
+------------------------------------------------------------------------------+
*/
//
/*========= Variables ========================================================*/
// grille 'SuDoku', caract�res de "1" � "9", case $i,$j
$Grille = array();
// masque de la grille: 0 = non masquable, 1 = la case peut �tre masqu�e
$Masque = array();
// loterie est une chaine de caract�res pour le tirage des cases restantes
$loterie = "";
// variable collision pour tester le cas o� on tirerais la m�me case
$collision = 0; 
// la grille est divis�e en 9 r�gions, 9 lignes et 9 colonnes
// les tableaux $Reg,$Lgn,$Col sont index�s 'num�ro,chiffre' ($n,$m m=chiffre-1)
// les valeurs sont des chaines de caract�res indiquant les positions possibles
$Reg = array();
$Lgn = array();
$Col = array();
//
/*========= Boucle de calcul =================================================*/
$tentative = 0;
$tentative_max = 10;
initialisation();
while (strlen($loterie)>0 AND $tentative<$tentative_max){
$tentative++;
initialisation();
$iter = 0;
$itermax = 82;
while ($loterie<>"" AND $iter<$itermax){
  $iter++;
  // placement d�terministe d'un chiffre dans une case
  $bingo = 0;
  for ($n=0; $n<=8; $n++){
    for ($m=0; $m<=8; $m++){
      // en premier les r�gions
      if (strlen($Reg[$n][$m])== 1){
        $p = ord($Reg[$n][$m])-48;
        $i = floor($n/3)*3+floor($p/3);
        $j = ($n-floor($n/3)*3)*3+($p-floor($p/3)*3);
        affectation($i,$j,$m,"1");
        $bingo = 1;
        break;
      }
      // en second les lignes
      if (strlen($Lgn[$n][$m])== 1){
        $p = ord($Lgn[$n][$m])-48;
        $i = $n;
        $j = $p;
        affectation($i,$j,$m,"1");
        $bingo = 1;
        break;
      }
      // en troisi�me les colonnes
      if (strlen($Col[$n][$m])== 1){
        $p = ord($Col[$n][$m])-48;
        $i = $p;
        $j = $n;
        affectation($i,$j,$m,"1");
        $bingo = 1;
        break;
      }
    }
    if ($bingo== 1) break;
  }
  // placement par tirage au sort, si le placement d�terministe n'a pas abouti
  if ($bingo== 0){
    // tirage d'une case $i,$j parmis les cases libres
    $ncase2 = strlen($loterie);
    $ncase = strlen($loterie)/2;
    $index = rand(0,$ncase-1)*2;
    $posi = substr($loterie,$index,2);
    // d�termination des coordonn�es de la case: $i,$j
    $i = ord(substr($posi,0))-97;
    $j = ord(substr($posi,1))-48;
    // tirage d'un chiffre parmis les chiffres libres
    $liste = "";
    for ($m=0; $m<=8; $m++){
      $libre = 1;
      // r�gions
      $n = floor($i/3)*3+floor($j/3);
      if ($Reg[$n][$m]== "") $libre = 0;
      // lignes
      $n = $i;
      if ($Lgn[$n][$m]== "") $libre = 0;
      // colonnes
      $n = $j;
      if ($Col[$n][$m]== "") $libre = 0;
      // concat�nation
      if ($libre== 1) $liste = $liste.chr(48+$m);
    }
    if (strlen($liste)>0){
      $m = ord(substr($liste,floor(rand(0,strlen($liste)-1))))-48;
      affectation($i,$j,$m,"0");
    }
  }
}
}
//
/*========= Sorties javascript ===============================================*/
if (strlen($loterie)== 0){
  // une grille valide trouv�e
  $result= 'niveau_1';
  // $Grille[$i][$j] $i et $j de 0 � 8
  // $Masque[$i][$j], si =1 le chiffre peut �tre masqu�, si =0 doit �tre affich�
  if ($tentative== 1){
    //  grille trouv�e d�s la premi�re tentative
  }
  else{
    // grille trouv�e apr�s $tentative tentatives
  }
}
else{
  // Echec, pas de grille valide trouv�e
  $result= 'non';
}
print("result_sudoku= '".$result."';\n");
for ($i=0; $i<9; $i++){
  for ($j=0;$j<9; $j++){
  print("Grille_sudoku[".$i."][".$j."]= '".$Grille[$i][$j]."';\n");
  print("Masque_sudoku[".$i."][".$j."]= '".$Masque[$i][$j]."';\n");
  }
}
/*============================================================================*/
/*--------- Fonctions --------------------------------------------------------*/
function initialisation(){
  global $Grille ,$Masque ,$loterie ,$collision;
  global $Reg, $Lgn, $Col;
  $loterie = "";
  $collision = 0;
  // iniatisation, grille et masque, d'abord initialis�e � '0'
  for ($i=0; $i<=8; $i++){
    for ($j=0; $j<=8; $j++){
      $Grille[$i][$j] = "0";
      $Masque[$i][$j] = 0;
      $loterie = $loterie.chr(97+$i).chr(48+$j);
    }
  }
  // Au d�but toutes les positions sont possibles
  for ($n=0; $n<=8; $n++){
    for ($m=0; $m<=8; $m++){
      $Reg[$n][$m] = "012345678";
      $Lgn[$n][$m] = "012345678";
      $Col[$n][$m] = "012345678";
    }
  }
}
//
function elimination($i,$j,$m){
  global $Grille ,$Masque ,$loterie ,$collision;
  global $Reg, $Lgn, $Col;
  // case $i,$j , chiffre= $m+1
  // �limination du chiffre en mettant les positions possibles � rien (= "")
  $n = floor($i/3)*3+floor($j/3); // r�gion concern�e num�ro $n
  $Reg[$n][$m] = "";
  $n = $i; // ligne concern�e num�ro $n
  $Lgn[$n][$m] = "";
  $n = $j; // Colonne concern�e num�ro $n
  $Col[$n][$m] = "";
  // �limination s�lective des positions possibles  dans les r�gions voisines
  for($n=0; $n<=8; $n++){
    for ($p=0; $p<=8; $p++){
      // $p est la position d'une case dans une r�gion
      // position de la case en coordonn�es 'grille', $ic,$jc
      $ic = floor($n/3)*3+floor($p/3);
      $jc = ($n-floor($n/3)*3)*3+($p-floor($p/3)*3);
      if ($ic==$i OR $jc==$j){
        $posi = Chr(48+$p);
        $Reg[$n][$m] = str_replace($posi,"",$Reg[$n][$m]);
      }
    }
  }
  // �limination s�lective des positions possibles  dans les lignes voisines
  $posi = chr(48+$j);
  for($n=0; $n<=8; $n++){
    $Lgn[$n][$m] = str_replace($posi,"",$Lgn[$n][$m]);
  }
  // �limination s�lective des positions possibles  dans les colonnes voisines
  $posi = chr(48+$i);
  for($n=0; $n<=8; $n++){
    $Col[$n][$m] = str_replace($posi,"",$Col[$n][$m]);
  }
  // �limination s�lective des positions possibles, lignes-colonnes/r�gion
  $n = floor($i/3)*3+floor($j/3); // r�gion concern�e num�ro $n
  for($p=0; $p<=8; $p++){
    // position de la case en coordonn�es 'grille', $ic,$jc
    $ic = floor($n/3)*3+floor($p/3);
    $jc = ($n-floor($n/3)*3)*3+($p-floor($p/3)*3);
    $posi = chr(48+$jc);
    $Lgn[$ic][$m] = str_replace($posi,"",$Lgn[$ic][$m]);
    $posi = chr(48+$ic);
    $Col[$jc][$m] = str_replace($posi,"",$Col[$jc][$m]);
  }
  // �limination de la position occup�e quelque soit le chiffre
  for($mc=0; $mc<=8; $mc++){
    // r�gions (la r�gion concern�e, num�ro $n)
    $n = floor($i/3)*3+floor($j/3);
    $p = ($i-floor($i/3)*3)*3+($j-floor($j/3)*3);
    $posi = chr(48+$p);
    $Reg[$n][$mc] = str_replace($posi,"",$Reg[$n][$mc]);
    // lignes
    $posi = chr(48+$j);
    $Lgn[$i][$mc] = str_replace($posi,"",$Lgn[$i][$mc]);
    // colonnes
    $posi = chr(48+$i);
    $Col[$j][$mc] = str_replace($posi,"",$Col[$j][$mc]);
  }
}
//
function affectation($i,$j,$m,$D){
  global $Grille ,$Masque ,$loterie ,$collision;
  if ($Grille[$i][$j]== "0"){
    $Grille[$i][$j]= chr(48+$m+1);
    $posi = chr(97+$i).chr(48+$j);
    $loterie = str_replace($posi,"",$loterie);
    elimination($i,$j,$m);
    if ($D== "1") $Masque[$i][$j]= 1;
  }
  else{
    $collision++;
  }
}
/*============================================================================*/
?>
