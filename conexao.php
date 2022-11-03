<?php
require_once 'config.php';

class Conexao {
    public static function conectar(){
        //criar uma  nova conexao com o baco
        $conn = new PDO(DB_DRIVE . ":host=" . NOME_SERVIDOR . ";dbname=" . NOME_BANCO, USUARIO, SENHA);
        // colocar o modo de erros do Pdo em exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // devolve uma conexao pronta
        return $conn;
    } 
}


?>