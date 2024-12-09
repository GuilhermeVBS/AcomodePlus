<?php

include_once 'Conexao.php';
include_once '../model/DTO/PagamentoDTO.php';

class PagamentoDAO
{
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }
    public function salvarPagamento(PagamentoDTO $pagamentoDTO)
    {
        try {
            $sql = "INSERT INTO pagamento (dataPaga, valorPaga, tipoPaga, Imovel_id_imovel, Usuario_id_usuario, numCard, nomeCard, dataExpCard, codCard, ContratoAluguel_id_contAlug) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            $dataPaga = $pagamentoDTO->getDataPagamento();
            $valorPaga = $pagamentoDTO->getValorPagamento();
            $tipoPaga = $pagamentoDTO->getTipoPagamento();
            $id_imovel = $pagamentoDTO->getIdImovel();
            $id_usuario = $pagamentoDTO->getIdUsuario();
            $numCard = $pagamentoDTO->getNumCard();
            $nomeCard = $pagamentoDTO->getNomeCard();
            $dataExpCard = $pagamentoDTO->getDataExpCard();
            $codCard = $pagamentoDTO->getCodCard();
            $id_contAlug = $pagamentoDTO->getIdContratoAluguel();


            $stmt->bindValue(1, $dataPaga);
            $stmt->bindValue(2, $valorPaga);
            $stmt->bindValue(3, $tipoPaga);
            $stmt->bindValue(4, $id_imovel);
            $stmt->bindValue(5, $id_usuario);
            $stmt->bindValue(6, $numCard);
            $stmt->bindValue(7, $nomeCard);
            $stmt->bindValue(8, $dataExpCard);
            $stmt->bindValue(9, $codCard);
            $stmt->bindValue(10, $id_contAlug);


            $stmt->execute();

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    public function buscarPagamentoPorId($id_pagamento)
    {
        try {
            $sql = "SELECT * FROM pagamento WHERE id_pagamento = :id_pagamento;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_pagamento', $id_pagamento, PDO::PARAM_INT);
            $stmt->execute();

            // Retorna os dados do usuário cujo id foi buscado
            $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
            return $retorno;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function buscarPagamentoPorUsuario($id_usuario)
    {
        try {
            // Alterando a consulta para buscar pagamentos por id_usuario
            $sql = "SELECT * FROM pagamento WHERE Usuario_id_usuario = :id_usuario;";
            $stmt = $this->pdo->prepare($sql);

            // Bind do parâmetro id_usuario
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            // Retorna os dados dos pagamentos relacionados ao usuário
            // Se houver múltiplos pagamentos, isso retornará um array
            $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Verifica se encontrou algum pagamento
            if ($retorno) {
                return $retorno;
            } else {
                return null; // Retorna null se não houver pagamentos para o usuário
            }
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function verificarPagamentosPorImovel($id_imovel)
{
    $sql = "SELECT COUNT(*) AS total FROM pagamento WHERE Imovel_id_imovel = :id_imovel";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id_imovel', $id_imovel, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'] > 0;
}


public function excluirPagamentosPorImovel($id_imovel)
{
    $sql = "DELETE FROM pagamento WHERE Imovel_id_imovel = :id_imovel";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id_imovel', $id_imovel, PDO::PARAM_INT);
    return $stmt->execute();
}
}