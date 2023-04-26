/* Fichier JavaScript: "SudokuInit.js"
+------------------------------------------------------------------------------+
| Module JavaScript externe pour l'insertion d'un service "jeu de Sudoku":     |
| module 1 (initialisation)                                                    |
| Tedheu 2010, version 1 (fr), mise à jour le 25 janvier 2010                  |
| fonctionne de paire avec le module PHP "GenerateurSudoku_1.php"              |
+------------------------------------------------------------------------------+
*/
if (typeof adressedossier_sudoku=='undefined') {
 var adressedossier_sudoku='';
}
//------------------ initialisation de variables (globales)
var result_sudoku= 'vide';
var Grille_sudoku=new Array(9);
var Masque_sudoku=new Array(9);
//---
for (i=0;i<9;i++){
  Grille_sudoku[i]=new Array(9);
  Masque_sudoku[i]=new Array(9);
  for (j=0;j<9;j++){
    Grille_sudoku[i][j]= '0';
    Masque_sudoku[i][j]= '0';
  }
}
//------------------ chargement de la grille
document.write('<SCRIPT language="JavaScript" src="'+adressedossier_sudoku+'GenerateurSudoku_1.php"><\/SCRIPT>');
if ((result_sudoku=='non')||(result_sudoku=='vide')){
  charge_grille_par_defaut();
  result_sudoku='defaut';
}
//
//---
function charge_grille_par_defaut() {
Grille_sudoku[0][0]= '6';
Masque_sudoku[0][0]= '0';
Grille_sudoku[0][1]= '5';
Masque_sudoku[0][1]= '1';
Grille_sudoku[0][2]= '8';
Masque_sudoku[0][2]= '1';
Grille_sudoku[0][3]= '3';
Masque_sudoku[0][3]= '1';
Grille_sudoku[0][4]= '9';
Masque_sudoku[0][4]= '1';
Grille_sudoku[0][5]= '2';
Masque_sudoku[0][5]= '1';
Grille_sudoku[0][6]= '7';
Masque_sudoku[0][6]= '1';
Grille_sudoku[0][7]= '1';
Masque_sudoku[0][7]= '1';
Grille_sudoku[0][8]= '4';
Masque_sudoku[0][8]= '0';
Grille_sudoku[1][0]= '2';
Masque_sudoku[1][0]= '1';
Grille_sudoku[1][1]= '3';
Masque_sudoku[1][1]= '0';
Grille_sudoku[1][2]= '1';
Masque_sudoku[1][2]= '1';
Grille_sudoku[1][3]= '7';
Masque_sudoku[1][3]= '0';
Grille_sudoku[1][4]= '5';
Masque_sudoku[1][4]= '1';
Grille_sudoku[1][5]= '4';
Masque_sudoku[1][5]= '0';
Grille_sudoku[1][6]= '9';
Masque_sudoku[1][6]= '1';
Grille_sudoku[1][7]= '6';
Masque_sudoku[1][7]= '1';
Grille_sudoku[1][8]= '8';
Masque_sudoku[1][8]= '0';
Grille_sudoku[2][0]= '9';
Masque_sudoku[2][0]= '0';
Grille_sudoku[2][1]= '4';
Masque_sudoku[2][1]= '1';
Grille_sudoku[2][2]= '7';
Masque_sudoku[2][2]= '1';
Grille_sudoku[2][3]= '6';
Masque_sudoku[2][3]= '1';
Grille_sudoku[2][4]= '1';
Masque_sudoku[2][4]= '0';
Grille_sudoku[2][5]= '8';
Masque_sudoku[2][5]= '1';
Grille_sudoku[2][6]= '2';
Masque_sudoku[2][6]= '0';
Grille_sudoku[2][7]= '5';
Masque_sudoku[2][7]= '0';
Grille_sudoku[2][8]= '3';
Masque_sudoku[2][8]= '1';
Grille_sudoku[3][0]= '5';
Masque_sudoku[3][0]= '1';
Grille_sudoku[3][1]= '7';
Masque_sudoku[3][1]= '1';
Grille_sudoku[3][2]= '3';
Masque_sudoku[3][2]= '1';
Grille_sudoku[3][3]= '9';
Masque_sudoku[3][3]= '1';
Grille_sudoku[3][4]= '8';
Masque_sudoku[3][4]= '1';
Grille_sudoku[3][5]= '6';
Masque_sudoku[3][5]= '0';
Grille_sudoku[3][6]= '1';
Masque_sudoku[3][6]= '0';
Grille_sudoku[3][7]= '4';
Masque_sudoku[3][7]= '1';
Grille_sudoku[3][8]= '2';
Masque_sudoku[3][8]= '1';
Grille_sudoku[4][0]= '8';
Masque_sudoku[4][0]= '0';
Grille_sudoku[4][1]= '6';
Masque_sudoku[4][1]= '1';
Grille_sudoku[4][2]= '9';
Masque_sudoku[4][2]= '1';
Grille_sudoku[4][3]= '2';
Masque_sudoku[4][3]= '1';
Grille_sudoku[4][4]= '4';
Masque_sudoku[4][4]= '1';
Grille_sudoku[4][5]= '1';
Masque_sudoku[4][5]= '1';
Grille_sudoku[4][6]= '3';
Masque_sudoku[4][6]= '1';
Grille_sudoku[4][7]= '7';
Masque_sudoku[4][7]= '0';
Grille_sudoku[4][8]= '5';
Masque_sudoku[4][8]= '1';
Grille_sudoku[5][0]= '1';
Masque_sudoku[5][0]= '1';
Grille_sudoku[5][1]= '2';
Masque_sudoku[5][1]= '0';
Grille_sudoku[5][2]= '4';
Masque_sudoku[5][2]= '1';
Grille_sudoku[5][3]= '5';
Masque_sudoku[5][3]= '0';
Grille_sudoku[5][4]= '7';
Masque_sudoku[5][4]= '1';
Grille_sudoku[5][5]= '3';
Masque_sudoku[5][5]= '0';
Grille_sudoku[5][6]= '6';
Masque_sudoku[5][6]= '1';
Grille_sudoku[5][7]= '8';
Masque_sudoku[5][7]= '0';
Grille_sudoku[5][8]= '9';
Masque_sudoku[5][8]= '1';
Grille_sudoku[6][0]= '7';
Masque_sudoku[6][0]= '1';
Grille_sudoku[6][1]= '8';
Masque_sudoku[6][1]= '1';
Grille_sudoku[6][2]= '6';
Masque_sudoku[6][2]= '1';
Grille_sudoku[6][3]= '4';
Masque_sudoku[6][3]= '1';
Grille_sudoku[6][4]= '3';
Masque_sudoku[6][4]= '0';
Grille_sudoku[6][5]= '9';
Masque_sudoku[6][5]= '0';
Grille_sudoku[6][6]= '5';
Masque_sudoku[6][6]= '1';
Grille_sudoku[6][7]= '2';
Masque_sudoku[6][7]= '0';
Grille_sudoku[6][8]= '1';
Masque_sudoku[6][8]= '1';
Grille_sudoku[7][0]= '3';
Masque_sudoku[7][0]= '1';
Grille_sudoku[7][1]= '1';
Masque_sudoku[7][1]= '1';
Grille_sudoku[7][2]= '5';
Masque_sudoku[7][2]= '0';
Grille_sudoku[7][3]= '8';
Masque_sudoku[7][3]= '0';
Grille_sudoku[7][4]= '2';
Masque_sudoku[7][4]= '1';
Grille_sudoku[7][5]= '7';
Masque_sudoku[7][5]= '1';
Grille_sudoku[7][6]= '4';
Masque_sudoku[7][6]= '1';
Grille_sudoku[7][7]= '9';
Masque_sudoku[7][7]= '1';
Grille_sudoku[7][8]= '6';
Masque_sudoku[7][8]= '0';
Grille_sudoku[8][0]= '4';
Masque_sudoku[8][0]= '0';
Grille_sudoku[8][1]= '9';
Masque_sudoku[8][1]= '1';
Grille_sudoku[8][2]= '2';
Masque_sudoku[8][2]= '1';
Grille_sudoku[8][3]= '1';
Masque_sudoku[8][3]= '1';
Grille_sudoku[8][4]= '6';
Masque_sudoku[8][4]= '1';
Grille_sudoku[8][5]= '5';
Masque_sudoku[8][5]= '0';
Grille_sudoku[8][6]= '8';
Masque_sudoku[8][6]= '1';
Grille_sudoku[8][7]= '3';
Masque_sudoku[8][7]= '0';
Grille_sudoku[8][8]= '7';
Masque_sudoku[8][8]= '1';
}
/*========= fin du script ====================================================*/
