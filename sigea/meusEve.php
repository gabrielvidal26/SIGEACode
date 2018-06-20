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
    
    //puxar produtos do banco
    $sqlcode = "SELECT * FROM evento where proprietario='$id_usuario'"; 
    $execute = $mysqli->query($sqlcode) or die($mysqli->error);
    $evento = $execute->fetch_assoc();
    $num = $execute->num_rows;

    //Pega a quantidade total de objetos no banco de dados
    $num_total = $mysqli->query("SELECT id,nome,descricao FROM evento WHERE proprietario='$id_usuario'")->num_rows;

    //definir numero de páginas
    $num_paginas = ceil($num_total / $itens_por_pagina);

    
?>
<script>
    function confirmar(id) {
         var resposta = confirm("Deseja remover esse registro?");

         if (resposta == true) {
              window.location.href = "excluirEve.php?id="+id;
         }
    }
</script>
<script>
    function edita(id) {
        
              window.location.href = "editaEve.php?id="+id;
         
    }
</script>
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

        
		
        <?php
            if($logado){            
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <h1>Meus Eventos</h1>
                    <?php //if($num > 0){ ?>
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

                                <td><?php echo $evento['nome']; ?></td>
                                <td><?php echo $evento['descricao']; ?></td>
                                
                                <?php if (isset($evento)){?>
                                <td><?php echo $participantes['participantes']; ?></td>
                                <td><button onclick="edita(<?=$evento['id']?>)" class="btn btn-default" value="Editar">Editar</button></td>
                                <td><button onclick="confirmar(<?=$evento['id']?>)" class="btn btn-danger" value="Excluir">Excluir</button></td>
                                <?php } ?>
                            </tr>
                            <?php } while($evento = $execute->fetch_assoc()); ?>
                        </tbody>
                    </table>

                    <nav>
                          <ul class="pagination">
                            <li>
                              <a href="meusEve.php?pagina=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <?php for($i=0;$i<$num_paginas;$i++){ ?>
                              <li> <a href="meusEve.php?pagina=<?php echo $i+1; ?>"> <?php echo $i+1; ?> </a> </li>
                            <?php } ?>
                            <li>
                              <a href="meusEve.php?pagina=<?php echo $num_paginas; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    <?php// } ?>
                </div>
            </div>
        </div>
        <?php require_once("inc/footer.inc"); ?>
        <?php }else{
                ?><script> alert("Efetue o Login");window.location.href="index.php";</script>
        <?php
            }
        ?> 
    </body> 
</html>