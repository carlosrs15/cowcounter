<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;
        excluir($codigo);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }
    function inserir($codigo){
        $dados = dadosForm();
        //var_dump($dados);
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO genero (genero) VALUES(:genero)');
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $genero = $dados['genero'];
        $stmt->execute();
        header("location:cadgenero.php");
        
    }

    function editar($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE genero SET genero = :genero WHERE codigo = :codigo');
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $genero = $dados['genero'];
        $codigo = $dados['codigo'];
        $stmt->execute();
        header("location:index.php");
    }

    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM genero WHERE codigo = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['codigo'] = $linha['codigo'];
            $dados['genero'] = $linha['genero'];
        }
        //var_dump($dados);
        return $dados;
        }
    function dadosForm(){
        $dados = array();
        $dados['codigo'] = $_POST['codigo'];
        $dados['genero'] = $_POST['genero'];
        return $dados;
    }

    ?>