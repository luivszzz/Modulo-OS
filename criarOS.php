<?php
# Inclua a conexão
require_once "./config.php";

# Inicialize a sessão
session_start();

# Se o usuário não estiver logado, redirecione-o para a página de login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}
# Defina variáveis e inicialize com valores vazios
$nomeCliente = $cpfCliente = $endereco = $cidade = $cep = $bairro = $infoAdic = $prdtModelo = $prdtDetalhes = $prdtReclam = $servDiag = $servGarant = $valorServ = $valorPeca = "";
$nomeCliente_err = $cpfCliente_err = $endereco_err = $cidade_err = $cep_err = $bairro_err = "";


# Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  # Validar nome
  if (empty(trim($_POST["inputNome"]))) {
    $nomeCliente_err = "Por favor digite o nome do cliente.";
  } else {
    $nomeCliente = trim($_POST["inputNome"]);
    if (!ctype_alnum(str_replace(array("@", "-", "_"), "", $nomeCliente))) {
      $nomeCliente_err = "O nome do cliente só pode conter letras, números e símbolos como '@', '_' ou '-'.";
    }
  }

  # Validar CPF/CNPJ
  if (empty(trim($_POST["inputCPNJ"]))) {
    $cpfCliente_err = "Por favor digite o CPF ou CNPJ do cliente.";
  } else {
    $cpfCliente = trim($_POST["inputCPNJ"]);
  }

  # Validar endereço
  if (empty(trim($_POST["inputEndereco"]))) {
    $endereco_err = "Por favor digite o endereço do cliente.";
  } else {
    $endereco = trim($_POST["inputEndereco"]);
  }

  # Validar cidade
  if (empty(trim($_POST["inputCidade"]))) {
    $cidade_err = "Por favor digite a cidade do cliente.";
  } else {
    $cidade = trim($_POST["inputCidade"]);
  }

  # Validar CEP
  if (empty(trim($_POST["inputCep"]))) {
    $cep_err = "Por favor digite o CEP do cliente.";
  } else {
    $cep = trim($_POST["inputCep"]);
  }

  # Validar bairro
  if (empty(trim($_POST["inputBairro"]))) {
    $bairro_err = "Por favor digite o bairro do cliente.";
  } else {
    $bairro = trim($_POST["inputBairro"]);
  }

  # Verifique os erros de entrada antes de inserir dados no banco de dados
  if (empty($nomeCliente_err) && empty($cpfCliente_err) && empty($endereco_err) && empty($cidade_err) && empty($cep_err) && empty($bairro_err)) {
    # Prepare uma instrução de insert
    $sql = "INSERT INTO users(username, email, password) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
      # Vincule variáveis à instrução preparada como parâmetros
      mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

      # Defina os parâmetros
      $param_username = $username;
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      # Execute a instrução preparada
      if (mysqli_stmt_execute($stmt)) {
        echo "<script>" . "alert('Cadastro concluído com sucesso. Faça login para continuar.');" . "</script>";
        echo "<script>" . "window.location.href='./login.php';" . "</script>";
        exit;
      } else {
        echo "<script>" . "alert('Ops! Algo deu errado. Por favor, tente novamente mais tarde.');" . "</script>";
      }

      # Feche a declaração
      mysqli_stmt_close($stmt);
    }
  }

  # Feche a conexão
  mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Página Inicial - Módulo OS</title>
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
    <h1>Preencher OS</h1>
  </div>
  <main class="form-os align-middle w-100 m-auto border rounded">
  <form class="row g-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
  <div class="col-12">
    <h1>Dados do cliente</h1>
  </div>
  <div class="col-md-6">
    <label for="inputNome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="inputNome" value="<?= $nomeCliente; ?>">
  </div>
  <div class="col-md-6">
    <label for="inputCPNJ" class="form-label">CPF/CPNJ</label>
    <input type="text" class="form-control" id="inputCPNJ" value="<?= $cpfCliente; ?>">
  </div>
  <div class="col-12">
    <label for="inputEndereco" class="form-label">Endereço</label>
    <input type="text" class="form-control" id="inputEndereco" placeholder="Rua 1, nº 234" value="<?= $endereco; ?>">
  </div>
  <div class="col-md-4">
    <label for="inputCidade" class="form-label">Cidade</label>
    <input type="text" class="form-control" id="inputCidade" value="<?= $cidade; ?>">
  </div>
  <div class="col-md-4">
    <label for="inputCep" class="form-label">CEP</label>
    <input type="text" class="form-control" id="inputCep" value="<?= $cep; ?>">
  </div>
  <div class="col-md-4">
    <label for="inputBairro" class="form-label">Bairro</label>
    <input type="text" class="form-control" id="inputBairro" value="<?= $bairro; ?>">
  </div>
  <div class="col-12">
    <label for="textEndAdic" class="form-label">Informações adicionais</label>
    <textarea class="form-control" id="textEndAdic" rows="3" value="<?= $infoAdic; ?>"></textarea>
  </div>
  <div class="col-12 border-top pt-3">
    <h1>Informações do produto</h1>
  </div>
  <div class="col-12">
    <label for="inputModelo" class="form-label">Modelo</label>
    <input type="text" class="form-control" id="inputModelo" value="<?= $prdtModelo; ?>">
  </div>
  <div class="col-12">
    <label for="inputDetalhes" class="form-label">Detalhes</label>
    <input type="text" class="form-control" id="inputDetalhes" value="<?= $prdtDetalhes; ?>">
  </div>
  <div class="col-12">
    <label for="textReclamacao" class="form-label">Reclamação do cliente</label>
    <textarea class="form-control" id="textReclamacao" rows="3" value="<?= $prdtReclam; ?>"></textarea>
  </div>
  <div class="col-12 border-top pt-3">
    <h1>Serviço</h1>
  </div>
  <div class="col-12">
    <label for="textDiagnostico" class="form-label">Diagnóstico e serviço a ser executado</label>
    <textarea class="form-control" id="textDiagnostico" rows="3" value="<?= $servDiag; ?>"></textarea>
  </div>
  <div class="col-12">
    <label for="textGarantia" class="form-label">Garantia e outras observações</label>
    <textarea class="form-control" id="textGarantia" rows="3" value="<?= $servGarant; ?>"></textarea>
  </div>
  <div class="col-12 border-top pt-3">
    <h1>Valores</h1>
  </div>
  <div class="col-md-6">
    <label for="inputValor" class="form-label">Valor dos serviços</label>
    <input type="number" class="form-control" id="inputValor" value="<?= $valorServ; ?>">
  </div>
  <div class="col-md-6">
    <label for="inputValor2" class="form-label">Valor de peças/produtos</label>
    <input type="number" class="form-control" id="inputValor2" value="<?= $valorPeca; ?>">
  </div>
  <div class="col-10 text-center">
    <button type="submit" class="btn btn-primary w-100">Gerar OS</button>
  </div>
  <div class="col-2 text-center">
    <a type="submit" href="./index.php" class="btn btn-secondary w-100">Voltar</a>
  </div>
</form>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
