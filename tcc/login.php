<!DOCTYPE html>
<?php 
    session_start();
    if (isset($_SESSION['user']))
        header("location:index.php");

    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <nav>
        <div class="nav-wrapper">
          <ul id="nav-mobile" class="right hide-on-med-and-down">

          </ul>
        </div>
    </nav>

    <form action="acaoLogin.php" method="post">
        <div class="form">
            <div class="login">
            <h3>Login</h3>
            <div class="texto">
                <i class="fas fa-user"></i>
                <input type="text" required=true  type="text" name="user" id="user" placeholder="Usuário">
            </div>

            <div class="texto">
                <i class="fas fa-lock"></i>
                <input type="password" required=true name="pass" id="pass" placeholder="Senha">
            </div>
<button class="botaofim" type="submit" name="acao" id="acao" value="login">Entrar</button><br>
<a href="cadastro.php" class="cadas">Cadastro</a>
</div>
</form>
        <h1 style="color:red"><?php echo $msg ?></h1>
  </body>
</html>
