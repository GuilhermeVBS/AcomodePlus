<?php

class PagamentoDTO
{
    private $id_pagamento;
    private $dataPaga;
    private $valorPaga;
    private $tipoPaga;
    private $Imovel_id_imovel;
    private $id_usuario;
    private $numCard;
    private $nomeCard;
    private $dataExpCard;
    private $codCard;
    private $id_contAlug;


    public function setIdPagamento($id_pagamento)
    {
        $this->id_pagamento = $id_pagamento;
    }
    public function getIdPagamento()
    {
        return $this->id_pagamento;
    }


    public function setDataPagamento($dataPaga)
    {
        $this->dataPaga = $dataPaga;
    }
    public function getDataPagamento()
    {
        return $this->dataPaga;
    }


    public function setValorPagamento($valorPaga)
    {
        $this->valorPaga = $valorPaga;
    }
    public function getValorPagamento()
    {
        return $this->valorPaga;
    }


    public function setTipoPagamento($tipoPaga)
    {
        $this->tipoPaga = $tipoPaga;
    }
    public function getTipoPagamento()
    {
        return $this->tipoPaga;
    }


    public function setIdImovel($Imovel_id_imovel)
    {
        $this->Imovel_id_imovel = $Imovel_id_imovel;
    }
    public function getIdImovel()
    {
        return $this->Imovel_id_imovel;
    }


    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }


    public function setNumCard($numCard)
    {
        $this->numCard = $numCard;
    }
    public function getNumCard()
    {
        return $this->numCard;
    }


    public function setNomeCard($nomeCard)
    {
        $this->nomeCard = $nomeCard;
    }
    public function getNomeCard()
    {
        return $this->nomeCard;
    }


    public function setDataExpCard($dataExpCard)
    {
        $this->dataExpCard = $dataExpCard;
    }
    public function getDataExpCard()
    {
        return $this->dataExpCard;
    }


    public function setCodCard($codCard)
    {
        $this->codCard = $codCard;
    }
    public function getCodCard()
    {
        return $this->codCard;
    }


    public function setIdContratoAluguel($id_contAlug)
    {
        $this->id_contAlug = $id_contAlug;
    }
    public function getIdContratoAluguel()
    {
        return $this->id_contAlug;
    }
}
