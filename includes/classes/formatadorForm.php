<?php
	class formatadorForm{
		public static function formatarString($inputText){
			$inputText = strip_tags($inputText);
			$inputText = trim($inputText);
			$inputText = strtolower($inputText);
			$inputText = ucfirst($inputText);
			return $inputText;
		}

		public static function formatarUsuario($inputText){
			$inputText = strip_tags($inputText);
			$inputText = str_replace(" ", "", $inputText);
			return $inputText;
		}

		public static function formatarSenha($inputText){
			$inputText = strip_tags($inputText);
			return $inputText;
		}

		public static function formatarEmail($inputText){
			$inputText = strip_tags($inputText);
			$inputText = str_replace(" ", "", $inputText);
			return $inputText;
		}
	}
?>