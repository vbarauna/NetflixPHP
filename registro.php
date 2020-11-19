<?php
require_once("includes/config.php");
require_once("includes/classes/formatadorForm.php");
require_once("includes/classes/constantes.php");
require_once("includes/classes/conta.php");

	$conta = new Conta($con);

	if (isset($_POST["botaoConfirmar"])) {
		$nome =  formatadorForm::formatarString($_POST["nome"]);
		$sobrenome =  formatadorForm::formatarString($_POST["sobrenome"]);
		$nomeUsuario =  formatadorForm::formatarUsuario($_POST["nomeUsuario"]);
		$email =  formatadorForm::formatarEmail($_POST["email"]);
		$email2 =  formatadorForm::formatarEmail($_POST["email2"]);
		$senha =  formatadorForm::formatarSenha($_POST["senha"]);
		$senha2 =  formatadorForm::formatarSenha($_POST["senha2"]);

		$sucesso = $conta->registro($nome, $sobrenome, $nomeUsuario, $email, $email2, $senha, $senha2);

		if($sucesso){
			$_SESSION["usuarioLogado"] = $nomeUsuario;
			header("Location: index.php");
		}
	}

	function salvaValor($nome){
        if(isset($_POST[$nome])){
        echo $_POST[$nome];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bem-vindo ao MovieIt!</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
    </head>

    <body>        
        <div class="cadastro">
            <div class="colunas">
            	<div class="header">
            		<img src="assets/images/logo2.png" title="Logo" alt="Logo do Site"/>   
            		<h3>Cadastre-se</h3>
            		<span>para continuar ao MovieIt.</span>   		
            	</div>
            	<form method="POST">
            		<?php echo $conta->getErro(constantes::$caracteresNome);?>
            		<input type="text" name="nome" placeholder="Nome" value="<?php salvaValor("nome");?>" required>
            		<?php echo $conta->getErro(constantes::$caracteresSobrenome);?>
            		<input type="text" name="sobrenome" placeholder="Sobrenome" value="<?php salvaValor("sobrenome");?>" required>
            		<?php echo $conta->getErro(constantes::$caracteresNomeUsuario);?>
            		<?php echo $conta->getErro(constantes::$nomeUsuarioUsado);?>
            		<input type="text" name="nomeUsuario" placeholder="Nome de usuário" value="<?php salvaValor("nomeUsuario");?>" required>
            		<?php echo $conta->getErro(constantes::$emailInvalido);?>
            		<?php echo $conta->getErro(constantes::$emailUsado);?>
            		<input type="email" name="email" placeholder="Endereço de e-mail" value="<?php salvaValor("email");?>" required>
            		<?php echo $conta->getErro(constantes::$emailNaoConfere);?>
            		<input type="email" name="email2" placeholder="Confirme o e-mail" value="<?php salvaValor("email2");?>" required>
            		<?php echo $conta->getErro(constantes::$caracteresSenha);?>
            		<input type="password" name="senha" placeholder="******" required>
            		<?php echo $conta->getErro(constantes::$senhaNaoConfere);?>
            		<input type="password" name="senha2" placeholder="******" required>
            		<input type="submit" name="botaoConfirmar" value="Confirmar">
            	</form>
            	<a href="login.php" class="mensagemCadastro">Já possui uma conta? <a href="login.php" class="mensagemEntrar" style="color: #dc1928;">Entre por aqui!</a></a>
            </div>
        </div>
    </body>
</html>