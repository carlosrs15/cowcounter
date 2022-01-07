<!DOCTYPE html>
 <div class="row">
<?php
include_once "acao.php";
include "valida.php";
$consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : "";
    if ($codigo > 0)
        $dados = buscarDados($codigo);
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/estilo.css">

    <title>Cow Counter</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    
    </script>
    <script>
        
      function valcodigoa(){
            var numeroBrinc = document.getElementById("numeroBrinco");
            var numeroBrinco = numeroBrinc.value;
            var valorArroba = document.getElementById("valorArroba");
            var pesoKG = document.getElementById("pesoKG");
            var dataNasc = document.getElementById("dataNasc");
            if (dataNasc.value == "") {
                dataNasc.focus();
                alert("Informe a data do nascimento do animal.");
                return false;
            }else if (numeroBrinco.value == ""){
                numeroBrinco.focus();
                alert("Informe o número do brinco.");
                return false;
            }else if (numeroBrinco.length != 6){
                alert('O número do brinco deve contem 6 dígitos numéricos');
                return false;
            }/*else if (numeroBrinco.value == 111111){
                alert('Já existe um gado com esta numeração de brinco.');
                return false;
            }*/ else if (pesoKG.value == ""){
                pesoKG.focus();
                alert("Informe o peso do animal.");
                return false;
            } else if (pesoKG.value <= 0){
                alert("O peso do animal deve ser maior que 0.");
                return false;
            } else if (valorArroba.value == ""){
                valorArroba.focus();
                alert("Informe o valor da arroba.");
                return false;
            } 
            alert('Animal cadastrado com sucesso!');        
        }
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, options);
        }); 
    </script>
    <nav>
        <div class="nav-wrapper">
        <a href="index.php" class="logo">Cow Counter</a>
        <a href="index.php" class="logocad">Cadastro do Gado</a>

          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php">Início</a></li>
            <li><a href="vender.php">Histórico</a></li>
            <li><a href="vacinas.php">Vacinas</a></li>
            <li><a href="acaoLogin.php?acao=logoff">Sair</a></li>
          </ul> 
        </div> 
    </nav>
    <div class="container">
    
        <link href="https://materializecss.com/css/prism.css" rel="stylesheet">
        <link href="https://materializecss.com/css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<br>
<div class="row">
         <a href="index.php" class="btn waves-effect waves-light red " type="submit" name="action">
             <i class="material-icons right">arrow_back</i> Voltar
    </a>

    </div>
<br>

<form method="post" action="acao.php" >
    Código          <input readonly  type="text" name="codigo" id="codigo" value="<?php if ($acao == "editar") echo $dados['codigo']; else echo 0; ?>"><br>
    Código do usuário         <input readonly  type="text" name="conta" id="conta" value="<?php  echo $_SESSION['id']; ?>"><br>
    Data Contagem   <input  type="date" name="dataContagem" id="dataContagem" value="<?php if ($acao == "editar") echo $dados['dataContagem'] ?>"><br>
    Data Nascimento * <input type="date" name="dataNasc" id="dataNasc" value="<?php if ($acao == "editar") echo $dados['dataNasc'] ?>"><br>
    Número Brinco *   <input placeholder="Ex: 123456" type="text" maxlength="6" name="numeroBrinco" id="numeroBrinco" value="<?php if ($acao == "editar") echo $dados['numeroBrinco']?>"><br>
    Gênero *
            <select name="genero">
            <?php 
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM genero
                    WHERE genero
                    LIKE '$consulta%'");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                    echo '<option name="genero" value="'.$linha['codigo'].'"';
                    if ($acao == "editar" && $linha['genero'] == $linha['codigo'])
                        echo ' selected';
                    echo '>'.$linha['genero'].'</option>';
                }
            ?>
            </select><br>
    Peso KG *         <input placeholder="Peso em kilogramas" type="number" name="pesoKG" id="pesoKG" value="<?php if ($acao == "editar") echo $dados['pesoKG'] ?>"><br>
    Valor Arroba *    <input placeholder="R$" type="number" name="valorArroba" id="valorArroba" value="<?php if ($acao == "editar") echo $dados['valorArroba'] ?>"><br>
    <br>
    <button href="index.php" type="submit" name="acao" id="acao" value="salvar" class="btn waves-effect waves-light green"  name="action" onclick="return valcodigoa();">
            Salvar <i class="material-icons right">save</i>
    </button>
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
    </div><br><br><br>
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

</body>
</html>
