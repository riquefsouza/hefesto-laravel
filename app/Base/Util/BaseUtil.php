<?php

namespace App\Base\Util;

class BaseUtil
{
    public function __construct()
    {

    }

    public static function containsNumericSequences(int $min, int $max, string $stexto): bool
    {
        $lista = array();
        $sValorMin = "";
        $vnum = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 );

        for ($n = 0; $n < 7; $n++)
        {
            for ($qtd = $min - 1; $qtd <= $max; $qtd++)
            {
                $sValorMin = "";
                for ($i = $n; $i <= ($qtd + $n); $i++)
                {
                    if ($i <= $max)
                    {
                        $sValorMin += strval($vnum[$i]);
                    }
                }
                array_push($lista, $sValorMin);
            }
        }
        $lista = array_unique($lista);
        return in_array($stexto, $lista);
    }

    public static function containsConsecutiveIdenticalCharacters(int $min, int $max, string $stexto): bool
    {
        $lista = array();
        $sAlfaMin = "";

        //foreach (range('a', 'z') as $c)
        for ($c = ord('a'); $c <= ord('z'); $c++)
        {
            for ($qtd = $min; $qtd <= $max; $qtd++)
            {
                $sAlfaMin = "";
                for ($i = 1; $i <= $qtd; $i++)
                {
                    $sAlfaMin += strval($c);
                }
                array_push($lista, $sAlfaMin);
                array_push($lista, strtoupper($sAlfaMin));
            }
        }
        return in_array($stexto, $lista);
    }

}
