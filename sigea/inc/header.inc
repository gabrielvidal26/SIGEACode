<?php
    date_default_timezone_set("America/Sao_Paulo");
    setlocale(LC_ALL, 'pt_BR');
	session_start();
	$logado=isset($_SESSION["usuario"]);

?>
<head>
<link rel="shortcut icon" href="/sigea/img/icon.ico" type="image/x-icon"/>
</head>
<div class="header">
	<meta charset="utf-8">
    
    <img style="padding: 50px 0px 0px 46%;" src="/sigea/img/logo2.png" center>
    <br><br><br>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a class="navbar-brand" href="index.php"><img height="30" width="30" src="/sigea/img/icon.png" style="margin:-5px -5px;"></a>
        </div>
        <!--
		<?php
        if(isset($_SESSION['msg'])){ ?>
            <p class="saudacao"><?=$_SESSION['msg']?></p>
            <?php } ?>
		-->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/sigea/index.php">Home <span class="sr-only">(current)</span></a></li>
          </ul>
          <?php if (isset($_SESSION['usuario'])){?>
          <ul class="nav navbar-nav">
            <li class="active"><a href="/sigea/perfil.php" style="margin-left:2px;">Perfil  <span class="sr-only">(current)</span></a></li>
             <li class="active"><a href="/sigea/cadastroEve.php" style="margin-left:2px;">Criar evento <span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="/sigea/meusEve.php" style="margin-left:2px;">Meus eventos <span class="sr-only">(current)</span></a></li>

			<li class="active"><a href="/sigea/eveConf.php" style="margin-left:2px;">Eventos com presença confirmada <span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <li><p class="navbar-text" style="padding-right:30px">Bem vindo, <?php echo $_SESSION["nome"]?></p></li>
            <div class="sair">
                <a href="/sigea/sair.php" data-toggle="tooltip" data-placement="left" title="Sair">
                    <button type="button" class="btn btn-default" aria-label="Right Align" style="float:right;">
                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                    </button>
                </a>
            </div>
          
          
            <?php }else{ ?>
                <ul class="nav navbar-nav navbar-right">
          <li><p class="navbar-text">Já possui uma conta?</p></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><b>Entrar</b> <span class="caret"></span></a>
			
            <ul id="login-dp" class="dropdown-menu">
				<li>
				    <div class="row">
						<div class="col-md-12">
                            <form class="form" role="form" method="post" action="/sigea/autentica.php" accept-charset="UTF-8" id="login-nav">
				                <div class="form-group">
								    <label class="sr-only" for="exampleInputEmail2">Email address</label>
									<input type="text" class="form-control" id="exampleInputEmail2" placeholder="Usuário" name ="usuario" required>
								</div>
								<div class="form-group">
								    <label class="sr-only" for="exampleInputPassword2">Password</label>
									<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Senha" name ="senha" required>

                                <br>
								<div class="form-group">
								    <button type="submit" id="entrar" value=0 class="btn btn-primary btn-block"  >Entrar</button>
								</div>
                                <div align="center">Ou</div>
                                <?php
                                    if(isset($_SESSION['msg'])){ ?>
                                        <p style="color: red;"><?=$_SESSION['msg']?></p>
                                        <script>
                                            $(document).ready(function(){
                                                $(".dropdown-toggle").dropdown("toggle"); 
											});
										</script>
										
                                    <?php } 
                                    $_SESSION['msg']=null;?>
                                    <?php
                                        require_once 'Facebook/autoload.php';
                                        $fb = new Facebook\Facebook([
                                            'app_id' => '1788903651415583', // Replace {app-id} with your app id
                                            'app_secret' => '971eefb44fdf0bd08db9645afc9b4501',
                                            'default_graph_version' => 'v2.11',
                                          ]);

                                        $helper = $fb->getRedirectLoginHelper();

                                        $permissions = ['email']; // Optional permissions
                                        $loginUrl = $helper->getLoginUrl('http://localhost/sigea/fb-callback.php', $permissions);
								  echo '<a href="' . htmlspecialchars($loginUrl) . '"><img src="img/facebook.png" height="55px"></img></a>'?>
                                  
				            </form>
				        </div>
				        <div class="bottom text-center">
						  Novo por aqui? <a href="/sigea/registro.php"><b>Crie uma conta</b></a>
				        </div>
					 </div>
				</li>
			</ul>
            
            <?php } ?>
        </li>
            
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
</div>