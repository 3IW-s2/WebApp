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
            $to = $this->to;
            $subject = $this->subject;
            $message = $this->message;

            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                       // Enable verbose debug output
                $mail->isSMTP();                             // Send using SMTP
                $mail->Host       = '46.226.107.16';
                $mail->Username   = 'user';         // SMTP username
                $mail->Password   = 'pass';         // SMTP password
                $mail->Port       = 25;                      // TCP port to connect to

                // Recipients
                $mail->setFrom('audesandrine6@gmail.com', 'Gavin');
                $mail->addAddress($to);     // Add a recipient

                // Content
                $mail->isHTML(true);                            // Set email format to HTML
                $mail->Subject = $subject;
                //$mail->Body= $message;
                //si la taille de $message est supérieur à 57 caractères (le message préfait)
                try {
                    if (strlen($message) > 57) {
                        $url = substr($message, 57);
                       //generer un qrcode en utilisant google chart
                        $qrCodeUrl = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . urlencode($url) . '&choe=UTF-8';
                        //met plutot l'image du qrcode  dans le body du mail avec le message
                        $mail->Body = '<img src="' . $qrCodeUrl . '" alt="QR Code" /> <br>' . $message;
                        $mail->IsHTML(true);  

                    }else {
                        $mail->Body = $message;
                    }
    
                } catch(\Exception $e) {
                    echo $e->getMessage();
                    die;
                }
                
            
               
               
                //$mail->Subject = 'Bienvenue ! ';
                //$mail->Body    = 'Bienvenue sur notre site. Nous sommes ravis de vous compter parmi nous ! votre code de confirmation est : 123456';
                

                // Envoi de l'e-mail
                $mail->send();
                        
                // Si l'e-mail est envoyé avec succès
                        //echo "L'e-mail  a été envoyé avec succès.";
                    } catch (Exception $e) {
                        // En cas d'erreur lors de l'envoi de l'e-mail
                       // echo 'Une erreur est survenue lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
            }
        }

     
        

}
