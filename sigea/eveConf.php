<?php 
    require_once("inc/header.inc");
    include("classes/conexao.php"); 
    $id_usuario = $_SESSION['id_usuario'];

    //definir o numero de itens por página
    $itens_por_pagina = 15;
    $pagina=1;
    if(isset($_GET['pagina']))
        $pagina = intval($_GET['pagina']);
    $exibe = (($pagina-1)*$itens_por_pagina);
    
    //puxar produtos do banco ----- insert into interesses (id_evento, id_usuario) values(id_evento,id_usuario);
  
    $sql = "SELECT e.nome, e.descricao, e.id, i.id_interesse FROM evento e, interesse i WHERE i.id_usu = $id_usuario AND i.id_eve = e.id";
    $execute = $mysqli->query($sql) or die($mysqli->error);
    $evento = $execute->fetch_assoc();
    
//    $sql2 = "SELECT COUNT(id_interesse) FROM interesse i WHERE i.id_eve = '".$evento['id']."'";
//    $execute2 = $mysqli->query($sql2) or die($mysqli->error);
//    $participantes = mysqli_fetch_row($execute2);

    //$sql2= "SELECT P1.nome, P1.resumo, P1.id FROM produtos P1, produtos P2, usuarios prop, usuarios u, interesses i WHERE u.id_usuario=$id_usuario AND P2.proprietario = $id_usuario AND P2.id = i.id_prod1 AND P1.id = i.id_prod2 AND prop.id_usuario = i.id_usu2 AND u.id_usuario = i.id_usu1";
    //$execute2 = $mysqli->query($sql2) or die($mysqli->error);
    //$produto2 = $execute2->fetch_assoc();

   // $sql3 = "SELECT prop.nome, prop.email FROM produtos P1, produtos P2, usuarios prop, usuarios u, interesses i WHERE u.id_usuario=$id_usuario AND P2.proprietario = $id_usuario AND P2.id = i.id_prod1 AND P1.id = i.id_prod2 AND prop.id_usuario = i.id_usu2 AND u.id_usuario = i.id_usu1";
    //$execute3 = $mysqli->query($sql3) or die($mysqli->error);
    //$produto3 = $execute3->fetch_assoc();
    
    $num = $execute->num_rows;

    //Pega a quantidade total de objetos no banco de dados
    //$num_total = $mysqli->query("SELECT id,nome,descricao FROM produtos WHERE proprietario='$id_usuario'")->num_rows;

    //definir numero de páginas
    //$num_paginas = ceil($num_total / $itens_por_pagina);
    
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
		<title>SIGEA</title>
        
         <link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <h1>Eventos Confirmados</h1>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Nome do Evento</td>
                                <td>Descrição</td>
    <?php if (isset($evento)){?><td>Participantes</td><?php } ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                      <?php do{ ?>
                            <tr>
                                <?php  $sql2 = "SELECT COUNT(id_interesse) as participantes FROM interesse i WHERE i.id_eve = '".$evento['id']."'";
                                $execute2 = $mysqli->query($sql2) or die($mysqli->error);
                                $participantes = $execute2->fetch_assoc(); ?>
                                <td><?php echo $evento['nome'] ?></td>
                                <td><?php echo $evento['descricao']; ?></td>
                                
                                <?php if (isset($evento)){?>
                                <td><?php echo $participantes['participantes']; ?></td>
                                <td><a href="recusar.php?id3=<?=$evento['id_interesse']?>"><button type="button" class="btn btn-danger">Cancelar Presença</button></a></td>
                                <?php } ?>
                            </tr>
                             <?php } while($evento = $execute->fetch_assoc()); ?>       
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once("inc/footer.inc"); ?> 
    </body> 
</html>