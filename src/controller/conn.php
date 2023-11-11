<?php 

    define('HOST', 'localhost');
    define('DBNAME', 'dbsgep');
    define('USER', 'root');
    define('PASSWORD', 'usbw');

    class Conexao{
        protected $db;

        function __construct(){
            $this->connectDatabase();
        }

        private function connectDatabase(){
            try 
            {
                $this->db = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASSWORD);
            } 
            catch (PDOException $e) 
            {
                echo "Error to connect with Database!".$e->getMessage();
                die();
            }
        } 

    }

?>