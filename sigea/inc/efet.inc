<?php
	$session_start();
	$usuario = isset($_SESSION['usuario']);
	
?>


<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="../css/estilo.css">
		<title>EcoEscambo - Playstation 4</title>
        
         <link href="../css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>

        
        
		<?php require_once("../inc/header.inc");?>

		<div class="content">
            <div class="container bg-primary">
				<?php if (!$usuario) { ?>
				usuário não está logado ainda.
				<?php } elseif($confirm!=1){ ?>
					Usuário ainda não realizou confirmação de email.
				}
			</div>
		</div>
	</body>
</html>
					