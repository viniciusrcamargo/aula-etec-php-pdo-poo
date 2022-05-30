<?php


class Conexao
{
    private $usuario;
    private $senha;
    private $banco;
    private $servidor;
    private static $pdo;

    /**
     * Conexao constructor.
     * @param $usuario
     * @param $senha
     * @param $banco
     * @param $servidor
     */
    public function __construct()
    {
        $this->usuario = "usuario";
        $this->senha = "conecta@123";
        $this->banco = "aulaetec";
        $this->servidor = "localhost";
    }

    public function conectar()
    {
        try{
            if(is_null(self:: $pdo)){
                self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
                //echo "conectado";
            }
            return self::$pdo;
        }catch (PDOException $e){
            echo 'Erro: '. $e->getMessage();
        }
    }

}