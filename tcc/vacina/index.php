<!DOCTYPE html>
<?php 
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    $title = "Cow Counter";
    $consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "2";
    
//Esse código ta puxando tudo o que tem em um banco de dados para a tabela.

    // Métodos para cada operação
    function inserirmsg($codigo){
        $dados = dadosForm();
        //var_dump($dados);

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO vacina (classe, administracao, dosagem, descricao, nome, codigo) VALUES(:classe, :administracao, :dosagem, :descricao, :nome, :codigo)');
        $stmt->bindParam(':classe', $classe, PDO::PARAM_INT);
        $classe = $dados['classe'];

        $stmt->bindParam(':administracao', $administracao, PDO::PARAM_INT);
        $administracao = $dados['administracao'];

        $stmt->bindParam(':dosagem', $dosagem, PDO::PARAM_INT);
        $dosagem = $dados['dosagem'];

        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $descricao = $dados['descricao'];

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $nome = $dados['nome'];

        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $codigo = $dados['codigo'];
    
        $stmt->execute();
        header("location:vacina.php");
    }

    // Busca um item pelo código no BD CERTO
    function buscarmsg($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM vacina WHERE codigo = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['codigo'] = $linha['codigo'];
            $dados['nome'] = $linha['nome'];
            $dados['descricao'] = $linha['descricao'];
            $dados['dosagem'] = $linha['dosagem'];
            $dados['administracao'] = $linha['administracao'];
            $dados['classe'] = $linha['classe'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form CERTO
    function mform(){
        $dados = array();
        $dados['codigo'] = $_POST['codigo'];
        $dados['nome'] = $_POST['nome'];
        $dados['dosagem'] = $_POST['dosagem'];
        $dados['descricao'] = $_POST['descricao'];
        $dados['administracao'] = $_POST['administracao'];
        $dados['classe'] = $_POST['classe'];
        return $dados;
    }


?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="vacinas.php" class="logovacina">Vacinas</a>
          <a href="index.php" class="logo">Cow Counter</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="../index.php">Início</a></li>
            <li><a href="../vender.php">Histórico</a></li>
            <li><a href="../vacina/index.php">Vacinas</a></li>
            <li><a href="../acaoLogin.php?acao=logoff">Sair</a></li>
          </ul>
        </div>
    </nav>
    <div class="container">

<br>
		<!--<form method="post">
            <input type="text" name="consulta" id="consulta" value="">
            <a href="cadvacina.php" class="btn waves-effect waves-light green" type="submit" name="action">
                Inserir nova vacina <i class="material-icons right">add</i>
            </a>
            <button type="submit" value=Pesquisar class="btn waves-effect waves-light green " type="submit" name="action">
                Pesquisar <i class="material-icons right">search</i>
            </button>
    	</form>-->
<br><br>

	<table border="1">
        <tr>
       	<th>Código</th>
        <th>Nome</th>
        <th>Classe</th>
        <th>Descrição</th>
        <th>Dosagem</th>
        <th>Detalhes</th>
    </tr>

    <?php
    $sql = "";
        if ($tipo == 2){
            if ($consulta != '') {
            $sql = "SELECT * FROM vacina WHERE nome = '$consulta' ORDER BY nome";
                } else {
            $sql = "SELECT * FROM vacina ORDER BY codigo";
            }
            } else{    
            $sql = "SELECT * FROM vacina WHERE codigo LIKE '$consulta%' ORDER BY codigo";
            } 
$pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
         while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
    ?>
        <tr>
			<td><?php echo $linha['codigo'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo $linha['classe'];?></td>
            <td><?php echo $linha['descricao'];?></td>
            <td><?php echo $linha['dosagem'];?></td>
            <td><a href='../showvacina.php?id=<?php echo $linha['codigo'];?>'> <img class="icon" src="../img/details/details.png" alt=""> </a></td>
        </tr>
        <?php } ?>      
    </table>
</div>
</div><br><br><br><br>
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
</body>
</html>