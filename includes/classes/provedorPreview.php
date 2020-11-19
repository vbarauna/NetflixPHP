<?php 
class provedorPreview{
	private $con, $nomeUsuario;

	public function __construct($con, $nomeUsuario){
		$this->con = $con;
		$this->nomeUsuario = $nomeUsuario;
	}

	public function criadorCategoriaPreview($idCategoria){
		$arrayEntidades = provedorEntidade::getEntidades($this->con, $idCategoria, 1);

		if(sizeof($arrayEntidades) == 0){
			mensagemErro::show("Sem filmes para mostrar");
		}
		return $this->criadorPreview($arrayEntidades[0]);
	}

	public function criadorPreviewSeries(){
		$arrayEntidades = provedorEntidade::getEntidadesSeries($this->con, null, 1);

		if(sizeof($arrayEntidades) == 0){
			mensagemErro::show("Sem series para mostrar");
		}
		return $this->criadorPreview($arrayEntidades[0]);
	}

	public function criadorPreviewFilmes(){
		$arrayEntidades = provedorEntidade::getEntidadesFilmes($this->con, null, 1);

		if(sizeof($arrayEntidades) == 0){
			mensagemErro::show("Sem filmes para mostrar");
		}
		return $this->criadorPreview($arrayEntidades[0]);
	}

	public function criadorPreview($entidade){
		if($entidade == null){
			$entidade = $this->getEntRandom();
		}

		$id = $entidade->getId();
		$nome = $entidade->getNome();
		$thumbnail = $entidade->getThumb();
		$preview = $entidade->getPreview();

		$idVideo = provedorVideo::getEntidadePorUsuario($this->con, $id, $this->nomeUsuario);
		$video = new video($this->con, $idVideo);

		$emProgresso = $video->emProgresso($this->nomeUsuario);
		$botaoPlay = $emProgresso ? " Continue a assistir" : " Play";
		$episodioTemporada = $video->getTempEpi();
		$subCabecalho = $video->verificaFilme() ? "" : "<h4>$episodioTemporada</h4>";


		return "<div class='previewContainer'>
					<img src='$thumbnail' class='imagemPreview' hidden>

					<video autoplay muted class='videoPreview' onended='finalPreview()'>
						<source src='$preview' type='video/mp4'>
					</video>

					<div class='interfacePreview'>
						<div class='detalhesPrincipais'>
							<h3>$nome</h3>
							$subCabecalho
								<div class='botoes'>
									<button onclick='playVideo($idVideo)'><i class='fas fa-play-circle'></i>$botaoPlay</button>
									<button onclick='desMutar(this)'><i class='fas fa-volume-mute'></i></button>
								</div>
						</div>
					</div>	
				</div>";
	}

	public function criadorTelaPreview($entidade){
		$id = $entidade->getId();
		$thumbnail = $entidade->getThumb();
		$nome = $entidade->getNome();

		return "<a href='Entidade.php?id=$id'>
					<div class='previewContainer small'>
						<img src='$thumbnail' title='$nome'>
					</div>
				</a>";
	}

	private function getEntRandom(){
		
		$entidade = provedorEntidade::getEntidades($this->con, null, 1);
		return $entidade[0];
	}
}
?>