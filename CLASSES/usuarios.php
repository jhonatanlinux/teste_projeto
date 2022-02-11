<?php

class Usuario{
    private $pdo;
    public $msgErro = "";//OK

    public function conectar($nome,$host,$usuario,$senha)
    {
        global $pdo;
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e){
            $msgErro = $e->getMessage();
        }
        

    }
    public function cadastrar($nome,$telefone,$email,$senha)
    {
        global $pdo;
        //VERIFICAR SE JA EXISTE EMAIL CADASTRADO
        $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false; //JA ESTA CADASTRADO
        }
        else {
            //CASO NÃO, CADASTRAR
            $sql = $pdo->prepare("INSERT INTO usuario (nome,telefone,email,senha) VALUES (:n,:t,:e,:s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
    }
    public function logar($email,$senha)
    {
        global $pdo;
        //VERIFICAR SE O EMAIL E SENHA ESTAO CADASTRADOS, SE SIM
        $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            //ENTRAR NO SISTEMA(SESSAO)
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //LOGADO COM SUCESSO
        }else {
            return false; //NAO FOI POSSIVEL LOGAR
        }


    }
}


?>