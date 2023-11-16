<?php
require_once 'conn.php';
require_once 'config_session.php';
class Noticia extends Conexao {
    protected $db;
    protected $noticia_name;
    protected $noticia_conteudo;
    protected $noticia_date;
    protected $noticia_photo;
    protected $id_noticia;

    function __construct()
    {
        parent::__construct();
    }

    function listarNoticia($id)
    {
        $dados = $this->db->query("SELECT * FROM noticia WHERE id_noticia = " . $id);
        $not = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $not;
    }

    function listarNoticiaUsuario($id)
    {
        $dados = $this->db->query("SELECT * FROM noticia WHERE id_usuario = " . $id);
        $not = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $not;
    }

    function noticiasRecentes($id)
    {
        $dados = $this->db->query("SELECT * FROM noticia WHERE id_usuario = " . $id . " ORDER BY dt_noticia DESC LIMIT 3");
        $not = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $not;
    }


    function cadastroNoticia($noticiaName, $conteudo, $urlImagem, $noticiaDate, $idUsuario)
    {
        try {
            $this->noticia_name = trim($noticiaName);
            $this->noticia_conteudo = trim($conteudo);
            $this->noticia_date = date("Y-m-d", strtotime(trim($noticiaDate)));
            $this->noticia_photo = trim($urlImagem);

            if (!empty($this->noticia_name) && !empty($this->noticia_conteudo) && !empty($this->noticia_photo) && !empty($this->noticia_date)) {
                $check_name = $this->db->prepare("SELECT * FROM noticia WHERE nm_titulo = ?  AND id_usuario = " . $idUsuario);
                $check_name->execute([$this->noticia_name]);
                if ($check_name->rowCount() > 0) {
                    return ['errorMessage' => 'Este título já está registrado. Tente outro.'];
                } else {
                    $sql = "INSERT INTO noticia (nm_titulo, ds_conteudo, im_capa_url, dt_noticia, id_usuario) VALUES(:noticiaName, :conteudo, :urlImagem, :noticiaDate, :idUsuario)";
                    $sign_up_stmt = $this->db->prepare($sql);
                    //BIND VALUES
                    $sign_up_stmt->bindValue(':noticiaName', htmlspecialchars($this->noticia_name), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':conteudo', htmlspecialchars($this->noticia_conteudo), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':urlImagem', htmlspecialchars($this->noticia_photo), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':noticiaDate', htmlspecialchars($this->noticia_date), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':idUsuario', htmlspecialchars($idUsuario), PDO::PARAM_STR);
                    $sign_up_stmt->execute();

                    return ['successMessage' => 'Notícia cadastrado com sucesso.'];
                }
            } else {
                return ['errorMessage' => 'Preencha todos os campos.'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    function atualizarNoticia($noticiaID, $noticiaName, $conteudo, $urlImagem, $dataNoticia, $userId)
    {
        try {
            // Verifica se o ID da noticia é válido
            $id = intval($noticiaID);
            if ($id <= 0) {
                return ['errorMessage' => 'ID de noticia inválido'];
            }

            $this->noticia_name = trim($noticiaName);
            $this->noticia_conteudo = trim($conteudo);
            $this->noticia_date = date("Y-m-d", strtotime(trim($dataNoticia)));
            $this->id_noticia = trim($noticiaID);
            $this->noticia_photo = trim($urlImagem);

            if (!empty($this->noticia_name) && !empty($this->noticia_conteudo) && !empty($this->noticia_date)) {
                // Verifica se a noticia existe
                $find_noticia = $this->db->prepare("SELECT * FROM noticia WHERE nm_titulo = ? AND id_noticia != ? AND id_usuario = ?");
                $find_noticia->execute([$this->noticia_name, $this->id_noticia, $userId]);
                if ($find_noticia->rowCount() > 0) {
                    return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
                } else {
                    // Verifica se a modalidade existe
                    $find_noticia = $this->db->prepare("SELECT * FROM noticia WHERE id_noticia = ?");
                    $find_noticia->execute([$id]);

                    if ($find_noticia->rowCount() === 1) {
                        // Atualiza os dados da noticia
                        $sql = "UPDATE noticia SET nm_titulo = :noticiaName, ds_conteudo = :conteudo, im_capa_url = :urlImagem, dt_noticia = :dataNoticia WHERE id_noticia = :noticiaID AND id_usuario = :userId";
                        $update_stmt = $this->db->prepare($sql);

                        // Atribui os valores a serem atualizados
                        $update_stmt->bindValue(':noticiaName', htmlspecialchars($this->noticia_name), PDO::PARAM_STR);
                        $update_stmt->bindValue(':conteudo', htmlspecialchars($this->noticia_conteudo), PDO::PARAM_STR);
                        $update_stmt->bindValue(':urlImagem', htmlspecialchars($this->noticia_photo), PDO::PARAM_STR);
                        $update_stmt->bindValue(':dataNoticia', htmlspecialchars($this->noticia_date), PDO::PARAM_STR);
                        $update_stmt->bindValue(':noticiaID', htmlspecialchars($this->id_noticia), PDO::PARAM_STR);
                        $update_stmt->bindValue(':userId', htmlspecialchars($userId), PDO::PARAM_STR);
                        $update_stmt->execute();

                        return ['successMessage' => 'Dados da noticia atualizados com sucesso'];
                    } else {
                        return ['errorMessage' => 'noticia não encontrada'];
                    }
                }
            } else {
                return ['errorMessage' => 'Preencha todos os campos.'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function excluirNoticia($noticia_id)
    {
        try {
            // Verifica se o ID do Notícia é válido
            $noticia_id = intval($noticia_id);
            if ($noticia_id <= 0) {
                return ['errorMessage' => 'ID da notícia inválido'];
            }

            // Exclui a Notícia do banco de dados
            $delete_noticia = $this->db->prepare("DELETE FROM noticia WHERE id_noticia = ?");
            $delete_noticia->execute([$noticia_id]);

            if ($delete_noticia->rowCount() === 1) {
                return ['successMessage' => 'Notícia excluída com sucesso'];
            } else {
                return ['errorMessage' => 'Notícia não encontrada'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function procurar_noticia_por_id($id)
    {
        try {
            // Preparar a consulta SQL
            $stmt = $this->db->prepare("SELECT * FROM noticia WHERE id_noticia = :id");

            // Vincular o parâmetro
            $stmt->bindParam(':id', $id);

            // Executar a consulta
            $stmt->execute();

            // Retornar o resultado como um array associativo
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erro ao obter os detalhes do Notícia: ' . $e->getMessage();
            return false;
        }
    }
}
