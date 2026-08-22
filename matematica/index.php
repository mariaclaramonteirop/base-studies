<?php
    require_once 'matematica/operacoesElementares.php';
    require_once 'matematica/conjuntos.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php
        // Exemplo de uso das funções de operações elementares
            $a = conjuntoNatural()[0]; // 1
            $b = conjuntoNatural()[1]; // 2
            $c = conjuntoNatural()[2]; // 3

            desenharTabelaOperacoes($a, $b, $c);
        ?>
</body>
</html>