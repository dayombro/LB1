<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = $_GET['emailname'];
$subject = $_GET['betreff'];
$content = $_GET['text'];
require_once 'vendor/autoload.php';


$mail = new PHPMailer;
try{
 $mail->setFrom($name, 'Feedback');
   $mail->addAddress('einetestmailvonmir@gmail.com');
   $mail->Subject = $subject;
   $mail->Body = $content;
    $mail->Body .= "
E-Mail: ";
    $mail->Body .= $name;
   /* SMTP parameters. */

   /* Tells PHPMailer to use SMTP. */
   $mail->isSMTP();

   /* SMTP server address. */
   $mail->Host = 'smtp.gmail.com';

   /* Use SMTP authentication. */
   $mail->SMTPAuth = true;

   /* Set the encryption system. */
   $mail->SMTPSecure = 'tls';

   /* SMTP authentication username. */
   $mail->Username = 'einetestmailvonmir@gmail.com';

   /* SMTP authentication password. */
   $mail->Password = 'Aaa12345$';

   /* Set the SMTP port. */
   $mail->Port = 587;

   /* Finally send the mail. */
   $mail->send();

}
catch (Exception $e)
{
   echo $e->errorMessage();
}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Feedback sent</title>
</head>
<body>
<h1>Feedback</h1>
<h3>Your feedback has been sucessfully sent</h3>
</body>
</html>

