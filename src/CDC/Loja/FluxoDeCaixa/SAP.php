<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\FluxoDeCaixa\NotaFiscal;

class SAP implements AcaoAposGerarNotaInterface
{
    public function executa(NotaFiscal $nf)
    {
        //Persiste NF
    }
}