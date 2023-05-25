<?php
session_start();
require("../BDD/connexion_BDD.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/style_Fin.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>inscription</title>
</head>

<body>
<div class="white" style="--color: white">
    <?php
        // Récupérer le temps de début
       $start_time = isset($_GET['start_time']) ? intval($_GET['start_time']) : time();

        // Récupérer le résultat de la vérification depuis les paramètres de l'URL
        $result = isset($_GET['result']) ? $_GET['result'] : '';


        $elapsed_time = time() - $start_time;
        $score = 2000 - $elapsed_time;

        // Afficher le message approprié selon le résultat
        if ($result === 'success') {
            echo '<blockquote class="quote small-container">
                    <span class="bam">BRAVO</span>
                    <span class="pow">BRAVO</span>
                </blockquote>';
            echo '<h2>vous avez résolu le Sudoku avec succès !<h2>';
            echo '<p>score : ' . $score. '</p>';
            echo '<p>Temps écoulé : ' . gmdate("H:i:s", $elapsed_time) . '</p>';
            echo'<div class="div_btn_fin">';
            if($_SESSION['user'] == true){
                $_SESSION['score'] = $score;
                echo '<div class="btn">
                            <a href="../BDD/traitement_rejouer_point.php">Rejouer</a>
                        </div>';
            }else{
                echo '<div class="btn">
                            <a href="../Jeux/sudoku.php">Rejouer</a>
                        </div>';
            }
            echo '<img src="../../img/coupe.png" alt="">';
            if($_SESSION['user'] == true){
                $_SESSION['score'] = $score;
                echo '<div class="btn">
                            <a href="../BDD/traitement_accueil_point.php">Accueil</a>
                        </div>';
            }else{
                echo '<div class="btn">
                            <a href="../../index.php">Accueil</a>
                        </div>';
            }
            echo '</div>';
            
        } elseif ($result === 'failure') {
            echo '<blockquote class="quote small-container">
                    <span class="bam">PERDU</span>
                    <span class="pow">PERDU</span>
                </blockquote>';
            echo '<h2>Le Sudoku que vous avez rempli n\'est pas correct.</h2>';
            echo '<p>Temps écoulé : ' . gmdate("H:i:s", $elapsed_time) . '</p>';
            echo'<div class="div_btn_fin">
                    <div class="btn">
                        <a href="../Jeux/sudoku.php">Rejouer</a>
                    </div>
                    <img src="../../img/fail.png" alt="">

                    <div class="btn">
                        <a href="../../index.php">Accueil</a>
                    </div>
                </div>';
        }else{
            echo '<h2>Résultat inconnu.</h2>';
        }

    ?>
    
            
    </div>
    <script>
        const body = document.querySelector("body");
        const quote = document.querySelector(".quote");

        fitForContainer();
        window.addEventListener("resize", () => {
            fitForContainer();
        });

        function fitForContainer() {
            if (body.offsetHeight > 600 && body.offsetWidth > 600) {
                quote.classList.remove('small-container');
            } else {
                quote.classList.add("small-container");
            }
        }

    </script>
</body>

</html>