
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/style_connexion.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>inscription</title>
</head>
<body>
    <div class="div_retour">
        <a href="../../index.php">
            <div class="btn">
                Accueil
            </div>
        </a>
    </div>
    <div class="block_formulaire">
        <div class="div_formulaire_inscription">
            <h1>Inscription</h1>
            <form class="formulaire" action="../BDD/traitement.php" method="POST">
                <label for="pseudo">Pseudo:</label>
                <input type="text" id="pseudo" name="pseudo_inscript" required><br><br>
            
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password_inscript" required maxlength="7"><br><br>
            
                <label for="email">Email:</label>
                <input type="email" id="email" name="email_inscript" required><br><br>
                <div class="coche_form">
                    <input type="checkbox" id="conditions" name="conditions" required>
                    <label for="conditions">J'accepte les <a href="#">conditions d'utilisation</a></label><br><br>
                </div>
                            
                <input class="btn_envoie" type="submit" value="inscription" name="inscription">
            </form>
            <a class="btn_change_connexion">J'ai deja un compte</a>
        </div>
        <div class="div_formulaire_connexion">
            <h1>Connexion</h1>
            <form class="formulaire" action="../BDD/traitement.php" method="POST">
                <label for="pseudo">Pseudo:</label>
                <input type="text" id="pseudo" name="pseudo_connexion" required><br><br>
            
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password_connexion" required><br><br>
                            
                <input class="btn_envoie" type="submit" value="connexion" name="connexion">
            </form>
            <a class="btn_change_inscript">Je n'est pas de compte</a>
        </div>
    </div>
    <?php
    for ($i = 1; $i <= 9; $i++) {
        echo '<div class="anim_'.$i.'">';
        echo $i;
        echo '</div>';
    }
    ?>
    <script>
        $(document).ready(function(){
            $(".btn_change_connexion").click(function(){
                $(".div_formulaire_inscription").hide()
                $(".div_formulaire_connexion").css("display","flex")
            });
            $(".btn_change_inscript").click(function(){
                $(".div_formulaire_connexion").hide()
                $(".div_formulaire_inscription").css("display","flex")
            });
        });
    </script>
</body>
</html>