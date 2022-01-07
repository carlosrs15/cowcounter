<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

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
        if ($codigo != 0)
            inserir($codigo);
        else
            inserir($codigo);
    }


    // Métodos para cada operação
    function inserir($codigo){
        $dados = dadosForm();
        //var_dump($dados);

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO vacinagado ( vacinacodigo, boicodigo, datavacina) VALUES( :vacinacodigo, :boicodigo, :datavacina)');
        $stmt->bindParam(':vacinacodigo', $vacinacodigo, PDO::PARAM_INT);
        $vacinacodigo = $dados['vacinacodigo'];

        $stmt->bindParam(':boicodigo', $boicodigo, PDO::PARAM_INT);
        $boicodigo = $dados['boicodigo'];

        $stmt->bindParam(':datavacina', $datavacina, PDO::PARAM_STR);
        $datavacina = $dados['datavacina'];
    
        $stmt->execute();
        header("location:../index.php");
    }

    function excluir($codigo){ // certo
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from vacinagado WHERE codigo = :codigo');
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
        $dados['vacinacodigo'] = $_POST['vacinacodigo'];
        $dados['boicodigo'] = $_POST['boicodigo'];
        $dados['datavacina'] = $_POST['datavacina'];
        return $dados;
    }
    

?>