<?php
# Inicialize a sessão
session_start();

# Verifique se o usuário já está logado. Se sim, redirecione-o para a página inicial
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
  echo "<script>" . "window.location.href='./'" . "</script>";
  exit;
}

# Incluia a conexão
require_once "./config.php";

# Defina variáveis e inicialize com valores vazios
$user_login_err = $user_password_err = $login_err = "";
$user_login = $user_password = "";

# Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["user_login"]))) {
    $user_login_err = "Por favor, insira seu nome de usuário ou um ID de e-mail.";
  } else {
    $user_login = trim($_POST["user_login"]);
  }

  if (empty(trim($_POST["user_password"]))) {
    $user_password_err = "Por favor, insira sua senha.";
  } else {
    $user_password = trim($_POST["user_password"]);
  }

  # Validar credenciais 
  if (empty($user_login_err) && empty($user_password_err)) {
    # Prepare uma declaração de SELECT
    $sql = "SELECT id, username, password FROM users WHERE username = ? OR email = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      # Vincule variáveis à instrução como parâmetros
      mysqli_stmt_bind_param($stmt, "ss", $param_user_login, $param_user_login);

      # Defina os parâmetros
      $param_user_login = $user_login;

      # Execute a instrução
      if (mysqli_stmt_execute($stmt)) {
        # Guarde o resultado
        mysqli_stmt_store_result($stmt);

        # Verifique se o usuário existe, se sim, verifique a senha
        if (mysqli_stmt_num_rows($stmt) == 1) {
          # Vincular valores no resultado a variáveis
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

          if (mysqli_stmt_fetch($stmt)) {
            # Verifique se a senha está correta
            if (password_verify($user_password, $hashed_password)) {

              # Verifique se a senha está correta
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["loggedin"] = TRUE;

              # Redirecione o usuário para página inicial
              echo "<script>" . "window.location.href='./'" . "</script>";
              exit;
            } else {
              # Se a senha estiver incorreta, mostre uma mensagem de erro
              $login_err = "O Email ou a senha que você colocou está errado.";
            }
          }
        } else {
          # Se o usuário não existir, mostre uma mensagem de erro
          $login_err = "Nome de usuário ou senha inválidos.";
        }
      } else {
        echo "<script>" . "alert('Ops! Algo deu errado. Por favor, tente novamente mais tarde.');" . "</script>";
        echo "<script>" . "window.location.href='./login.php'" . "</script>";
        exit;
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
  <title>Login - Módulo OS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
  <script defer src="./js/script.js"></script>
</head>

<body>
  <div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
      <div class="col-lg-5">
        <?php
        if (!empty($login_err)) {
          echo "<div class='alert alert-danger'>" . $login_err . "</div>";
        }
        ?>
        <div class="form-wrap border rounded p-4">
          <h1>Login</h1>
          <p>Por favor faça o login para continuar</p>
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <div class="mb-3">
              <label for="user_login" class="form-label">E-mail ou usuário</label>
              <input type="text" class="form-control" name="user_login" id="user_login" value="<?= $user_login; ?>">
              <small class="text-danger"><?= $user_login_err; ?></small>
            </div>
            <div class="mb-2">
              <label for="password" class="form-label">Senha</label>
              <input type="password" class="form-control" name="user_password" id="password">
              <small class="text-danger"><?= $user_password_err; ?></small>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="togglePassword">
              <label for="togglePassword" class="form-check-label">Mostrar senha</label>
            </div>
            <div class="mb-3">
              <input type="submit" class="btn btn-primary form-control" name="submit" value="Login">
            </div>
            <p class="mb-0">Ainda não possui uma conta? <a href="./registro.php">Cadastre-se!</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>