<?php
    include("classes/conexao.php"); 
	require_once("inc/header.inc");

    $idp = $_POST['idp'];
    $conta = count($idp);
    
    
    for($i=0;$i<$conta;$i++){
        
        $sql1="SELECT * FROM palestra WHERE id_palestra = $idp[$i]";
        $execute1 = $mysqli->query($sql1) or die($mysqli->error);
        $palestra = $execute1->fetch_assoc();
        
              
            $sql="UPDATE palestra SET tema='".$_POST['tema'][$i]."',data='".$_POST['data'][$i]."',horaini='".$_POST['horaini'][$i]."',horafim='".$_POST['horafim'][$i]."',palestrante='".$_POST['palestrante'][$i]."' WHERE id_palestra='".$palestra['id_palestra']."'";
            $execute = $mysqli->query($sql) or die($mysqli->error);
        
        
    }
    header("Location: meusEve.php");
?>
