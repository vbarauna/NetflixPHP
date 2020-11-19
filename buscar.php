<?php 
include_once("includes/header.php");
?>

<div class="caixaBusca">
	<input type="text" class="busca" placeholder="O que deseja assistir?">
</div>

<div class="resultados">
	
</div>

<script type="text/javascript">
	$(function(){
		var nomeUsuario = '<?php echo $usuarioLogado; ?>';
		var timer;

		$(".busca").keyup(function(){
			clearTimeout(timer);

			timer = setTimeout(function(){
				var val = $(".busca").val();
				
				if(val != ""){
					$.post("ajax/getResultados.php", { termo: val, nomeUsuario: nomeUsuario}, function(data) {
							$(".resultados").html(data);
						})
				}
				else{
					$(".resultados").html("");
				}

			}, 500);
		})
	})
</script>