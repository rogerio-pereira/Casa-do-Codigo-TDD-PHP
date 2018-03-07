<?php

namespace CDC\Loja\RH;

use CDC\Loja\RH\Funcionario;

class CalculadoraDeSalarios
{
    public function calculaSalario(Funcionario $funcionario)
    {
        //Desenvolvedores
        if($funcionario->getCargo() === TabelaCargos::DESENVOLVEDOR) {
            if($funcionario->getSalario() > 3000)
                return $funcionario->getSalario() * 0.8;

            return $funcionario->getSalario() * 0.9;
        }
        //DBA
        else if($funcionario->getCargo() === TabelaCargos::DBA) {
            if($funcionario->getSalario() > 2500)
                return $funcionario->getSalario() * 0.75;

            return $funcionario->getSalario() * 0.85;
        }
    }
}