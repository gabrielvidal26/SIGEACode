<?php 
    require_once("inc/header.inc");
    include("classes/conexao.php"); 
    $id_usuario = $_SESSION['id_usuario'];
    
    $id = $_GET['id'];
    $sql = "DELETE FROM interesse WHERE id_eve = $id";
    $execute = $mysqli->query($sql) or die($mysqli->error);
    $sql2 = "DELETE FROM evento WHERE id = $id";
    $execute2 = $mysqli->query($sql2) or die($mysqli->error);
    
?>

<script>
    alert ("Evento excluido com sucesso!");
    window.location.href = "meusEve.php";
</script>