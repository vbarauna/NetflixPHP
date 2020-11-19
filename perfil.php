<?php
require_once("includes/header.php");
require_once("includes/classes/conta.php");
require_once("includes/classes/formatadorForm.php");
require_once("includes/classes/constantes.php");

$mensagemDetalhes = "";
$mensagemSenhas = "";

if(isset($_POST["botaoSalvarDetalhes"])){
    $conta = new conta($con);

    $nome = formatadorForm:: formatarString($_POST["nome"]);
    $sobrenome = formatadorForm:: formatarString($_POST["sobrenome"]);
    $email = formatadorForm:: formatarEmail($_POST["email"]);

    if($conta->atualizarDetalhes($nome, $sobrenome, $email, $usuarioLogado)){
        // Dados alterados com sucesso
        $mensagemDetalhes = "<div class='alertaSucesso'>
                                Dados alterados com sucesso!
                            </div>";
    }
    else{
        // Falha ao alterar dados
        $mensagemErro = $conta->getPrimeiroErro();

        $mensagemDetalhes = "<div class='alertaErro'>
                                $mensagemErro
                            </div>";
    }
}

if(isset($_POST["botaoSalvarSenhas"])){
    $conta = new conta($con);

    $senhaAntiga = formatadorForm:: formatarSenha($_POST["senhaAntiga"]);
    $novaSenha = formatadorForm:: formatarSenha($_POST["novaSenha"]);
    $novaSenha2 = formatadorForm:: formatarSenha($_POST["novaSenha2"]);

    if($conta->atualizarSenha($senhaAntiga, $novaSenha, $novaSenha2, $usuarioLogado)){
        // Dados alterados com sucesso
        $mensagemSenhas = "<div class='alertaSucesso'>
                                Senha alterada com sucesso!
                            </div>";
    }
    else{
        // Falha ao alterar dados
        $mensagemErro = $conta->getPrimeiroErro();

        $mensagemSenhas = "<div class='alertaErro'>
                                $mensagemErro
                            </div>";
    }
}



?>

<div class="containerConfiguracoes colunas">

    <div class="formSection">

        <form method="POST">

            <h2>Detalhes do Usuário</h2>

            <?php
            $usuario = new Usuario($con, $usuarioLogado);

            $nome = isset($_POST["nome"]) ? ($_POST["nome"]) : $usuario->getNome();
            $sobrenome = isset($_POST["sobrenome"]) ? ($_POST["sobrenome"]) : $usuario->getSobrenome();
            $email = isset($_POST["email"]) ? ($_POST["email"]) : $usuario->getEmail();
            
            ?>

            <input type="text" name="nome" placeholder="Nome" value="<?php echo $nome; ?>">
            <input type="text" name="sobrenome" placeholder="Sobrenome" value="<?php echo $sobrenome; ?>">
            <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">

            <div class="mensagem">
                <?php echo $mensagemDetalhes; ?>
            </div>

            <input type="submit" name="botaoSalvarDetalhes" value="Salvar!">

        </form>

    </div>

    <div class="formSection">

        <form method="POST">

            <h2>Atualizar Dados</h2>

            <input type="password" name="senhaAntiga" placeholder="Senha Antiga">
            <input type="password" name="novaSenha" placeholder="Nova Senha">
            <input type="password" name="novaSenha2" placeholder="Confirmar Nova Senha">

            <div class="mensagem">
                <?php echo $mensagemSenhas; ?>
            </div>

            <input type="submit" name="botaoSalvarSenhas" value="Atualizar!" style="cursor:pointer">
            
            
            <a href="deletaconta.php" class="botaoExcluir">Excluir Conta</a>
            
            

        </form>

    </div>

</div>