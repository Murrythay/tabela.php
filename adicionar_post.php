<?php
require_once 'pessoas.php';
require_once 'conexao.php';


try{
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    // o codigo acima recebe o que vem no post e guarda nas variaveis
    $pessoa = new Pessoas();
    // criar nono objeto da classe pessoa
    $pessoa->nome = $nome;
    $pessoa->idade = $idade;
    // vincular os atributos da classe com as variaveis
    $pessoa->inserir();
    //insere
    setcookie("adicionar", true);
    header("Location: index.php");
} catch (Exception $e) {
    echo $e->getMessage();
}

?>