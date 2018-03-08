<?php

namespace CDC\Loja\RH;

use CDC\Loja\RH\Funcionario;

class CalculadoraDeSalarios
{
    public function calculaSalario(Funcionario $funcionario)
    {
        //Desenvolvedores
        if($funcionario->getCargo() === TabelaCargos::DESENVOLVEDOR)
            return $this->dezOuVintePorCentoDeDesconto($funcionario);
        //DBA e TESTADOSR
        else if(
            $funcionario->getCargo() === TabelaCargos::DBA ||
            $funcionario->getCargo() === TabelaCargos::TESTADOR
        ) 
            return $this->quinzeOuVinteECincoPorCento($funcionario);

        throw new Exception("Tipo de funcionario inválido");
        
    }

    private function dezOuVintePorCentoDeDesconto($funcionario)
    {
        if($funcionario->getSalario() > 3000)
            return $funcionario->getSalario() * 0.8;

        return $funcionario->getSalario() * 0.9;
    }

    private function quinzeOuVinteECincoPorCento($funcionario)
    {
        if($funcionario->getSalario() < 2500)
            return $funcionario->getSalario() * 0.85;

        return $funcionario->getSalario() * 0.75;
    }
}