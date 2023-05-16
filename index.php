<?php
session_start();


print_r($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="stylesheet" href="style/style_acceuil.css">
    <script>
        // Fonction pour effectuer la redirection
        function redirectToSudoku() {
            window.location.href = "pages/Jeux/sudoku.php";


        }

        // Ajouter un écouteur d'événement pour détecter le clic sur le bouton radio
        document.addEventListener('DOMContentLoaded', function () {
            var redRadio1 = document.getElementById('red1');
            redRadio1.addEventListener('click', redirectToSudoku);

        });
        function redirectToSudokuFacile() {
            window.location.href = "pages/Jeux/sudoku_facile.php";

        }

        // Ajouter un écouteur d'événement pour détecter le clic sur le bouton radio
        document.addEventListener('DOMContentLoaded', function () {
            var redRadio2 = document.getElementById('red2');
            redRadio2.addEventListener('click', redirectToSudokuFacile);

        });
        function redirectToSudokuMoyen() {
            window.location.href = "pages/Jeux/sudoku_moyen.php";

        }

        // Ajouter un écouteur d'événement pour détecter le clic sur le bouton radio
        document.addEventListener('DOMContentLoaded', function () {
            var redRadio3 = document.getElementById('red3');
            redRadio3.addEventListener('click', redirectToSudokuMoyen);

        });
        function redirectToSudokuDifficile() {
            window.location.href = "pages/Jeux/sudoku_difficile.php";

        }

        // Ajouter un écouteur d'événement pour détecter le clic sur le bouton radio
        document.addEventListener('DOMContentLoaded', function () {
            var redRadio4 = document.getElementById('red4');
            redRadio4.addEventListener('click', redirectToSudokuDifficile);

        });
    </script>
</head>

<body>
    <header>
        <div class="div_retour">
            <span class="info-icon" title="Voici les Règles du Sudoku :
        Le Sudoku est un jeu de logique où vous devez remplir une grille de 9x9 cases avec des chiffres de 1 à 9.
        Chaque ligne, chaque colonne et chaque région de 3x3 cases ne doit contenir qu'une seule occurrence de chaque chiffre.
        Le jeu commence avec quelques chiffres déjà remplis, et vous devez compléter le reste en respectant les règles.">🛈</span>
        <?php 
            if($_SESSION['user'] == true){
                ?>
                    <a href="pages/BDD/traitement_deco.php">
                        <div class="btn">
                            Déconnexion
                        </div>
                    </a>
                <?php            }
            else{
                ?>
                    <a href="pages/connexion/connexion.php">
                        <div class="btn">
                            Connexion
                        </div>
                    </a>
                <?php
            }
        ?>
            

        </div>

    </header>
    <div class="flex">
        <blockquote class="quote small-container">
            <span class="bam">1</span>
            <span class="pow">2</span>
        </blockquote>
        <blockquote class="quote small-container">
            <span class="bam">3</span>
            <span class="pow">4</span>
        </blockquote>
    </div>
    <blockquote class="quote small-container">

        <span class="bam">sudo!</span>
        <span class="pow">ku!</span>

    </blockquote>
    <div class="bouton">
        <div class="options">
            <input type="radio" name="option" id="red1" checked />
            <label for="red1" style="--color: red"><strong>Very Easy</strong></label>
        </div>
        <div class="options">
            <input type="radio" name="option" id="red2" checked />
            <label for="red2" style="--color: red"><strong> Facile</strong></label>
        </div>
        <div class="options">
            <input type="radio" name="option" id="red3" checked />
            <label for="red3" style="--color: red"><strong>Moyen</strong></label>
        </div>
        <div class="options">
            <input type="radio" name="option" id="red4" checked />
            <label for="red4" style="--color: red"><strong>Difficile</strong></label>
        </div>
    </div>
    <div class="flex" style="--color: red">
        <blockquote class="quote small-container">
            <span class="bam">5</span>
            <span class="pow">6</span>
        </blockquote>
        <blockquote class="quote small-container">
            <span class="bam">7</span>
            <span class="pow">8</span>
        </blockquote>
    </div>
</body>

</html>