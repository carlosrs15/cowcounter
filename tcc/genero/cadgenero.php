<!DOCTYPE html>
 <div class="row">
<?php
include_once "acaogenero.php";
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
    <meta name="viewport" content="wcodigoth=device-wcodigoth, initial-scale=1.0">
    <title>Cow Counter</title>
    <script>
        function valcodigoa(){
            var genero = document.getElementById("genero");
            if (genero.value == "") {
                genero.focus();
                alert("Insira o gênero.");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
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

<form method="post" action="acaogenero.php" >
    Código          <input readonly  type="text" name="codigo" id="codigo" value="<?php if ($acao == "editar") echo $dados['codigo']; else echo 0; ?>"><br>
    Gênero  <input  type="text" name="genero" id="genero" value="<?php if ($acao == "editar") echo $dados['genero'] ?>"><br>
    <button href="index.php" type="submit" name="acao" id="acao" value="salvar" class="btn waves-effect waves-light green"  name="action" onclick="return valcodigoa();">
            Salvar <i class="material-icons right">save</i>
    </button>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
</script>


</body>
</html>