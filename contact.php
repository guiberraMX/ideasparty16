<?php
    //ini_set('display_errors', '1');
    require 'php_mailer/PHPMailerAutoload.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host       = 'smtp.gmail.com';
    //
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = true;
    //
    $mail->Username   = 'ideaspartymx@gmail.com';
    $mail->Password   = '1d3aspartymx';

    $mail->setFrom('ideaspartymx@gmail.com', 'Ideas Party');
    $mail->addAddress('jjuarez007@gmail.com');
    $mail->addAddress('ideaspartymx@gmail.com');
    //Set the subject line
    $mail->Subject = 'Registro IdeasPartyMX';





    if($_POST)
    {

    	//check if its an ajax request, exit if not
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

    		//exit script outputting json data
    		$output = json_encode(
    		array(
    			'type'=>'error',
    			'text' => 'Request must come from Ajax'
    		));

    		die($output);
        }

    	//check $_POST vars are set, exit if any missing
    	if(!isset($_POST["nombre"])
    		|| !isset($_POST["edad"])
    		|| !isset($_POST["ciudad"])
    		|| !isset($_POST["correo"])
    		|| !isset($_POST["codigo"]))
    	{
    		$output = json_encode(array('type'=>'error', 'text' => 'Por favor rellena todos los campos!'));
    		die($output);
    	}

    	//Sanitize input data using PHP filter_var().
    	$user_Name        = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    	$user_Email       = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
    	$edad        = filter_var($_POST["edad"], FILTER_SANITIZE_STRING);
    	$ciudad        = filter_var($_POST["ciudad"], FILTER_SANITIZE_STRING);
    	$codigo        = filter_var($_POST["codigo"], FILTER_SANITIZE_STRING);
    	// $user_Type        = filter_var($_POST["userType"], FILTER_SANITIZE_STRING);


    	$message ="Hola mi nombre es ".$user_Name.". Tengo ".$edad.". Soy de: ".$ciudad.". ";
    	$message .= "Ya he adquirido mi boleto en algun punto de venta y voy a terminar mi registo. ";
    	$message .= "Mi correo electronico es: ".$user_Email.". ";
    	$message .= "El codigo de mi boleto es: ".$codigo.". Nos vemos este 20 de Octubre. Hasta Pronto!";




        $mail->Body = $message;

        $sentMail = $mail->send();


    	if(!$sentMail)
    	{
    		$output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'.$mail->ErrorInfo));
    		die($output);
    	}else{
    		$output = json_encode(array('type'=>'message', 'text' => 'Te has registrado exitosamente'));
    		die($output);
    	}





    }

?>
