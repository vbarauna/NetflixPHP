<?php 
class categorias{
	private $con, $nomeUsuario;

	public function __construct($con, $nomeUsuario){
		$this->con = $con;
		$this->nomeUsuario = $nomeUsuario;
	}

	public function mostrarCategorias(){
		$query = $this->con->prepare("SELECT * FROM categories");
		$query->execute();

		$html = "<div class='previewCategorias'>";

		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$html .= $this->getCategoriasHTML($row, null, true, true);
		}

		return $html . "</div>";
	}

	public function mostrarCategoriasSeries(){
		$query = $this->con->prepare("SELECT * FROM categories");
		$query->execute();

		$html = "<div class='previewCategorias'>
					<h1>Séries</h1>";

		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$html .= $this->getCategoriasHTML($row, null, true, false);
		}

		return $html . "</div>";
	}

	public function mostrarCategoriasFilmes(){
		$query = $this->con->prepare("SELECT * FROM categories");
		$query->execute();

		$html = "<div class='previewCategorias'>
					<h1>Filmes</h1>";

		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$html .= $this->getCategoriasHTML($row, null, false, true);
		}

		return $html . "</div>";
	}

	private function getCategoriasHTML($dataSQL, $titulo, $series, $filmes){
		$idCategoria = $dataSQL["id"];
		$titulo = $titulo == null ? $dataSQL["name"] : $titulo;

		if($series && $filmes){
			$entidades = provedorEntidade::getEntidades($this->con, $idCategoria, 30);
		}

		else if($series){
			$entidades = provedorEntidade::getEntidadesSeries($this->con, $idCategoria, 30);
		}

		else {
			$entidades = provedorEntidade::getEntidadesFilmes($this->con, $idCategoria, 30);			
		}

		if(sizeof($entidades)==0){
			return;
		}

		$entidadesHTML = "";
		$provedorPreview = new provedorPreview($this->con, $this->nomeUsuario);
		foreach ($entidades as $entidade) {
			$entidadesHTML .= $provedorPreview->criadorTelaPreview($entidade);
			
		}

		return "<div class='categorias'>
					<a href='categoria.php?id=$idCategoria'>
						<h3>$titulo</h3>
					</a>
					<div class='entidades'>
						$entidadesHTML
					</div>
				</div>";
	}
}
?>