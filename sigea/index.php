<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php 
    include("classes/conexao.php"); 
	require_once("inc/header.inc");
	//definir o numero de itens por página
    $itens_por_pagina = 9;
    $pagina=1;
    if(isset($_GET['pagina']))
        $pagina = intval($_GET['pagina']);
    $exibe = (($pagina-1)*$itens_por_pagina);
    
    //puxar produtos do banco
    $sqlcode = "SELECT * FROM evento ORDER BY id DESC LIMIT $exibe,$itens_por_pagina"; 
    $execute = $mysqli->query($sqlcode) or die($mysqli->error);
    $evento = $execute->fetch_assoc();
    $num = $execute->num_rows;

    //Pega a quantidade total de objetos no banco de dados
    $num_total = $mysqli->query("SELECT id,nome,descricao FROM evento")->num_rows;

    //definir numero de páginas
    $num_paginas = ceil($num_total / $itens_por_pagina);
    
?>
<!DOCTYPE html>
<html>
	
	<head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
		<title>SIGEA</title>
        
         <link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body>
        
        <script src="js/bootstrap.min.js"></script>
        <div class="content">
            <div class="container">
                <?php if(isset($evento))
                    {?>
                        <nav class="navbar navbar-light bg-light">
                          <form class="form-inline" method="get" action="pesquisar.php" style="padding-top:20px;left:450px;position:relative;width:50%;">
                            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" name="buscar">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                          </form>
                        </nav>
                <div class="ofertas">    
                    <div class="row">
                        <!--produtos-->

                        <?php do{ ?>
                            <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                              <img src="img/<?php echo $evento['nome_img']; ?>" alt="<?php echo $evento['nome_img'] ?>">
                                <h3 class="textoAlinhado"><?php echo $evento['nome']?></h3>
                              <div class="caption ellipsis" >


                                <p><a href="evento.php?idEvento=<?php echo $evento['id']?>" class="btn btn-primary" role="button">Ver detalhes</a></p>
                              </div>
                            </div>
                          </div>
                            <?php } while($evento = $execute->fetch_assoc());?>

                        </div>
                    
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="index.php?pagina=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <?php for($i=0;$i<$num_paginas;$i++){ ?>
                              <li> <a href="index.php?pagina=<?php echo $i+1; ?>"> <?php echo $i+1; ?> </a> </li>
                            <?php } ?>
                            <li>
                              <a href="index.php?pagina=<?php echo $num_paginas; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    
                </div>
                <?php } else { ?>
                <img src="img/default2.png" style="top:20px; width:30%; left:400px;  position:relative; border:1px solid black;border-radius:20px;">
                <?php } ?>
		      </div>
            
        </div>
        <?php require_once("inc/footer.inc");?>
	</body>
    
</html>