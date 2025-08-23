<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php'; // Autoload Composer

class Mailer
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        try {
            // Paramètres du serveur SMTP
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.example.com'; // ton serveur SMTP
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'ton_email@example.com'; // ton email
            $this->mail->Password = 'ton_motdepasse';       // ton mot de passe
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            $this->mail->setFrom('ton_email@example.com', 'Event Platform');
        } catch (Exception $e) {
            echo "Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function sendMail($to, $subject, $body)
    {
        try {
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();
            $this->mail->clearAddresses(); // Important pour ne pas accumuler les destinataires
        } catch (Exception $e) {
            error_log("Mail error to {$to}: {$this->mail->ErrorInfo}");
        }
    }
}
