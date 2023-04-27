/* Fichier JavaScript: "SDK_SudokuJeu.js"
+------------------------------------------------------------------------------+
| Module JavaScript externe pour l'insertion d'un service "jeu de Sudoku":     |
| module 2 (interface jeu)                                                     |
| Tedheu 2010, version 1 (fr), mise � jour le 25 janvier 2010                  |
| Ce script doit �tre initialis� par le module "SudokuInit.js"                 |
| variables pass�es: tableaux 9x9 Grille et Masque ( caract�res '0' � '9' )    |
+------------------------------------------------------------------------------+
*/
//
//------------------ initialisation de variables (globales)
var SDK_chronoval=0, SDK_chrono;
var SDK_memchif, SDK_modecase;
//
var SDK_Joueur=new Array(9);
var SDK_Grille=new Array(9);
var SDK_Masque=new Array(9);
for (i=0;i<9;i++){
  SDK_Joueur[i]=new Array(9);
  SDK_Grille[i]=new Array(9);
  SDK_Masque[i]=new Array(9);
  for (j=0;j<9;j++){
    SDK_Joueur[i][j]= '0';
    SDK_Grille[i][j]= Grille_sudoku[i][j];
    SDK_Masque[i][j]= Masque_sudoku[i][j];
  }
}
//--- lancement du jeu
SDK_sudoku();
//
/*========= fonctions JavaScript =============================================*/
//--- fonctions de base
function getObjs(Id){
  var Id, objs;
  if (document.getElementById) objs=document.getElementById(Id);
  // sinon, tanpis !
  return objs;
}
//---
function charge_contenu(texteHTML,Id){
  var texteHTML, Id;
  Objs=getObjs(Id);
  Objs.innerHTML= texteHTML;
}
//------------------------------------------------------------------------------
//------------------ Construction du jeu
function SDK_sudoku() {
    var texteHTML, a, b, c, d, i, j;
    //
    SDK_modecase=0;
    // ossature de pr�sentation
    texteHTML='<div id="SDK_grille"></div>';
    texteHTML+='<div id="SDK_menuV"></div>';
    texteHTML+='<div id="SDK_menuH"></div>';
    charge_contenu(texteHTML,'SDK_cadre');
    //
    //- construction de la grille de jeu 9x9 cases, division "SDK_grille"
    texteHTML='<table border="0" cellspacing="5">';
    for (a=0;a<3;a++){
      texteHTML+='<tr>';
      for (b=0;b<3;b++){
        texteHTML+='<td class="region"><table cellspacing="0">';
        for (c=0;c<3;c++){
          texteHTML+='<tr>';
          for (d=0;d<3;d++){
            i=3*a+c; j=3*b+d;
            if (SDK_Masque[i][j]=='0'){
              texteHTML+='<td id="SDK_case'+i+j+'" class="case0" onClick="SDK_case('+i+','+j+');">&nbsp;</td>';
            }else{
              texteHTML+='<td id="SDK_case'+i+j+'" class="case1" onClick="SDK_case('+i+','+j+');">&nbsp;</td>';
            }
          }
        texteHTML+='</tr>';
        }
      texteHTML+='</table></td>';
      }
      texteHTML+='</tr>';
    }
    texteHTML+='</table>';
    charge_contenu(texteHTML,'SDK_grille');
    //
    //- construction du menu vertical, division "SDK_menuV"
    // boutons de commande
    texteHTML ='<input id="SDK_commande1" class="menu" type="button" onClick="SDK_gestion(1)" value="jouer la grille"/>';
    texteHTML+='<input id="SDK_commande2" class="menu" type="button" onClick="SDK_gestion(2)" value="pause"/>'; // pause ou continue
    texteHTML+='<input id="SDK_commande3" class="menu" type="button" onClick="SDK_gestion(3)" value="rejouer"/>';
    texteHTML+='<hr>';
    texteHTML+='<input id="SDK_commande4" class="menu" type="button" onClick="SDK_gestion(4)" value="joker"/>';
    texteHTML+='<input id="SDK_commande5" class="menu" type="button" onClick="SDK_gestion(5)" value="solution"/>';
    // status
    texteHTML+='<div id="SDK_status">&nbsp;</div>';
    // chronom�tre
    texteHTML+='<div id="SDK_chrono"><span id="SDK_chrono-mn">&nbsp;</span>:&nbsp;<span id="SDK_chrono-se">&nbsp;</span></div>';
    charge_contenu(texteHTML,'SDK_menuV');
    for (i=2;i<=5;i++){
      Objs=getObjs('SDK_commande'+i);
      Objs.style.visibility= 'hidden';
    }
    //- construction du menu horizontal, division "SDK_menuH"
    // barre gomme et chiffres
    Objs=getObjs('SDK_menuH');
    Objs.disabled= true;
    texteHTML='<fieldset>';
    for (i=0;i<10;i++){
      texteHTML+='<input id="SDK_bouton'+i+'" type="button" accesskey="'+i+'+ALT"';
      (i==0)? texteHTML+=' value="&nbsp;" class="gomme"': texteHTML+=' value="'+i+'" ';
      texteHTML+='onClick="SDK_mem('+i+');" disabled="true">\n';
    }
    // contr�le du choix
    texteHTML+='<div id="SDK_chx"></div>';
    texteHTML+='</fieldset>';
    charge_contenu(texteHTML,'SDK_menuH');
}
//------------------------------------------------------------------------------
//--- Gestion des commandes
function SDK_gestion(c){
    var c, texteHTML, i, j, p, chiffre, reste;
    var List=new Array();
    switch(c){
      case 1: // commande "jouer la grille"
        // initialisation du chronom�tre
        SDK_chronoval= 0;
        // initialisation de la grille du SDK_Joueur
        reste=0;
        for (i=0;i<9;i++){
          for (j=0;j<9;j++){
            if (SDK_Masque[i][j]=='0'){
              SDK_Joueur[i][j]=SDK_Grille[i][j];
            }else{
              SDK_Joueur[i][j]='0';
              reste++;
            }
          }
        }
        // status
        Objs=getObjs('SDK_status');
        Objs.innerHTML=reste;
        // gestion des boutons "commandes"
        Objs=getObjs('SDK_commande1');
        Objs.style.visibility= 'hidden';
        List=[2,3,4,5];
        for (i in List){
          Objs=getObjs('SDK_commande'+List[i]);
          Objs.style.visibility= 'visible';
        }
        // on affiche la grille
        SDK_affichegrille(1);
        // on active la barre horizontale
        Objs=getObjs('SDK_menuH');
        Objs.disabled= false;
        for (i=0;i<10;i++){
          Objs=getObjs('SDK_bouton'+i);
          Objs.disabled= false;
        }
        // pas de chiffre m�moris�
        SDK_memchif='';
        // on lance le chronom�tre
        SDK_chrono=setInterval('SDK_chronometre()',1000);
        // mode de gestion des clics/cases
        SDK_modecase=1;
        break;
      case 2: // commande "pause/continue"
        // gestion des boutons "commandes" et du chronom�tre
        Objs=getObjs('SDK_commande2');
        etat= Objs.value;
        // bascule [pause <--> continue]
        switch(etat){
          case 'pause':
            Objs.value= 'continue';
            clearInterval(SDK_chrono);
            SDK_affichegrille(0);
            Objs=getObjs('SDK_commande4');
            Objs.style.visibility= 'hidden';
            // mode de gestion des clics/cases
            SDK_modecase=0;
            break;
          case 'continue':
            Objs.value= 'pause';
            SDK_chrono=setInterval('SDK_chronometre()',1000);
            SDK_affichegrille(1);
            Objs=getObjs('SDK_commande4');
            Objs.style.visibility= 'visible';
            // mode de gestion des clics/cases
            SDK_modecase=1;
            break;
        }
        break;
      case 3: // commande "rejouer"
        // arr�t et remise � z�ro du chronom�tre
        clearInterval(SDK_chrono);
        // r�affichage du jeu
        SDK_sudoku()
        // mode de gestion des clics/cases
        SDK_modecase=0;
        break;
      case 4: // commande "joker"
        Objs=getObjs('SDK_chx');
        Objs.innerHTML='<span class="joker">Joker</span>';
        SDK_modecase=2;
        break;
      case 5: // commande "solution"
        // affichage de la solution
        for (i=0;i<9;i++){
          for (j=0;j<9;j++){
            p= SDK_Joueur[i][j].indexOf('">');
            (p<0)? chiffre='0': chiffre= SDK_Joueur[i][j].substr(p+2,1);
            if (chiffre!=SDK_Grille[i][j]){
              SDK_memchif= SDK_Grille[i][j];
              SDK_modecase=2;
              SDK_case(i,j);
            }
          }
        }
        break;
    }
}
//--- Gestion du clic dans une case
function SDK_case(i,j){
    var i, j, classe, reste;
    // mode 0 = rien
    if (SDK_modecase==0){
      return;
    }
    // mode 1 = affiche dans la case la s�lection m�moris�e dans SDK_memchif
    if (SDK_modecase==1){
      if (SDK_Masque[i][j]!='0' && SDK_memchif!=''){
        Objs=getObjs('SDK_case'+i+j);
        switch (SDK_memchif) {
          case '&nbsp;': // (rappel: gomme> SDK_memchif='&nbsp;')
            SDK_Joueur[i][j]='0';
            break;
          case SDK_Grille[i][j]:
            SDK_Joueur[i][j]='<span class="c1">'+SDK_memchif+'</span>';
            break;
          default:
            SDK_Joueur[i][j]='<span class="c2">'+SDK_memchif+'</span>';
        }
        (SDK_Joueur[i][j]!='0')? Objs.innerHTML=SDK_Joueur[i][j]: Objs.innerHTML='&nbsp;';
      }
    }
    // mode 2= affiche la solution case par case, retour mode 1
    if (SDK_modecase==2){
      Objs=getObjs('SDK_case'+i+j);
      SDK_Joueur[i][j]='<span class="c3">'+SDK_Grille[i][j]+'</span>';
      Objs.innerHTML=SDK_Joueur[i][j];
      //
      SDK_mem(SDK_memchif);
      // retour mode 1
      SDK_modecase=1;
    }
    // status (cases non jou�es ou fausses)
    Objs=getObjs('SDK_status');
    reste=0;
    for (i=0;i<9;i++){
      for (j=0;j<9;j++){
        if (SDK_Masque[i][j]!='0'){
          if (SDK_Joueur[i][j].substr(SDK_Joueur[i][j].indexOf('">')+2,1)!=SDK_Grille[i][j]) reste++;
        }
      }
    }
    // gestion du reste 
    if (reste!=0) {
      Objs.innerHTML=reste;
    }else{
      // la grille est finie
      Objs.innerHTML='<span class="fin">termin�</span>';
      // gestion des boutons "commandes"
      Objs=getObjs('SDK_commande3');
      Objs.style.visibility= 'visible';
      List=[1,2,4,5];
      for (i in List){
        Objs=getObjs('SDK_commande'+List[i]);
        Objs.style.visibility= 'hidden';
      }
      // on d�sactive la barre horizontale
      Objs=getObjs('SDK_menuH');
      Objs.disabled= true;
      for (i=0;i<10;i++){
        Objs=getObjs('SDK_bouton'+i);
        Objs.disabled= true;
      }
      // pas de chiffre m�moris� ni affich�
      SDK_memchif='';
      Objs=getObjs('SDK_chx');
      Objs.innerHTML='&nbsp;';
      // arr�t du chronom�tre
      clearInterval(SDK_chrono);
      // retour en mode 0
      SDK_modecase= 0;
    }
}
//--- gestion de la s�lection du chiffre
function SDK_mem(chiffre){
    var chiffre, v, i;
    chiffre= chiffre.toString();
    // grise le bouton s�lectionn�: '0' � '9' ('0'= gomme)
    v= parseInt(chiffre);
    for (i=0;i<10;i++){
      Objs=getObjs('SDK_bouton'+i);
	  (i==v)? Objs.disabled= true: Objs.disabled= false;
    }
    // m�morise et affiche la s�lection
    Objs=getObjs('SDK_chx');
    switch (chiffre) {
      case '':
        Objs.innerHTML='&nbsp;';
        break;
      case '0':
        Objs.innerHTML='<span class="gomme">gomme</span>';
        SDK_memchif='&nbsp;';
        break;
      default:
        Objs.innerHTML=chiffre;
        SDK_memchif= chiffre;
    }
}
//------------------------------------------------------------------------------
//--- affiche la grille
function SDK_affichegrille(s){
  var s, i, j;
  for (i=0;i<9;i++){
    for (j=0;j<9;j++){
      if (SDK_Joueur[i][j]>'0'){
        Objs=getObjs('SDK_case'+i+j);
        switch(s) {
          case 0:
            Objs.innerHTML= '&nbsp;';
            break;
          case 1:
            Objs.innerHTML= SDK_Joueur[i][j];
            break;
        }
      }
    }
  }
}
//--- chronom�tre
function SDK_chronometre() {
    var texteHTML, secondes, minutes;
    SDK_chronoval++;
    secondes= SDK_chronoval%60;
    minutes= parseInt(SDK_chronoval/60);
    minutes= minutes%60;
    Objs= getObjs('SDK_chrono-se');
    (secondes<10)? texteHTML= '&nbsp;'+secondes: texteHTML= secondes;
    if (secondes==0) texteHTML= '&nbsp;&nbsp;';
    Objs.innerHTML= texteHTML;
    (minutes<10)? texteHTML= '&nbsp;'+minutes: texteHTML= minutes;
    if (minutes==0) texteHTML= '&nbsp;&nbsp;'
    Objs=getObjs('SDK_chrono-mn');
    Objs.innerHTML= texteHTML;
}
/*========= fin du script ====================================================*/
