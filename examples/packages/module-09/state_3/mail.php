<?php
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

require_once 'vendor/autoload.php';
require_once 'init.php';
require_once 'functions.php';

/* BEGIN STATE 01 */
$dsn = 'smtp://75f3c8c888f4c0:d3bf00f9a2376d@smtp.mailtrap.io:2525?encryption=tls&auth_mode=login';
$transport = Transport::fromDsn($dsn);
/* END STATE 01 */

/* BEGIN STATE 02 */
$mailer = new Mailer($transport);
/* END STATE 02 */


/* BEGIN STATE 03 */
$sql = "SELECT id, title, show_count, path FROM gifs g WHERE MONTH(dt_add) = MONTH(NOW()) "
     . "AND YEAR(dt_add) = YEAR(NOW()) ORDER BY show_count DESC LIMIT 3";

$res = mysqli_query($link, $sql);
/* END STATE 03 */

/* BEGIN STATE 04 */
if ($res && mysqli_num_rows($res)) {
    $gifs = mysqli_fetch_all($res, MYSQLI_ASSOC);

    /* BEGIN STATE 05 */
    $res = mysqli_query($link, "SELECT email, name FROM users");

    if ($res && mysqli_num_rows($res)) {
        $users = mysqli_fetch_all($res, MYSQLI_ASSOC);
        /* BEGIN STATE 06 */
        $recipients = [];

        foreach ($users as $user) {
            $recipients[$user['email']] = $user['name'];
        }
        /* END STATE 06 */

        /* BEGIN STATE 07 */
        $message = new Email();
        $message->subject("Самые горячие гифки за этот месяц");
        $message->from('keks@phpdemo.ru');
        $message->to($recipients);
        /* END STATE 07 */

        /* BEGIN STATE 08 */
        $msg_content = include_template('month_email.php', ['gifs' => $gifs]);
        $message->html($msg_content);
        /* END STATE 08 */

        /* BEGIN STATE 09 */
        $result = $mailer->send($message);
        /* END STATE 09 */

        /* BEGIN STATE 10 */
        if ($result) {
            print("Рассылка успешно отправлена");
        }
        else {
            print("Не удалось отправить рассылку");
        }
        /* END STATE 10 */
    }
    /* END STATE 05 */
}
/* END STATE 04 */
