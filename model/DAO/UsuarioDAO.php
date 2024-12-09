    <?php

    include_once 'Conexao.php';
    include_once '../model/DTO/ImovelDTO.php';

    class UsuarioDAO
    {

        public $pdo = null;

        public function __construct()
        {
            $this->pdo = Conexao::getInstance();
        }
        public function salvarUsuario(UsuarioDTO $usuarioDTO)
        {
            try {
                $sql = "INSERT INTO usuario (nome, dataNasc, cpf, telefone, email, senha, tipoUsuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->pdo->prepare($sql);

                $nome = $usuarioDTO->getNome();
                $dataNasc = $usuarioDTO->getDataNasc();
                $cpf = $usuarioDTO->getCpf();
                $telefone = $usuarioDTO->getTelefone();
                $email = $usuarioDTO->getEmail();
                $senha = $usuarioDTO->getSenha();
                $tipoUsuario = $usuarioDTO->getTipoUsuario();

                $stmt->bindValue(1, $nome);
                $stmt->bindValue(2, $dataNasc);
                $stmt->bindValue(3, $cpf);
                $stmt->bindValue(4, $telefone);
                $stmt->bindValue(5, $email);
                $stmt->bindValue(6, $senha);
                $stmt->bindValue(7, $tipoUsuario);

                if ($stmt->execute()) {
                    return $this->pdo->lastInsertId();
                } else {
                    return false;
                }
            } catch (PDOException $exe) {
                echo $exe->getMessage();
            }
        }

        public function listarUsuarios()
        {
            try {
                $sql = "SELECT * FROM usuario";
                $stmt = $this->pdo->prepare($sql);

                $stmt->execute();

                $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return $retorno;
            } catch (PDOException $exe) {
                echo $exe->getMessage();
            }
        }


        public function excluirUsuario($id_usuario)
        {
            try {
                // Verificar se o usuário possui imóveis associados
                $sql = "SELECT * FROM imovel WHERE id_proprietario = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(1, $id_usuario);
                $stmt->execute();
                $count = $stmt->fetchColumn();

                if ($count > 0) {
                    // Se o usuário tiver imóveis associados, retornar um erro
                    return 'O usuário não pode ser excluído, pois possui imóveis cadastrados    .';
                }

                // Se o usuário não possui imóveis, proceder com a exclusão
                $sql = "DELETE FROM usuario WHERE id_usuario = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(1, $id_usuario);
                $stmt->execute();

                return true; // Exclusão bem-sucedida
            } catch (PDOException $exe) {
                echo $exe->getMessage();
                return false;
            }
        }



        public function buscarUsuarioPorId($id_usuario)
        {
            try {
                $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario;";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();

                // Retorna os dados do usuário cujo id foi buscado
                $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
                return $retorno;
            } catch (PDOException $exe) {
                echo $exe->getMessage();
            }
        }



        public function alterarUsuario(UsuarioDTO $usuarioDTO)
        {
            try {
                $sql = "UPDATE usuario SET nome=?, dataNasc=?, cpf=?, telefone=?, email=?, senha=?, tipoUsuario=? WHERE id_usuario=?";
                $stmt = $this->pdo->prepare($sql);

                $nome = $usuarioDTO->getNome();
                $dataNasc = $usuarioDTO->getDataNasc();
                $cpf = $usuarioDTO->getCpf();
                $telefone = $usuarioDTO->getTelefone();
                $email = $usuarioDTO->getEmail();
                $senha = $usuarioDTO->getSenha();
                $tipoUsuario = $usuarioDTO->getTipoUsuario();
                $id_usuario = $usuarioDTO->getIdUsuario();

                $stmt->bindValue(1, $nome);
                $stmt->bindValue(2, $dataNasc);
                $stmt->bindValue(3, $cpf);
                $stmt->bindValue(4, $telefone);
                $stmt->bindValue(5, $email);
                $stmt->bindValue(6, $senha);
                $stmt->bindValue(7, $tipoUsuario);
                $stmt->bindValue(8, $id_usuario);

                $retorno = $stmt->execute();
                return $retorno;
            } catch (PDOException $exe) {
                echo $exe->getMessage();
            }
        }

        public function validarLogin($cpf, $senha)
        {
            try {
                $sql = "SELECT * FROM Usuario WHERE cpf = '{$cpf}' AND senha = '{$senha}';";
                $stmt = $this->pdo->prepare($sql);

                $stmt->execute();
                $retorno = $stmt->fetch(PDO::FETCH_ASSOC);

                return $retorno;
            } catch (PDOException $exe) {
                echo $exe->getMessage();
            }
        }


        public function atualizarImagemPerfil($id_usuario, $nomeImagem)
        {
            try {
                $sql = "UPDATE usuario SET imgUsuario = ? WHERE id_usuario = ?";
                $stmt = $this->pdo->prepare($sql);

                $stmt->bindValue(1, $nomeImagem);
                $stmt->bindValue(2, $id_usuario);

                $retorno = $stmt->execute();
                return $retorno;
            } catch (PDOException $exe) {
                echo $exe->getMessage();
            }
        }
        public function buscarImagemPerfil($id_usuario)
        {
            try {
                // Consulta SQL para buscar o nome da imagem de perfil do usuário
                $sql = "SELECT imgUsuario FROM usuario WHERE id_usuario = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(1, $id_usuario);
                $stmt->execute();

                // Retorna o nome da imagem, ou um valor padrão se não houver imagem
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    return $resultado['imgUsuario'];
                } else {
                    return null; // Se não encontrar o usuário ou a imagem
                }
            } catch (PDOException $exe) {
                echo $exe->getMessage();
            }
        }
    }