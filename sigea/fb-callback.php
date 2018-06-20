<?php    

    session_start();
    include("classes/conexao.php");
    require_once 'Facebook/autoload.php';
    $fb = new Facebook\Facebook([
      'app_id' => '1788903651415583', // Replace {app-id} with your app id
      'app_secret' => '971eefb44fdf0bd08db9645afc9b4501',
      'default_graph_version' => 'v2.11',
      ]);

    $helper = $fb->getRedirectLoginHelper();
    //var_dump($helper);

    if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
    }
    try {
      $accessToken = $helper->getAccessToken();
        //var_dump($accessToken);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    if (! isset($accessToken)) {
      if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
      } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
      }
      exit;
    }

    // Logged in
    //echo '<h3>Access Token</h3>';
    //var_dump($accessToken->getValue());

    // The OAuth 2.0 client handler helps us manage access tokens
    $oAuth2Client = $fb->getOAuth2Client();

    // Get the access token metadata from /debug_token
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    //echo '<h3>Metadata</h3>';
    //var_dump($tokenMetadata);

    // Validation (these will throw FacebookSDKException's when they fail)
    $tokenMetadata->validateAppId('1788903651415583'); // Replace {app-id} with your app id
    // If you know the user ID this access token belongs to, you can validate it here
    //$tokenMetadata->validateUserId('123');
    $tokenMetadata->validateExpiration();

    if (! $accessToken->isLongLived()) {
      // Exchanges a short-lived access token for a long-lived one
      try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
      } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
        exit;
      }

      //echo '<h3>Long-lived</h3>';
      //var_dump($accessToken->getValue());
    }

    try {
      // Returns a `Facebook\FacebookResponse` object
      $response = $fb->get('/me?fields=id,name,email', $accessToken);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

        $user = $response->getGraphUser();

        $sqlcode2 = "SELECT email FROM usuario WHERE email = '".$user['email']."'";
        $email = $mysqli->query($sqlcode2) or die($mysqli->error);
        //$email->num_rows;
        //$busca = mysqli_stmt_num_rows($email);

    if(($email->num_rows) =='0')
    {
        $sqlcode = "INSERT INTO usuario(nome,usuario,email,senha,aut) VALUES              ('".$user['name']."','".$user['email']."','".$user['email']."','".$user['id']."',1)";
        $execute = $mysqli->query($sqlcode) or die($mysqli->error);
        $_SESSION['fb_access_token'] = (string) $accessToken;
    }
    
        $sql = "SELECT id_usuario,nome,usuario,senha FROM usuario";
        $exec = $mysqli->query($sql) or die($mysqli->error);

        $usuario = $user['email'];
        $senha = $user['id'];


        foreach ($exec as $row){   
            if ($row['usuario']==$usuario && $row['senha']==$senha){
                $sql2 = "SELECT aut FROM usuario WHERE usuario = '$usuario'";
                $execute = $mysqli->query($sql2) or die($mysqli->error);
                $lin=mysqli_fetch_assoc($execute);
                $aut = $lin['aut'];
                
                if ($aut==1){

                    $_SESSION['usuario']=$usuario;
                    $_SESSION['msg'] = "Bem vindo $usuario!";
                    $_SESSION['nome']= $row['nome'];
                    $_SESSION['id_usuario']=$row['id_usuario'];
                    header('Location: http://localhost/sigea/index.php');
                }
                else{

                    $_SESSION['msg'] = "Por favor, autentifique sua conta através do email enviado, Obrigado!";
                    header('Location: http://localhost/sigea/index.php');
                }
            }
        }

    // User is logged in with a long-lived access token.
    // You can redirect them to a members-only page.
    //header('Location: http://localhost/ecoescambo/index.php');
?>