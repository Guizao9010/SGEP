<?php
require_once 'conn.php';
require_once 'config_session.php';
class User extends Conexao{
    protected $db;
    protected $user_name;
    protected $user_email;
    protected $user_pass;
    protected $user_confirmpass;
    protected $id_user;
    
    function __construct(){
        parent::__construct();
    }

    function cadastroUser($username, $email, $password, $confirm){
        try{
            $this->user_name = trim($username);
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
            $this->user_confirmpass = trim($confirm);
            
            if(!empty($this->user_name) && !empty($this->user_email) && !empty($this->user_pass) && !empty($this->user_confirmpass) && !empty($this->user_pass)){
                
                if($this->user_pass != $this->user_confirmpass){
                    return ['errorMessage' => 'Senha incorreta'];
                }else{
                    if (filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) { 
                        $check_email = $this->db->prepare("SELECT * FROM usuario WHERE ds_email = ?");
                        $check_email->execute([$this->user_email]);
                        
                        if($check_email->rowCount() > 0){
                            return ['errorMessage' => 'Este email já está registrado. Tente outro.'];
                        }
                        else{
                            $sql = "INSERT INTO usuario (ds_email, nm_usuario, ds_senha, cd_usuario) VALUES(:user_email, :username, :user_pass, :id_user)";
                
                            $sign_up_stmt = $this->db->prepare($sql);
                            //BIND VALUES
                            $sign_up_stmt->bindValue(':username',htmlspecialchars($this->user_name), PDO::PARAM_STR);
                            $sign_up_stmt->bindValue(':user_email',$this->user_email, PDO::PARAM_STR);
                            $sign_up_stmt->bindValue(':user_pass',$this->user_pass, PDO::PARAM_STR);
                            $sign_up_stmt->bindValue(':id_user',$this->user_pass, PDO::PARAM_STR);
                            $sign_up_stmt->execute();
                            return ['successMessage' => 'Cadastrado com sucesso.'];                   
                        }
                    }
                    else{
                        return ['errorMessage' => 'Email inválido.'];
                    } 
                }
            }
            else{
                return ['errorMessage' => 'Preencha todos os campos.'];
            } 
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function loginUser($email, $password){  
        try{
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
    
            $find_email = $this->db->prepare("SELECT * FROM usuario WHERE ds_email = ?");
            $find_email->execute([$this->user_email]);
            
            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);
    
                if($this->user_pass === $row['ds_senha']){
                    $_SESSION = [
                        'user_id' => $row['cd_usuario'],
                        'email' => $row['ds_email']
                    ];
    
                    header('Location: admDashboard.php');
                }
                else{
                    return ['errorMessage' => 'Invalid password'];
                }             
            }
            else{
                return ['errorMessage' => 'Invalid email address!'];
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // ATUALIZAR USUÁRIO


   // EXCLUIR USUÁRIO


    function procurar_user_por_id($id){
        try{
            $find_user = $this->db->prepare("SELECT * FROM usuario WHERE cd_usuario = ?");
            $find_user->execute([$id]);
            if($find_user->rowCount() === 1){
                return $find_user->fetch(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>