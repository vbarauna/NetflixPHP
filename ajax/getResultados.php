<?php
require_once("../includes/config.php");
require_once("../includes/classes/provedorResultados.php");
require_once("../includes/classes/provedorEntidade.php");
require_once("../includes/classes/Entidade.php");
require_once("../includes/classes/provedorPreview.php");

if(isset($_POST["termo"]) && isset($_POST["nomeUsuario"])){
	
	$provedorResultados = new provedorResultados($con, $_POST["nomeUsuario"]);
	echo $provedorResultados->getResultados($_POST["termo"]);
}
else{
	echo "Nenhum termo ou nome de usuário passado para o arquivo.";
}
?>