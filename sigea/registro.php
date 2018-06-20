<?php require_once("inc/header.inc");
?>
<script type="text/javascript">
    // Função de validação das senhas \\
    function verificarSenha(){
        var campo1 = document.getElementById("InputPassword1").value;
        var campo2 = document.getElementById("InputPassword2").value;
        if(campo1 == campo2){
            document.getElementById("resultado").innerHTML = "Senhas corretas!";
            document.getElementById("resultado").style.color = "#008B45";
        }
        else{
            document.getElementById("resultado").innerHTML = "Senhas diferentes!";
            document.getElementById("resultado").style.color = "#FF6347";
        }
    }
    
    function validaEnvio(frm){
        var erros=0;
        var msg;
        
        if (frm.InputPassword1.value!=frm.InputPassword2.value){
            msg = "Senhas incorretas!";
            erros++;
        }
        
        if (erros>0){
            alert(msg);
            return false;
        }
        
        frm.submit();
    }
    
    
</script>

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
                <form method="post" action="sentMail/mailSent.php" id ="frm" onsubmit="validaEnvio(this); return false;" >
                  <div class="form-group">
                    <label for="InputNome">Nome</label>
                    <input type="text" class="form-control" id="InputNome" placeholder="Digite seu nome" name="nome" required>
                  </div>
                  <div class="form-group">
                    <label for="InputUsuario">Usuário</label>
                    <input type="text" class="form-control" id="InputUsuario" placeholder="Digite seu Login" name="usuario" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite seu Email" name="email"required>
                  </div>
                  <div class="form-group">
                    <label for="InputPassword1">Senha</label>
                    <input type="password" class="form-control" id="InputPassword1" placeholder="Digite sua Senha" name="senha"required onkeyup="verificarSenha();">
                  </div>
                  <div class="form-group">
                    <label for="InputPassword1">Confirmar Senha</label>
                    <input type="password" class="form-control" id="InputPassword2" placeholder="Confirme sua senha" name="senha2"required onkeyup="verificarSenha();">
                  </div>
                    <p id="resultado"></p>
                  <button type="submit" class="btn btn-default">Enviar</button>
                    <?php

                        require_once 'Facebook/autoload.php';
                        $fb = new Facebook\Facebook([
                          'app_id' => '1788903651415583', // Replace {app-id} with your app id
                          'app_secret' => '971eefb44fdf0bd08db9645afc9b4501',
                          'default_graph_version' => 'v2.11',
                          ]);

                        $helper = $fb->getRedirectLoginHelper();

                        $permissions = ['email']; // Optional permissions
                        $loginUrl = $helper->getLoginUrl('http://localhost/sigea/fb-callback.php', $permissions);
                        echo '<a href="' . htmlspecialchars($loginUrl) . '"><img src="img/facebook.png" height="43px"/a>';
                    ?>   
                </form>
            </div>
           
    </body>
</html>