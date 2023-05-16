<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku</title>
    <link rel="stylesheet" href="style/fin.css">
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
            echo'<div class="div_btn_fin">
                    <div class="btn">
                        <a href="sudoku.php">Rejouer</a>
                    </div>
                    <img src="img/coupe.png" alt="">
            
                    <div class="btn">
                    <a href="acceuil.php">Accueil</a>
                    </div>
                </div>';
            
        } elseif ($result === 'failure') {
            echo '<blockquote class="quote small-container">
                    <span class="bam">PERDU</span>
                    <span class="pow">PERDU</span>
                </blockquote>';
            echo '<h2>Le Sudoku que vous avez rempli n\'est pas correct.</h2>';
            echo '<p>Temps écoulé : ' . gmdate("H:i:s", $elapsed_time) . '</p>';
            echo'<div class="div_btn_fin">
                    <div class="btn">
                        <a href="sudoku.php">Rejouer</a>
                    </div>
                    <img src="img/fail.png" alt="">

                    <div class="btn">
                        <a href="acceuil.php">Accueil</a>
                    </div>
                </div>';
        }else{
            echo '<h2>Résultat inconnu.</h2>';
        }

    ?>
    
            
    </div>
</body>
</html>
