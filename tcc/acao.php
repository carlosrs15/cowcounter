<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui CERTO
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;
        excluir($codigo);
    }

    // Se foi enviado via POST para acao entra aqui CERTO
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }
    $acao = isset($_GET['vendido']) ? $_GET['vendido'] : "";
    if($acao!=""){
            vendido($_GET['vendido']);
    }


    // Métodos para cada operação
    function inserir($codigo){
        $dados = dadosForm();
        //var_dump($dados);

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO marca (pesoKG, valorArroba, numeroBrinco, genero, conta, dataNasc, dataContagem) VALUES(:pesoKG, :valorArroba, :numeroBrinco, :genero,:conta, :dataNasc, :dataContagem)');
        $stmt->bindParam(':pesoKG', $pesoKG, PDO::PARAM_INT);
        $pesoKG = $dados['pesoKG'];

        $stmt->bindParam(':valorArroba', $valorArroba, PDO::PARAM_INT);
        $valorArroba = $dados['valorArroba'];

        $stmt->bindParam(':numeroBrinco', $numeroBrinco, PDO::PARAM_INT);
        $numeroBrinco = $dados['numeroBrinco'];

        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $genero = $dados['genero'];

        $stmt->bindParam(':conta', $conta, PDO::PARAM_STR);
        $conta = $dados['conta'];

        $stmt->bindParam(':dataNasc', $dataNasc, PDO::PARAM_STR);
        $dataNasc = $dados['dataNasc'];

        $stmt->bindParam(':dataContagem', $dataContagem, PDO::PARAM_STR);
        $dataContagem = $dados['dataContagem'];
    
        $stmt->execute();
        header("location:cad.php");
    }

    function editar($codigo){        
        $dados = dadosForm();
        $pdo = Conexao::getInstance();

        $stmt = $pdo->prepare('UPDATE marca SET dataContagem = :dataContagem, dataNasc = :dataNasc, genero = :genero, numeroBrinco = :numeroBrinco, valorArroba = :valorArroba, pesoKG = :pesoKG   WHERE codigo = :codigo');
        $stmt->bindParam(':dataContagem', $dataContagem, PDO::PARAM_STR);
        $stmt->bindParam(':dataNasc', $dataNasc, PDO::PARAM_STR);
        $stmt->bindParam(':numeroBrinco', $numeroBrinco, PDO::PARAM_INT);
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR); 
        $stmt->bindParam(':valorArroba', $valorArroba, PDO::PARAM_INT);
        $stmt->bindParam(':pesoKG', $pesoKG, PDO::PARAM_INT);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $dataContagem = $dados['dataContagem'];
        $dataNasc = $dados['dataNasc'];
        $numeroBrinco = $dados['numeroBrinco'];
        $genero = $dados['genero'];
        $valorArroba = $dados['valorArroba'];
        $pesoKG = $dados['pesoKG'];
        $codigo = $dados['codigo'];
        $stmt->execute();
        header("location:index.php");
    }

    function excluir($codigo){ // certo
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from marca WHERE codigo = :codigo');
        $stmt->bindParam(':codigo', $codigoD, PDO::PARAM_INT);
        $codigoD = $codigo;
        $stmt->execute();
        header("location:index.php");

    }


    // Busca um item pelo código no BD CERTO
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM marca WHERE codigo = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['codigo'] = $linha['codigo'];
            $dados['dataContagem'] = $linha['dataContagem'];
            $dados['dataNasc'] = $linha['dataNasc'];
            $dados['numeroBrinco'] = $linha['numeroBrinco'];
            $dados['genero'] = $linha['genero'];
            $dados['conta'] = $linha['conta'];
            $dados['vendido'] = $linha['vendido'];
            $dados['valorArroba'] = $linha['valorArroba'];
            $dados['pesoKG'] = $linha['pesoKG'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form CERTO
    function dadosForm(){
        $dados = array();
        $dados['codigo'] = $_POST['codigo'];
        $dados['dataContagem'] = $_POST['dataContagem'];
        $dados['dataNasc'] = $_POST['dataNasc'];
        $dados['numeroBrinco'] = $_POST['numeroBrinco'];
        $dados['genero'] = $_POST['genero'];
        $dados['conta'] = $_POST['conta'];
        $dados['valorArroba'] = $_POST['valorArroba'];
        $dados['pesoKG'] = $_POST['pesoKG'];
        return $dados;
    }
    //Muda o boi para o vendido
    function vendido($codigo){
        $pdo = Conexao::getInstance(); 
        $stmt = $pdo->prepare('UPDATE marca SET  vendido = 1 WHERE codigo = :codigo');
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $stmt->execute();
        header("location:index.php");
    }
    function devolvido($codigo){
        $pdo = Conexao::getInstance(); 
        $stmt = $pdo->prepare('UPDATE marca SET  vendido = 0 WHERE codigo = :codigo');
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $stmt->execute();
        header("location:index.php");
    }
    

?>