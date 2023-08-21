<?php
require __DIR__ . "/PHPMailer/src/Exception.php";
require __DIR__ . "/PHPMailer/src/OAuth.php";
require __DIR__ . "/PHPMailer/src/PHPMailer.php";
require __DIR__ . "/PHPMailer/src/POP3.php";
require __DIR__ . "/PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once('../../../../wp-load.php');
date_default_timezone_set('Europe/Kiev');

$mail = new PHPMailer(true);
$mail->clearAddresses();
$mail->clearAttachments();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $siteName    = get_bloginfo("name");
  $siteUrl     = str_replace(['http://', 'https://'], '', get_bloginfo("url"));
  $mailForSend = get_option('ps_main_email') ?: get_option('admin_email');
  if (strripos($siteUrl, '.') === false) $siteUrl .= '.com';
  $from       = 'testsend@' . $siteUrl;
  $subject    = 'Заявка с сайта ' . $siteName;
  $reply_mail = !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : $mailForSend;
  $allData    = '<h3>При заполнении формы пользователем были получены следующие данные :</h3>';

  try {
    $mail->SMTPDebug = 0;
    $mail->CharSet   = 'UTF-8';
    $mail->setFrom($from, $siteName);
    $mail->addAddress($mailForSend, "$siteName сайт");
    $mail->addReplyTo($reply_mail, 'Ящик клиента');
    $mail->isHTML(true);

    if (!empty($_POST['form_name'])) {
      $allData .= '<br><b>Отправка была из формы - : </b>' . strip_tags($_POST['form_name']);
    }
    if (!empty($_POST['productTitle'])) {
      $allData .= '<br><b>Название товара : </b>' . htmlspecialchars($_POST['productTitle']);
    }
    if (!empty($_POST['productSku'])) {
      $allData .= '<br><b>Артикуль : </b>' . htmlspecialchars($_POST['productSku']);
    }
    if (!empty($_POST['name'])) {
      $allData .= '<br><br><b>Имя : </b>' . htmlspecialchars($_POST['name']);
    }
    if (!empty($_POST['surname'])) {
      $allData .= '<br><b>Фамилия : </b>' . htmlspecialchars($_POST['surname']);
    }
    if (!empty($_POST['tel'])) {
      $allData .= '<br><b>Телефон : </b>' . htmlspecialchars($_POST['tel']);
    }
    if (!empty($_POST['email'])) {
      $allData .= '<br><b>E-mail : </b>' . htmlspecialchars($_POST['email']);
    }
    if (!empty($_POST['textarea'])) {
      $allData .= '<br><b>Комментарий : </b>' . htmlspecialchars($_POST['textarea']);
    }
    if (!empty($_POST['course'])) {
      $allData .= '<br><b>Курс : </b>' . htmlspecialchars($_POST['course']);
    }
    if (!empty($_POST['location_url'])) {
      $allData .= '<br><b>Url Страницы отправки письма - : </b>' . htmlspecialchars($_POST['location_url']);
    }
    $allData .= '<br><b>Дата отправки на сервере : </b>' . date("H:i - d:m:Y");

    if (!empty($_FILES['file']) && $_FILES['file']['size'][0] !== 0) {
      $subject = 'Письмо с вложением с сайта ' . $siteName;
      for ($i = 0, $length = count($_FILES['file']['name']); $i < $length; $i++) {
        $filename = $_FILES['file']['name'][ $i ];
        $path     = $_FILES['file']['tmp_name'][ $i ];
        $mail->addAttachment($path, $filename);
      }
    }

    $mail->Subject = $subject;
    $mail->Body    = $allData;
    $mail->AltBody = 'Новое сообщение c сайта' . $siteName;

    $mail->send();

    $json = [
      "send" => true,
    ];
    echo json_encode($json);
    $orderData = array (
      'post_title'   => strip_tags($_POST['form_name'])?: __('Новое письмо от клиента', 'theme-sp'),
      'post_content' => $allData,
      'post_type'    => 't-mail',
    );
    $orderId = wp_insert_post(wp_slash($orderData));

  }
  catch (Exception $e) {
    $json = [
      "send"  => false,
      "error" => __('Помилка, дані не відправлені спробуйте ще', 'theme-sp'),
      "log"   => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
    ];
    echo json_encode($json);
  }
  $mail->clearAddresses();
  $mail->clearAttachments();

}
else {
  http_response_code(403);
  echo "<h1 style='text-align: center; color: red; margin: 50px;'>Сорян! Вам отказано в доступе!</h1>";
}