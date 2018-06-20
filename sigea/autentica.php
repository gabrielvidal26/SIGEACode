<?php
	(include "classes/conexao.php");
    session_start();
    $usuario=$_POST['usuario'];
	$senha=$_POST['senha'];
	
    $sql = "SELECT id_usuario,nome,usuario,senha FROM usuario";
    $exec = $mysqli->query($sql) or die($mysqli->error);
    
    foreach ($exec as $row){   
        if ($row['usuario']==$usuario && $row['senha']==$senha){
            $sql2 = "SELECT aut FROM usuario WHERE usuario = '$usuario'";
            $execute = $mysqli->query($sql2) or die($mysqli->error);
            $lin=mysqli_fetch_assoc($execute);
            $aut = $lin['aut'];
            if ($aut==1){

                $_SESSION['usuario']=$usuario;
                $_SESSION['msg'] = "Bem vindo $usuario!";
                $_SESSION['nome']= $row['nome'];
                $_SESSION['id_usuario']=$row['id_usuario'];
                header ("Location: index.php");
            }
            else{
                
                $_SESSION['msg'] = "Por favor, autentifique sua conta através do email enviado, Obrigado!";
                
                header("Location: index.php");
            }
        }
    }

    if(!isset($_SESSION['msg'])){
        $_SESSION['msg'] = "Usuário ou senha incorretos!";
        header ("Location: index.php");
    }
    
?>