<?php
    function getConnection(){
    $banco = new PDO("mysql:host=localhost; dbname=site","root","usbw");
    return $banco;
}
?>