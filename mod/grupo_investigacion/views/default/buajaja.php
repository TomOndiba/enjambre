
<?php
// Crear una nueva  instancia de PHPMailer habilitando el tratamiento de excepciones
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 25;
$mail->Host = '172.18.21.231';
$mail->Username = "root";
$mail->Password = "elgg2014";
$mail->From = "carlosjrinconavila@gmail.com";
$mail->FromName = "Mi nombre y apellidos";
$mail->AddAddress("erlis1986@gmail.com", "Nombre 1");
$mail->AddAddress("carlosjrinconavila@gmail.com", "Nombre 2");
$mail->Subject = "Asunto del correo";
$body = "Proebando los correos con un tutorial<br>";
$body .= "hecho por <strong>Developando</strong>.<br>";
$body .= "<font color='red'>Visitanos pronto</font>";
$mail->Body = $body;
$mail->Send();
 
?>

