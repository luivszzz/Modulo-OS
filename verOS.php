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
        <script defer type="text/javascript">
            

    function printpage() {
        var printButton = document.getElementById("print");
        document.getElementById('print').classList.add("d-none");
        document.getElementById('back').classList.add("d-none");
        window.print()
        document.getElementById('print').classList.remove("d-none");
        document.getElementById('back').classList.remove("d-none");

    }
</script>
<style>
    table {
width:500px;
table-layout:fixed;
}


td {
word-wrap:break-word;
}
</style>
    </head>
    <body>
    <div class="position-fixed bottom-0 end-1 mb-3 ms-3 bd-mode-toggle">
    <a type="submit" id="back" href="./index.php" class="btn btn-secondary w-100 d-flex align-items-center">Voltar</a>
  </div>
  <div class="position-fixed bottom-0 end-0 mb-3 ms-3 bd-mode-toggle">
    <a type="submit" class="btn btn-primary w-100 d-flex align-items-center" id="print" onclick="printpage()">Imprimir</a>
  </div>
        <div class="book">
            <div class="page">
                <div class="subpage text-center">
                    
                    <h1 class="h3 mb-3 fw-bold"><img class="mb-2" src="./img/icon.png" alt="" width="30" height="30"> João Manutenção - Ordem de Serviço</h1>
                    <table class="table text-start table-bordered align-middle">
                        <thead class="table-active">
                            <tr>
                                <th scope="col" colspan="7"><h1 class="h3 fw-bold">Cliente</h1></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">Nome:</th>
                            <td colspan="3"><?= $nomeCliente ?></td>
                            <th scope="row">CPF:</th>
                            <td colspan="2"><?= $cpfCliente ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Endereço:</th>
                            <td colspan="6"><?= $endereco ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Cidade</th>
                            <td><?= $infoAdic ?></td>
                            <th scope="row">CEP</th>
                            <td><?= $infoAdic ?></td>
                            <th scope="row">Bairro</th>
                            <td colspan="2"><?= $infoAdic ?></td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="7">Informações adicionais:</th>
                        </tr>
                        <tr>
                            <td colspan="7"><?= $infoAdic ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table text-start table-bordered align-middle">
                        <thead class="table-active">
                            <tr>
                                <th scope="col" colspan="3"><h1 class="h3 fw-bold">Produto</h1></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">Modelo:</th>
                            <td colspan="2"><?= $prdtModelo ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Detalhes:</th>
                            <td colspan="2"><?= $prdtDetalhes ?></td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="3">Reclamação:</th>
                        </tr>
                        <tr>
                            <td colspan="3"><?= $prdtReclam ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table text-start table-bordered align-middle">
                        <thead class="table-active">
                            <tr>
                                <th scope="col" colspan="6"><h1 class="h3 fw-bold">Serviço</h1></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row" colspan="6">Diagnóstico e serviço a ser executado:</th>
                        </tr>
                        <tr>
                            <td colspan="6"><?= $servDiag ?></td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="6">Garantia e outras observações:</th>
                        </tr>
                        <tr>
                            <td colspan="6"><?= $servGarant ?></td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Valor do serviço</th>
                            <th scope="row" colspan="2">Valor de peças/produtos</th>
                            <th scope="row" colspan="2">Valor total</th>
                        </tr>
                            <td colspan="2">R$ <?= $valorServ ?></td>
                            <td colspan="2">R$ <?= $valorPeca ?></td>
                            <td colspan="2">R$ <?= $valorServ+$valorPeca ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table text-start table-bordered align-middle">
                        <tbody>
                        <tr>
                            <th scope="row"><br><br><br><br><br></th>
                            <th scope="row"><br></th>
                        </tr>
                        <tr>
                            <td scope="row">Assinatura do prestador</th>
                            <td scope="row">Assinatura do cliente</th>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>