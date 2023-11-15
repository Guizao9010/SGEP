<?php
require_once 'conn.php';
require_once 'config_session.php';
class Unit extends Conexao
{
    protected $db;
    protected $unit_name;
    protected $unit_end;
    protected $unit_desc;
    protected $id_unit;
    protected $user_id;

    function __construct()
    {
        parent::__construct();
    }

    //MOSTRAR Unidade
    function listarUnidades($id)
    {
        $dados = $this->db->query("SELECT * FROM unidade WHERE id_unidade = " . $id);
        $unit = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $unit;
    }

    function listarUnidadesUsuario($id)
    {
        $dados = $this->db->query("SELECT * FROM unidade WHERE id_usuario = " . $id);
        $unit = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $unit;
    }

    function cadastrarUnidade($unitname, $endereco, $descricao, $idUsuario)
    {
        try {
            $this->unit_name = trim($unitname);
            $this->unit_end = trim($endereco);
            $this->unit_desc = trim($descricao);

            if (!empty($this->unit_name) && !empty($this->unit_end) && !empty($this->unit_desc)) {
                $check_name = $this->db->prepare("SELECT * FROM unidade WHERE nm_unidade = ? AND id_usuario = ".$idUsuario);
                $check_name->execute([$this->unit_name]);

                if ($check_name->rowCount() > 0) {
                    return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
                } else {
                    $sql = "INSERT INTO unidade (nm_unidade, ds_endereco, ds_unidade, id_usuario) VALUES (:unitname, :endereco, :descricao, :idUsuario)";

                    $sign_up_stmt = $this->db->prepare($sql);
                    //BIND VALUES
                    $sign_up_stmt->bindValue(':unitname', htmlspecialchars($this->unit_name), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':endereco', htmlspecialchars($this->unit_end), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':descricao', htmlspecialchars($this->unit_desc), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':idUsuario', htmlspecialchars($idUsuario), PDO::PARAM_STR);
                    $sign_up_stmt->execute();
                    return ['successMessage' => 'Unidade cadastrada com sucesso.'];
                }
            } else {
                return ['errorMessage' => 'Preencha todos os campos.'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function atualizarUnidade($unitID, $unitname, $endereco, $descricao, $userId)
    {
        try {
            // Verifica se o ID da Unidade é válido
            $id = intval($unitID);
            if ($id <= 0) {
                return ['errorMessage' => 'ID de Unidade inválido'];
            }

            $this->unit_name = trim($unitname);
            $this->unit_end = trim($endereco);
            $this->unit_desc = trim($descricao);
            $this->id_unit = trim($unitID);

            if (!empty($this->unit_name) && !empty($this->unit_end) && !empty($this->unit_desc)) {
                // Verifica se a unidade existe
                $find_unit = $this->db->prepare("SELECT * FROM unidade WHERE nm_unidade = ? AND id_unidade != ? AND id_usuario = ?");
                $find_unit->execute([$this->unit_name, $this->id_unit, $userId]);
                if ($find_unit->rowCount() > 0) {
                    return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
                } else {
                    // Verifica se a modalidade existe
                    $find_mod = $this->db->prepare("SELECT * FROM unidade WHERE id_unidade = ?");
                    $find_mod->execute([$id]);

                    if ($find_unit->rowCount() === 1) {
                        // Atualiza os dados da Unidade
                        $sql = "UPDATE unidade SET nm_unidade = :unitname, ds_endereco = :endereco, ds_unidade = :descricao WHERE id_unidade = :unitID";
                        $update_stmt = $this->db->prepare($sql);
        
                        // Atribui os valores a serem atualizados
                        $update_stmt->bindValue(':unitname', htmlspecialchars($this->unit_name), PDO::PARAM_STR);
                        $update_stmt->bindValue(':endereco', htmlspecialchars($this->unit_end), PDO::PARAM_STR);
                        $update_stmt->bindValue(':descricao', htmlspecialchars($this->unit_desc), PDO::PARAM_STR);
                        $update_stmt->bindValue(':unitID', htmlspecialchars($this->id_unit), PDO::PARAM_STR);
                        $update_stmt->execute();
        
                        return ['successMessage' => 'Dados da Unidade atualizados com sucesso'];
                    } else {
                        return ['errorMessage' => 'Unidade não encontrada'];
                    }
                }
            }  else {
                return ['errorMessage' => 'Preencha todos os campos.'];
            }          
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function excluirUnidade($unit_id)
    {
        try {
            // Verifica se o ID do Unidade é válido
            $unit_id = intval($unit_id);
            if ($unit_id <= 0) {
                return ['errorMessage' => 'ID de unidade inválido'];
            }

            // Exclui a Unidade do banco de dados
            $delete_unit = $this->db->prepare("DELETE FROM unidade WHERE id_unidade = ?");
            $delete_unit->execute([$unit_id]);

            if ($delete_unit->rowCount() === 1) {
                return ['successMessage' => 'Unidade excluído com sucesso'];
            } else {
                return ['errorMessage' => 'Unidade não encontrada'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    function procurar_unit_por_id($id)
    {
        try {
            $find_unit = $this->db->prepare("SELECT * FROM unidade WHERE id_unidade = ?");
            $find_unit->execute([$id]);
            if ($find_unit->rowCount() === 1) {
                return $find_unit->fetch(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
