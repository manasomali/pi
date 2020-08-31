
<?php
 $nome = $_POST["nome"];
 $email = $_POST["email"];
 $mensagem = $_POST["mensagem"];
 $assunto = "Ferramenta PI: ".$nome." - ".$email;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'gese.energia@gmail.com';                 // SMTP username
    $mail->Password = 'senha';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($email, $nome);
    $mail->addAddress('matheus.marques_96@hotmail.com', 'eu');     // Add a recipient
    
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $assunto;
    $mail->Body    = $mensagem;
    $mail->AltBody = $mensagem;

    $mail->send();

    header("Location: https://gese.florianopolis.ifsc.edu.br/consumidorlivre/precoindiferente/index.php");
    die();

} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
