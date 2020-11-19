<?php
class Entidade{
	private $con, $dataSQL;

	public function __construct($con, $input) {
		$this->con = $con;

		if(is_array($input)){
			$this->dataSQL = $input;
		}
		else{
			$query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
			$query->bindValue(":id", $input);
			$query->execute();

			$this->dataSQL = $query->fetch(PDO::FETCH_ASSOC);
		}
	}

	public function getId(){
		return $this->dataSQL["id"];
	}

	public function getNome(){
		return $this->dataSQL["name"];
	}

	public function getThumb(){
		return $this->dataSQL["thumbnail"];
	}

	public function getIdCategoria(){
		return $this->dataSQL["categoryId"];
	}

	public function getPreview(){
		return $this->dataSQL["preview"];
	}

	public function getTemporadas(){
		$query = $this->con->prepare("SELECT * FROM videos WHERE entityId=:id AND isMovie = 0 ORDER BY season, episode ASC");
		$query->bindValue(":id", $this->getId());
		$query->execute();

		$temporadas = array();
		$videos = array();
		$temporadaAtual = null;
		while($row = $query->fetch(PDO::FETCH_ASSOC)){

			if($temporadaAtual != null && $temporadaAtual != $row["season"]){
				$temporadas[] = new temporada($temporadaAtual, $videos);
				$videos = array();
			}

			$temporadaAtual = $row["season"];
			$videos[] = new video($this->con, $row);
		}

		if(sizeof($videos) != 0){
			$temporadas[] = new temporada($temporadaAtual, $videos);
		}

		return $temporadas;
	}
}
?>