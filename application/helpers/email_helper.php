<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * Configuration du système d'envoi des mails
 */
define('MAIL_USER', "service_commercial@kajepi.com");
define('MAIL_USER_NAME', "SERVICE COMMERCIAL KAJEPI PRINT");
define('MAIL_PWD', "kajepiCom");
define('MAIL_PORT', 465);
define('MAIL_SECURE', "ssl");
define('MAIL_HOST', "imap.kajepi.com");

define('MAIL_SUPPORT_GROSSISTE', "support.sygalin@groupelin.com");

define('SD_MAIL_TITLE', "title");
define('SD_MAIL_MESSAGE', "message");
define('SD_MAIL_SENDTO', "sendTo");
define('SD_MAIL_REPLYTO', "replyTo");
define('SD_MAIL_USERNAME', "userName");
define('SD_MAIL_FILE', "file");
define('SD_MAIL_CC', "cc");

if ( ! function_exists('send')) {
    function send($creds=array())
    {
        date_default_timezone_set('Etc/UTC');

        $mail = new PHPMailer;
        $mail->isSMTP();
        //$mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';// Enable verbose debug output

                                          // Set mailer to use SMTP
        $mail->Host = 'mail.msacad.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;   // Enable SMTP authentication
        $mail->Port = 25;
        $mail->Username = $creds['userMail'];                 // SMTP username
        $mail->Password = $creds['userPassword'];                           // SMTP password
        //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                                         // TCP port to connect to

		try {
			$mail->setFrom($creds['from'][0], $creds['from'][1]);
		} catch (phpmailerException $e) {
		}
		$mail->addAddress($creds['to'][0]);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($creds['replyTo'], 'C.F.P. MULTISOFT ACADEMY');
        $mail->addCC($creds['to'][0]);
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML($creds['html']);                                  // Set email format to HTML

        $mail->Subject = $creds['subject'];
        $mail->Body = $creds['message'];
        $mail->AltBody = htmlspecialchars($creds['message']);

        if (!$mail->send()) {
            return $mail->ErrorInfo;
        } else {
            return true;
        }
    }
}

/*if ( ! function_exists('sendMail')) {
    function sendMail($infos=array())
    {
        $info=(object) $infos;
        $data['mail']=$info;
        $creds = array(
            'userMail' => MSA_MAIL,
            'userPassword' => MSA_PWD,
            'from' => array(MSA_MAIL, 'C.F.P. MULTISOFT ACADEMY'),
            'to' => array($info->user->mail, ucwords($info->user->firstname).' '.mb_strtoupper($info->user->lastname)),
            'replyTo' => MSA_MAIL,
            'cc' => $info->user->mail,
            'html' => true,
            'subject' => $info->title,
            'message' => mailView($data)
        );

        return send($creds);
    }
}*/

if(!function_exists("sendMail")) {
    function sendMail($info=array()){
        $controller = &get_instance();

        $data['mail']=new stdClass();
        $data['mail']->title=$info["title"];
        $data['mail']->message=$info["message"];
        $controller->load->library('CI_Mailer');
        $mail=new CI_Mailer(true);
		try {
			if(isset($info["mailFrom"]) and isset($info["mailFromName"]) and !empty($info["mailFrom"]) and !empty($info["mailFromName"]))
				$mail->setFrom($info["mailFrom"], $info["mailFromName"]);
			$mail->to(array(array($info["sendTo"], $info["userName"])))
				->loadView('infos', $data)
				->setSubject($data['mail']->title);

//        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/sygalin-75.jpeg', 'logo','sygalin-75.jpeg');

			if(isset($info["file"])){
				if(is_array($info["file"]) and !empty($info["file"])){
					foreach ($info["file"] as $k=>$item) {
						$mail->AddAttachment($item, "fichier-$k");
					}
				}
				else{
					$mail->AddAttachment($info["file"], "fichier");
				}
			}


			$mail->addReplyTo($info['replyTo'], 'SUPPORT SYGALIN');

			if(isset($info["cc"])){
				if(is_array($info["cc"]) and !empty($info["cc"])){
					foreach ($info["cc"] as $k=>$item) {
						$mail->addCC($item);
					}
				}
				else{
					$mail->addCC($info["cc"]);
				}
			}

			return $mail->Mail();
		} catch (phpmailerException $e) {
			var_dump($e->getMessage());
		}




    }
}

if ( ! function_exists('sendNewLetter')) {
    function sendNewLetter($infos=array())
    {

        $info=(object) $infos;
        $data['mail']=$info;
        $creds = array(
            'userMail' => MSA_MAIL2,
            'userPassword' => MSA_PWD2,
            'from' => array(MSA_MAIL2, 'C.F.P. MULTISOFT ACADEMY'),
            'to' => array($info->email),
            'replyTo' => MSA_MAIL2,
            'cc' => $info->email,
            'html' => true,
            'subject' => utf8_decode($info->subject),
            'message' => $info->contenu
        );

        return send($creds);
    }
}

if(!function_exists('mailView')){
    function mailView($vars=array()){
        $CI = &get_instance();
        return $CI->load->view("email", $vars, true);
    }
}
