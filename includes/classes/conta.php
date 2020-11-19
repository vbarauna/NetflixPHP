<?php
class conta {

	private $con;
	private $arrayErro = array();

	public function __construct($con){
		$this->con = $con;
	}

	public function atualizarDetalhes($n, $sn, $em, $nu){
		$this->validarNome($n);
		$this->validarSobrenome($sn);
		$this->validarNovoEmail($em, $nu);

		if(empty($this->arrayErro)){
			$query = $this->con->prepare("UPDATE usuarios SET nome=:n, sobrenome=:sn, email=:em 
											WHERE nomeUsuario=:nu");

			$query->bindValue(":n", $n);
			$query->bindValue(":sn", $sn);
			$query->bindValue(":em", $em);
			$query->bindValue(":nu", $nu);
		
			return $query->execute();
		}

		return false;
	}

	public function registro($n, $sn, $nu, $em, $em2, $se, $se2){
		$this->validarNome($n);
		$this->validarSobrenome($sn);
		$this->validarNomeUsuario($nu);
		$this->validarEmail($em, $em2);
		$this->validarSenhas($se, $se2);

		if(empty($this->arrayErro)){
			return $this->inserirDetalhes($n, $sn, $nu, $em, $se);
		}
		
		return false;
	}

	public function login($nu, $se){
		$se = hash("sha512", $se);

		$query = $this->con->prepare("SELECT * FROM usuarios WHERE nomeUsuario=:nu AND senha=:se");

		$query->bindValue(":nu", $nu);
		$query->bindValue(":se", $se);

		$query->execute();

		if($query->rowCount() == 1){
			return true;
		}

		array_push($this->arrayErro, Constantes::$loginFalhou);

		return false;
	}

	private function inserirDetalhes($n, $sn, $nu, $em, $se){
		$se = hash("sha512", $se);

		$query = $this->con->prepare("INSERT INTO usuarios (nome, sobrenome, nomeUsuario, email, senha) VALUES (:n, :sn, :nu, :em, :se)");
		$query->bindValue(":n", $n);
		$query->bindValue(":sn", $sn);
		$query->bindValue(":nu", $nu);
		$query->bindValue(":em", $em);
		$query->bindValue(":se", $se);

		return $query->execute();
	}

	private function validarNome($n){
		if(strlen($n) < 2 || strlen($n) > 25){
			array_push($this->arrayErro, constantes::$caracteresNome);
		}
	}

	private function validarSobrenome($sn){
		if(strlen($sn) < 2 || strlen($sn) > 30){
			array_push($this->arrayErro, constantes::$caracteresSobrenome);
		}
	}

	private function validarNomeUsuario($nu){
		if(strlen($nu) < 2 || strlen($nu) > 30){
			array_push($this->arrayErro, constantes::$caracteresNomeUsuario);
			return;
		}

		$query = $this->con->prepare("SELECT * FROM usuarios WHERE nomeUsuario=:nu");
		$query->bindValue(":nu", $nu);

		$query->execute();

		if($query->rowCount() !=0){
			array_push($this->arrayErro, constantes::$nomeUsuarioUsado);
		}
	}

	private function validarEmail($em, $em2){
		if($em != $em2){
			array_push($this->arrayErro, constantes::$emailNaoConfere);
			return;
		}

		if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
			array_push($this->arrayErro, constantes::$emailInvalido);
			return;
		}

		$query = $this->con->prepare("SELECT * FROM usuarios WHERE email=:em");
		$query->bindValue(":em", $em);

		$query->execute();

		if($query->rowCount() !=0){
			array_push($this->arrayErro, constantes::$emailUsado);
		}
	}
	
	private function validarNovoEmail($em, $nu){
		
		if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
			array_push($this->arrayErro, constantes::$emailInvalido);
			return;
		}

		$query = $this->con->prepare("SELECT * FROM usuarios WHERE email=:em AND nomeUsuario != :nu");
		$query->bindValue(":em", $em);
		$query->bindValue(":nu", $nu);

		$query->execute();

		if($query->rowCount() !=0){
			array_push($this->arrayErro, constantes::$emailUsado);
		}
	}

	private function validarSenhas($se, $se2){
		if($se != $se2){
			array_push($this->arrayErro, constantes::$senhaNaoConfere);
			return;
		}
			if(strlen($se) < 5 || strlen($se) > 25){
			array_push($this->arrayErro, constantes::$caracteresSenha);
		}
	}

	public function getErro($erro){
		if(in_array($erro, $this->arrayErro)){
			return "<span class='mensagemErro'>$erro</span>";
		}
	}

	public function getPrimeiroErro(){
		if(!empty($this->arrayErro)){
			return $this->arrayErro[0];
		}
	}

	public function atualizarSenha($seA, $se, $se2, $nu){
		$this->validarSenhaAntiga($seA, $nu);
		$this->validarSenhas($se, $se2);

		if(empty($this->arrayErro)){
			$query = $this->con->prepare("UPDATE usuarios SET senha=:se	WHERE nomeUsuario=:nu");
			$se = hash("sha512", $se);
			$query->bindValue(":se", $se);
			$query->bindValue(":nu", $nu);
		
			return $query->execute();
		}

		return false;
	}

	public function validarSenhaAntiga($seA, $nu){
		$se = hash("sha512", $seA);

		$query = $this->con->prepare("SELECT * FROM usuarios WHERE nomeUsuario=:nu AND senha=:se");
		$query->bindValue(":nu", $nu);
		$query->bindValue(":se", $se);

		$query->execute();

		if($query->rowCount() == 0){
			array_push($this->arrayErro, constantes::$senhaIncorreta);
		}
	}

	public function excluirConta($nu){
		$query = $this->con->prepare("DELETE FROM usuarios WHERE nomeUsuario=:nu");

		$query->bindValue(":nu", $nu);		
		$query->execute();
	}
}
?>