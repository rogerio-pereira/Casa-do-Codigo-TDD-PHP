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
        $ultimoVizinhoDaDireita = 0;

        for($i=strlen($numeroEmRomano) - 1; $i >= 0; $i--){
            //Pega o inteiro referente ao simbolo atual
            $numeroAtual = 0;
            $simboloAtual = $numeroEmRomano[$i];

            if(array_key_exists($simboloAtual, $this->tabela))
                $numeroAtual = $this->tabela[$simboloAtual];


            //Se o da direita for menor, multiplicaremos por -1 para se tornar negativo
            $multiplicador = 1;
            if($numeroAtual < $ultimoVizinhoDaDireita)
                $multiplicador = -1;

            $acumulador += $numeroAtual * $multiplicador;

            //Atualiza Vizinho da Direita
            $ultimoVizinhoDaDireita = $numeroAtual;
        }

        return $acumulador;
    }
}