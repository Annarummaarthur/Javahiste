<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku Facile</title>
    <link rel="stylesheet" href="../../style/style_sudoku.css">
    <script>
      window.onload = function() {
            var startTime = new Date().getTime();
            var timer = document.getElementById("timer");

            // Fonction pour mettre à jour l'affichage du temps
            function updateTimer() {
                
                var currentTime = new Date().getTime();
                var elapsedTime = currentTime - startTime;

                // Calcul du temps en heures, minutes et secondes
                var hours = Math.floor(elapsedTime / (1000 * 60 * 60));
                var minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

                // Formatage de l'affichage du temps
                var timeString = hours.toString().padStart(2, "0") + ":" +
                                 minutes.toString().padStart(2, "0") + ":" +
                                 seconds.toString().padStart(2, "0");

                // Mise à jour de l'affichage du temps
                timer.innerHTML = timeString;

                // Appel récursif pour mettre à jour le temps toutes les secondes
                setTimeout(updateTimer, 1000);
            }

            // Démarrer le compteur de temps
            updateTimer();
        };
        
    </script>

</head>
<body>
    <div id="flex1">
        <h1>Sudoku</h1>
        <div id="timer">00:00:00</div>
    </div>    
    <?php

    // Fonction pour générer une grille de Sudoku aléatoire
    function generer_grille_sudoku() {
        $tab = array_fill(0, 9, array_fill(0, 9, 0));
        $numbers = range(1, 9);
        shuffle($numbers);
        for ($j=0; $j<9; $j++) {
            $shift = ($j % 3) * 3;
            for ($i=0; $i<9; $i++) {
                $tab[$j][$i] = $numbers[($shift + $i + (int)($j/3)) % 9];
            }
        }
        
         // Remplacer 10 cases aléatoires par des zéros pour représenter les cases vides
         for ($k=0; $k<10; $k++) {
            $i = rand(0, 8);
            $j = rand(0, 8);
            $tab[$j][$i] = 0;
        }
        return $tab;
    }
   
    
    // Fonction pour afficher une grille de Sudoku
    function afficher_grille_sudoku($tab) {
        echo '<form method="post">';
        echo '<div class="flex">';
        echo '<div class="white" style="--color: white">';
        echo "<table>";
        for ($j=0; $j<9; $j++) {
            echo "<tr>";
            for ($i=0; $i<9; $i++) {
                $value = $tab[$j][$i] == 0 ? '<input type="text" name="saisies['.$j.']['.$i.']" min="1" max="9" required>' : $tab[$j][$i];
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
        echo '<input type="submit" name="submit" style="--color: red" value="Vérifier">';
        echo '</div>';
        echo '<input type="hidden" name="start_time" value="<?php echo time(); ?>">';
        echo '</form>';
        
    }

    // Récupérer les saisies de l'utilisateur
    function recuperer_saisies_utilisateur() {
        $saisies = array();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saisies'])) {
            $saisies = $_POST['saisies'];
        }
        
        return $saisies;
    }

    // Vérifier si le Sudoku est correctement rempli
    function verifier_sudoku_rempli($saisies) {
        // Vérifier les lignes
        for ($i = 0; $i < 9; $i++) {
            $ligne = array();
            for ($j = 0; $j < 9; $j++) {
                if (isset($saisies[$i][$j])) {
                    $valeur = $saisies[$i][$j];
                    if (in_array($valeur, $ligne)) {
                        return false; // Doublon trouvé
                    }
                    $ligne[] = $valeur;
                }
            }
        }
        
        // Vérifier les colonnes
        for ($j = 0; $j < 9; $j++) {
            $colonne = array();
            for ($i = 0; $i < 9; $i++) {
                if (isset($saisies[$i][$j])) {
                    $valeur = $saisies[$i][$j];
                    if (in_array($valeur, $colonne)) {
                        return false; // Doublon trouvé
                    }
                    $colonne[] = $valeur;
                }
            }
        }
        
        // Vérifier les régions
        for ($region = 0; $region < 9; $region++) {
            $ligneDebut = (int) ($region / 3) * 3;
            $colonneDebut = ($region % 3) * 3;
            $regionValues = array();
            for ($i = $ligneDebut; $i < $ligneDebut + 3; $i++) {
                for ($j = $colonneDebut; $j < $colonneDebut + 3; $j++) {
                    if (isset($saisies[$i][$j])) {
                        $valeur = $saisies[$i][$j];
                        if (in_array($valeur, $regionValues)) {
                            return false; // Doublon trouvé
                        }
                        $regionValues[] = $valeur;
                    }
                }
            }
        }
        
        return true; // Sudoku correctement rempli
    }

    // Générer et afficher une grille de Sudoku
    $grille = generer_grille_sudoku();
    afficher_grille_sudoku($grille);

     

    // Vérifier si des saisies ont été soumises
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        
        // Récupérer les saisies de l'utilisateur
        $saisies = recuperer_saisies_utilisateur();

        // Vérifier si le Sudoku est correctement rempli
        $sudokuCorrect = verifier_sudoku_rempli($saisies);

        // Ajouter le temps de début
        $start_time = time();
        
        // Rediriger vers fins.php avec les paramètres appropriés
        if ($sudokuCorrect) {
            header('Location: ../pages_Fin/Fin.php?result=success&start_time=' . $start_time);
            exit;
        } else {
            header('Location: ../pages_Fin/Fin.php?result=failure&start_time=' . $start_time);
            exit;
        }
    }

    

    ?>

</body>
</html>

