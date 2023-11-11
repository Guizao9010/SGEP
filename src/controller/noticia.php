<?php
require_once "./config/conexao.php";
require_once 'config_session.php';
class Noticia extends Conexao {
    protected $db;
    protected $noticia_name;
    protected $noticia_conteudo;
    protected $noticia_date;
    protected $noticia_photo;
    protected $id_noticia;
    
    function __construct(){
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

    function cadastroNoticia($nome, $conteudo, $dataNoticia, $imagem){
        $this->noticia_name = trim($nome);
        $this->noticia_conteudo = trim($conteudo);
        $this->noticia_date = trim($dataNoticia);

        // Converter a imagem em bytes
        $dadosImagem = file_get_contents($imagem);
        $this->noticia_photo = base64_encode($dadosImagem);
        
        try {
            // Preparar a consulta SQL
            $sql = "INSERT INTO noticia (ds_conteudo, dt_noticia, id_noticia, im_noticia) VALUES (:nome, :conteudo, :dataNoticia, :imagem)";
            $stmt = $this->db->prepare($sql);
            
            // Vincular os parâmetros
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':conteudo', $this->noticia_conteudo, PDO::PARAM_STR);
            $stmt->bindParam(':dataNoticia', $this->noticia_date, PDO::PARAM_STR);
            $stmt->bindParam(':imagem', $this->noticia_photo, PDO::PARAM_LOB);
            
            // Executar a consulta
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro ao cadastrar o Noticia: ' . $e->getMessage();
            return false;
        }
    }

    function atualizarNoticia($noticiaID, $noticiaName, $dataNoticia, $conteudo, $userId)
    {
        try {
            // Verifica se o ID da noticia é válido
            $id = intval($noticiaID);
            if ($id <= 0) {
                return ['errorMessage' => 'ID de noticia inválido'];
            }

            $this->noticia_name = trim($noticiaName);
            $this->noticia_conteudo = trim($conteudo);
            $this->noticia_date = trim($dataNoticia);
            $this->id_noticia = trim($noticiaID);

            if (!empty($this->noticia_name) && !empty($this->noticia_conteudo) && !empty($this->noticia_date)) {
                // Verifica se a noticia existe
                $find_noticia = $this->db->prepare("SELECT * FROM noticia WHERE nm_noticia = ? AND id_noticia != ? AND id_usuario = ?");
                $find_noticia->execute([$this->noticia_name, $this->id_noticia, $userId]);
                if ($find_noticia->rowCount() > 0) {
                    return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
                } else {
                    // Verifica se a modalidade existe
                    $find_mod = $this->db->prepare("SELECT * FROM noticia WHERE id_noticia = ?");
                    $find_mod->execute([$id]);

                    if ($find_noticia->rowCount() === 1) {
                        // Atualiza os dados da noticia
                        $sql = "UPDATE noticia SET nm_noticia = :noticiaName, ds_conteudo = :conteudo, dt_noticia = :dataNoticia WHERE id_noticia = :noticiaID";
                        $update_stmt = $this->db->prepare($sql);
        
                        // Atribui os valores a serem atualizados
                        $update_stmt->bindValue(':noticiaName', htmlspecialchars($this->noticia_name), PDO::PARAM_STR);
                        $update_stmt->bindValue(':conteudo', htmlspecialchars($this->noticia_conteudo), PDO::PARAM_STR);
                        $update_stmt->bindValue(':dataNoticia', htmlspecialchars($this->noticia_date), PDO::PARAM_STR);
                        $update_stmt->bindValue(':noticiaID', htmlspecialchars($this->id_noticia), PDO::PARAM_STR);
                        $update_stmt->execute();
        
                        return ['successMessage' => 'Dados da noticia atualizados com sucesso'];
                    } else {
                        return ['errorMessage' => 'noticia não encontrada'];
                    }
                }
            }  else {
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

    function procurar_noticia_por_id($id){
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
?>