<?php
require_once("includes/header.php");

$provedorPreview = new provedorPreview($con, $usuarioLogado);
echo $provedorPreview->criadorPreview(null);

$containers = new categorias($con, $usuarioLogado);
echo $containers->mostrarCategorias();
?>