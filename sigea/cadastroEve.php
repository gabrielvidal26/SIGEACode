<?php require_once("inc/header.inc"); 
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
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
        <script type="text/javascript">
                    $(function(){
                        $(".add").click(function() {
                            var input = '<div class="itens">';/* criacao do formulario*/
                                input += '<label> Tema da palestra</label><br> <input type="text" class="form-control" name="tema[]" required><br>';
                                input += '<label> Data da palestra</label><br> <input type="date" name="data[]" required><br>';
                                input += '<label> Hora de início</label><br> <input type="time" name="horaini[]" required><br>';
                                input += '<label> Hora do término</label><br> <input type="time" name="horafim[]" required><br>';
                                input += '<label> Palestrante</label><br> <input type="text" class="form-control" name="palestrante[]" required><br>';
                                input += '<a  href="#campoextra" class="del">Excluir</a> </div>';
                            
                            $(".campoextra").append(input);
                            return false;    
                        });
                        
                        $(document).on('click', '.del' ,function(){ /*exclusao do formulario criado*/
                            $(this).parent().remove();
                        });

                    });
        </script>
	</head>
	
	<body style="background-color:azure;">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
		
            <div class="registroprod" style="width:30%;">
                <form method="post" action="recebeupload.php" id ="frm" enctype="multipart/form-data">
                    <legend>Criar Evento</legend>
                  <div class="form-group">
                    <label for="InputNome">Nome</label>
                    <input type="text" class="form-control" id="InputNomeProd" placeholder="Digite o nome do evento" name="nomeeve" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="InputDesc">Descrição</label>
                 <!--   <input type="text" class="form-control" id="InputDesc" placeholder="Digite a descrição do produto" name="descprod" required>
--> 
                      <textarea class="form-control" maxlength="256" rows="7" cols="55" style="resize:none" form="frm" name="desceve" placeholder="Digite a descrição do evento" required></textarea>
                  </div>   
                  <div class="form-group">
                    <label>Selecione uma imagem para o evento</label>
                    <input type='file' name='foto' value='Cadastrar foto' required>
                  </div>
                    <div class="form-group">
                        <label> Inicio do Evento</label><br>
                        <input type="date" name="dataini" required>
                        <br><label> Fim do Evento</label><br>
                        <input type="date" name="datafim" required>
                    </div>
                     <div class="form-group"><!-- formulario dinamico -->                         
                        <label> Tema da Palestra</label>
                         <input type="text" class="form-control" placeholder="Digite o tema da palestra" name="tema[]" maxlength="30" required>
                         <label> Data da Palestra</label><br>
                         <input type="date" name="data[]" required><br>
                        <label> Hora de Início</label><br>
                        <input type="time" name="horaini[]" required>
                        <br><label> Hora do Término</label><br>
                        <input type="time" name="horafim[]" required>
                        <br><label> Palestrante</label><br>
                        <input type="text" class = "form-control" name="palestrante[]" placeholder="Digite o nome do palestrante" required><br> 
 
                        <div class="campoextra">
                         <br>
                         </div>
                    </div>
                  <button type="submit" class="btn btn-default" style="position:relative;left:90px;">Enviar</button>
                    <a href="#" class="add"><button type="submit" class="btn btn-default" style="position:relative;left:90px;">Adicionar Palestra</button></a>
                </form>
            </div>
        
    </body>
</html>