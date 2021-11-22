<?php
require 'PHPMailerAutoload.php';
define('MSA_MAIL','multisoftacademy@gmail.com');
define('MSA_PWD','msoft2009');

$mail = new PHPMailer;
$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = gethostbyname('smtp.gmail.com');  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = MSA_MAIL;                 // SMTP username
$mail->Password = MSA_PWD;                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom(MSA_MAIL, "Multisoft");
$mail->addAddress(MSA_MAIL, "Petit test");     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addCC(MSA_MAIL);
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(false);                                  // Set email format to HTML

$mail->Subject = "Un essai";
$mail->Body = "Ceci est un essai.";
$mail->AltBody = "Ceci est un essai.";

if (!$mail->send()) {
    echo "Mal passé.";
    echo "Erreur: ".$mail->ErrorInfo;
} else {
    echo "Bien passé";
}