<?php

class UsuarioDTO
{
    private $nome;
    private $dataNasc;
    private $cpf;
    private $cnpj;
    private $Id_usuario;
    private $telefone;
    private $email;
    private $senha;
    private $tipoUsuario;
    private $imgUsuario;


    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }


    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;
    }
    public function getDataNasc()
    {
        return $this->dataNasc;
    }


    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
    public function getCpf()
    {
        return $this->cpf;
    }


    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }
    public function getCnpj()
    {
        return $this->cnpj;
    }



    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }


    public function setIdUsuario($Id_usuario)
    {
        $this->Id_usuario = $Id_usuario;
    }
    public function getIdUsuario()
    {
        return $this->Id_usuario;
    }


    public function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }
    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    public function setImgUsuario($imgUsuario)
    {
        $this->imgUsuario = $imgUsuario;
    }
    public function getImgUsuario()
    {
        return $this->imgUsuario;
    }
}
