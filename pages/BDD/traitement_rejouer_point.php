<?php
session_start();
require("../BDD/connexion_BDD.php");

if (isset($_SESSION['user'])) {
    $pseudo = $_SESSION['user_name'];

    $query = "SELECT user_points FROM utilisateur WHERE user_pseudo = :pseudo";
    $stmt = $dbco->prepare($query);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentScore = $result['user_points'];

        if (is_null($currentScore)) {
            $currentScore = 0;
        }

        $scoreToAdd = $_SESSION['score']; 
        $newScore = $currentScore + $scoreToAdd;

        $query = "UPDATE utilisateur SET user_points = :newScore WHERE user_pseudo = :pseudo";
        $stmt = $dbco->prepare($query);
        $stmt->bindParam(':newScore', $newScore);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
    } else {
        print_r("aaaaaaaaaaa");
    }
}

header("Location:../Jeux/sudoku.php");
exit();
?>