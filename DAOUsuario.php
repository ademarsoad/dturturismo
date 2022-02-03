<?php

class DAOUsuario
{
    private $conn;
    

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost; dbname=dturturismo", "root", "");
        } catch (PDOException $e) {
            echo "Erro com o banco de dados " . $e;
        } catch (Exception $e) {
            echo "Erro generico " . $e;
        }
    }
    public function cadastroUsuario()
    {
        

     
    }

    public function logar($usuario, $senha) {
        $cmd = $this->conn->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $cmd->bindValue(":e", $usuario);
        $cmd->bindValue(":s", $senha);
        $cmd->execute();

        if($cmd->rowCount() > 0) {
            $dados = $cmd->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dados['id_usuario'];
            return true;
        } else {
            return false;
        }
    }
}
