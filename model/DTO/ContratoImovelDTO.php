<?php

class ContratoImovelDTO
{
    private $id_contImov;
    private $dataContImov;
    private $nomeContImov;
    private $id_proprietario;
    private $id_imovel;

    public function setIdContratoImovel($id_contImov)
    {
        $this->id_contImov = $id_contImov;
    }
    public function getIdContratoImovel()
    {
        return $this->id_contImov;
    }


    public function setDataContImov($dataContImov)
    {
        $this->dataContImov = $dataContImov;
    }
    public function getDataContImov()
    {
        return $this->dataContImov;
    }


    public function setNomeContImov($nomeContImov)
    {
        $this->nomeContImov = $nomeContImov;
    }
    public function getNomeContImov()
    {
        return $this->nomeContImov;
    }


    public function setIdUsuario($id_proprietario)
    {
        $this->id_proprietario = $id_proprietario;
    }
    public function getIdUsuario()
    {
        return $this->id_proprietario;
    }

    public function setIdImovel($id_imovel)
    {
        $this->id_imovel = $id_imovel;
    }
    public function getIdImovel()
    {
        return $this->id_imovel;
    }
}