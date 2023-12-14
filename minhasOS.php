<?php

# Inclua a conexão
require_once "./config.php";


$username = $email = $password = "";


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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Página Inicial - João Manutenção</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <script src="./js/color-modes.js"></script>
  <script defer src="./js/script.js"></script>
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
</head>


<body class="bg-body-tertiary d-flex flex-column" style="heigth: 100%;">
  
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path
        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path
        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
      <path
        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path
        d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
  </svg>
  
  <div class="position-fixed bottom-0 end-1 mb-3 ms-3 bd-mode-toggle">
    <a type="submit" href="./index.php" class="btn btn-secondary w-100 d-flex align-items-center">Voltar</a>
  </div>

  <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
      aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
      <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
        <use href="#circle-half"></use>
      </svg>
      <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
            <use href="#sun-fill"></use>
          </svg>
          Claro
          <svg class="bi ms-auto d-none" width="1em" height="1em">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark"
          aria-pressed="true">
          <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
            <use href="#moon-stars-fill"></use>
          </svg>
          Escuro
          <svg class="bi ms-auto d-none" width="1em" height="1em">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
            <use href="#circle-half"></use>
          </svg>
          Automático
          <svg class="bi ms-auto d-none" width="1em" height="1em">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
    </ul>
  </div>

  <div class="align-middle text-center w-100 pt-3">
    <h1>Minhas OS's</h1>
  <a href="./criarOS.php" class="btn btn-primary">Criar uma nova OS</a>
  </div>




  <div class="tbl-container bdr border rounded w-auto align-middle m-auto">
    <table frame="void" rules="all" class="table mb-0 text-center align-middle">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
          <th scope="col">Endereço</th>
          <th scope="col">Cidade</th>
          <th scope="col">CEP</th>
          <th scope="col">Bairro</th>
          <th scope="col">Informações adicionais</th>
          <th scope="col">Modelo do produto</th>
          <th scope="col">Detalhes do produto</th>
          <th scope="col">Reclamação do cliente</th>
          <th scope="col">Diagnóstico e serviço a serem executados</th>
          <th scope="col">Garantia e outras observações</th>
          <th scope="col">Valor dos serviços</th>
          <th scope="col">Valor de peças/produtos</th>
          <th scope="col">Valor total</th>
          <th scope="col">Estado da OS</th>
          <th scope="col">Ação</th>
        </tr>
      </thead>
      <tbody>
        
        <?php
          //Ler OS's do usuário logado
          $stmt = mysqli_prepare($link, "SELECT * FROM orders WHERE `userID`=?;");
          mysqli_stmt_bind_param($stmt, 'i', $_SESSION["id"]);
          $stmt->execute();
          $result = $stmt->get_result();
          if(mysqli_num_rows($result) >=1){
            $tmpCount = 0;
            while($row = $result->fetch_assoc()){
              $tmpCount++;
              echo"
                <tr>
                  <th scope='row'>$tmpCount</th>
                  <td>$row[nomeCliente]</td>
                  <td>$row[cpfCliente]</td>
                  <td>$row[endereco]</td>
                  <td>$row[cidade]</td>
                  <td>$row[cep]</td>
                  <td>$row[bairro]</td>
                  <td>$row[infoAdic]</td>
                  <td>$row[prdtModelo]</td>
                  <td>$row[prdtDetalhes]</td>
                  <td>$row[prdtReclam]</td>
                  <td>$row[servDiag]</td>
                  <td>$row[servGarant]</td>
                  <td>$row[valorServ]</td>
                  <td>$row[valorPeca]</td>
                  <td>".$row["valorServ"]+$row["valorPeca"]."</td>
                  <td>$row[orderEstado]</td>
                  <td>
                    <a href='./verOS.php?id=$row[orderID]' class='btn btn-primary btn-sm'>Ver</a>
                    <a href='./editarOS.php?id=$row[orderID]' class='btn btn-warning btn-sm'>Editar</a>
                    <a href='./deletarOS.php?id=$row[orderID]' class='btn btn-danger btn-sm'>Excluir</a>
                  </td>
                </tr>
              ";
            }
          }
          else{
            echo"<tr>
              <td colspan='18'>Você não possui OS's registradas.</td>
            </tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
