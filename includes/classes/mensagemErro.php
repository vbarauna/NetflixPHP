<?php
	class mensagemErro{
		public static function show($texto){
			exit("<span class='bannerErro'>$texto</span>");
		}
	}
?>