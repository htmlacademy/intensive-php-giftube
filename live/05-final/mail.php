<?php
require_once 'vendor/autoload.php';
require_once '../common/init.php';


$transport = new Swift_SmtpTransport("smtp.mailtrap.io", 2525);
$transport->setUsername("75f3c8c888f4c0");
$transport->setPassword("d3bf00f9a2376d");

$mailer = new Swift_Mailer($transport);

$sql = "SELECT id, title, show_count, path FROM gifs g WHERE MONTH(dt_add) = MONTH(NOW()) "
     . "AND YEAR(dt_add) = YEAR(NOW()) ORDER BY show_count DESC LIMIT 3";

$res = mysqli_query($link, $sql);

if ($res && mysqli_num_rows($res)) {
    $gifs = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $res = mysqli_query($link, "SELECT email, name FROM users");

    if ($res && mysqli_num_rows($res)) {
        $users = mysqli_fetch_all($res, MYSQLI_ASSOC);
        $recipients = [];

        foreach ($users as $user) {
            $recipients[$user['email']] = $user['name'];
        }

        $message = new Swift_Message();
        $message->setSubject("Самые горячие гифки за этот месяц");
        $message->setFrom(['keks@phpdemo.ru' => 'GifTube']);
        $message->setTo($recipients);

        $msg_content = include_template('month_email.php', ['gifs' => $gifs]);
        $message->setBody($msg_content, 'text/html');

        $result = $mailer->send($message);

        if ($result) {
            print("Рассылка успешно отправлена");
        }
        else {
            print("Не удалось отправить рассылку");
        }
    }
}
