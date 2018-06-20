<?php 
	include("classes/conexao.php"); 
	require_once("inc/header.inc");
    if(isset($_GET['idEvento']))
        $id = intval($_GET['idEvento']);
	else
		header('Location: index.php');
	
	$sqlcode = "SELECT *,DATE_FORMAT(dataini, '%d/%m/%Y') as dataini2, DATE_FORMAT(datafim,'%d/%m/%Y') AS datafim2 FROM evento,palestra  WHERE evento.id=$id and evento.id=palestra.id_evento"; 
    $execute = $mysqli->query($sqlcode) or die($mysqli->error);
    $evento = $execute->fetch_assoc();
    
    $prop = $evento['proprietario'];
    $sqlcode2 = "SELECT * FROM usuario WHERE usuario.id_usuario=$prop"; 
    $execute3 = $mysqli->query($sqlcode2) or die($mysqli->error);
    $dono = $execute3->fetch_assoc();



    $i=0;
    if (isset($_SESSION['id_usuario'])){
        $sql = "SELECT id,nome FROM evento WHERE proprietario = $_SESSION[id_usuario]";
        $execute2 = $mysqli->query($sql) or die($mysqli->error);
        
        while($sql = mysqli_fetch_array($execute)){
            $id_prod[$i] = $sql["id"];
            $nome_prod[$i] = $sql["nome"];
            $i++;
        }
    }
    
?>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
		<title>SIGEA - <?php echo $evento['nome'];?></title>
        
         <link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script>
            function confirmar(){
                
                alert("Presença confirmada");
            }
        </script>

        <div class="content">
            <div class="container">
				<div class="media ">
				  <div class="media-left media-middle">
					<a href="#">
					  <img class="media-object" style="max-width: 350px; max-height: 500px;border-radius: 0px  0px 20px 20px;" src="img/<?php echo $evento['nome_img']; ?>" alt="img/$evento['nome_img']; ?>">
					</a>
				  </div>
				  <div class="media-body bg-primary" style="border:1px solid black;color:black;background-color:inherit;border-radius: 0px  0px 20px 20px;">
					<h2 class="media-bottom"><?php echo $evento['nome'];?></h2>
					<p><?php echo $evento['descricao'];?></p>
                      <p>Evento criado por: <?php echo $dono['nome'];?></p>
                      <p>Início - <?php echo $evento['dataini2'];?></p>
                      <p>Fim - <?php echo $evento['datafim2'];?></p>
                      
                      <?php
                        
                        $sql1 = "SELECT COUNT(id_palestra) FROM palestra WHERE palestra.id_evento=$id";
                        $execute1 = $mysqli->query($sql1) or die($mysqli->error);
                        $palestra1 = mysqli_fetch_row($execute1);
                        
                        $sql2 = "SELECT MIN(id_palestra) FROM palestra WHERE palestra.id_evento=$id";
                        $execute3 = $mysqli->query($sql2) or die($mysqli->error);
                        $palestra2 = mysqli_fetch_row($execute3);
                     
                        ?>
                        
                      <table class="table table-bordered" style="right:10px;left:40px;position:relative;width:90%;">
                        <thead >
                            <tr>
                                <td>Tema da Palestra</td>
                                <td>Data da Palestra</td>
                                <td>Hora de Início</td>
                                <td>Hora do Término</td>
                                <td>Palestrante</td>
                                
                            </tr>
                        </thead>
                               <?php $sql = "SELECT *,DATE_FORMAT(data, '%d/%m/%Y') AS data2 FROM palestra, evento WHERE palestra.id_evento=evento.id and evento.id=$id";
                                    $execute4 = $mysqli->query($sql) or die($mysqli->error);
                                    $palestra = $execute4->fetch_assoc();?>     
                          
                          <?php do{ ?>
                        <tbody>
                            

                            <tr>

                      
                                  <td><?php echo $palestra['tema'];?></td>
                                  <td><?php echo $palestra['data2'];?></td>
                                  <td><?php echo substr($palestra['horaini'],0,-8);?></td>
                                  <td><?php echo substr($palestra['horafim'],0,-8);?></td>
                                  <td><?php echo $palestra['palestrante'];?></td>
                                
                            </tr>
                              <?php } while($palestra = $execute4->fetch_assoc())?>      
                           
                        </tbody>
                    </table>
                      
                      
                    <?php if (isset($_SESSION['id_usuario'])){?>
                      <?php 
                            $query ="SELECT id_interesse FROM interesse WHERE interesse.id_usu = '".$_SESSION['id_usuario']."' 
                                                                            AND interesse.id_eve = $id";
                             $executa = $mysqli->query($query) or die($mysqli->error);?>
                            
                           <?php if(($executa->num_rows) =='0')
                            {?>

                                  <form action="interesse.php" type="post">
                                    <input type="hidden" name="idP1" value="<?=$evento['id']?>"/>
                                    <input onclick="confirmar();" class="btn btn-info btn-lg" id="btn_interesse" type="submit" value="Confirmar Presença !">
                                    </form>
                      <?php }
                            else
                            {?>
                                <?php 
                                $sql = "SELECT i.id_interesse FROM evento e, interesse i WHERE i.id_usu = '".$_SESSION['id_usuario']."' AND i.id_eve = e.id";
                                $execute = $mysqli->query($sql) or die($mysqli->error);
                                $evento = $execute->fetch_assoc();?>
                      
                                <button type="button" class="btn btn-info btn-lg" id="btn_interesse" style="position:relative;right:100px;">Presença já Confirmada!</button>
                      
                                <a href="recusa2.php?id3=<?=$evento['id_interesse']?>"><button type="button" class="btn btn-danger" style="position:relative; width:30%;right:100px;padding:9px;font-size:18px;">Cancelar Presença</button></a>
                    <?php  }?>
                            
                      <?php } 
                      else { ?>
                      
                            <p>Realize o login !</p>
                            <p>Para confirmar a presença, é necessário realizar login antes</p>
                                 <?php } ?>    
                              
                            </div>
                        </div>
                      </div>
                  </div>
                   
            <div class = "footer">
                <?php require("inc/footer.inc");?>
            </div>