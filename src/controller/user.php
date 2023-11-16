<?php
require_once 'conn.php';
require_once 'config_session.php';
class User extends Conexao
{
    protected $db;
    protected $user_name;
    protected $user_email;
    protected $user_pass;
    protected $hash_pass;
    protected $id_user;

    protected $tipo;

    function __construct()
    {
        parent::__construct();
    }

    //MOSTRAR USUÁRIO
    function listarUsuarios()
    {
        $dados = $this->db->query("SELECT * FROM usuario");
        $user = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    function buscarUsuario($key)
    {
        $busca = $this->db->query("SELECT * FROM usuario WHERE nm_usuario = '$key' OR cd_usuario = '$key'");
        $user = $busca->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    function cadastroUser($username, $email, $password, $userID)
    {
        try {
            $this->user_name = trim($username);
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
            $this->id_user = trim($userID);

            if (!empty($this->user_name) && !empty($this->user_email) && !empty($this->user_pass) && !empty($this->id_user)) {
                if (filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) {
                    $check_email = $this->db->prepare("SELECT * FROM usuario WHERE ds_email = ?");
                    $check_email->execute([$this->user_email]);

                    if ($check_email->rowCount() > 0) {
                        return ['errorMessage' => 'Este email já está registrado. Tente outro.'];
                    } else {

                        $this->hash_pass = password_hash($this->user_pass, PASSWORD_DEFAULT);

                        $sql = "INSERT INTO usuario (ds_email, nm_usuario, ds_senha, cd_usuario) VALUES(:user_email, :username, :user_pass, :id_user)";

                        $sign_up_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $sign_up_stmt->bindValue(':username', htmlspecialchars($this->user_name), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':user_email', $this->user_email, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':user_pass', $this->hash_pass);
                        $sign_up_stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_STR);
                        $sign_up_stmt->execute();
                        return ['successMessage' => 'Cadastrado com sucesso.'];
                    }
                } else {
                    return ['errorMessage' => 'Email inválido.'];
                }
            } else {
                return ['errorMessage' => 'Preencha todos os campos.'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function loginUser($email, $password)
    {
        try {
            $this->user_email = trim($email);
            $this->user_pass = trim($password);

            $find_email = $this->db->prepare("SELECT * FROM usuario WHERE ds_email = ?");
            $find_email->execute([$this->user_email]);

            if ($find_email->rowCount() === 1) {
                $row = $find_email->fetch(PDO::FETCH_ASSOC);
                $match_pass = password_verify($this->user_pass, $row['ds_senha']);
                // Verifique o tipo de usuário
                if ($row['sg_tipo'] == 'ADMIN') {
                    if ($this->user_pass ===  $row['ds_senha']) {
                        $_SESSION = [
                            'user_id' => $row['id'],
                            'email' => $row['ds_email']
                        ];
                        header('Location: admin/admDashboard.php');
                        exit;
                    } else {
                        return ['errorMessage' => 'Senha inválida'];
                    }                    
                } else {
                    if ($match_pass) {
                        $_SESSION = [
                            'user_id' => $row['id'],
                            'email' => $row['ds_email']
                        ];
                        header('Location: user/userDashboard.php');
                        exit;
                    } else {
                        return ['errorMessage' => 'Senha inválida'];
                    }                   
                }
            } else {
                return ['errorMessage' => 'Email inválido'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function atualizarUsuario($id, $username, $email, $password, $idUser)
    {
        try {
            // Verifica se o ID do usuário é válido
            $id = intval($id);
            if ($id <= 0) {
                return ['errorMessage' => 'ID de usuário inválido'];
            }

            $this->user_name = trim($username);
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
            $this->id_user = trim($idUser);

            // Verifica se o email é válido
            if (!filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) {
                return ['errorMessage' => 'Email inválido'];
            }

            // Verifica se a senha é fornecida
            if (empty($this->user_pass)) {
                return ['errorMessage' => 'Senha não fornecida'];
            }

            // Verifica se o usuário existe
            $find_user = $this->db->prepare("SELECT * FROM usuario WHERE id = ?");
            $find_user->execute([$id]);

            if ($find_user->rowCount() === 1) {
                
                $this->hash_pass = password_hash($this->user_pass, PASSWORD_DEFAULT);
                // Atualiza os dados do usuário
                $sql = "UPDATE usuario SET nm_usuario = :username, ds_email = :user_email, ds_senha = :user_pass, cd_usuario = :idUser WHERE id = :id";

                
                $update_stmt = $this->db->prepare($sql);
                // Atribui os valores a serem atualizados
                $update_stmt->bindValue(':username', htmlspecialchars($this->user_name), PDO::PARAM_STR);
                $update_stmt->bindValue(':user_email', $this->user_email, PDO::PARAM_STR);
                $update_stmt->bindValue(':user_pass', $this->hash_pass, PDO::PARAM_STR);
                $update_stmt->bindValue(':idUser', $this->id_user, PDO::PARAM_STR);
                $update_stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $update_stmt->execute();

                return ['successMessage' => 'Dados do usuário atualizados com sucesso'];
            } else {
                return ['errorMessage' => 'Usuário não encontrado'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function excluirUsuario($user_id)
    {
        try {
            // Verifica se o ID do usuário é válido
            $user_id = intval($user_id);
            if ($user_id <= 0) {
                return ['errorMessage' => 'ID de usuário inválido'];
            }

            // Exclui o usuário do banco de dados
            $delete_user = $this->db->prepare("DELETE FROM usuario WHERE id = ?");
            $delete_user->execute([$user_id]);

            if ($delete_user->rowCount() === 1) {
                return ['successMessage' => 'Usuário excluído com sucesso'];
            } else {
                return ['errorMessage' => 'Usuário não encontrado'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    function procurar_user_por_id($id)
    {
        try {
            $find_user = $this->db->prepare("SELECT * FROM usuario WHERE id = ?");
            $find_user->execute([$id]);
            if ($find_user->rowCount() === 1) {
                return $find_user->fetch(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    function all_users($id)
    {
        try {
            $get_users = $this->db->prepare("SELECT nm_usuario, ds_senha, cd_usuario FROM usuario WHERE id != ?");
            $get_users->execute([$id]);
            if ($get_users->rowCount() > 0) {
                return $get_users->fetchAll(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
