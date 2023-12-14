<?php
# Inicialize a sessão
session_start();
# Se o usuário não estiver logado, redirecione-o para a página de login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}

# Inclua a conexão
require_once "./config.php";


if(!isset($_GET["id"])){
    header("location: ./minhasOS.php");
    exit;
}
$id = $_GET["id"];

$sql = "SELECT * FROM orders WHERE `orderID`=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if(!$row){
    header("location: ./minhasOS.php");
    exit;
}
$nomeCliente = $row["nomeCliente"];
$cpfCliente = $row["cpfCliente"];
$endereco = $row["endereco"];
$cidade = $row["cidade"];
$cep = $row["cep"];
$bairro = $row["bairro"];
$infoAdic = $row["infoAdic"];
$prdtModelo = $row["prdtModelo"];
$prdtDetalhes = $row["prdtDetalhes"];
$prdtReclam = $row["prdtReclam"];
$servDiag = $row["servDiag"];
$servGarant = $row["servGarant"];
$valorServ = $row["valorServ"];
$valorPeca = $row["valorPeca"];
$estadoOS = $row["orderEstado"];
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
                <div class="subpage text-center">
                    
                    <h1 class="h3 mb-3 fw-bold"><img class="mb-2" src="./img/icon.png" alt="" width="30" height="30"> João Manutenção - Ordem de Serviço</h1>
                    <p>Nome do cliente: <?= $nomeCliente;?></p>
                    <table class="table text-start table-bordered align-middle">
                        <thead class="table-active">
                            <tr>
                                <th scope="col" colspan="4"><h1 class="h3 fw-bold">Cliente</h1></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">Nome:</th>
                            <td colspan="3">Mark</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="page">
                <div class="subpage">Page 2/2</div>    
            </div>
        </div>
    </body>
</html>