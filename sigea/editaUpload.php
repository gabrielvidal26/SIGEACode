<?php
    include("classes/conexao.php"); 
	require_once("inc/header.inc");
    

    $nome_eve=$_POST['nomeeve'];
    $id_e=$_POST['id'];

//    $sql2 = "SELECT id FROM evento WHERE nome='$nome_eve'";
//    $execute = $mysqli->query($sql2) or die($mysqli->error);
//    $id_e = $execute->fetch_assoc();

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
       <?php }
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

                    $sql = "UPDATE evento SET nome='$nome_eve',descricao='$descricao',dataini='$dataini',datafim='$datafim',proprietario='$id_usuario',nome_img='$novoNome' WHERE id='$id_e'";
                    $execute = $mysqli->query($sql) or die($mysqli->error);

                }
            }
        }
        else {
            $sql = "UPDATE evento SET nome='$nome_eve',descricao='$descricao',dataini='$dataini',datafim='$datafim',proprietario='$id_usuario' WHERE id='$id_e'";
            $execute = $mysqli->query($sql) or die($mysqli->error);
            }        
        }
header("Location: meusEve.php");
?>