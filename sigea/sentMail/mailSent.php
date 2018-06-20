<?php
    include("../classes/conexao.php"); 
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha=$_POST['senha'];
    $aut = false;
	$suc=0;
	
	$sql = "SELECT usuario,email FROM usuario";
    $exec = $mysqli->query($sql) or die($mysqli->error);
	
    foreach($exec as $row){
		if ($row['usuario'] === $usuario){?>
			<script>
				alert("Usuário já cadastrado!");
				window.location.href= "../registro.php";
			</script>
		<?php $suc++;
		}
		if ($row['email'] === $email){?>
			<script>
				alert("E-mail já cadastrado!");
				window.location.href= "../registro.php";
			</script>
		<?php $suc++;
		}
	}
	if ($suc===0){
		
		$sqlcode = "INSERT INTO usuario(nome,usuario,email,senha,aut) VALUES
					('$nome','$usuario','$email','$senha',0)";


		$execute = $mysqli->query($sqlcode) or die($mysqli->error);    


		$sql = "SELECT id_usuario FROM usuario WHERE usuario='$usuario'";
		$execute = $mysqli->query($sql) or die($mysqli->error);    
		
		$row=mysqli_fetch_assoc($execute);

		$id = $row['id_usuario'];

		// A mensagem enviada
		$message = "Olá Sr/Sra ".$usuario."\nBem vindo ao SIGEA!\n\n
		Para confirmar seu login acesse: http://eduardosantos.16mb.com/sigea/sentMail/confirm.php?id=".$id;

		$headers = "MIME-Version: 1.1\r\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		$headers .= "From: admin@sigea.com\r\n"; // remetente
		$headers .= "Return-Path: admin@sigea.com\r\n"; // return-path
		// Send
		$envio = mail($email, "SIGEA - Confirmação de email", $message,$headers);
		if($envio)
			echo "Mensagem enviada com sucesso";
		else
			echo "A mensagem não pode ser enviada";
?>

    <script>
        alert("Cadastro efetivado com sucesso!");
        window.location.href = "../index.php";
    </script>
	<?php } ?>