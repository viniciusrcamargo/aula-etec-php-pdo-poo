<?php

require_once 'Conexao.php';


class Contato
{
    private $id;
    private $nome;
    private $email;
    private $conectar;

    public function __construct()
    {
        $this->conectar = new Conexao();
    }

    public function insert($dados): bool
    {
        try {
            var_dump($dados);
            $this->nome = $dados['nome'];
            $this->email = $dados['email'];
            $stmt = $this->conectar->conectar()->prepare("INSERT INTO contato (NOME, EMAIL) VALUES (:nome, :email)");
            $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
            $stmt->execute();
            //header('location: conexao.php');
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function select()
    {
        try {
            $stmt = $this->conectar->conectar()->prepare("SELECT * FROM contato");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function selectOne($id)
    {
        try {
            $stmt = $this->conectar->conectar()->prepare("SELECT ID, NOME, EMAIL FROM contato WHERE ID = ? LIMIT 1");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $result = [];
            $result = $stmt->fetchall();
            header('location: Index.php');
            return $result;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function updade($dados)
    {
        try {
            var_dump($dados);
            $this->id = $dados['id'];
            $this->nome = $dados['nome'];
            $this->endereco = $dados['endereco'];
            $this->email = $dados['email'];
            $stmt = $this->conectar->conectar()->prepare("UPDATE contato SET NOME = :nome, ENDERECO = :endereco, EMAIL = :email WHERE ID = :id;");
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
            $stmt->execute();
            header('location: Index.php');
            return $stmt;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function delete($dado)
    {
        try {
            $this->id = $dado['id'];
            $stmt = $this->conectar->conectar()->prepare("DELETE FROM contato WHERE ID = :id;");
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            header('location: Index.php');
            return $stmt;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}