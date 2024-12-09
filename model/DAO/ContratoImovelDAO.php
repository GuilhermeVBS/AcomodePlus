<?php

include_once 'Conexao.php';
include_once '../model/DTO/ContratoImovelDTO.php';

class ContratoImovelDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function salvarContratoImovel(ContratoImovelDTO $contratoImovDTO)
    {
        try {
            $sql = "INSERT INTO contratoImovel (dataContImov, Usuario_id_usuario, Imovel_id_imovel, nomeContImov) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(1, $contratoImovDTO->getDataContImov());
            $stmt->bindValue(2, $contratoImovDTO->getIdUsuario());
            $stmt->bindValue(3, $contratoImovDTO->getIdImovel());
            $stmt->bindValue(4, $contratoImovDTO->getNomeContImov());

            if ($stmt->execute()) {
                // Retorna o ID do contrato recém-inserido
                return $this->pdo->lastInsertId();
            } else {
                return false; // Retorna false em caso de falha
            }
        } catch (PDOException $exe) {
            // Log de erro (opcional) e retorno para controle de exceções
            error_log("Erro ao salvar contrato de imóvel: " . $exe->getMessage());
            return false; // Retorna false em caso de exceção
        }
    }
    public function buscarContratoImovelPorId($id_contImov)
    {
        try {
            $sql = "SELECT * FROM contratoImovel WHERE id_contImov = :id_contImov;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_contImov', $id_contImov, PDO::PARAM_INT);
            $stmt->execute();
    
            // Retorna os dados do contrato ou false se não encontrado
            $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($retorno) {
                return $retorno;
            } else {
                return false;  // Retorna false caso não encontre o contrato
            }
        } catch (PDOException $exe) {
            echo $exe->getMessage();
            return false;
        }
    }

    public function buscarContImovPorIdImovel($id_imovel)
    {
        try {
            $sql = "SELECT * FROM contratoImovel WHERE Imovel_id_imovel = :id_imovel";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_imovel', $id_imovel,PDO::PARAM_INT);
            $stmt->execute();
    
            // Retorna os dados do contrato ou false se não encontrado
            $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($retorno) {
                return $retorno;
            } else {
                return false;  // Retorna false caso não encontre o contrato
            }
        } catch (PDOException $exe) {
            echo $exe->getMessage();
            return false;
        }
    }
    
    public function excluirContratoImovel($id_imovel)
    {
        try {
            $sql = "DELETE FROM contratoImovel WHERE Imovel_id_imovel = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_imovel);

            $retorno = $stmt->execute();

            return $retorno;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

}