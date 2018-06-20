<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
<?php 
    include("classes/conexao.php"); 
 
    $id3 = $_GET ['id3'];
    $sql3 = "DELETE FROM interesse WHERE id_interesse=$id3";
    $exec = $mysqli->query($sql3) or die($mysqli->error);
?>

<script>
    alert("Presença Cancelada !");
    window.location.href="index.php"
</script>