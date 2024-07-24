<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

function sendMail($to, $subject, $body)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->CharSet = "utf-8";
        $mail->Host = "smtp.beget.com";
        $mail->SMTPAuth = true;
        $mail->Username = "admin@s5cheats.ru";
        $mail->Password = "2uhEW6owEFJ%";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port = 465;
        // Recipients
        $mail->setFrom("admin@s5cheats.ru", "s5cheats");
        $mail->addAddress($to);
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        // Content
        // $mail->isHTML(true); // Set email format to HTML
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $body;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        #echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        error_log(
            "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
        );
        return false;
    }
}

SendMail();
