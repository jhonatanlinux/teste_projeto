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
	<div id="corpo-form">
	<h1>ENTRAR</h1>
	<form method="POST">
		<input type="email" placeholder="Usuário" name="email">
		<input type="password" placeholder="Senha" name="senha">
		<input type="submit" value="ACESSAR">
		<a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se!</strong></a>
	</div>
	<?php
	if(ISSET($_POST['email'])){
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        if (!empty($email) && !empty($senha))
        {
        	$u->conectar("projeto","localhost","root","");
        	if ($u->msgErro == ""){

        	if($u->logar($email,$senha))
        	{
        		header("location: areaprivada.php");
        	}else{
        		?>
            	<div class="msg-erro">
            	EMAIL OU SENHA ESTÃO INCORRETOS!
            	</div>
            	<?php
        	}
        }else{
        	?>
            <div class="msg-erro">
            <?php echo "Erro: ".$u->msgErro;?>
            </div>
            <?php
        	}
        }else{
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