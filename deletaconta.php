<?php

    require_once("includes/config.php");
    require_once("includes/classes/formatadorForm.php");
    require_once("includes/classes/constantes.php");
    require_once("includes/classes/conta.php");
    
    $conta = new Conta($con);

    if(isset($_POST["botaoConfirmar"])){
        header('Location: contaexcluida.php');
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Confirmar Exclusão de Conta</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
    </head>

    <body>        
        <div class="cadastro">
            <div class="colunas">
            	<div class="header">
            		<img src="assets/images/logo2.png" title="Logo" alt="Logo do Site"/>   
            		<b><h1 style="text-align: left;">Calma ai!</h3>
                    <span style="text-align: justify;">Você realmete deseja realizar esta operação?</span> <br>  
                    <span style="text-align: justify;">Ela não pode ser desfeita!</span>   </b>		
                </div>
                
            	<form method="POST">
                    
                    <span>
                        <a href="perfil.php" class="botaoCancelar">Cancelar</a>
                        <input type="submit" name="botaoConfirmar" value="Excluir" style="cursor:pointer">
                    </span>
                </form>                           	
            </div>
        </div>
    </body>
</html>   