<?php
    include("classes/conexao.php"); 
	require_once("inc/header.inc");
    $nome_eve=$_POST['nomeeve'];
    $descricao=$_POST['desceve'];
    $id_usuario = $_SESSION['id_usuario'];
    $dataini=$_POST['dataini'];
    $datafim=$_POST['datafim'];
    $datahj=date('Y-m-d');
    
    if(strtotime($dataini) < strtotime($datahj))
    { 
        if(strtotime($datafim) < strtotime($datahj))
        {?>
        <script>
            alert("Data inválida");
            window.location.href = "cadastroEve.php";
        </script>
  <?php  } 
    }

else{
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'foto' ][ 'name' ] ) && $_FILES[ 'foto' ][ 'error' ] == 0 ) {
   $msg1 = 'Você enviou o arquivo: <strong>' . $_FILES[ 'foto' ][ 'name' ] . '</strong><br />';
   $msg2 = 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'foto' ][ 'type' ] . ' </strong ><br />';
   $msg3 = 'O nome do seu evento é:<strong>' . $nome_eve . '</strong><br />';
   $msg4 = 'Descrição do seu evento: <strong>' . $descricao . '<br /><br />';
 
    $arquivo_tmp = $_FILES[ 'foto' ][ 'tmp_name' ];
    $nome = $_FILES[ 'foto' ][ 'name' ];
    
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
    $extensao1 = '.' . $extensao;
    // Converte a extensão para minúsculo
    $extensao2 = strtolower ( $extensao1 );
 
    // Somente imagens, .jpg;.jpeg;
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.png;.gif', $extensao2 ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . $extensao2;
 
        // Concatena a pasta com o nome
        $destino = 'img/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( copy ( $arquivo_tmp, $destino ) ) {
            $msg5 = 'Arquivo salvo com sucesso !</strong><br/>';
            ////////////// SQL//////////////////
            
            $sql = "INSERT INTO evento (nome,descricao,dataini,datafim,nome_img,proprietario) VALUES('$nome_eve','$descricao','$dataini','$datafim','$novoNome','$id_usuario')";
            $execute = $mysqli->query($sql) or die($mysqli->error);
            
            $sql2 = "SELECT MAX(id) FROM evento";
            $execute2 = $mysqli->query($sql2) or die($mysqli->error);
            $idmax = mysqli_fetch_row($execute2);
            
            //$sql3 = "INSERT INTO palestra (data,id_evento) VALUES('".$_POST['dataini']."', '".$_POST['datafim']."', $idmax[0])";
            //$execute3 = $mysqli->query($sql3) or die($mysqli->error);
            
            //$sql4 = "SELECT MAX(id_palestra) FROM palestra";
            //$execute4 = $mysqli->query($sql4) or die($mysqli->error);
            //$idmax2 = mysqli_fetch_row($execute4);
            
                foreach($_POST['tema'] as $indice => $value) {
                    
                        $sql = "INSERT INTO palestra(tema,data,horaini,horafim,palestrante,id_evento) VALUES ('".$_POST['tema'][$indice]."','".$_POST['data'][$indice]."','".$_POST['horaini'][$indice]."','".$_POST['horafim'][$indice]."','".$_POST['palestrante'][$indice]."','$idmax[0]')";	
                    // ou mysql_query("INSERT INTO minha_tabela (nome,valor) VALUES('".$_POST['nome'][$indice]."', '".$_POST['valor'][$indice]."')");
                    
                        $execute = $mysqli->query($sql) or die($mysqli->error);
                    }	
            
        }
        else
            $msg7 = 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br/>';
    }
    else
        $msg8 = 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.png;*.gif;"<br/>';
}
else
    $msg9 = 'Você não enviou nenhum arquivo!';
}
?>

    
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
		<title>SIGEA</title>
        
        
         CSS do validador 
        <link href="css/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
        <link href="css/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
        <link href="css/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
        
         <link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body style="background-color:azure;">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

		
            <div class ="registroprod2">
                <?php  
                    if(isset($msg7))
                    {                       
                        echo $msg7;
                    }
                    else if(isset($msg8))
                    {    
                        echo $msg8;
                    
                    }
                    else if(isset($msg9))
                    {                        
                            
                        echo $msg9;
    
                    }
                    else
                    {
                        echo $msg1;
                        echo $msg2;
                        echo $msg3;
                        echo $msg4;
                        echo $msg5;
                        //echo $sql;
                        
                    }

                ?>
                
                <img src="<?php echo $destino ?>" style="max-width: 500px; max-height: 500"/>
                
            </div>
    </body>
</html>