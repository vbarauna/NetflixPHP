<?php

    require_once("includes/config.php");
    require_once("includes/classes/formatadorForm.php");
    require_once("includes/classes/constantes.php");
    require_once("includes/classes/conta.php");
    
?>

<!DOCTYPE html>
<html>

<head>

    <head lang="pt-br">
        <meta charset="UTF-8">
        <title>Adeus :'(</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css" />


        <script type="text/javascript">
        var contador = 15;

        function contar() {
            document.getElementById('contador').innerHTML = contador;
            contador--;
        }

        function redirecionar() {
            contar();
            if (contador == 0) {
                document.location.href = 'logoutexclusao.php';
            }
        }
        setInterval(redirecionar, 1000);
        </script>

    </head>

<body>
    <div class="cadastro">
        <div class="colunas">
            <div class="header">
                <img src="assets/images/logo2.png" title="Logo" alt="Logo do Site" />
                <b>
                    <h1 style="text-align: left;">Vamos sentir saudades...</h1>
                        <span style="text-align: justify;">É uma pena que você não queira mais nossos serviços.</span>
                        <br>
                        <span style="text-align: justify;">Mas esperamos te ver em breve!</span><br><br><br>
                        <p>Você será redirecionado em <label id="contador"></label> segundos.</p>
                        <h6>Caso isso não aconteça, <a href="logoutexclusao.php" style="color: #dc1928;">clique aqui.</a></h6>
                </b>
            </div>
        </div>
    </div>
</body>

</html>