<?php
require_once 'matematica/conjuntos.php';
// operações elementares

// soma
function soma($a, $b) {
    return $a + $b;
}

// subtração
function subtracao($a, $b) {
    return $a - $b;
}

// multiplicação - produto
function produto($a, $b) {
    return $a * $b;
}

// divisão
function divisao($a, $b) {
    if ($b == 0) {
        throw new Exception("Divisão por zero não é permitida."); // conjunto irracional -  no conjunto dos números reais, a divisão por zero não é definida
    }
    return $a / $b;
}

// Associatividade e comutatividade
// Associatividade e comutatividade são propriedades matemáticas que se aplicam a operações como soma e multiplicação.
// A associatividade indica que a forma como os números são agrupados não afeta o resultado da operação, 
// enquanto a comutatividade indica que a ordem dos números não afeta o resultado.

// assosiativa da soma
function associativaSoma($a, $b, $c) {
    return soma(soma($a, $b), $c) == soma($a, soma($b, $c)); // (a + b) + c = a + (b + c)
}

// comutativa da soma
function comutativaSoma($a, $b) {
    return soma($a, $b) == soma($b, $a); // a + b = b + a
}

//Elementos neutros e inversos
// O elemento neutro da soma é 0, pois qualquer número somado a 0 resulta no próprio número.
function elementoNeutroSoma($a) {
    return soma($a, 0) == $a; // a + 0 = a
}

// O inverso aditivo de um número é o número que, quando somado ao original, resulta em 0.
function inversoAditivo($a) {
    return soma($a, -$a) == 0; // a + (-a) = 0
}

// associativa da multiplicação
function associativaMultiplicacao($a, $b, $c) {
    return produto(produto($a, $b), $c) == produto($a, produto($b, $c)); // (a * b) * c = a * (b * c)
}

// comutativa da multiplicação
function comutativaMultiplicacao($a, $b) {
    return produto($a, $b) == produto($b, $a); // a * b = b * a
}

// O elemento neutro da multiplicação é 1, pois qualquer número multiplicado por 1 resulta no próprio número.
function elementoNeutroMultiplicacao($a) {
    return produto($a, 1) == $a; // a * 1 = a
}

// O inverso multiplicativo de um número é o número que, quando multiplicado pelo original, resulta em 1.
function inversoMultiplicativo($a) {
    if ($a == 0) {
        throw new Exception("O inverso multiplicativo não é definido para zero."); // conjunto irracional -  no conjunto dos números reais, o inverso multiplicativo não é definido para zero
    }
    return produto($a, 1 / $a) == 1; // a * (1/a) = 1
}

// Distributividade
// A distributividade é uma propriedade que relaciona a multiplicação e a soma. Ela indica que a multiplicação de um número por uma soma é igual à soma das multiplicações desse número pelos termos da soma.
function distributiva($a, $b, $c) {
    return produto($a, soma($b, $c)) == soma(produto($a, $b), produto($a, $c)); // a * (b + c) = (a * b) + (a * c)
}

// inverso aditivo e multiplicativo (elementos opostos)
// denota-se por -a no inverso aditivo
// denota-se por 1/a no inverso multiplicativo, a^-1 = 1/a significa que a^-1 é o inverso multiplicativo de a, ou seja, o número que, quando multiplicado por a, resulta em 1.

//outras propriedades
// se a.b = 0, então a = 0 ou b = 0 (propriedade do zero)
//se (-a).b = a.(-b) = -(a.b) (propriedade do inverso aditivo)
//se (-a).(-b) = a.b (propriedade do inverso aditivo)
function propriedadeDoZero($a, $b) {
    return produto($a, $b) == 0 ? ($a == 0 || $b == 0) : true; // se a.b = 0, então a = 0 ou b = 0
}

function propriedadeDoInversoAditivo($a, $b) {
    return produto(-$a, $b) == produto($a, -$b) && produto(-$a, -$b) == produto($a, $b); // (-a).b = a.(-b) = -(a.b)
}

    function formaVisualDeCadaOperacaoSomaProduto($a, $b, $c) {
        return [
            'soma' => "$a + $b = " . soma($a, $b),
            'subtracao' => "$a - $b = " . subtracao($a, $b),
            'produto' => "$a * $b = " . produto($a, $b),
            'divisao' => "$a / $b = " . (function() use ($a, $b) {
                try {
                    return divisao($a, $b);
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            })(),
            'associativaSoma' => "($a + $b) + $c = $a + ($b + $c) : " . (associativaSoma($a, $b, $c) ? 'Verdadeiro' : 'Falso'),
            'comutativaSoma' => "$a + $b = $b + $a : " . (comutativaSoma($a, $b) ? 'Verdadeiro' : 'Falso'),
            'elementoNeutroSoma' => "$a + 0 = $a : " . (elementoNeutroSoma($a) ? 'Verdadeiro' : 'Falso'),
            'inversoAditivo' => "$a + (-$a) = 0 : " . (inversoAditivo($a) ? 'Verdadeiro' : 'Falso'),
            'associativaMultiplicacao' => "($a * $b) * $c = $a * ($b * $c) : " . (associativaMultiplicacao($a, $b, $c) ? 'Verdadeiro' : 'Falso'),
            'comutativaMultiplicacao' => "$a * $b = $b * $a : " . (comutativaMultiplicacao($a, $b) ? 'Verdadeiro' : 'Falso'),
            'elementoNeutroMultiplicacao' => "$a * 1 = $a : " . (elementoNeutroMultiplicacao($a) ? 'Verdadeiro' : 'Falso'),
            'inversoMultiplicativo' => "$a * (1/$a) = 1 : " . (function() use ($a) {
                try {
                    return inversoMultiplicativo($a) ? 'Verdadeiro' : 'Falso';
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            })(),
            'distributiva' => "$a * ($b + $c) = ($a * $b) + ($a * $c) : " . (distributiva($a, $b, $c) ? 'Verdadeiro' : 'Falso'),
            'propriedadeDoZero' => "$a * $b = 0 : " . (propriedadeDoZero($a, $b) ? 'Verdadeiro' : 'Falso'),
            'propriedadeDoInversoAditivo' => "(-$a) * $b = $a * (-$b) = -($a * $b) : " . (propriedadeDoInversoAditivo($a, $b) ? 'Verdadeiro' : 'Falso')
        ];
    }

    function desenharTabelaOperacoes($a, $b, $c) {
        $operacoes = formaVisualDeCadaOperacaoSomaProduto($a, $b, $c);
        echo "<table border='1'>";
        echo "<tr><th>Operação</th><th>Resultado</th></tr>";
        foreach ($operacoes as $operacao => $resultado) {
            echo "<tr><td>$operacao</td><td>$resultado</td></tr>";
        }
        echo "</table>";
    }

    