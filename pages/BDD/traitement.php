<?php
session_start();
require("../BDD/connexion_BDD.php");



if (isset($_POST['inscription'])) {
    $pseudo = $_POST["pseudo_inscript"];
    $mdp = $_POST["password_inscript"];
    $mail = $_POST["email_inscript"];
    
    $sth = $dbco->prepare("
            INSERT INTO utilisateur(user_pseudo, user_password, user_email)
            VALUES(:pseudo, :passwrd, :mail)
            ");
    $sql =  'SELECT user_pseudo FROM utilisateur';
    $utilisateurs = array("PHP", "Java", "Python", "HTML");
    foreach  ($dbco->query($sql) as $row) {//Récupere tout les utilisateurs existant
        array_push($utilisateurs, $row['user_pseudo']);
    }
    if(in_array($pseudo, $utilisateurs)){//Verifie que l'utilsateur que on veut crée n'a pas le meme nom que un autre 
        header("Location:../connexion/connexion.php");
	}else{// si le pseudo n'est pas pris alor rajouté l'utilisateur
        $sth->bindParam(':pseudo', $pseudo);
        $sth->bindParam(':passwrd', password_hash($mdp, PASSWORD_DEFAULT, ['cost' => 10])); // chiffre le password
        $sth->bindParam(':mail', $mail);
        $sth->execute();
        header("Location:../../index.php");
    }
}


if (isset($_POST['connexion'])) {
    $pseudo = $_POST["pseudo_connexion"];
    $mdp = $_POST["password_connexion"];
    $sql =  'SELECT user_pseudo, user_password FROM utilisateur';
    foreach  ($dbco->query($sql) as $row) {
        if($_POST["pseudo_connexion"] == $row['user_pseudo']){
            if( password_verify($mdp, $row['user_password'])){// vérifie que le password correspond au password chiffré de la base de donnée
                $_SESSION['user'] = true;
                $_SESSION['user_name'] = $row['user_pseudo'];
                header("Location:../../index.php");
            }else{
                header("Location:../connexion/connexion.php");
            }
        }
    }
    
}


?>