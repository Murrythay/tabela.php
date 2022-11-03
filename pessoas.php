<?php

class Pessoas{
    public $id_pessoa;
    public $nome;
    public $idade;
    public $data_registro;

    public function __construct($id_pessoa=false)
    //construtro passado id como parametrovalor padrao de id falso
    {
        if($id_pessoa){//caso seja passado um id ao construtor
            
            $this->id_pessoa = $id_pessoa;
            // associa o id recebido no parametro ao id propriedade da classe
            $this->carregar();
            // e carrega o restamte das propriedades
        }
    }
    public function carregar(){
        $query = "SELECT nome, idade, data_registro FROM pessoas WHERE :id_pessoa";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_pessoa', $this->id_pessoa);
        $stmt->execute();

        $lista = $stmt->fetch();
        $this->nome = $lista['nome'];
        $this->idade = $lista['idade'];
        $this->data_registro = $lista['data_registro'];
    }

    public function inserir() { // insere um registro
        $query = "INSERT INTO pessoas (nome, idade) VALUES (:nome, :idade)";
        // insere usando query preparada
        $conexao = Conexao::conectar();
        //cria conexão
        $stmt = $conexao->prepare($query);
        // prepara a query
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':idade', $this->idade);
        // acima vinculam os valores da query com
        // as propriedades da classe
        $stmt->execute();
        // executa
    }

    public function listar() { // lista todos os registros da tabela
        $query = "SELECT * FROM pessoas";
        // seleciona todas as colunas da tabela
        $conexao = Conexao::conectar();
        // cria conexao
        $resultado = $conexao->query($query);
        // executa query e quarda o resultado na variáqvel
        $lista = $resultado->fetchAll();
        // transforma o resultado em
        // umarray associativo ("chave":"valor")
        return $lista;
        ///retorna a lista 
    }

    public function atualizar(){//
        $query = "UPDATE pessoas SET nome = :nome, idade = :idade WHERE id_pessoa = :id_pessoa";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":idade", $this->idade);
        $stmt->bindValue(":id_pessoa", $this->id_pessoa);
        $stmt->execute();

    }

    public function deletar(){
        $query = "DELETE FROM pessoas WHERE id_pessoa=:id_pessoa";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":id_pessoa", $this->id_pessoa);
        $stmt->execute();
    }
    
    public function listarPorNome($palavra) { // lista todos os registros da tabela
        $palavra = '%' . $palavra . '%'; //%palavra%
        $query = "SELECT * FROM pessoas Where nome LIKE :palavra";
        // seleciona todas as colunas da tabela
        $conexao = Conexao::conectar();
        // cria conexao
        $stmt = $conexao->prepare($query);
        // executa query e quarda o resultado na variáqvel
        $stmt->bindValue(":palavra", $palavra);
        //vincula o placecholder de palavra com
        //a variavel palavra do metodo
        $stmt->execute();
        //executa
        $lista = $stmt->fetchAll();
        // transforma o resultado em
        // umarray associativo ("chave":"valor")
        return $lista;
        ///retorna a lista 
    }

}

//C create = inserir
//R ead = carregar e listar
//U update = atualizar
//D elet = deletar

?>