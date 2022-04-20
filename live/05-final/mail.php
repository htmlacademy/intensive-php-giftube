<?php
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

require 'vendor/autoload.php';

//<editor-fold desc="dsn">
// Конфигурация траспорта
$dsn = 'smtp://75f3c8c888f4c0:d3bf00f9a2376d@smtp.mailtrap.io:2525?encryption=tls&auth_mode=login';
$transport = Transport::fromDsn($dsn);
//</editor-fold>

//<editor-fold desc="message">
// Формирование сообщения
$message = new Email();
$message->to("sks89@mail.ru");
$message->from("mail@giftube.academy");
$message->subject("Просмотры вашей гифки");
$message->text("Вашу гифку «Кот и пылесос» посмотрело больше 1 млн!");
//</editor-fold>

//<editor-fold desc="send">
// Отправка сообщения
$mailer = new Mailer($transport);
$mailer->send($message);
//</editor-fold>