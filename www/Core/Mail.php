<?php
namespace App\Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Mail{
    
        private String $to;
        private String $subject;
        private String $message;
    
        public function __construct(String $to, String $subject, String $message)
        {
            $this->to = $to;
            $this->subject = $subject;
            $this->message = $message;
        }
    
        public function send(): void
        {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = '';                     // SMTP username
                $mail->Password   = '';                               // SMTP password
                $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 2525;                                    // TCP port to connect to
    
                //Recipients
                $mail->setFrom('', 'Mailer');
                $mail->addAddress($this->to);     // Add a recipient                
                // Contenu de l'e-mail
                $mail->Subject = 'Bienvenue !';
                $mail->Body = 'Bienvenue sur notre site. Nous sommes ravis de vous compter parmi nous !';
                
                // Envoi de l'e-mail
                $mail->send();
                        
                // Si l'e-mail est envoyé avec succès
                        echo 'L\'e-mail de bienvenue a été envoyé avec succès.';
                    } catch (Exception $e) {
                        // En cas d'erreur lors de l'envoi de l'e-mail
                        echo 'Une erreur est survenue lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
            }
        }

}
