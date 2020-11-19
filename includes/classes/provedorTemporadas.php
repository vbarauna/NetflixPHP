<?php
class provedorTemporadas{
	private $con, $nomeUsuario;

	public function __construct($con, $nomeUsuario){
		$this->con = $con;
		$this->nomeUsuario = $nomeUsuario;
	}

	public function criar($entidade){
		$temporadas = $entidade->getTemporadas();

		if(sizeof($temporadas) == 0){
			return;
		}

		$temporadasHTML = "";

		foreach ($temporadas as $temporada) {
			$numeroTemporada = $temporada->getNumeroTemporada();

			$videosHTML = "";
			foreach ($temporada->getVideos() as $video) {
				$videosHTML .= $this->criarVideo($video);
			}

			$temporadasHTML .= "<div class='temporada'> 
									<h3> Temporada $numeroTemporada </h3>
									<div class='videos'>
										$videosHTML
									</div>
								</div>";
		}

		return $temporadasHTML;
	}

	private function criarVideo($video){
		$id = $video->getId();
		$thumbnail = $video->getThumb();
		$titulo = $video->getTitulo();
		$descricao = $video->getDescricao();
		$numeroEpisodio = $video->getNumeroEpisodio();
		$jaAssistido = $video->jaAssistido($this->nomeUsuario) ? "<i class='fas fa-check-circle seen'></i>" : "";

		return "<a href='assistir.php?id=$id'> 
					<div class='episodio'>
						<div class='conteudo'>

							<img src='$thumbnail'>

							<div class='informacaoVideo'>
								<h4>$numeroEpisodio. $titulo</h4>
								<span>$descricao</span>
							</div>
							
							$jaAssistido

						</div>
					</div>
				</a>";

	}
}
?>


