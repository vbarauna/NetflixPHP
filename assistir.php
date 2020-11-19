<?php
$escondeBarraNaveg = true;
require_once("includes/header.php");

	if(!isset($_GET["id"])) {
    	mensagemErro::show("Sem ID declarada na URL");
	}

	$video = new video($con, $_GET["id"]);
	$videoASeguir = provedorVideo::getASeguir($con, $video);
?>

<div class="localAssistir">

	<div class="controlesVideo navegacao">
		<button onclick="voltar()"><i class="fas fa-arrow-circle-left"></i></button>
		<h1><?php echo $video->getTitulo();?></h1>
	</div>

	<div class="controlesVideo aSeguir" style="display:none">
		<button onclick="resetVideo()"><i class="fas fa-redo"></i></button>
		<div class="conteudoASeguir">
			<h2>A Seguir:</h2>
			<h3><?php echo $videoASeguir->getTitulo(); ?></h3>
			<h3><?php echo $videoASeguir->getTempEpi(); ?></h3>

			<button class="playASeguir" onclick="playVideo(<?php echo $videoASeguir->getId(); ?>)"><i class="fas fa-play-circle"></i> Play</button>
		</div>
	</div>

	<video controls autoplay onended="mostrarASeguir()"> 
		<source src='<?php echo $video->getDiretorio(); ?>' type="video/mp4">
	</video>
</div>
<script>
	iniVideo("<?php echo $video->getId(); ?>", "<?php echo $usuarioLogado; ?>");
</script>