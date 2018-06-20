<?php 
	include("classes/conexao.php"); 
	require_once("inc/header.inc");

    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT nome,usuario,email FROM usuario WHERE usuario.id_usuario = $id_usuario";
    $execute = $mysqli->query($sql) or die($mysqli->error);
    $perfil = $execute->fetch_assoc();
    
?>

<!DOCTYPE html>
<html>
	<head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
		<title>SIGEA</title>
        
        
        <!-- CSS do validador -->
        <link href="css/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
        <link href="css/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
        <link href="css/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
        
         <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type='text/javascript' src='http://code.jquery.com/jquery-1.11.0.js'></script>
        <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
		
        
	</head>
	
	<body style="background-color:azure;">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

            <div class="registro">
                <form action="editarPerf.php" id ="frm" >
                    <legend>Perfil</legend>
                  <div class="form-group">
                    <label for="InputNome">Nome</label><br>
                    <?php echo $perfil['nome'];?>
                  </div>
                  <div class="form-group">
                    <label for="InputUsuario">Usuário</label><br>
                    <?php echo $perfil['usuario'];?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label><br>
                    <?php echo $perfil['email'];?>
                  </div>
                    <?php if($perfil['usuario'] == $perfil['email']){?>
                        <p>Seu Perfil foi criado a partir do Facebook, não será possível alterações.</p>
                   <?php } else { ?><button class="btn btn-default">Editar</button><?php } ?>
    
                    
                </form>
            </div>
           
    </body>
    <?php require_once("inc/footer.inc");?>
</html>