<?php
    include("classes/conexao.php");
    require_once("inc/header.inc");
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT * FROM usuario WHERE usuario.id_usuario = $id_usuario";
    $exec = $mysqli->query($sql) or die($mysqli->error);
    $perfil = $exec->fetch_assoc();

    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senhaAtual = $_POST['senhaAtual'];
    
    if(isset($senhaAtual)){
    
            $senhaNova = $_POST['senhaNova'];
        
            if($senhaAtual == $perfil['senha'])
            {    
                $sql1 = "UPDATE usuario SET senha = '$senhaNova' WHERE id_usuario=$id_usuario";
                $exec1 = $mysqli->query($sql1) or die($mysqli->error);
            }
            else{?>
                <script>
                    alert("Senha atual está errada");
                     window.location.href = "/perfil.php";
                </script>
            <?php }
                
        
    }
    else if($nome != $perfil['nome'])
    {
        $sql1 = "UPDATE usuario SET nome = '$nome' WHERE id_usuario = $id_usuario";
        $exec1 = $mysqli->query($sql1) or die($mysqli->error);
    }
    else if($usuario != $perfil['usuario'])
    {
        $sql1 = "UPDATE usuario SET usuario = '$usuario' WHERE id_usuario = $id_usuario";
        $exec1 = $mysqli->query($sql1) or die($mysqli->error);
    }
    else if($email != $perfil['email'])
    {
        $sql1 = "UPDATE usuario SET email = '$email' WHERE id_usuario = $id_usuario";
        $exec1 = $mysqli->query($sql1) or die($mysqli->error);
    }
    header ("Location: perfil.php");
 ?>   