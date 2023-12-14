<?php
# Inclua a conexão
require_once "./config.php";



if ( isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "DELETE FROM orders WHERE orderID=$id";
    $connection->query($sql);
}

header("location: ./minhasOS.php");
exit;
?>