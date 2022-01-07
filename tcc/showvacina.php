<!DOCTYPE html>
<?php 
     include_once "conf/default.inc.php";
     require_once "conf/Conexao.php";
     $title = "Cow Counter";
     $id = isset($_GET['id']) ? $_GET['id'] : "1";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function excluirRegistro(url){
            if (confirm("Deseja realmente excluir?"))
                location.href = url; 
        }
    </script>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
        <a href="index.php" class="logo">Cow Counter</a>
        <a href="index.php" class="logocad">Detalhes da vacina</a>

          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php">Início</a></li>
            <li><a href="vender.php">Histórico</a></li>
            <li><a href="vacinas.php">Vacinas</a></li>
            <li><a href="acaoLogin.php?acao=logoff">Sair</a></li>
          </ul>
        </div>
    </nav>
    <div class="container">
    <br>

    <a href="vacina/index.php" class="btn waves-effect waves-light red" type="submit" name="action">
             <i class="material-icons right">arrow_back</i> Voltar
    </a>
<br>    
<br>
        <table border="1">
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Classe</th>
                <th>Descrição</th>
                <th>Dosagem</th>
                <th>Administração</th>
            </tr>
    <?php
        $sql = "SELECT * FROM vacina WHERE codigo = $id";
        $pdo = Conexao::getInstance(); 
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)){
    ?> 
            <tr>
                <td><?php echo $linha['codigo'];?></td>
                <td><?php echo $linha['nome'];?></td>
                <td><?php echo $linha['classe'];?></td>
                <td><?php echo $linha['descricao'];?></td>
                <td><?php echo $linha['dosagem'];?></td>
                <td><?php echo $linha['administracao'];?></td>
            </tr>
        </table>
    
<?php
    }
?>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <section class="footer">
        <div class="container">
        <div class="c1">
            <br><br>            
            <div class="contato">Entre em contato</div><br>
            <div class="c11">
                Rua João Custódio da Luz, 279 - Pouso Redondo<br><br>
                suporte@cowcounter.com<br><br>
                Cel: (47) 99104-7203
            </div>
        </div>
        <br><br>
        <div class="desenvolvedores">Desenvolvedores</div><br> 
        <div class="desen">
            <div class="d1">Igor Vinicius Dos Santos</div> 
            <div class="d2">igorviniciusantos@gmail.com<br><br></div>
            <div class="d1">Carlos Eduardo Ribeiro</div>
            <div class="d2">carloseduardoribeiro@gmail.com</div>              
        </div>
    </section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>