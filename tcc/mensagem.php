<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Cow Counter";
    $consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "1";
?>

<?php  

    $acaomsg = isset($_GET['acaomsg']) ? $_GET['acaomsg'] : "";
    if ($acaomsg == "excluir"){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;
        excluir($codigo);
    }

    // Se foi enviado via POST para acaomsg entra aqui CERTO
    $acaomsg = isset($_POST['acaomsg']) ? $_POST['acaomsg'] : "";
    if ($acaomsg == "salvar"){
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        if ($codigo == 0)
            inserirmsg($codigo);
        else
            editarmsg($codigo);
    }


    // Métodos para cada operação
    function inserirmsg($codigo){
        $dados = msgform();
        //var_dump($dados);

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO mensagem (mensagem, assunto, endereco, telefone, email, nome) VALUES(:mensagem, :assunto, :endereco, :telefone, :email, :nome)');
        $stmt->bindParam(':mensagem', $mensagem, PDO::PARAM_INT);
        $mensagem = $dados['mensagem'];

        $stmt->bindParam(':assunto', $assunto, PDO::PARAM_INT);
        $assunto = $dados['assunto'];

        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_INT);
        $endereco = $dados['endereco'];

        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $telefone = $dados['telefone'];

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $email = $dados['email'];

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $nome = $dados['nome'];
    
        $stmt->execute();
        header("location:cad.php");
    }

    function editarmsg($codigo){        
        $dados = msgform();
        $pdo = Conexao::getInstance();

        $stmt = $pdo->prepare('UPDATE mensagem SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, assunto = :assunto, mensagem = :mensagem   WHERE codigo = :codigo');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_INT);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR); 
        $stmt->bindParam(':assunto', $assunto, PDO::PARAM_INT);
        $stmt->bindParam(':mensagem', $mensagem, PDO::PARAM_INT);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $nome = $dados['nome'];
        $email = $dados['email'];
        $endereco = $dados['endereco'];
        $telefone = $dados['telefone'];
        $assunto = $dados['assunto'];
        $mensagem = $dados['mensagem'];
        $codigo = $dados['codigo'];
        $stmt->execute();
        header("location:index.php");
    }

    // Busca um item pelo código no BD CERTO
    function buscarmsg($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM mensagem WHERE codigo = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['codigo'] = $linha['codigo'];
            $dados['nome'] = $linha['nome'];
            $dados['email'] = $linha['email'];
            $dados['endereco'] = $linha['endereco'];
            $dados['telefone'] = $linha['telefone'];
            $dados['assunto'] = $linha['assunto'];
            $dados['mensagem'] = $linha['mensagem'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form CERTO
    function msgform(){
        $dados = array();
        $dados['codigo'] = $_POST['codigo'];
        $dados['nome'] = $_POST['nome'];
        $dados['email'] = $_POST['email'];
        $dados['endereco'] = $_POST['endereco'];
        $dados['telefone'] = $_POST['telefone'];
        $dados['assunto'] = $_POST['assunto'];
        $dados['mensagem'] = $_POST['mensagem'];
        return $dados;
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<br>	
	<div class="container">
		<center><h3>Mensagens</h3></center>
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
                    <span>Nome</span>
                </label>
            </p>
        </div>

		<form method="post">
            <input type="text" name="consulta" id="consulta" value="">
            <button type="submit" value=Pesquisar class="btn waves-effect waves-light green " type="submit" name="action">
                Pesquisar <i class="material-icons right">search</i>
            </button>
            <a href="mensagem.php" class="btn waves-effect waves-light grey" type="submit" name="action">
            Listar <i class="material-icons right">reorder</i>
        </a>
    	</form>
<br><br>

	<table border="1">
        <tr>
       	<th>Código</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Assunto</th>
        <th>Mensagem</th>
        <th>Excluir</th> 
    </tr>

    <?php
    $sql = "";
        if ($tipo == 1){
            if ($consulta != '') {
            $sql = "SELECT * FROM mensagem WHERE codigo = '$consulta' ORDER BY codigo";
                } else {
            $sql = "SELECT * FROM mensagem ORDER BY codigo";
            }
            } else{    
            $sql = "SELECT * FROM mensagem WHERE nome LIKE '$consulta%' ORDER BY nome";
            } 
$pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
         while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
    ?>
        <tr>
			<td><?php echo $linha['codigo'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo $linha['email'];?></td>
            <td><?php echo $linha['assunto'];?></td>
            <td><?php echo $linha['mensagem'];?></td>       
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&codigo=<?php echo $linha['codigo'];?>')"><img class="icon" src="img/excluir/excluir4.png" alt=""></a></td>
        </tr>
        <?php } ?>      
    </table>
</div>
</body>
</html>