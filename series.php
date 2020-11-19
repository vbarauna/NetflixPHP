<?php
require_once("includes/header.php");

$provedorPreview = new provedorPreview($con, $usuarioLogado);
echo $provedorPreview->criadorPreviewSeries();

$containers = new categorias($con, $usuarioLogado);
echo $containers->mostrarCategoriasSeries();
?>