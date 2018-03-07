<?php

namespace CDC\Exemplos;

class ConversorDeNumeroRomano
{
    protected $tabela = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000,
    ];

    public function converte($numeroEmRomano)
    {
        $acumulador = 0;

        for($i=0; $i<strlen($numeroEmRomano); $i++){
            $numeroAtual = $numeroEmRomano[$i];

            if(array_key_exists($numeroAtual, $this->tabela))
                $acumulador += $this->tabela[$numeroAtual];
        }

        return $acumulador;
    }
}