<?php

require_once 'conexao.php';
require_once 'pessoas.php';

/*//criando Banco de dados
try{
    $conn = Conexao::conectar();
    $sql = "CREATE DATABASE IF NOT EXISTS meuPDO";
    // cria o banco Se ele NAO EXISTE
    $conn->exec($sql);
    echo "Banco de dados Criando com sucesso <br>";
} catch (PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
//---------------------------------------------------------------
//CRIANDO TAABELAS

try {
        $conn = Conexao::conectar();
        $sql = "CREATE TABLE IF NOT EXISTS pessoas (
        id_pessoa INT(6) AUTO_INCREMENT PRIMARY KEY, 
        nome VARCHAR(255),
        idade INT(3),
        data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $conn->exec($sql);
        echo "tabela pessoas criada com sucesso";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn=null;
//---------------------------------------------
/*/
//LISTANDO VIA CLASSE

    if(isset($_GET['busca'])){
        $palavra = $_GET['busca'];
    try {
        $pessoa = new Pessoas();
        $lista = $pessoa->listarPorNome($palavra); 
     } catch (Exception $e){
        echo $sql . $e->getMessage();
     }
}else{
    try{
        $pessoa = new Pessoas();
        $lista = $pessoa->listar(); 
        } catch (Exception $e){
        echo $sql . $e->getMessage();
    }
}
 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="tost.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Document</title>
</head>
<body>
    <div id="exibe"></div>
    <div class="flex-container space-between" id="container_topo">
        <div>
            <button id="btn_criar"><a href="criar_pessoa.php"><span class="material-symbols-outlined">add</span></a></button>
        </div>
    
         <div id="campo-pesquisa">
             <form action="index.php" class="flex-container" >
                 <input type="search" name="busca" id="busca">
                 <button type="submit" id= "btn_pesquisa"><span class="material-symbols-outlined">search</span></button>

             </form>
         </div>
    </div>
    
    <?php if (count($lista)>0):?>
        <div class="flex-container">
    <table>
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>idade</th>
            <th>registro</th>
        </tr>
        <?php foreach($lista as $item):?>
            <!-- foreach para percorrer cada elementoda lista gerada e cruar a TR abaixo para cada um deles-->
            <tr>
                <td><?= $item['id_pessoa']?></td>
                 <!-- preenchendo o valor de cada TD da tabela com o valor referente ao item atual indicando sua chave -->
                <td><?= $item['nome']?></td>
                <td><?= $item['idade']?></td>
                <td><?= $item['data_registro']?></td>
            </tr>
              
            <td><a href="editar.php?id_pessoa=<?=$item['id_pessoa']?>"><span class="material-symbols-outlined" id="btn_editar">edit</span></a></td>
            <td><a href="delete.php?id_pessoa=<?=$item['id_pessoa']?>"><span class="material-symbols-outlined" id="btn_delete">delete</span></a></td>
       
        <?php endforeach ?>
        <!-- devemos finalizar o laço foreach-->
        
    </table>
    </div>
    <?php else: ?>
        <p>
            nao tem pessoas cadastrada
        </p>
        <?php endif ?>
       <script src="script.js"></script>
</body>
</html>