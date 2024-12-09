<?php

include_once 'Conexao.php';
include_once '..\model\DTO\EnderecoDTO.php';

class EnderecoDAO
{
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }
    public function salvarEndereco(EnderecoDTO $enderecoDTO)
    {
        try {
            $sql = "INSERT INTO endereco (cep, estado, cidade, bairro, rua, casa, referencia)VALUES ( ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            $cep = $enderecoDTO->getCep();
            $estado = $enderecoDTO->getEstado();
            $cidade = $enderecoDTO->getCidade();
            $bairro = $enderecoDTO->getBairro();
            $rua = $enderecoDTO->getRua();
            $casa = $enderecoDTO->getCasa();
            $referencia = $enderecoDTO->getReferencia();

            $stmt->bindValue(1, $cep);
            $stmt->bindValue(2, $estado);
            $stmt->bindValue(3, $cidade);
            $stmt->bindValue(4, $bairro);
            $stmt->bindValue(5, $rua);
            $stmt->bindValue(6, $casa);
            $stmt->bindValue(7, $referencia);

            $retorno = $stmt->execute();

            if ($retorno) {
                $id_gerado = $this->pdo->lastInsertId();
                return $id_gerado;
            } else {
                return $retorno;
            }
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function listarEndereco()
    {
        try {
            $sql = "SELECT * FROM endereco";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute();

            $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $retorno;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }


    public function excluirEndereco($id_endereco)
    {
        try {
            $sql = "DELETE FROM endereco WHERE id_endereco= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_endereco);

            $retorno = $stmt->execute();

            return $retorno;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }


    public function buscarEnderecoPorId($id_endereco)
    {
        try {
            $sql = "SELECT * FROM endereco WHERE id_endereco = :id_endereco";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);
            $stmt->execute();

            $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
            return $retorno;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }


    public function alterarEndereco(EnderecoDTO $enderecoDTO)
    {
        try {
            $sql = "UPDATE Endereco SET cep=?, estado=?, cidade=?, bairro=?, rua=?, casa=?, referencia=? WHERE id_endereco=?";
            $stmt = $this->pdo->prepare($sql);

            $cep = $enderecoDTO->getCep();
            $estado = $enderecoDTO->getEstado();
            $cidade = $enderecoDTO->getCidade();
            $bairro = $enderecoDTO->getBairro();
            $rua = $enderecoDTO->getRua();
            $casa = $enderecoDTO->getCasa();
            $referencia = $enderecoDTO->getReferencia();
            $id_endereco = $enderecoDTO->getIdEndereco();

            $stmt->bindValue(1, $cep);
            $stmt->bindValue(2, $estado);
            $stmt->bindValue(3, $cidade);
            $stmt->bindValue(4, $bairro);
            $stmt->bindValue(5, $rua);
            $stmt->bindValue(6, $casa);
            $stmt->bindValue(7, $referencia);
            $stmt->bindValue(8, $id_endereco);

            $retorno = $stmt->execute();
            return $retorno;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }
}