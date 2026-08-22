<?php

// conjuntos

// Conjunto dos números naturais (N)
// O conjunto dos números naturais é representado por N e inclui todos os números inteiros não negativos, começando do 1.
// Exemplo: N = {1, 2, 3, 4, 5, ...}
function conjuntoNatural() {
    return range(1, 100); // Conjunto dos números naturais de 1 a 100
}
function ehConjuntoNatural($numero) {
    return in_array($numero, conjuntoNatural());
}

// Conjunto dos números inteiros (Z)
// O conjunto dos números inteiros é representado por Z e inclui todos os números inteiros, tanto positivos quanto negativos, incluindo o zero.
// Exemplo: Z = {..., -3, -2, -1, 0, 1, 2, 3, ...}

function conjuntoInteiro() {
    return range(-100, 100); // Conjunto dos números inteiros de -100 a 100
}
function ehConjuntoInteiro($numero) {
    return in_array($numero, conjuntoInteiro());
}

// Conjunto dos números racionais (Q)
// O conjunto dos números racionais é representado por Q e inclui todos os números que podem ser expressos como uma fração, onde o numerador é um número inteiro e o denominador é um número inteiro diferente de zero.
// Exemplo: Q = {p/q | p ∈ Z, q ∈ Z, q ≠ 0}
// A função abaixo gera um conjunto de números racionais representados como frações.
// A função gera números racionais com denominadores de 1 a 10 e numeradores de -10 a 10.
// A função retorna um array contendo os números racionais únicos gerados.
function conjuntoRacional() {
    $racionais = [];
    for ($denominador = 1; $denominador <= 10; $denominador++) {
        for ($numerador = -10; $numerador <= 10; $numerador++) {
            if ($denominador != 0) {
                $racionais[] = $numerador / $denominador;
            }
        }
    } // ex: 1/2, 3/4, -5/6
    return array_unique($racionais); // Conjunto dos números racionais
}
function ehConjuntoRacional($numero) {
    // Verifica se um número pertence ao conjunto dos números racionais
    return in_array($numero, conjuntoRacional());
}

// Conjunto dos números irracionais (I)
// O conjunto dos números irracionais é representado por I e inclui todos os números que não podem ser expressos como uma fração, ou seja, não podem ser representados como uma razão de dois números inteiros.
// Exemplo: I = {√2, π, e, ...}
function conjuntoIrracional() {
    return [sqrt(2), pi(), exp(1)]; // Conjunto dos números irracionais
}
function ehConjuntoIrracional($numero) {
    // Verifica se um número pertence ao conjunto dos números irracionais
    return in_array($numero, conjuntoIrracional());
}

// Conjunto dos números reais (R)
// O conjunto dos números reais é representado por R e inclui todos os números que podem ser representados na reta numérica, incluindo os números racionais e irracionais.
// Exemplo: R = Q ∪ I
function conjuntoReal() {
    return array_merge(conjuntoRacional(), conjuntoIrracional()); // Conjunto dos números reais
}
function ehConjuntoReal($numero) {
    // Verifica se um número pertence ao conjunto dos números reais
    return in_array($numero, conjuntoReal());
}

// Conjunto dos números complexos (C)
// O conjunto dos números complexos é representado por C e inclui todos os números que podem ser expressos na forma a + bi, onde a e b são números reais e i é a unidade imaginária (i² = -1).
// Exemplo: C = {a + bi | a, b ∈ R, i² = -1}
// A função abaixo gera um conjunto de números complexos representados como pares (a, b), onde a é a parte real e b é a parte imaginária.
function conjuntoComplexo() {
    $complexos = [];
    for ($a = -10; $a <= 10; $a++) {
        for ($b = -10; $b <= 10; $b++) {
            $complexos[] = [$a, $b]; // Representando números complexos como pares (a, b)
        }
    }
    return $complexos; // Conjunto dos números complexos
}
function ehConjuntoComplexo($numero) {
    // Verifica se um número pertence ao conjunto dos números complexos
    return in_array($numero, conjuntoComplexo());
}