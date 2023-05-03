
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style_connexion.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>inscription</title>
</head>
<body>
    <div class="div_retour">
        <div class="btn">
            Accueil
        </div>
    </div>
    <div class="block_formulaire">
        <div class="div_formulaire_inscription">
            <h1>Inscription</h1>
            <form class="formulaire" action="../BDD/traitement.php" method="POST">
                <label for="pseudo">Pseudo:</label>
                <input type="text" id="pseudo" name="pseudo_inscript" required><br><br>
            
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password_inscript" required><br><br>
            
                <label for="email">Email:</label>
                <input type="email" id="email" name="email_inscript" required><br><br>
                <div class="coche_form">
                    <input type="checkbox" id="conditions" name="conditions" required>
                    <label for="conditions">J'accepte les <a href="#">conditions d'utilisation</a></label><br><br>
                </div>
                            
                <input class="btn_envoie" type="submit" value="inscription" name="inscription">
            </form>
            <a class="btn_change_connexion">Je n'est pas de compte</a>
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
            <a class="btn_change_inscript">J'ai deja un compte</a>
        </div>
    </div>
    <div class="anim_1">
        1
    </div>
    <div class="anim_2">
        2
    </div>
    <div class="anim_3">
        3
    </div>
    <div class="anim_4">
        4
    </div>
    <div class="anim_5">
        5
    </div>
    <div class="anim_6">
        6
    </div>
    <div class="anim_7">
        7
    </div>
    <div class="anim_8">
        8
    </div>
    <div class="anim_9">
        9
    </div>
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