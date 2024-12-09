<?php

include_once 'Conexao.php';
include_once '..\model\DTO\ImgImovelDTO.php';

class ImgImovelDAO
{
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function salvarImagensImovel(ImgImovelDTO $imgImovelDTO)
    {
        try {
            $sql = "INSERT INTO ImagensImovel (id_imovel, nomeImagem) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);

            $id_imovel = $imgImovelDTO->getIdImovel();
            $nomeImagem = $imgImovelDTO->getNomeImagem();

            $stmt->bindValue(1, $id_imovel);
            $stmt->bindValue(2, $nomeImagem);
            $stmt->execute();
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function excluirImagensImovel($id_imovel)
    {
        try {
            $sql = "DELETE FROM imagensImovel WHERE id_imovel= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_imovel);

            $retorno = $stmt->execute();

            return $retorno;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function buscarImagensPorImovel($id_imovel)
    {
        try {
            $sql = "SELECT nomeImagem FROM imagensImovel WHERE id_imovel = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_imovel);
            $stmt->execute();

            // Retorna todas as imagens associadas ao imóvel
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exe) {
            echo $exe->getMessage();
            return [];
        }
    }


    public function alterarImagensImovel($id_imovel, array $nomesImagens)
    {
        try {
            $sql = "UPDATE imagensImovel SET nomeImagem = ? WHERE id_imovel = ?";
    
            $stmt = $this->pdo->prepare($sql);
    
            foreach ($nomesImagens as $nomeImagem) {
                $stmt->bindValue(1, $nomeImagem);
                $stmt->bindValue(2, $id_imovel);
                $stmt->execute();
            }
    
            return true;
        } catch (PDOException $exe) {
            echo "Erro ao atualizar as imagens: " . $exe->getMessage();
            return false;
        }
    }
    
}