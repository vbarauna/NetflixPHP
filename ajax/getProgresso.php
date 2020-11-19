<?php
require_once("../includes/config.php");

if(isset($_POST["idVideo"]) && isset($_POST["nomeUsuario"])){
	$query = $con->prepare("SELECT progresso FROM progressoVideo WHERE nomeUsuario=:nomeUsuario AND idVideo=:idVideo");
	$query->bindValue(":nomeUsuario", $_POST["nomeUsuario"]);
	$query->bindValue(":idVideo", $_POST["idVideo"]);
	$query->execute();

	echo $query->fetchColumn();
}
else{
	echo "O ID do vídeo ou o nome de usuário não foram passados para o arquivo.";
}
?>