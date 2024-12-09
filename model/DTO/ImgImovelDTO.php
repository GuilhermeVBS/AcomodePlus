<?php

class ImgImovelDTO
{
    private $id_imovel;
    private $id_imagem;
    private $nomeImagem;


    public function setIdImovel($id_imovel)
    {
        $this->id_imovel = $id_imovel;
    }
    public function getIdImovel()
    {
        return $this->id_imovel;
    }


    public function setIdImagem($id_imagem)
    {
        $this->id_imagem = $id_imagem;
    }
    public function getIdImagem()
    {
        return $this->id_imagem;
    }


    public function setNomeImagem($nomeImagem)
    {
        $this->nomeImagem = $nomeImagem;
    }
    public function getNomeImagem()
    {
        return $this->nomeImagem;
    }
}