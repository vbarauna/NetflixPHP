<?php 
class provedorEntidade{

	public static function getEntidades($con, $idCategoria, $limite){

		$sql = "SELECT * FROM entities ";

		if($idCategoria != null){
			$sql .="WHERE categoryId=:categoryId ";
		}

		$sql .= "ORDER BY RAND() LIMIT :limit";

		$query = $con->prepare($sql);

		if($idCategoria != null){
			$query->bindValue(":categoryId", $idCategoria);
		}

		$query->bindValue(":limit", $limite, PDO::PARAM_INT);
		$query->execute();

		$result = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$result[] = new Entidade($con, $row);
		}

		return $result;
	}

	public static function getEntidadesSeries($con, $idCategoria, $limite){

		$sql = "SELECT DISTINCT(entities.id) FROM entities
				INNER JOIN videos ON entities.id = videos.entityId 
				WHERE videos.isMovie = 0 ";

		if($idCategoria != null){
			$sql .= "AND categoryId=:categoryId ";
		}

		$sql .= "ORDER BY RAND() LIMIT :limit";

		$query = $con->prepare($sql);

		if($idCategoria != null){
			$query->bindValue(":categoryId", $idCategoria);
		}

		$query->bindValue(":limit", $limite, PDO::PARAM_INT);
		$query->execute();

		$result = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$result[] = new Entidade($con, $row["id"]);
		}

		return $result;
	}

	public static function getEntidadesFilmes($con, $idCategoria, $limite){

		$sql = "SELECT DISTINCT(entities.id) FROM entities
				INNER JOIN videos ON entities.id = videos.entityId 
				WHERE videos.isMovie = 1 ";

		if($idCategoria != null){
			$sql .= "AND categoryId=:categoryId ";
		}

		$sql .= "ORDER BY RAND() LIMIT :limit";

		$query = $con->prepare($sql);

		if($idCategoria != null){
			$query->bindValue(":categoryId", $idCategoria);
		}

		$query->bindValue(":limit", $limite, PDO::PARAM_INT);
		$query->execute();

		$result = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$result[] = new Entidade($con, $row["id"]);
		}

		return $result;
	}

		public static function getEntidadesBusca($con, $termo){

		$sql = "SELECT * FROM entities WHERE name LIKE CONCAT('%', :termo, '%') LIMIT 30 ";

		$query = $con->prepare($sql);

		$query->bindValue(":termo", $termo);
		$query->execute();

		$result = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$result[] = new Entidade($con, $row);
		}

		return $result;
	}

}
?>