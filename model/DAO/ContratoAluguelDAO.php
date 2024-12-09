<?php

include_once 'Conexao.php';
include_once '..\model\DTO\ContratoAluguelDTO.php';

class ContratoAluguelDAO
{
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }
    public function salvarContratoAluguel(ContratoAluguelDTO $contratoAlugDTO)
    {
        try {
            $sql = "INSERT INTO contratoAluguel (dataContAlug, Usuario_id_usuario, nomeContAlug) 
                    VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(1, $contratoAlugDTO->getDataContAlug());
            $stmt->bindValue(2, $contratoAlugDTO->getIdUsuario());
            $stmt->bindValue(3, $contratoAlugDTO->getNomeContAlug());

            if ($stmt->execute()) {
                // Retorna o ID do último registro inserido
                return $this->pdo->lastInsertId();
            } else {
                // Exibe uma mensagem de erro se o insert falhar
                echo "Erro ao salvar o contrato.";
                return false;
            }
        } catch (PDOException $exe) {
            // Exibe detalhes do erro
            echo "Erro ao salvar o contrato: " . $exe->getMessage();
            return false;
        }
    }

    public function buscarContratoAluguelPorUsuario($id_usuario)
    {
        try {
            $sql = "SELECT * FROM contratoaluguel WHERE Usuario_id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->execute();

            // Retorna todas as imagens associadas ao imóvel
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exe) {
            echo $exe->getMessage();
            return [];
        }
    }
}