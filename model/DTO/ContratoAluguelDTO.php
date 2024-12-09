<?php

class ContratoAluguelDTO
{
    private $id_contAlug;
    private $dataContAlug;
    private $nomeContAlug;
    private $Usuario_id_usuario;

    public function setIdContratoAluguel($id_contAlug)
    {
        $this->id_contAlug = $id_contAlug;
    }
    public function getIdContratoAluguel()
    {
        return $this->id_contAlug;
    }


    public function setDataContAlug($dataContAlug)
    {
        $this->dataContAlug = $dataContAlug;
    }
    public function getDataContAlug()
    {
        return $this->dataContAlug;
    }


    public function setNomeContAlug($nomeContAlug)
    {
        $this->nomeContAlug = $nomeContAlug;
    }
    public function getNomeContAlug()
    {
        return $this->nomeContAlug;
    }


    public function setIdUsuario($Usuario_id_usuario)
    {
        $this->Usuario_id_usuario = $Usuario_id_usuario;
    }
    public function getIdUsuario()
    {
        return $this->Usuario_id_usuario;
    }
}