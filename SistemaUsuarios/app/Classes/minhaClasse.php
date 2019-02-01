<?php

namespace App\Classes;


class minhaclasse
{

    public static function criarCodigo()
    {
        //criar um codígo aleatório (senha) com 10 caracteres


            $index = rand (99999, 999990);
            $valor = $index;

        return $valor;

    }

}
