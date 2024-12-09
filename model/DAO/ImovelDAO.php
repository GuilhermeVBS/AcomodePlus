<?php

include_once 'Conexao.php';
include_once '../model/DTO/ImovelDTO.php';

class ImovelDAO
{
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function salvarImovel(ImovelDTO $imovelDTO)
    {
        try {
            $sql = "INSERT INTO Imovel (areaImovel, descricaoImovel, precoImovel, titulo, subtitulo, Endereco_id_endereco, id_proprietario, email, telefone) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(1, $imovelDTO->getAreaImovel());
            $stmt->bindValue(2, $imovelDTO->getDescricaoImovel());
            $stmt->bindValue(3, $imovelDTO->getPrecoImovel());
            $stmt->bindValue(4, $imovelDTO->getTitulo());
            $stmt->bindValue(5, $imovelDTO->getSubtitulo());
            $stmt->bindValue(6, $imovelDTO->getEnderecoId());
            $stmt->bindValue(7, $imovelDTO->getIdProprietario());
            $stmt->bindValue(8, $imovelDTO->getEmail());
            $stmt->bindValue(9, $imovelDTO->getTelefone());

            $stmt->execute();

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function excluirImovel($id_imovel)
    {
        try {
            $sql = "DELETE FROM imovel WHERE id_imovel= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_imovel);

            $retorno = $stmt->execute();

            return $retorno;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }


    public function alterarImovel(ImovelDTO $imovelDTO)
    {
        try {
            $sql = "UPDATE Imovel SET  areaImovel=?, descricaoImovel=?, precoImovel=?, titulo=?, subtitulo=?, situacao=? WHERE id_imovel=?";
            $stmt = $this->pdo->prepare($sql);

            $areaImovel = $imovelDTO->getAreaImovel();
            $descricaoImovel = $imovelDTO->getDescricaoImovel();
            $precoImovel = $imovelDTO->getPrecoImovel();
            $titulo = $imovelDTO->getTitulo();
            $subtitulo = $imovelDTO->getSubtitulo();
            $situacao = $imovelDTO->getSituacao();
            $id_imovel = $imovelDTO->getIdImovel();

            $stmt->bindValue(1, $areaImovel);
            $stmt->bindValue(2, $descricaoImovel);
            $stmt->bindValue(3, $precoImovel);
            $stmt->bindValue(4, $titulo);
            $stmt->bindValue(5, $subtitulo);
            $stmt->bindValue(6, 'pendente');
            $stmt->bindValue(7, $id_imovel);

            $retorno = $stmt->execute();
            return $retorno;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function controlarImoveis()
    {
        try {
            $sql = "SELECT im.id_imovel, im.areaImovel, im.descricaoImovel, im.precoImovel, im.titulo, im.subtitulo, im.id_proprietario, img.nomeImagem, e.estado, e.rua, e.cep, e.id_endereco 
                    FROM imovel im 
                    LEFT JOIN imagensImovel img ON im.id_imovel = img.id_imovel 
                    LEFT JOIN endereco e ON im.Endereco_id_endereco = e.id_endereco 
                    WHERE situacao = 'pendente'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $imoveis = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_imovel = $row['id_imovel'];

                if (!isset($imoveis[$id_imovel])) {
                    $imoveis[$id_imovel] = [
                        'id_imovel' => $id_imovel,
                        'areaImovel' => $row['areaImovel'],
                        'descricaoImovel' => $row['descricaoImovel'],
                        'precoImovel' => $row['precoImovel'],
                        'titulo' => $row['titulo'],
                        'subtitulo' => $row['subtitulo'],
                        'id_proprietario' => $row['id_proprietario'],
                        'cep' => $row['cep'],
                        'estado' => $row['estado'],
                        'rua' => $row['rua'],
                        'id_endereco' => $row['id_endereco'],
                        'imagens' => []
                    ];
                }

                if (!empty($row['nomeImagem'])) {
                    $imoveis[$id_imovel]['imagens'][] = $row['nomeImagem'];
                }
            }

            return $imoveis;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function listarImoveis()
    {
        try {
            $sql = "SELECT im.id_imovel, im.areaImovel, im.descricaoImovel, im.precoImovel, im.titulo, im.subtitulo, im.id_proprietario, im.situacao, im.disponibilidade, img.nomeImagem, e.estado, e.rua, e.cep, e.id_endereco, ci.id_contImov, ci.nomeContImov
                    FROM imovel im 
                    LEFT JOIN imagensImovel img ON im.id_imovel = img.id_imovel 
                    LEFT JOIN endereco e ON im.Endereco_id_endereco = e.id_endereco
                    LEFT JOIN contratoImovel ci ON im.id_imovel = ci.Imovel_id_imovel";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $imoveis = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_imovel = $row['id_imovel'];

                if (!isset($imoveis[$id_imovel])) {
                    $imoveis[$id_imovel] = [
                        'id_imovel' => $id_imovel,
                        'areaImovel' => $row['areaImovel'],
                        'descricaoImovel' => $row['descricaoImovel'],
                        'precoImovel' => $row['precoImovel'],
                        'titulo' => $row['titulo'],
                        'subtitulo' => $row['subtitulo'],
                        'id_proprietario' => $row['id_proprietario'],
                        'situacao' => $row['situacao'],
                        'disponibilidade' => $row['disponibilidade'],
                        'cep' => $row['cep'],
                        'estado' => $row['estado'],
                        'rua' => $row['rua'],
                        'id_endereco' => $row['id_endereco'],
                        'id_contImov' => $row['id_contImov'],
                        'nomeContImov' => $row['nomeContImov'],
                        'imagens' => []
                    ];
                }

                if (!empty($row['nomeImagem'])) {
                    $imoveis[$id_imovel]['imagens'][] = $row['nomeImagem'];
                }
            }

            return $imoveis;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function imoveisAprovados()
    {
        try {
            $sql = "SELECT im.id_imovel, im.areaImovel, im.descricaoImovel, im.precoImovel, im.titulo, im.subtitulo, im.id_proprietario, img.nomeImagem, e.estado, e.rua, e.cep, e.id_endereco 
                    FROM imovel im 
                    LEFT JOIN imagensImovel img ON im.id_imovel = img.id_imovel 
                    LEFT JOIN endereco e ON im.Endereco_id_endereco = e.id_endereco
                    WHERE situacao = 'aprovado' AND disponibilidade = 'disponivel'
                      ORDER BY im.id_imovel DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $imoveis = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_imovel = $row['id_imovel'];

                if (!isset($imoveis[$id_imovel])) {
                    $imoveis[$id_imovel] = [
                        'id_imovel' => $id_imovel,
                        'areaImovel' => $row['areaImovel'],
                        'descricaoImovel' => $row['descricaoImovel'],
                        'precoImovel' => $row['precoImovel'],
                        'titulo' => $row['titulo'],
                        'subtitulo' => $row['subtitulo'],
                        'id_proprietario' => $row['id_proprietario'],
                        'cep' => $row['cep'],
                        'estado' => $row['estado'],
                        'rua' => $row['rua'],
                        'id_endereco' => $row['id_endereco'],
                        'imagens' => []
                    ];
                }

                if (!empty($row['nomeImagem'])) {
                    $imoveis[$id_imovel]['imagens'][] = $row['nomeImagem'];
                }
            }

            return $imoveis;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }


    public function imoveisRejeitados()
    {
        try {
            $sql = "SELECT im.id_imovel, im.areaImovel, im.descricaoImovel, im.precoImovel, im.titulo, im.subtitulo, im.id_proprietario, img.nomeImagem, e.estado, e.rua, e.cep, e.id_endereco 
                    FROM imovel im 
                    LEFT JOIN imagensImovel img ON im.id_imovel = img.id_imovel 
                    LEFT JOIN endereco e ON im.Endereco_id_endereco = e.id_endereco
                    WHERE situacao = 'rejeitado'
                      ORDER BY im.id_imovel DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $imoveis = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_imovel = $row['id_imovel'];

                if (!isset($imoveis[$id_imovel])) {
                    $imoveis[$id_imovel] = [
                        'id_imovel' => $id_imovel,
                        'areaImovel' => $row['areaImovel'],
                        'descricaoImovel' => $row['descricaoImovel'],
                        'precoImovel' => $row['precoImovel'],
                        'titulo' => $row['titulo'],
                        'subtitulo' => $row['subtitulo'],
                        'id_proprietario' => $row['id_proprietario'],
                        'cep' => $row['cep'],
                        'estado' => $row['estado'],
                        'rua' => $row['rua'],
                        'id_endereco' => $row['id_endereco'],
                        'imagens' => []
                    ];
                }

                if (!empty($row['nomeImagem'])) {
                    $imoveis[$id_imovel]['imagens'][] = $row['nomeImagem'];
                }
            }

            return $imoveis;
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }


    public function buscarImovelPorId($id_imovel)
    {
        try {
            $sql = "SELECT im.id_imovel, im.areaImovel, im.descricaoImovel, im.precoImovel, im.titulo, im.subtitulo, im.id_proprietario, im.email, im.telefone, im.situacao,im.disponibilidade, img.nomeImagem
                FROM imovel im 
                LEFT JOIN imagensImovel img ON im.id_imovel = img.id_imovel 
                WHERE im.id_imovel = :id_imovel ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id_imovel', $id_imovel, PDO::PARAM_INT);
            $stmt->execute();

            $imovel = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                if (empty($imovel)) {
                    $imovel = [
                        'id_imovel' => $row['id_imovel'],
                        'areaImovel' => $row['areaImovel'],
                        'descricaoImovel' => $row['descricaoImovel'],
                        'precoImovel' => $row['precoImovel'],
                        'titulo' => $row['titulo'],
                        'subtitulo' => $row['subtitulo'],
                        'id_proprietario' => $row['id_proprietario'],
                        'email' => $row['email'],
                        'telefone' => $row['telefone'],
                        'situacao' => $row['situacao'],
                        'disponibilidade' => $row['disponibilidade'],
                        'imagens' => []
                    ];
                }

                // Adiciona cada imagem ao array 'imagens'
                if (!empty($row['nomeImagem'])) {
                    $imovel['imagens'][] = $row['nomeImagem'];
                }
            }

            return $imovel;
        } catch (PDOException $e) {
            echo "Erro ao pesquisar imóvel: " . $e->getMessage();
            return null;
        }
    }


    public function pesquisarImoveis($filtros)
    {
        try {
            $condicoes = ["im.situacao = 'aprovado'"];
            $parametros = [];

            if (!empty($filtros['estado'])) {
                $condicoes[] = "e.estado = :estado";
                $parametros[':estado'] = $filtros['estado'];
            }
            if (!empty($filtros['precoMaximo'])) {
                $condicoes[] = "im.precoImovel <= :precoMaximo";
                $parametros[':precoMaximo'] = $filtros['precoMaximo'];
            }
            if (!empty($filtros['bairro'])) {
                $condicoes[] = "e.bairro = :bairro";
                $parametros[':bairro'] = $filtros['bairro'];
            }
            if (!empty($filtros['cidade'])) {
                $condicoes[] = "e.cidade = :cidade";
                $parametros[':cidade'] = $filtros['cidade'];
            }
            // Adicione mais condições conforme necessário

            $sql = "SELECT im.id_imovel, im.areaImovel, im.descricaoImovel, im.precoImovel, im.titulo, im.subtitulo, im.id_proprietario, 
                       img.nomeImagem, e.estado, e.rua, e.cep, e.id_endereco, e.cidade, e.bairro
                FROM imovel im 
                LEFT JOIN imagensImovel img ON im.id_imovel = img.id_imovel 
                LEFT JOIN endereco e ON im.Endereco_id_endereco = e.id_endereco
                WHERE " . implode(' AND ', $condicoes);

            $stmt = $this->pdo->prepare($sql);

            foreach ($parametros as $param => $valor) {
                $stmt->bindValue($param, $valor, is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $stmt->execute();

            // Processa os resultados como antes
            $imoveis = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_imovel = $row['id_imovel'];

                if (!isset($imoveis[$id_imovel])) {
                    $imoveis[$id_imovel] = [
                        'id_imovel' => $id_imovel,
                        'areaImovel' => $row['areaImovel'],
                        'descricaoImovel' => $row['descricaoImovel'],
                        'precoImovel' => $row['precoImovel'],
                        'titulo' => $row['titulo'],
                        'subtitulo' => $row['subtitulo'],
                        'id_proprietario' => $row['id_proprietario'],
                        'cep' => $row['cep'],
                        'estado' => $row['estado'],
                        'rua' => $row['rua'],
                        'cidade' => $row['cidade'],
                        'bairro' => $row['bairro'],
                        'id_endereco' => $row['id_endereco'],
                        'imagens' => []
                    ];
                }

                if (!empty($row['nomeImagem'])) {
                    $imoveis[$id_imovel]['imagens'][] = $row['nomeImagem'];
                }
            }

            return $imoveis;
        } catch (PDOException $e) {
            error_log("Erro ao pesquisar imóveis: " . $e->getMessage());
            echo "Erro ao pesquisar imóveis.";
            return null;
        }
    }


    public function buscarImovelPorProprietario($id_proprietario)
    {
        try {
            $sql = "SELECT im.id_imovel, im.areaImovel, im.descricaoImovel, im.precoImovel, im.titulo, im.subtitulo, im.id_proprietario, im.situacao, e.estado, e.rua, e.cep, e.id_endereco, img.nomeImagem
            FROM imovel im 
            LEFT JOIN imagensImovel img ON im.id_imovel = img.id_imovel 
             LEFT JOIN endereco e ON im.Endereco_id_endereco = e.id_endereco
            WHERE im.id_proprietario = :id_proprietario
              ORDER BY im.id_imovel DESC";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id_proprietario', $id_proprietario, PDO::PARAM_INT);
            $stmt->execute();

            $imoveis = []; // Array para armazenar todos os imóveis

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                // Verifica se o imóvel já foi adicionado ao array, se não, cria um novo
                if (!isset($imoveis[$row['id_imovel']])) {
                    $imoveis[$row['id_imovel']] = [
                        'id_imovel' => $row['id_imovel'],
                        'areaImovel' => $row['areaImovel'],
                        'descricaoImovel' => $row['descricaoImovel'],
                        'precoImovel' => $row['precoImovel'],
                        'titulo' => $row['titulo'],
                        'subtitulo' => $row['subtitulo'],
                        'id_proprietario' => $row['id_proprietario'],
                        'cep' => $row['cep'],
                        'estado' => $row['estado'],
                        'rua' => $row['rua'],
                        'id_endereco' => $row['id_endereco'],
                        'situacao' => $row['situacao'],
                        'imagens' => []
                    ];
                }

                // Adiciona a imagem ao imóvel
                if (!empty($row['nomeImagem'])) {
                    $imoveis[$row['id_imovel']]['imagens'][] = $row['nomeImagem'];
                }
            }

            return array_values($imoveis); // Retorna um array com todos os imóveis

        } catch (PDOException $e) {
            echo "Erro ao pesquisar imóvel: " . $e->getMessage();
            return null;
        }
    }


    public function aprovarImovel($id_imovel)
    {
        try {
            $sql = "UPDATE imovel SET situacao = 'aprovado' WHERE id_imovel = :id_imovel";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('id_imovel', $id_imovel, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function rejeitarImovel($id_imovel)
    {
        try {
            $sql = "UPDATE imovel SET situacao = 'rejeitado' WHERE id_imovel = :id_imovel";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('id_imovel', $id_imovel, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function marcarImovelIndisponivel($id_imovel)
    {
        try {
            $sql = "UPDATE imovel SET disponibilidade = 'indisponivel' WHERE id_imovel = :id_imovel";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('id_imovel', $id_imovel, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $exe) {
            echo $exe->getMessage();
            return false;
        }
    }
}