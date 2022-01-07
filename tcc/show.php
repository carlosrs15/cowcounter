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
<a href="index.php" class="btn waves-effect waves-light red " type="submit" name="action">
             <i class="material-icons right">arrow_back</i> Voltar
    </a>
<br>    
<br>
        <table border="1">
            <tr>
                <th>Código</th>
                <th>Data Contagem</th>
                <th>Data Nascimento</th>
                <th>Número do Brinco</th>
                <th>Gênero</th>
                <th>Peso</th>
                <th>Valor Arroba</th>
                <th>Vacinar</th>
                <th>Vender</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
    <?php
        $sql = "SELECT * FROM marca WHERE codigo = $id";
        $pdo = Conexao::getInstance(); 
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)){
    ?> 
            <tr>
                <td><?php echo $linha['codigo'];?></td>
                <td><?php echo date("d/m/Y", strtotime($linha['dataContagem']));?></td> 
                <td><?php echo date("d/m/Y", strtotime($linha['dataNasc']));?></td>
                <td><?php echo $linha['numeroBrinco'];?></td>
                <td><?php if($linha['genero']==1){ echo "Macho"; }else if($linha['genero']==2){ echo "Femea"; } ?></td>
                <td><?php echo $linha['pesoKG'];?>kg</td>
                <?php echo "<td> R$ {$linha['valorArroba']}</td>";?>
                <td><a href='vacinar/teste.php?id=<?php echo $linha['codigo'];?>'><button class="btn-flat"><i class="material-icons left">colorize</i></button></a></td>
                <td><a href="acao.php?vendido=<?php echo $id;?>"><button class="btn-flat"><img class="icon" src="img/vender/vender.jpg"></button></a></td>
                <td><a href='cad.php?acao=editar&codigo=<?php echo $linha['codigo'];?>'><img class="icon" src="img/editar/edit3.png" alt=""></a></td>
                <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&codigo=<?php echo $linha['codigo'];?>')"><img class="icon" src="img/excluir/excluir4.png" alt=""></a></td>
            </tr>
        </table>
     
<?php
$codigoboi = $linha['codigo'];  
}
?>
<br><br>
<table border="1">
            <tr>
                <th>Código</th>
                <th>Nome da vacina</th>
                <th>Data da vacinação</th>
            </tr>
    <?php
        $sh = "SELECT  vacina.nome, vacinagado.datavacina, vacinagado.boicodigo,vacinagado.vacinacodigo,vacina.codigo
        FROM vacina JOIN vacinagado WHERE vacinagado.boicodigo=$codigoboi AND vacinagado.vacinacodigo = vacina.codigo GROUP BY vacina.codigo";
        $pdo = Conexao::getInstance(); 
        $consulta = $pdo->query($sh);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)){
            if($codigoboi == $linha['boicodigo']){
    ?> 
            <tr>
                <td><?php echo $linha['codigo'];?></td>
                <td><?php echo $linha['nome'];?></td>
                <td><?php echo date("d/m/Y", strtotime($linha['datavacina']));?></td>
            </tr>
     
<?php
    }}
?>


</table>
</div>

</div><br><br><br><br><br><br><br><br>
<br><br><br>    <section class="footer">
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