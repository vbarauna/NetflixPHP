<?php
class provedorVideo{
	public static function getASeguir($con, $videoAtual){
		$query = $con->prepare("SELECT * FROM videos 
								WHERE entityId=:entityId AND id != :videoId 
								AND ((season=:season AND episode > :episode) OR season > :season) 
								ORDER BY season, episode ASC LIMIT 1"); // selecionando videos para mostrar a seguir, desde que não seja o mesmo vídeo atual e desde que seja um episodio precedente do atual.

		$query->bindValue(":entityId", $videoAtual->getIdEntidade());
		$query->bindValue(":season", $videoAtual->getNumeroTemporada());
		$query->bindValue(":episode", $videoAtual->getNumeroEpisodio());
		$query->bindValue(":videoId", $videoAtual->getId());

		$query->execute();

		if($query->rowCount() == 0){
			$query = $con->prepare("SELECT * FROM videos 
									WHERE season <= 1 AND episode <= 1
									AND id != :videoId");
			$query->bindValue(":videoId", $videoAtual->getId());
			$query->execute();
		}

		$row = $query->fetch(PDO::FETCH_ASSOC);
		return new video($con, $row);
	}

	public static function getEntidadePorUsuario($con, $idEntidade, $nomeUsuario){
		$query = $con->prepare("SELECT idVideo FROM progressoVideo
								INNER JOIN videos ON progressoVideo.idVideo = videos.id
								WHERE videos.entityId = :entityId
								AND progressoVideo.nomeUsuario = :nomeUsuario
								ORDER BY progressoVideo.dataAtualizado DESC
								LIMIT 1");

		$query->bindValue(":entityId", $idEntidade);
		$query->bindValue(":nomeUsuario", $nomeUsuario);
		$query->execute();

		if($query->rowCount() == 0){
			$query = $con->prepare("SELECT id FROM videos 
									WHERE entityId=:entityId
									ORDER BY season, episode ASC LIMIT 1");

			$query->bindValue(":entityId", $idEntidade);
			$query->execute();
		}

		return $query->fetchColumn();
	}
}
?>