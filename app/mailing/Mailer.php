<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class Mailer
{
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'wathekzidi68@gmail.com';
        $this->mail->Password = 'zlkuziqghnpkqsez';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;

        $this->mail->setFrom('wathekzidi68@gmail.com', 'Event Platform');
    }

    // Envoie un mail simple à une adresse spécifique
    public function send(string $to, string $subject, string $body, string $htmlBody = ''): bool
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $htmlBody ?: $body;
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            echo "Erreur PHPMailer : " . $this->mail->ErrorInfo;
            return false;
        }
    }

    // Envoie un mail toujours à ton adresse fixe
    public function sendToMe(string $subject, string $htmlBody): bool
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress('wathekzidi68@gmail.com');
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $htmlBody;
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            echo "Erreur PHPMailer : " . $this->mail->ErrorInfo;
            return false;
        }
    }
}
