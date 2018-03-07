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
        'm' => 1000,
    ];

    public function converte($numeroEmRomano)
    {
        if(array_key_exists($numeroEmRomano, $this->tabela))
            return $this->tabela[$numeroEmRomano];

        return 0;
    }
}