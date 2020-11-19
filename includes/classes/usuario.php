<?php
class Usuario{
    private $con, $sqlData;

    public function __construct($con, $nomeUsuario){
        $this->con = $con;

        $query = $con->prepare("SELECT * FROM usuarios WHERE nomeUsuario=:nomeUsuario");
        $query->bindValue(":nomeUsuario", $nomeUsuario);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getNome(){
        return $this->sqlData["nome"];
    }

    public function getSobrenome(){
        return $this->sqlData["sobrenome"];
    }

    public function getEmail(){
        return $this->sqlData["email"];
    }
}
?>