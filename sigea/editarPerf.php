<?php 
	include("classes/conexao.php"); 
	require_once("inc/header.inc");

    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT nome,usuario,email,id_usuario FROM usuario WHERE usuario.id_usuario = $id_usuario";
    $execute = $mysqli->query($sql) or die($mysqli->error);
    $perfil = $execute->fetch_assoc();
    $i=0;
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
        <script type="text/javascript">
                    $(function(){
                        var contador = 0;
                        var limite = 1;
                        $(".add").click(function() {
                            if(contador<limite)
                                {
                                    var input = '<div class="itens">';/* criacao do formulario*/
                                        input += '<label> Senha Atual</label><br><input type="password" name="senhaAtual"><br>';
                                        input += '<label> Nova Senha</label><br><input type="password" name="senhaNova" id="senha1" onkeyup="verificarSenha()";><br>';
                                        input += '<label> Confirmar Senha</label><br><input type="password" name="senha2" id="senha2" onkeyup="verificarSenha()";><br><br>';
                                        input += '<a  href="#campoextra" class="del">Cancelar</a> </div><br>';
                                    
                                    contador = 1;
                                
                            
                                    $(".campoextra").append(input);
                                }
                                    return false;
                                
                            
                        });
                        
                        $(document).on('click', '.del' ,function(){ /*exclusao do formulario criado*/
                            $(this).parent().remove();
                            contador=0;
                        });

                    });
                
        </script>
        <script type="text/javascript">
    // Função de validação das senhas \\
    function verificarSenha(){
        var campo1 = document.getElementById("senha1").value;
        var campo2 = document.getElementById("senha2").value;
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
        
        if (frm.senha1.value!=frm.senha2.value){
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
		
        
	</head>
	
	<body style="background-color:azure;">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

             <div class="registro">
                <form method="post" action="atualizaCad.php" onsubmit="validaEnvio(this); return false;">
                  <div class="form-group">
                    <label for="InputNome">Nome</label>
                    <input type="text" class="form-control" id="InputNome" placeholder="Digite seu nome" value="<?php echo $perfil['nome'];?>" name="nome">
                  </div>
                  <div class="form-group">
                    <label for="InputUsuario">Usuário</label>
                    <input type="text" class="form-control" id="InputUsuario" placeholder="Digite seu Login" value="<?php echo $perfil['usuario'];?>" name="usuario">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite seu Email" value="<?php echo $perfil['email'];?>" name="email">
                  </div>
                    
                    <div class="campoextra"></div>
                    <p id="resultado"></p><br>
                    <input type="hidden" value="<?php $perfil['id_usuario'] ?>" name="id">
                    <button type="submit" class="btn btn-default">Enviar</button>
                    <a href="#" class="add"><button type="submit" class="btn btn-default">Mudar senha</button></a>
                 </form>
        </div>
           
    </body>
    <?php require_once("inc/footer.inc");?>
</html>