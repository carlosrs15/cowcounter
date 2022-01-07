<!DOCTYPE html>
 <div class="row">
<?php
include_once "acao.php";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cow Counter</title>
    <script>
        
        function valcodigoa(){
            var obrigatorio = document.getElementById("obrigatorio");
            var nome = document.getElementById("nome");
            var funcao = document.getElementById("funcao");
            var descricao = document.getElementById("descricao");
            if (obrigatorio.value == "") {
                obrigatorio.focus();
                alert("Informe se a vacina é obrigatória.");
                return false;
            }else if (nome.value == "") {
                nome.focus();
                alert("Informe o nome da vacina.");
                return false;
            }else if (funcao.value == ""){
                funcao.focus();
                alert("Informe a função.");
                return false;
            }else if (descricao.value == ""){
                descricao.focus();
                alert("Informe a descrição.");
                return false;
            }
            alert('Animal cadastrado com sucesso!');        
        } 
    </script>
    <div class="container">
        <div class="row">
            <div class="col s6 offset-s4">
                <h3>Cow Counter</h3>
            </div>
        </div>
    <link rel="stylesheet" href="../materialize/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<br>
<div class="row">
        <a href="index.php" class="btn waves-effect waves-light grey darken-1" type="submit" name="action">
            Listar <i class="material-icons right">reorder</i>
        </a>

    </div>
<br>

<form method="post" action="acao.php" >
    Obrigatório   <input  type="text" name="obrigatorio" id="obrigatorio" value="<?php if ($acao == "editar") echo $dados['obrigatorio'] ?>"><br>
    Nome <input type="text" name="nome" id="nome" value="<?php if ($acao == "editar") echo $dados['nome'] ?>"><br>
    Função   <input type="text" name="funcao" id="funcao" value="<?php if ($acao == "editar") echo $dados['funcao']?>"><br>
    Descrição   <input type="text" name="descricao" id="descricao" value="<?php if ($acao == "editar") echo $dados['descricao']?>"><br>
    <button href="index.php" type="submit" name="acao" id="acao" value="salvar" class="btn waves-effect waves-light green"  name="action" onclick="return valcodigoa();">
            Salvar <i class="material-icons right">save</i>
    </button>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
</script>


</body>
</html>
