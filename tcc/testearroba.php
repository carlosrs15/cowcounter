<!DOCTYPE html>
<?php
?> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>  </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        document.getElementBy
    </script>
    
</head>
<body>
    
    <nav>
        <div class="nav-wrapper">
          <a href="#" class="logo">Cow Counter</a>

          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php">Início</a></li>
            <li><a href="vender.php">Histórico</a></li>
            <li><a href="vacina/index.php">Vacinas</a></li>
            <li><a href="acaoLogin.php?acao=logoff">Sair</a></li>
          </ul>
        </div> 
    </nav>
    <div class="container">
        <?php 
            $url ='https://www.canalrural.com.br/cotacao/boi-gordo/';
            $homepage = 'https://economia.uol.com.br/cotacoes/cambio/';
            $dados = file_get_contents($url);
            $var1 = explode('<div class="boi-gordo">',$dados);
            $var2 = explode('</tbody>',$var1[1]);
            print $var2[0];




        ?>
        
    </div>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
