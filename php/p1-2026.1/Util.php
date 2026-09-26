<?php

class Util
{
    public static function getCurrentDateTime()
    {
        return date('Y-m-d H:i:s');
    }

    public static function paraCamelCase($texto){
        $textoNormalizado = str_replace(["-","_","."], " ", mb_strtolower($texto));
        $partes = explode(" ", $textoNormalizado);

        foreach ($partes as $indice => $palavra){
            if($indice ==0){
                $partes[$indice] = $palavra;
            } else {
                $partes[$indice] = ucfirst($palavra);
                // ou -> $partes[$indice] = mb_strtoupper(mb_substr($palavra, 0, 1)).mb_substr($palavra,1);
                // ambos funcionam, mas a primeira é mais legível
            }

            $textoConcatenado = implode("", $partes);
        }

        return $textoConcatenado;
    }
}