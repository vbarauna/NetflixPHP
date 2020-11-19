<?php
class temporada{
	private $numeroTemporada, $videos;
	public function __construct($numeroTemporada, $videos){
		$this->numeroTemporada = $numeroTemporada;
		$this->videos = $videos;
	}

	public function getNumeroTemporada(){
		return $this->numeroTemporada;
	}

	public function getVideos(){
		return $this->videos;
	}
}
?>