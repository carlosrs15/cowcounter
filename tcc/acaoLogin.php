<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "logoff"){
		session_start();
		session_destroy();
		header("location:login.php");	
	}

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "login"){
        $user = isset($_POST['user']) ? $_POST['user'] : "";
        $pass = isset($_POST['pass']) ? $_POST['pass'] : "";
        login($user, $pass);
    }
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        if ($id == 0)
            inserir($id);
        else
            inserir($id);
    }

    function login($user, $pass){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM contas WHERE user = '$user'");
        $id = '';
        $pass_bd = '';
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $id = $linha['id'];
            $pass_bd = $linha['pass'];
        }
        if (md5($pass) == $pass_bd){
            session_start();
			$_SESSION['user'] = $user;
			$_SESSION['id'] = $id;
			header("location:index.php");	
		}else 
            header("location:login.php?msg=Login Incorreto!");
    } 


    

    function inserir($id){
        $dados = dadosForm();
        //var_dump($dados);

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO contas (email, user, pass, nome) VALUES(:email, :user, md5(:pass), :nome)');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $email = $dados['email'];

        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $user = $dados['user'];

        $stmt->bindParam(':pass', $pass, PDO::PARAM_INT);
        $pass = $dados['pass'];

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $nome = $dados['nome'];
    
        $stmt->execute();
        header("location:cad.php");
    }
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['email'] = $_POST['email'];
        $dados['user'] = $_POST['user'];
        $dados['pass'] = $_POST['pass'];
        $dados['nome'] = $_POST['nome'];
        return $dados;
    }

?>