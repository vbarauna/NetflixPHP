<?php
class video{
	private $con, $dataSQL, $entidade;

	public function __construct($con, $input) {
		$this->con = $con;

		if(is_array($input)){
			$this->dataSQL = $input;
		}
		else{
			$query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
			$query->bindValue(":id", $input);
			$query->execute();

			$this->dataSQL = $query->fetch(PDO::FETCH_ASSOC);
		}

		$this->entidade = new Entidade($con, $this->dataSQL["entityId"]);
	}

	public function getId(){
		return $this->dataSQL["id"];
	}

	public function getIdEntidade(){
		return $this->dataSQL["entityId"];
	}

	public function getTitulo(){
		return $this->dataSQL["title"];
	}

	public function getDescricao(){
		return $this->dataSQL["description"];
	}

	public function getDiretorio(){
		return $this->dataSQL["filePath"];
	}

	public function getThumb(){
		return $this->entidade->getThumb();
	}

	public function getNumeroEpisodio(){
		return $this->dataSQL["episode"];
	}

	public function getNumeroTemporada(){
		return $this->dataSQL["season"];
	}

	public function getTempEpi(){
		if($this->verificaFilme()){
			return;
		}

		$temporada = $this->getNumeroTemporada();
		$episodio = $this->getNumeroEpisodio();

		return "Temporada $temporada, Episodio $episodio";
	}

	public function verificaFilme(){
		return $this->dataSQL["isMovie"] == 1;
	}

	public function emProgresso($nomeUsuario){
		$query = $this->con->prepare("SELECT * FROM progressoVideo
									WHERE idVideo=:idVideo AND nomeUsuario=:nomeUsuario");
		$query->bindValue(":idVideo", $this->getId());
		$query->bindValue(":nomeUsuario", $nomeUsuario);
		$query->execute();

		return $query->rowCount() != 0;
	}

	public function jaAssistido($nomeUsuario){
		$query = $this->con->prepare("SELECT * FROM progressoVideo
									WHERE idVideo=:idVideo AND nomeUsuario=:nomeUsuario AND terminado = 1");
		
		$query->bindValue(":idVideo", $this->getId());
		$query->bindValue(":nomeUsuario", $nomeUsuario);
		$query->execute();

		return $query->rowCount() != 0;

	}
}
?>