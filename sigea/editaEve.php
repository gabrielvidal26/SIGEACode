<?php require_once("inc/header.inc");
        include("classes/conexao.php");

    $ideve = $_GET['id'];
    $sql = "SELECT * FROM evento e, palestra p WHERE e.id = $ideve and $ideve = p.id_evento";
    $execute = $mysqli->query($sql) or die($mysqli->error);
    $evento = $execute->fetch_assoc();

    $sql1="SELECT COUNT(id_palestra) as quantidade FROM palestra WHERE id_evento=$ideve";
    $execute1 = $mysqli->query($sql1) or die($mysqli->error);
    $num_palestra = $execute1->fetch_assoc();
    $status=1;
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
                        var contador = 0;
                        var limite = 1;
                        $(".add").click(function() {
                        if(contador<limite)
                                {
                            var input = '<form method="post" class="campoextra" action="addPalestra.php">';/* criacao do formulario*/
                                input += '<label> Tema da palestra</label><br> <input type="text" class="form-control" name="tema[]" required><br>';
                                input += '<label> Data da palestra</label><br> <input type="date" name="data[]" required><br>';
                                input += '<label> Hora de início</label><br> <input type="time" name="horaini[]" required><br>';
                                input += '<label> Hora do término</label><br> <input type="time" name="horafim[]" required><br>';
                                input += '<label> Palestrante</label><br> <input type="text" class="form-control" name="palestrante[]" required><br>';
                                input += '<input type="hidden" value="<?php echo $evento['id']; ?>" name="id" >';
                                input += '<button class="btn btn-default">Enviar</button>';
                                input += '<a  href="#campoextra" class="del"><button class="btn btn-default">Excluir</button></a> </form>';
                            contador = 1;
                            
                            $(".campoextra").append(input);
                                }
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
		
            <div class="registroprod" style="width:70%;">
                <form method="post" action="editaUpload.php" id ="frm" enctype="multipart/form-data">
                    <legend>Editar Evento</legend>
                  <div class="form-group">
                    <label for="InputNome">Nome</label>
                    <input type="text" class="form-control" id="InputNomeProd" placeholder="Digite o nome do evento" name="nomeeve" maxlength="30" required value="<?php echo $evento['nome'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="InputDesc">Descrição</label>
                 <!--   <input type="text" class="form-control" id="InputDesc" placeholder="Digite a descrição do produto" name="descprod" required>
--> 
                      <textarea class="form-control" maxlength="256" rows="7" cols="55" style="resize:none" form="frm" name="desceve" placeholder="Digite a descrição do evento" required><?php echo $evento['descricao'] ?></textarea>
                  </div>   
                  <div class="form-group">
                    <label>Selecione uma imagem para o evento</label>
                    <input type='file' name='foto' value='Cadastrar foto'>
                  </div>
                    <div class="form-group">
                        <label> Inicio do Evento</label><br>
                        <input type="date" name="dataini" value="<?php echo $evento['dataini'] ?>" required>
                        <br><label> Fim do Evento</label><br>
                        <input type="date" name="datafim" value="<?php echo $evento['datafim'] ?>" required>
                    </div>
                    
                    <input type="hidden" value="<?php echo $evento['id']; ?>" name="id" >
                    <button type="submit" class="btn btn-default" style="position:relative;left:200px;width:60%;">Enviar Alterações do Evento</button>
                </form>
                <br>
                <form method="post" action="editaPalestra.php" id ="frm" enctype="multipart/form-data">
                    <?php do {  $i=0;  $idp[$i]=$evento['id_palestra']; ?>
                    <div class="form-group">
                     <table class="table table-bordered"><!-- formulario dinamico -->
                      <thead>
                        <tr> 
                            <td>Tema da Palestra</td>
                             <td> Data da Palestra</td>
                             <td> Hora de Início</td>
                             <td> Hora do Término</td>
                             <td> Palestrante</td>
                            
                          </tr>    
                         </thead>
                         <tbody>
                           <tr>        
                               <td><input type="text" value="<?php echo $evento['tema'] ?>" class="form-control" placeholder="Digite o tema da palestra" name="tema[]" maxlength="30" required></td>
                               <input type="hidden" value="<?php echo $idp[$i]; ?>" name="idp[]" >
                            <td><input type="date" name="data[]" value="<?php echo $evento['data'] ?>" required></td>
                            <td><input type="time" name="horaini[]" value="<?php echo substr($evento['horaini'],0,-8) ?>" required></td>
                            <td><input type="time" name="horafim[]" value="<?php echo substr($evento['horafim'],0,-8) ?>"required></td>
                            <td><input type="text" value="<?php echo $evento['palestrante'] ?>" class = "form-control" name="palestrante[]" placeholder="Digite o nome do palestrante" required></td>
                               <?php if($num_palestra['quantidade']==1){?>
                               <td><button type="submit" class="btn btn-default" style="position:relative;left:1px;">Enviar Alteração</button>
                               </td>
                               
                               <?php } else {  ?>
                                    <td><button type="submit" class="btn btn-default" style="position:relative;left:1px;">Enviar Alteração</button>
                                    </td>
                                    <form method="post" action="excluiPalestra.php?id=<?php echo $idp[$i]?>" id ="frm" enctype="multipart/form-data">

                                   <input type="hidden" value="<?php echo $evento['id']; ?>" name="ideve" >
                                    <td><button class="btn btn-danger" value="Excluir">Excluir</button></td>
                                   <?php }?>
                               <?php $idp[$i++]; ?>    
                               </form>   
                               
                           </tr>            
                        </tbody>
                        <?php } while($evento = $execute->fetch_assoc()); ?>
                        <br> 
                    </table>
                    <p style="color:red;">***Todo evento deve ter no mínimo uma palestra!***</p>
                    </div>
                    </form>
                
                
                <form method="post" class="campoextra" action="addPalestra.php">
                    <br>
                    <input type="hidden" value="<?php echo $evento['id']; ?>" name="id" >
                </form>
                <a href="#" class="add"><button type="submit" class="btn btn-default" style="position:relative;left:200px;width:60%;">Adicionar Palestra</button></a>
            </div>
        
    </body>
</html>