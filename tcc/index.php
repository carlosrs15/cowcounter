<!DOCTYPE html>
<?php 
    $hoje = date('d/m/Y');
    include "valida.php";
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Cow Counter";

    $consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "2";
    $acaomsg = isset($_GET['acaomsg']) ? $_GET['acaomsg'] : "";
    $dados;
    if ($acaomsg == 'editarmsg'){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : "";
        if ($codigo > 0)
            $dados = buscarmsg($codigo);
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title >
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

          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php">Início</a></li>
            <li><a href="vender.php">Histórico</a></li>
            <li><a href="vacina/index.php">Vacinas</a></li>
            <li><a href="acaoLogin.php?acao=logoff">Sair</a></li>
          </ul>
        </div>
    </nav>
      <div class="container">
<br>
  
    <form method="post">
        <div class="row">
            <p>
                <label>
                    <input type="radio" name="tipo" value="1" <?php if ($tipo == 1) { echo "checked"; }?>>
                    <span>Código</span>
                </label>
            </p>

            <p>
                <label>
                    <input type="radio" name="tipo" value="2" <?php if ($tipo == 2) { echo "checked"; }?>>
                    <span>Número do Brinco</span>
                </label>
            </p>
        </div>

        <form method="post">
           <button type="submit" value=Pesquisar class="btn waves-effect waves-light" type="submit" name="action">
                Aplicar <i class="material-icons right">check</i>
           </button>
           <a href="cad.php" class="btn waves-effect waves-light green" type="submit" name="action">
                Inserir novo gado <i class="material-icons right">add</i>
            </a>
        </form>
        <br><br>    
        <form method="post">
            <input type="text" name="consulta" id="consulta" value="<?php echo $consulta; ?>">
            <button type="submit" value=Pesquisar class="btn waves-effect waves-light green " type="submit" name="action">
                Pesquisar <i class="material-icons right">search</i>
            </button>
        </form>
        <br><br>
        <table border="1" class="highlight">
        <tr>
        <th>Código</th>
        <th>Data Nascimento</th>
        <th>Número Brinco</th>
        <th>Gênero</th>
        <th>Peso</th>
        <th>Preço Arroba</th>
        <th>Preço Total</th>
        <th>Detalhes</th> 
        <th>Excluir</th> 
    </tr>

    <?php
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM marca 
    WHERE numeroBrinco LIKE '$consulta%'");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        if(!$linha['vendido'] && $linha['conta']== $_SESSION['id']){
        $valorTotal = floor(($linha['pesoKG'] / 15) * $linha['valorArroba']);
    ?>
        <tr>
            <td><?php echo $linha['codigo'];?></td>
            <td><?php echo date("d/m/Y", strtotime($linha['dataNasc']));?></td>
            <td><?php echo $linha['numeroBrinco'];?></td>
            <td><?php if($linha['genero']==1){ echo "Macho"; }else if($linha['genero']==2){ echo "Femea"; } ?></td>
            <td><?php echo $linha['pesoKG'];?>kg</td>
            <?php echo "<td> R$ {$linha['valorArroba']}</td>";?>
            <?php echo "<td> R$ {$valorTotal}</td>";?>
            <td><a href='show.php?id=<?php echo $linha['codigo'];?>'> <img class="icon" src="img/details/details.png" alt=""> </a></td>
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&codigo=<?php echo $linha['codigo'];?>')"><img class="icon" src="img/excluir/excluir4.png" alt=""></a></td>
        </tr>
   <?php }} ?>
      
    </table>
    </div>

<br><br><br><br>

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
