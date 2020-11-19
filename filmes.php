<?php
require_once("includes/header.php");

$provedorPreview = new provedorPreview($con, $usuarioLogado);
echo $provedorPreview->criadorPreviewFilmes();

$containers = new categorias($con, $usuarioLogado);
echo $containers->mostrarCategoriasFilmes();
?>