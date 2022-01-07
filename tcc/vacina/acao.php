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
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }


    // Métodos para cada operação
    function inserir($codigo){
        $dados = dadosForm();
        //var_dump($dados);

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO vacina (obrigatorio, nome, funcao, descricao) VALUES(:obrigatorio, :nome, :numeroBrinco, :funcao, :descricao)');
        $stmt->bindParam(':obrigatorio', $obrigatorio, PDO::PARAM_INT);
        $obrigatorio = $dados['obrigatorio'];

        $stmt->bindParam(':nome', $nome, PDO::PARAM_INT);
        $nome = $dados['nome'];

        $stmt->bindParam(':funcao', $funcao, PDO::PARAM_INT);
        $funcao = $dados['funcao'];

        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $descricao = $dados['descricao'];
    
        $stmt->execute();
        header("location:cad.php");
    }

    function editar($codigo){        
        $dados = dadosForm();
        $pdo = Conexao::getInstance();

        $stmt = $pdo->prepare('UPDATE vacina SET obrigatorio = :obrigatorio, nome = :nome, funcao = :funcao, descricao = :descricao   WHERE codigo = :codigo');
        $stmt->bindParam(':obrigatorio', $obrigatorio, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':funcao', $funcao, PDO::PARAM_INT);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR); 
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $obrigatorio = $dados['obrigatorio'];
        $nome = $dados['nome'];
        $funcao = $dados['funcao'];
        $descricao = $dados['descricao'];
        $codigo = $dados['codigo'];
        $stmt->execute();
        header("location:index.php");
    }

    function excluir($codigo){ // certo
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from vacina WHERE codigo = :codigo');
        $stmt->bindParam(':codigo', $codigoD, PDO::PARAM_INT);
        $codigoD = $codigo;
        $stmt->execute();
        header("location:index.php");

    }


    // Busca um item pelo código no BD CERTO
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM vacina WHERE codigo = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['codigo'] = $linha['codigo'];
            $dados['obrigatorio'] = $linha['obrigatorio'];
            $dados['nome'] = $linha['nome'];
            $dados['funcao'] = $linha['funcao'];
            $dados['descricao'] = $linha['descricao'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form CERTO
    function dadosForm(){
        $dados = array();
        $dados['codigo'] = $_POST['codigo'];
        $dados['obrigatorio'] = $_POST['obrigatorio'];
        $dados['nome'] = $_POST['nome'];
        $dados['funcao'] = $_POST['funcao'];
        $dados['descricao'] = $_POST['descricao'];
        return $dados;
    }



?>