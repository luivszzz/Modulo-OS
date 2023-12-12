<?php
# Inicialize a sessão
session_start();

# Esvazie todas as variáveis de sessão
$_SESSION = array();

# Destrua a sessão
session_destroy();

# Redirecione para a página de login
echo "<script>" . "window.location.href='./login.php';" . "</script>";
exit;
