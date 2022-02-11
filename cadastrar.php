<!DOCTYPE html>
<?php
    require_once 'CLASSES/usuarios.php';
    $u = new Usuario;

?>

<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Query DashBoard</title>
	<link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
	<div id="corpo-form-cad">
	<h1>CADASTRAR</h1>
	<form method="POST">
		<input type="text" name="nome" placeholder="Nome Completo" maxlength="50">
        <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
        <input type="email" name="email" placeholder="Usuário" maxlength="50">
		<input type="password" name="senha" placeholder="Senha" maxlength="20">
        <input type="password" name="confsenha" placeholder="Confirmar Senha">
		<input type="submit" value="CADASTRAR">
        <a href="sair.php"> SAIR </a>
	</div>
    <?php
    //VERIFICAR SE CLICOU NO BOTÃO
    if(ISSET($_POST['nome'])){
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confsenha']);
        //VERIFICAR SE ESTA PREENCHIDO
        if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
        {
            $u->conectar("projeto","localhost","root","");
            if ($u->msgErro == "")//ESTA TUDO CERTO
            {
                if($senha == $confirmarSenha){
                    if($u->cadastrar($nome,$telefone,$email,$senha))
                    {
                        ?>
                        <div id="msg-sucesso">
                             CADASTRADO COM SUCESSO!
                        </div>
                        <?php
                    }
                    else {
                        ?>
                        <div class="msg-erro">
                        EMAIL JÁ CADASTRADO!
                        </div>
                        <?php
                    }
                }
                else {
                    ?>
                        <div class="msg-erro">
                        SENHAS NÃO CORRESPONDEM
                        </div>
                    <?php
                }
            }
            else {
                ?>
                        <div class="msg-erro">
                        <?php echo "Erro: ".$u->msgErro;?>
                        </div>
                    <?php
            }
        }else {
                    ?>
                        <div class="msg-erro">
                        PREENCHA TODOS OS CAMPOS!
                        </div>
                    <?php
        }
    }

    ?>
</body>
</html>