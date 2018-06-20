<?php
	(include "classes/conexao.php");
    session_start();
    
    //Produto que o usuário quer para ser trocado\\
    $idE1= (int) $_REQUEST['idP1'];
    
    //id do usuário que realiza a oferta\\
    $idUsu= (int) $_SESSION['id_usuario'];
    
    $sql = "INSERT INTO interesse(id_eve,id_usu) VALUES ($idE1,$idUsu)";
    $exec = $mysqli->query($sql) or die($mysqli->error);
    header ("Location: evento.php?idEvento=$idE1");
    ?>