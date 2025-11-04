<?php
/**
 * Класс для отправки писем через SMTP
 */
class MailSender {
    private $mail;
    
    public function __construct() {
        if (defined('COMPOSER_NOT_INSTALLED') || !class_exists('PHPMailer\PHPMailer\PHPMailer')) {
            throw new Exception('Composer зависимости не установлены. Запустите: composer install');
        }
        $this->mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $this->configure();
    }
    
    private function configure() {
        // Настройки SMTP
        $this->mail->isSMTP();
        $this->mail->Host = SMTP_HOST;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = SMTP_USERNAME;
        $this->mail->Password = SMTP_PASSWORD;
        
        // Для Beget используем SSL на порту 465
        if (SMTP_PORT == 465) {
            $this->mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $this->mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        }
        
        $this->mail->Port = SMTP_PORT;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        // Отправитель
        $this->mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
    }
    
    /**
     * Отправить письмо
     * 
     * @param string $to Адрес получателя
     * @param string $subject Тема письма
     * @param string $body Тело письма (HTML)
     * @param array $attachments Массив путей к файлам для вложения
     * @return bool
     */
    public function send($to, $subject, $body, $attachments = []) {
        try {
            $this->mail->clearAddresses();
            $this->mail->clearAttachments();
            
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            
            // Добавление вложений
            foreach ($attachments as $attachment) {
                if (file_exists($attachment)) {
                    $this->mail->addAttachment($attachment);
                }
            }
            
            return $this->mail->send();
        } catch (Exception $e) {
            error_log("Ошибка отправки письма: {$this->mail->ErrorInfo}");
            return false;
        }
    }
}
?>
