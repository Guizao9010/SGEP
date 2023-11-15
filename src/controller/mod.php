<?php
require_once 'conn.php';
require_once 'config_session.php';
class Mod extends Conexao
{
    protected $db;
    protected $mod_name;
    protected $mod_description;
    protected $mod_id;
    function __construct()
    {
        parent::__construct();
    }

    //MOSTRAR MODALIDADES   

    function listarModalidade($id)
    {
        $dados = $this->db->query("SELECT * FROM modalidade WHERE id_modalidade = " . $id);
        $mod = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $mod;
    }

    function listarModalidadeUsuario($id)
    {
        $dados = $this->db->query("SELECT * FROM modalidade WHERE id_usuario = " . $id);
        $mod = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $mod;
    }


    function cadastroMod($modName, $modDescription, $idUsuario)
    {
        try {
            $this->mod_name = trim($modName);
            $this->mod_description = trim($modDescription);

            if (!empty($this->mod_name) && !empty($this->mod_description)) {
                $check_name = $this->db->prepare("SELECT * FROM modalidade WHERE nm_modalidade = ? AND id_usuario = ".$idUsuario);
                $check_name->execute([$this->mod_name]);
                if ($check_name->rowCount() > 0) {
                    return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
                } else {
                    $sql = "INSERT INTO modalidade (nm_modalidade, ds_modalidade, id_usuario) VALUES(:modName, :modDescription, :idUsuario)";
                    $sign_up_stmt = $this->db->prepare($sql);
                    //BIND VALUES
                    $sign_up_stmt->bindValue(':modName', htmlspecialchars($this->mod_name), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':modDescription', htmlspecialchars($this->mod_description), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':idUsuario', htmlspecialchars($idUsuario), PDO::PARAM_STR);
                    $sign_up_stmt->execute();
                    return ['successMessage' => 'Modalidade cadastrada com sucesso.'];
                }
            } else {
                return ['errorMessage' => 'Preencha todos os campos.'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    function atualizarMod($idMod, $modName, $modDescription, $userId)
    {
        try {
            // Verifica se o ID da Modalidade é válido
            $id = intval($idMod);
            if ($id <= 0) {
                return ['errorMessage' => 'ID de Modalidade inválido'];
            }

            $this->mod_name = trim($modName);
            $this->mod_description = trim($modDescription);
            $this->mod_id = trim($idMod);

            if (!empty($this->mod_name) && !empty($this->mod_description)) {
                $check_name = $this->db->prepare("SELECT * FROM modalidade WHERE nm_modalidade = ? AND id_modalidade != ? AND id_usuario = ?");
                $check_name->execute([$this->mod_name, $this->mod_id, $userId]);
                if ($check_name->rowCount() > 0) {
                    return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
                } else {
                    // Verifica se a modalidade existe
                    $find_mod = $this->db->prepare("SELECT * FROM modalidade WHERE id_modalidade = ?");
                    $find_mod->execute([$id]);

                    if ($find_mod->rowCount() === 1) {
                        // Atualiza os dados da modalidade
                        $sql = "UPDATE modalidade SET nm_modalidade = :modName, ds_modalidade = :modDescription WHERE id_modalidade = :modId";

                        $update_stmt = $this->db->prepare($sql);
                        // Atribui os valores a serem atualizados
                        $update_stmt->bindValue(':modName', htmlspecialchars($this->mod_name), PDO::PARAM_STR);
                        $update_stmt->bindValue(':modDescription', htmlspecialchars($this->mod_description), PDO::PARAM_STR);
                        $update_stmt->bindValue(':modId', htmlspecialchars($this->mod_id), PDO::PARAM_STR);
                        $update_stmt->execute();

                        return ['successMessage' => 'Informações da Modalidade atualizadas com sucesso'];
                    } else {
                        return ['errorMessage' => 'Modalidade não encontrada'];
                    }
                }
            } else {
                return ['errorMessage' => 'Preencha todos os campos.'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function excluirMod($idMod)
    {
        try {
            // Verifica se o ID da modalidade é válido
            $mod_id = intval($idMod);
            if ($mod_id <= 0) {
                return ['errorMessage' => 'ID da Modalidade inválido'];
            }

            // Exclui a modalidade do banco de dados
            $delete_mod = $this->db->prepare("DELETE FROM modalidade WHERE id_modalidade = ?");
            $delete_mod->execute([$mod_id]);

            if ($delete_mod->rowCount() === 1) {
                return ['successMessage' => 'Modalidade excluída com sucesso'];
            } else {
                return ['errorMessage' => 'Modalidade não Encontrada'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    function procurar_mod_por_id($id)
    {
        try {
            $find_mod = $this->db->prepare("SELECT * FROM modalidade WHERE id_modalidade = ?");
            $find_mod->execute([$id]);
            if ($find_mod->rowCount() === 1) {
                return $find_mod->fetch(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function mod_existe($id)
    {
        try {
            $get_mods = $this->db->prepare("SELECT * FROM modalidade WHERE id_modalidade = ?");
            $get_mods->execute([$id]);
            if ($get_mods->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
