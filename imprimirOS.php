<?php
# Inicialize a sessão
session_start();

# Se o usuário não estiver logado, redirecione-o para a página de login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>OS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="./css/a4.css" rel="stylesheet">
        <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
    </head>
    <body>
        <div class="book">
            <div class="page">
                <div class="subpage">Page 1/2</div>   
            </div>
            <div class="page">
                <div class="subpage">Page 2/2</div>    
            </div>
        </div>
    </body>
</html>