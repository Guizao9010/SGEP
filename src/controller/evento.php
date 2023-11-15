<?php
require_once 'conn.php';
require_once 'config_session.php';
class Event extends Conexao
{
    protected $db;
    protected $event_name;
    protected $event_description;
    protected $event_date;
    protected $event_id;
    function __construct()
    {
        parent::__construct();
    }

    //MOSTRAR EVENTOS   

    function listarEvento($id)
    {
        $dados = $this->db->query("SELECT * FROM evento WHERE id_evento = " . $id);
        $event = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $event;
    }

    function listarEventoUsuario($id)
    {
        $dados = $this->db->query("SELECT nm_evento, ds_evento, dt_evento, nm_unidade FROM evento e, unidade u WHERE e.id_usuario = " .$id." AND u.id_usuario = " .$id." AND e.id_unidade = u.id_unidade");
        $event = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $event;
    }
    
    function buscarEvento($key, $id) {
        $busca = $this->db->query(
            "SELECT nm_evento, ds_evento, dt_evento, nm_unidade FROM evento e, unidade u 
            WHERE e.id_usuario = " .$id." AND u.id_usuario = " .$id." AND e.id_unidade = u.id_unidade AND (nm_unidade LIKE '%$key%' OR nm_evento LIKE '%$key%')");
        $mod = $busca->fetchAll(PDO::FETCH_ASSOC);
        return $mod;
    }
    

    function cadastroEvento($eventName, $eventDescription, $eventDate, $idUnidade, $idUsuario)
    {
        try {
            $this->event_name = trim($eventName);
            $this->event_description = trim($eventDescription);
            $this->event_date = date("Y-m-d", strtotime(trim($eventDate)));

            if (!empty($this->event_name) && !empty($this->event_description) && !empty($this->event_date)) {
                $check_name = $this->db->prepare("SELECT * FROM evento WHERE nm_evento = ?  AND id_usuario = ".$idUsuario);
                $check_name->execute([$this->event_name]);
                if ($check_name->rowCount() > 0) {
                    return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
                } else {
                    $sql = "INSERT INTO evento (nm_evento, ds_evento, dt_evento, id_unidade, id_usuario) VALUES(:eventName, :eventDescription, :eventDate, :idUnidade, :idUsuario)";
                    $sign_up_stmt = $this->db->prepare($sql);
                    //BIND VALUES
                    $sign_up_stmt->bindValue(':eventName', htmlspecialchars($this->event_name), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':eventDescription', htmlspecialchars($this->event_description), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':eventDate', htmlspecialchars($this->event_date), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':idUnidade', htmlspecialchars($idUnidade), PDO::PARAM_STR);
                    $sign_up_stmt->bindValue(':idUsuario', htmlspecialchars($idUsuario), PDO::PARAM_STR);
                    $sign_up_stmt->execute();
                   
                    return ['successMessage' => 'Evento cadastrado com sucesso.'];
                }
            } else {
                return ['errorMessage' => 'Preencha todos os campos.'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    function atualizarEvento($idEvent, $eventName, $eventDescription, $eventDate, $idUnidade, $userId)
    {
        try {
            // Verifica se o ID da evento é válido
            $id = intval($idEvent);
            if ($id <= 0) {
                return ['errorMessage' => 'ID de evento inválido'];
            }

            $this->event_name = trim($eventName);
            $this->event_description = trim($eventDescription);
            $this->event_date = date("Y-m-d", strtotime(trim($eventDate)));
            $this->event_id = trim($idEvent);

            if (!empty($this->event_name) && !empty($this->event_description) && !empty($this->event_date) && !empty($idUnidade)) {
                $check_name = $this->db->prepare("SELECT * FROM evento WHERE nm_evento = ? AND id_evento != ? AND id_usuario = ?");
                $check_name->execute([$this->event_name, $this->event_id, $userId]);
                if ($check_name->rowCount() > 0) {
                    return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
                } else {
                    // Verifica se a evento existe
                    $find_event = $this->db->prepare("SELECT * FROM evento WHERE id_evento = ?");
                    $find_event->execute([$id]);

                    if ($find_event->rowCount() === 1) {
                        // Atualiza os dados da evento
                        $sql = "UPDATE evento SET nm_evento = :eventName, ds_evento = :eventDescription, dt_evento = :eventDate, id_unidade = :idUnidade WHERE id_evento = :eventId";

                        $update_stmt = $this->db->prepare($sql);
                        // Atribui os valores a serem atualizados
                        $update_stmt->bindValue(':eventName', htmlspecialchars($this->event_name), PDO::PARAM_STR);
                        $update_stmt->bindValue(':eventDescription', htmlspecialchars($this->event_description), PDO::PARAM_STR);
                        $update_stmt->bindValue(':eventDate', htmlspecialchars($this->event_date), PDO::PARAM_STR);
                        $update_stmt->bindValue(':idUnidade', htmlspecialchars($idUnidade), PDO::PARAM_STR);
                        $update_stmt->bindValue(':eventId', htmlspecialchars($this->event_id), PDO::PARAM_STR);
                        $update_stmt->execute();
                        echo "<script> setTimeout(function(){
                            window.location.href = 'eventos.php';
                        }, 1000); // Tempo em milissegundos
                        </script>";
                        return ['successMessage' => 'Informações da evento atualizadas com sucesso'];
                    } else {
                        return ['errorMessage' => 'evento não encontrada'];
                    }
                }
            } else {
                return ['errorMessage' => 'Preencha todos os campos.'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function excluirEvento($idEvent)
    {
        try {
            // Verifica se o ID da evento é válido
            $event_id = intval($idEvent);
            if ($event_id <= 0) {
                return ['errorMessage' => 'ID da evento inválido'];
            }

            // Exclui a evento do banco de dados
            $delete_event = $this->db->prepare("DELETE FROM evento WHERE id_evento = ?");
            $delete_event->execute([$event_id]);

            if ($delete_event->rowCount() === 1) {
                return ['successMessage' => 'evento excluída com sucesso'];
            } else {
                return ['errorMessage' => 'evento não Encontrada'];
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    function procurar_evento_por_id($id)
    {
        try {
            $find_event = $this->db->prepare("SELECT * FROM evento WHERE id_evento = ?");
            $find_event->execute([$id]);
            if ($find_event->rowCount() === 1) {
                return $find_event->fetch(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function event_existe($id)
    {
        try {
            $get_events = $this->db->prepare("SELECT * FROM evento WHERE id_evento = ?");
            $get_events->execute([$id]);
            if ($get_events->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
