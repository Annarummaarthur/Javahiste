<?php
session_start();
require_once 'Grille.php';

if (!isset($_SESSION['grid'])) {
    $_SESSION['grid'] = generateSudoku(1);
    $_SESSION['lives'] = 3;
}

if ($_SESSION['lives'] == 0) {
    echo 'Perdu';
    unset($_SESSION['grid']);
    unset($_SESSION['lives']);
    exit();
}

if (isset($_POST['submit'])) {
    $row = $_POST['row'];
    $col = $_POST['col'];
    $num = $_POST['num'];
    if ($_SESSION['grid'][$row][$col] != $num) {
        $_SESSION['lives']--;
    }
    $_SESSION['grid'][$row][$col] = $num;
}

$grid = $_SESSION['grid'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sudoku</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Sudoku</h1>
    <form method="post">
        <table>
            <?php for ($i = 0; $i < 9; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < 9; $j++): ?>
                <td>
                    <?php if ($grid[$i][$j] == 0): ?>
                    <input type="number" name="num" min="1" max="9" required>
                    <?php else: ?>
                    <?php echo $grid[$i][$j]; ?>
                    <?php endif; ?>
                    <input type="hidden" name="row" value="<?php echo $i; ?>">
                    <input type="hidden" name="col" value="<?php echo $j; ?>">
                </td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        </table>
        <button type="submit" name="submit">Soumettre</button>
    </form>
    <p>Vies restantes: <?php echo $_SESSION['lives']; ?></p>
    <?php if ($grid == solveSudoku($grid)): ?>
    <p>Gagné</p>
    <?php endif; ?>
</body>
</html>