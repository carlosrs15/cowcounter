<!DOCTYPE html>
<?php 
    session_start();
    if (isset($_SESSION['user']))
        header("location:index.php");

    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">


    <form action="acaoLogin.php" method="post">
        <div class="form">
            <div class="login">
            <h3>Cadastro</h3>

            <div class="input">
                <input type="text" required=true  type="text" name="nome" id="nome" placeholder="Nome">
            </div>

            <div class="input">
                <input type="text" required=true  type="text" name="email" id="email" placeholder="E-mail">
            </div>


            <div class="input">
                <input type="text" required=true  type="text" name="user" id="user" placeholder="Usuário">
            </div>

            <div class="input">
                <input type="password" required=true name="pass" id="pass" placeholder="Senha">
            </div>
<button class="botaofim" type="submit" name="acao" id="acao" value="salvar">Cadastrar</button><br>
<a href="login.php" class="cadas">Login</a>
</div>
</form>
        <h1 style="color:red"><?php echo $msg ?></h1>
  </body>
</html>

</body>
</html>