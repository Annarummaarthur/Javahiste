<link rel="stylesheet" type="text/css" href="SDK_SudokuStyle_M.css">
<div id="SDK_cadre"></div>
<script language="JavaScript" type="text/javascript" src="SudokuInit.js"></script>
<script>

var SDK_chronoval=0, SDK_chrono;
var SDK_memchif, SDK_modecase;
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
SDK_sudoku();
function getObjs(Id){
  var Id, objs;
  if (document.getElementById) objs=document.getElementById(Id);
  return objs;
}
function charge_contenu(texteHTML,Id){
  var texteHTML, Id;
  Objs=getObjs(Id);
  Objs.innerHTML= texteHTML;
}
function SDK_sudoku() {
    var texteHTML, a, b, c, d, i, j;
    //
    SDK_modecase=0;
    texteHTML='<div id="SDK_grille"></div>';
    texteHTML+='<div id="SDK_menuV"></div>';
    texteHTML+='<div id="SDK_menuH"></div>';
    charge_contenu(texteHTML,'SDK_cadre');
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
    texteHTML ='<input id="SDK_commande1" class="menu" type="button" onClick="SDK_gestion(1)" value="jouer la grille"/>';
    texteHTML+='<input id="SDK_commande2" class="menu" type="button" onClick="SDK_gestion(2)" value="pause"/>'; // pause ou continue
    texteHTML+='<input id="SDK_commande3" class="menu" type="button" onClick="SDK_gestion(3)" value="rejouer"/>';
    texteHTML+='<hr>';
    texteHTML+='<input id="SDK_commande4" class="menu" type="button" onClick="SDK_gestion(4)" value="joker"/>';
    texteHTML+='<input id="SDK_commande5" class="menu" type="button" onClick="SDK_gestion(5)" value="solution"/>';
    texteHTML+='<div id="SDK_status">&nbsp;</div>';
    texteHTML+='<div id="SDK_chrono"><span id="SDK_chrono-mn">&nbsp;</span>:&nbsp;<span id="SDK_chrono-se">&nbsp;</span></div>';
    charge_contenu(texteHTML,'SDK_menuV');
    for (i=2;i<=5;i++){
      Objs=getObjs('SDK_commande'+i);
      Objs.style.visibility= 'hidden';
    }
    Objs=getObjs('SDK_menuH');
    Objs.disabled= true;
    texteHTML='<fieldset>';
    for (i=0;i<10;i++){
      texteHTML+='<input id="SDK_bouton'+i+'" type="button" accesskey="'+i+'+ALT"';
      (i==0)? texteHTML+=' value="&nbsp;" class="gomme"': texteHTML+=' value="'+i+'" ';
      texteHTML+='onClick="SDK_mem('+i+');" disabled="true">\n';
    }
    texteHTML+='<div id="SDK_chx"></div>';
    texteHTML+='</fieldset>';
    charge_contenu(texteHTML,'SDK_menuH');
}
function SDK_gestion(c){
    var c, texteHTML, i, j, p, chiffre, reste;
    var List=new Array();
    switch(c){
      case 1: 
        SDK_chronoval= 0;
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
        Objs=getObjs('SDK_status');
        Objs.innerHTML=reste;
        Objs=getObjs('SDK_commande1');
        Objs.style.visibility= 'hidden';
        List=[2,3,4,5];
        for (i in List){
          Objs=getObjs('SDK_commande'+List[i]);
          Objs.style.visibility= 'visible';
        }
        SDK_affichegrille(1);
        Objs=getObjs('SDK_menuH');
        Objs.disabled= false;
        for (i=0;i<10;i++){
          Objs=getObjs('SDK_bouton'+i);
          Objs.disabled= false;
        }
        SDK_memchif='';
        SDK_chrono=setInterval('SDK_chronometre()',1000);
        SDK_modecase=1;
        break;
      case 2: 
        Objs=getObjs('SDK_commande2');
        etat= Objs.value;
        switch(etat){
          case 'pause':
            Objs.value= 'continue';
            clearInterval(SDK_chrono);
            SDK_affichegrille(0);
            Objs=getObjs('SDK_commande4');
            Objs.style.visibility= 'hidden';
            SDK_modecase=0;
            break;
          case 'continue':
            Objs.value= 'pause';
            SDK_chrono=setInterval('SDK_chronometre()',1000);
            SDK_affichegrille(1);
            Objs=getObjs('SDK_commande4');
            Objs.style.visibility= 'visible';
            SDK_modecase=1;
            break;
        }
        break;
      case 3: 
        clearInterval(SDK_chrono);
        SDK_sudoku()
        SDK_modecase=0;
        break;
      case 4:
        Objs=getObjs('SDK_chx');
        Objs.innerHTML='<span class="joker">Joker</span>';
        SDK_modecase=2;
        break;
      case 5: 
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
function SDK_case(i,j){
    var i, j, classe, reste;
    if (SDK_modecase==0){
      return;
    }
    if (SDK_modecase==1){
      if (SDK_Masque[i][j]!='0' && SDK_memchif!=''){
        Objs=getObjs('SDK_case'+i+j);
        switch (SDK_memchif) {
          case '&nbsp;': 
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
    if (SDK_modecase==2){
      Objs=getObjs('SDK_case'+i+j);
      SDK_Joueur[i][j]='<span class="c3">'+SDK_Grille[i][j]+'</span>';
      Objs.innerHTML=SDK_Joueur[i][j];
      SDK_mem(SDK_memchif);
      SDK_modecase=1;
    }
    Objs=getObjs('SDK_status');
    reste=0;
    for (i=0;i<9;i++){
      for (j=0;j<9;j++){
        if (SDK_Masque[i][j]!='0'){
          if (SDK_Joueur[i][j].substr(SDK_Joueur[i][j].indexOf('">')+2,1)!=SDK_Grille[i][j]) reste++;
        }
      }
    }
    if (reste!=0) {
      Objs.innerHTML=reste;
    }else{
      Objs.innerHTML='<span class="fin">terminé</span>';
      Objs=getObjs('SDK_commande3');
      Objs.style.visibility= 'visible';
      List=[1,2,4,5];
      for (i in List){
        Objs=getObjs('SDK_commande'+List[i]);
        Objs.style.visibility= 'hidden';
      }
      Objs=getObjs('SDK_menuH');
      Objs.disabled= true;
      for (i=0;i<10;i++){
        Objs=getObjs('SDK_bouton'+i);
        Objs.disabled= true;
      }
      SDK_memchif='';
      Objs=getObjs('SDK_chx');
      Objs.innerHTML='&nbsp;';
      clearInterval(SDK_chrono);
      SDK_modecase= 0;
    }
}
function SDK_mem(chiffre){
    var chiffre, v, i;
    chiffre= chiffre.toString();
    v= parseInt(chiffre);
    for (i=0;i<10;i++){
      Objs=getObjs('SDK_bouton'+i);
	  (i==v)? Objs.disabled= true: Objs.disabled= false;
    }
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

</script>
