<?php
require_once("../includes/config.php");

if(isset($_POST["idVideo"]) && isset($_POST["nomeUsuario"]) && isset($_POST["progresso"])){
	$query = $con->prepare("UPDATE progressoVideo SET progresso=:progresso, dataAtualizado=NOW()					WHERE nomeUsuario=:nomeUsuario AND idVideo=:idVideo");
	$query->bindValue(":nomeUsuario", $_POST["nomeUsuario"]);
	$query->bindValue(":idVideo", $_POST["idVideo"]);
	$query->bindValue(":progresso", $_POST["progresso"]);

	$query->execute();
}
else{
	echo "O ID do vídeo ou o nome de usuário não foram passados para o arquivo.";
}
?>