<?php
require_once("../includes/config.php");

if(isset($_POST["idVideo"]) && isset($_POST["nomeUsuario"])){
	$query = $con->prepare("UPDATE progressoVideo SET terminado=1, progresso=0 WHERE nomeUsuario=:nomeUsuario AND idVideo=:idVideo");
	$query->bindValue(":nomeUsuario", $_POST["nomeUsuario"]);
	$query->bindValue(":idVideo", $_POST["idVideo"]);

	$query->execute();
}
else{
	echo "O ID do vídeo ou o nome de usuário não foram passados para o arquivo.";
}
?>