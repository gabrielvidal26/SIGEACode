<?php
    include("classes/conexao.php"); 
	require_once("inc/header.inc");

    $idpalestra=$_GET['id'];
    $idevento=$_POST['ideve'];
    
    $sql1="SELECT COUNT(id_palestra) as quantidade FROM palestra WHERE id_evento=$idevento";
    $execute1 = $mysqli->query($sql1) or die($mysqli->error);
    $num_palestra = $execute1->fetch_assoc();

    if($num_palestra==1)
    {
        header("Location: meusEve.php");
    }
else{

        $sql = "DELETE FROM palestra WHERE id_palestra=$idpalestra";
        $execute = $mysqli->query($sql) or die($mysqli->error);
        header("Location: meusEve.php");
    }
?>