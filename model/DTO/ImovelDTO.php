<?php

class ImovelDTO
{
    private $id_imovel;
    private $areaImovel;
    private $descricaoImovel;
    private $precoImovel;
    private $titulo;
    private $subtitulo;
    private $situacao;
    private $id_endereco;
    private $id_proprietario;
    private $email;
    private $telefone;


    public function setIdImovel($id_imovel)
    {
        $this->id_imovel = $id_imovel;
    }
    public function getIdImovel()
    {
        return $this->id_imovel;
    }


    public function setAreaImovel($areaImovel)
    {
        $this->areaImovel = $areaImovel;
    }
    public function getAreaImovel()
    {
        return $this->areaImovel;
    }

    public function setDescricaoImovel($descricaoImovel)
    {
        $this->descricaoImovel = $descricaoImovel;
    }
    public function getDescricaoImovel()
    {
        return $this->descricaoImovel;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = $subtitulo;
    }
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }


    public function setPrecoImovel($precoImovel)
    {
        $this->precoImovel = $precoImovel;
    }
    public function getPrecoImovel()
    {
        return $this->precoImovel;
    }

    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }
    public function getSituacao()
    {
        return $this->situacao;
    }


    public function setEnderecoId($id_endereco)
    {
        $this->id_endereco = $id_endereco;
    }
    public function getEnderecoId()
    {
        return $this->id_endereco;
    }


    public function setIdproprietario($id_proprietario)
    {
        $this->id_proprietario = $id_proprietario;
    }
    public function getIdproprietario()
    {
        return $this->id_proprietario;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }


    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
}