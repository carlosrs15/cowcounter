<!DOCTYPE html>
<?php 
     include_once "../conf/default.inc.php";
     require_once "../conf/Conexao.php";
     $title = "Cow Counter";
     $id = isset($_GET['id']) ? $_GET['id'] : "1";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="https://materializecss.com/css/prism.css" rel="stylesheet">
    <link href="https://materializecss.com/css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilo.css">
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

          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php">Início</a></li>
            <li><a href="vender.php">Histórico</a></li>
            <li><a href="vacina/index.php">Vacinas</a></li>
            <li><a href="acaoLogin.php?acao=logoff">Sair</a></li>
          </ul>
        </div>
    </nav>

    <div class="container">

    <br><br>
    <!--<a href="cad.php?acao=editar&codigo=<?php echo $id;?>" class="btn waves-effect waves-light" type="submit" name="action">
            Alterar <i class="material-icons right">visibility</i>
    </a>-->
    <a href="../index.php" class="btn waves-effect waves-light red " type="submit" name="action">
             <i class="material-icons right">arrow_back</i> Voltar
    </a>
<br>    
<br>
<form method="post" action="acao.php" >
    <?php
        $sql = "SELECT * FROM marca WHERE codigo = $id";
        $pdo = Conexao::getInstance(); 
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)){
            $codigo =$linha['codigo'];
                }
                ?>
                Código          <input readonly  type="text" name="boicodigo" id="boicodigo" value="<?php echo $codigo ?>"><br>
                <input style="display:none" type="text" name="datavacina" id="datavacina" value="<?php echo date('Y-m-d') ?>">
                Selecione a vacina
                <select name="vacinacodigo">
                    <?php 
                    $vac = "SELECT * FROM vacina WHERE nome = nome";
                    $pdo = Conexao::getInstance(); 
                    $consulta = $pdo->query($vac);
                    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                        echo '<option name="vacina" value="'.$linha['codigo'].'"';
                        if ($linha['nome'] == $linha['codigo'])
                        echo ' selected';
                        echo '>'.$linha['nome'].'</option>';
                    }
                    ?>
                    </select>
                    <button href="index.php" type="submit" name="acao" id="acao" value="salvar" class="btn waves-effect waves-light green"  name="action" onclick="return valcodigoa();">
                    Salvar <i class="material-icons right">save</i>
                    </button>
                </div>



</form>




    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>if (!window.jQuery) { document.write('<script src="bin/jquery-3.2.1.min.js"><\/script>'); }
    </script>
    <script src="https://materializecss.com/docs/js/jquery.timeago.min.js"></script>
    <script src="https://materializecss.com/docs/js/prism.js"></script>
    <script src="https://materializecss.com/docs/js/lunr.min.js"></script>
    <script src="https://materializecss.com/docs/js/search.js"></script>
    <script src="https://materializecss.com/bin/materialize.js"></script>
    <script src="https://materializecss.com/docs/js/init.js"></script>

</body>
</html>