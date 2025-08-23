<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class Mailer
{
    private PHPMailer $mail;

    public function __construct(array $cfg)
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = $cfg['host'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $cfg['username'];
        $this->mail->Password = $cfg['password'];
        $this->mail->SMTPSecure = $cfg['encryption'];
        $this->mail->Port = $cfg['port'];

        $this->mail->setFrom($cfg['from_address'], $cfg['from_name']);
        $this->mail->isHTML(true);
        $this->mail->CharSet = 'UTF-8';
    }

    public function send(string $toEmail, string $toName, string $subject, string $htmlBody): bool
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($toEmail, $toName);
            $this->mail->Subject = $subject;
            $this->mail->Body = $htmlBody;
            $this->mail->AltBody = strip_tags($htmlBody);
            return $this->mail->send();
        } catch (Exception $e) {
            error_log('[Mailer] Erreur : ' . $e->getMessage());
            return false;
        }
    }
}
