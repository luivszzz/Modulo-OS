<?php
# Inclua a conexão
require_once "./config.php";

# Defina variáveis e inicialize com valores vazios
$username_err = $email_err = $password_err = "";
$username = $email = $password = "";

# Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  # Validar nome de usuário
  if (empty(trim($_POST["username"]))) {
    $username_err = "Por favor digite um nome de usuário.";
  } else {
    $username = trim($_POST["username"]);
    if (!ctype_alnum(str_replace(array("@", "-", "_"), "", $username))) {
      $username_err = "O nome de usuário só pode conter letras, números e símbolos como '@', '_' ou '-'.";
    } else {
      # Prepare uma declaração de SELECT
      $sql = "SELECT id FROM users WHERE username = ?";

      if ($stmt = mysqli_prepare($link, $sql)) {
        # Vincule variáveis à instrução como parâmetros
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        # Defina os parâmetros
        $param_username = $username;

        # Execute a instrução preparada 
        if (mysqli_stmt_execute($stmt)) {
          # Guarde o resultado
          mysqli_stmt_store_result($stmt);

          # Verifique se o nome de usuário já está registrado
          if (mysqli_stmt_num_rows($stmt) == 1) {
            $username_err = "Este nome de usuário já está registrado.";
          }
        } else {
          echo "<script>" . "alert('Ops! Algo deu errado. Por favor, tente novamente mais tarde.')" . "</script>";
        }

        # Feche a declaração
        mysqli_stmt_close($stmt);
      }
    }
  }

  # Validar email
  if (empty(trim($_POST["email"]))) {
    $email_err = "Por favor insira um endereço de e-mail";
  } else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "Por favor insira um endereço de e-mail válido.";
    } else {
      # Prepare uma declaração selecionada
      $sql = "SELECT id FROM users WHERE email = ?";

      if ($stmt = mysqli_prepare($link, $sql)) {
        # Vincule variáveis à instrução como parâmetros
        mysqli_stmt_bind_param($stmt, "s", $param_email);

        # Defina os parâmetros
        $param_email = $email;

        # Execute a instrução preparada
        if (mysqli_stmt_execute($stmt)) {
          # Guarde o resultado
          mysqli_stmt_store_result($stmt);

          # Verifique se o e-mail já está cadastrado
          if (mysqli_stmt_num_rows($stmt) == 1) {
            $email_err = "Este e-mail já está registado.";
          }
        } else {
          echo "<script>" . "alert('Ops! Algo deu errado. Por favor, tente novamente mais tarde.');" . "</script>";
        }

        # Fechar declaração
        mysqli_stmt_close($stmt);
      }
    }
  }

  # Valide a senha
  if (empty(trim($_POST["password"]))) {
    $password_err = "Por favor insira uma senha.";
  } else {
    $password = trim($_POST["password"]);
    if (strlen($password) < 8) {
      $password_err = "A senha deve conter pelo menos 8 ou mais caracteres.";
    }
  }

  # Verifique os erros de entrada antes de inserir dados no banco de dados
  if (empty($username_err) && empty($email_err) && empty($password_err)) {
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Módulo OS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
  <script defer src="./js/script.js"></script>
</head>

<body>
  <div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
      <div class="col-lg-5">
        <div class="form-wrap border rounded p-4">
          <h1>Cadastrar</h1>
          <p>Por favor preencha este formulário para se registrar</p>
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <div class="mb-3">
              <label for="username" class="form-label">Nome de usuário</label>
              <input type="text" class="form-control" name="username" id="username" value="<?= $username; ?>">
              <small class="text-danger"><?= $username_err; ?></small>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Endereço de e-mail</label>
              <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>">
              <small class="text-danger"><?= $email_err; ?></small>
            </div>
            <div class="mb-2">
              <label for="password" class="form-label">Senha</label>
              <input type="password" class="form-control" name="password" id="password" value="<?= $password; ?>">
              <small class="text-danger"><?= $password_err; ?></small>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="togglePassword">
              <label for="togglePassword" class="form-check-label">Mostrar senha</label>
            </div>
            <div class="mb-3">
              <input type="submit" class="btn btn-primary form-control" name="submit" value="Cadastrar">
            </div>
            <p class="mb-0">Já possui uma conta? <a href="./login.php">Faça login</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>