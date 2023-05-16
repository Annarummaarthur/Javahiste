<?php

function generateSudoku($difficulty) {
    // Initialisation de la grille
    $grid = array_fill(0, 9, array_fill(0, 9, 0));

    // Générer une grille résolue avec des chiffres différents à chaque fois
    $digits = range(1, 9);
    shuffle($digits);
    for ($i = 0; $i < 9; $i++) {
        $grid[$i] = $digits;
        array_push($digits, array_shift($digits));
    }
    solveSudoku($grid);

    // Masquer certaines cellules en fonction du niveau de difficulté
    $cellsToHide = 0;
    switch ($difficulty) {
        case 1:
            $cellsToHide = 35;
            break;
        case 2:
            $cellsToHide = 45;
            break;
        case 3:
            $cellsToHide = 55;
            break;
        default:
            throw new Exception('Invalid difficulty level');
    }
    $hiddenCells = array_rand(array_flip(range(0, 80)), $cellsToHide);
    foreach ($hiddenCells as $cell) {
        $grid[floor($cell / 9)][$cell % 9] = 0;
    }

    return $grid;
}


function solveSudoku(&$grid) {
    $row = -1;
    $col = -1;
    $isEmpty = true;
    for ($i = 0; $i < 9; $i++) {
        for ($j = 0; $j < 9; $j++) {
            if ($grid[$i][$j] == 0) {
                $row = $i;
                $col = $j;
                $isEmpty = false;
                break;
            }
        }
        if (!$isEmpty) {
            break;
        }
    }
    if ($isEmpty) {
        return true;
    }
    for ($num = 1; $num <= 9; $num++) {
        if (isSafe($grid, $row, $col, $num)) {
            $grid[$row][$col] = $num;
            if (solveSudoku($grid)) {
                return true;
            }
            $grid[$row][$col] = 0;
        }
    }
    return false;
}

function isSafe($grid, $row, $col, $num) {
    for ($i = 0; $i < 9; $i++) {
        if ($grid[$row][$i] == $num) {
            return false;
        }
    }
    for ($i = 0; $i < 9; $i++) {
        if ($grid[$i][$col] == $num) {
            return false;
        }
    }
    $boxRow = $row - $row % 3;
    $boxCol = $col - $col % 3;
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($grid[$boxRow + $i][$boxCol + $j] == $num) {
                return false;
            }
        }
    }
    return true;
}

?>