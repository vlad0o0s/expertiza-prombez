<?php
/**
 * Класс для отправки писем через SMTP
 * Использует PHPMailer из public_html/PHPMailer
 */

// Подключаем PHPMailer из корня проекта
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailSender
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->configure();
    }

    private function configure()
    {
        // Настройки SMTP (как в public_html/sendmail.php)
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.beget.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'test@realmdigital.ru';
        $this->mail->Password = 'SmmwcUd123!';
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Port = 465;

        $this->mail->CharSet = 'UTF-8';

        // Отправитель
        $this->mail->setFrom('test@realmdigital.ru', 'TOP EXPERT');
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
    public function send($to, $subject, $body, $attachments = [])
    {
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