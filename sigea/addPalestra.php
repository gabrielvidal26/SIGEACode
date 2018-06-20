<?php
    include("classes/conexao.php"); 
	require_once("inc/header.inc");
    $id=(int) $_POST['id'];
 foreach($_POST['tema'] as $indice => $value) {
                    
     $sql = "INSERT INTO palestra(tema,data,horaini,horafim,palestrante,id_evento) VALUES ('".$_POST['tema'][$indice]."','".$_POST['data'][$indice]."','".$_POST['horaini'][$indice]."','".$_POST['horafim'][$indice]."','".$_POST['palestrante'][$indice]."','$id')";	
    $execute = $mysqli->query($sql) or die($mysqli->error);
  }	
    header("Location: meusEve.php");
?>