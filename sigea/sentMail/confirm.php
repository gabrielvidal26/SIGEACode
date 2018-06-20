<?php
    include("../classes/conexao.php"); 
	session_start();
	$id=$_GET['id'];
    $sql = "UPDATE usuario set aut = 1 WHERE id_usuario = ".$id;
    $execute = $mysqli->query($sql) or die($mysqli->error);
?>

<script>
    alert("Conta confirmada com sucesso!");
    window.location.href="../index.php"
</script>