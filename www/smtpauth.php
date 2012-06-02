<?php

 $mhSmtpMail_Server     = "smtp.pdc-russia.ru";       // Укажите адрес SMTP-сервера
 $mhSmtpMail_Port       = "25";                    // Порт SMTP-сервера, как правило 25
 $mhSmtpMail_Username   = "info@pdc-russia.ru"; // Имя почтового ящика (пользователя)
 $mhSmtpMail_Password   = "###";              // и пароль к нему.
 $mhSmtpMail_From       = "bernerandstafford.ru";       // Имя отправителя в поле From

// Обратите внимание, что в условиях нашей почтовой системы, имя пользователя требуется указывать полностью, например postmaster@domain.tld

function MailSmtp($To, $Subject, $Body, $Headers)

{

  global $mhSmtpMail_Server, $mhSmtpMail_Port, $mhSmtpMail_Username, $mhSmtpMail_Password;

  $mhSmtpMail_localhost  = "localhost";
  $mhSmtpMail_newline    = "\r\n";
  $mhSmtpMail_timeout    = "30";

  $smtpConnect = fsockopen($mhSmtpMail_Server, $mhSmtpMail_Port, $errno, $errstr, $mhSmtpMail_timeout);
  $smtpResponse = fgets($smtpConnect, 515);

  if(empty($smtpConnect))
    {
      $output = "Failed to connect: $smtpResponse";
      return $output;
    }
  else
    {
      $logArray['connection'] = "Connected: $smtpResponse";
    }

  fputs($smtpConnect,"AUTH LOGIN" . $mhSmtpMail_newline);
  $smtpResponse = fgets($smtpConnect, 515);
  $logArray['authrequest'] = "$smtpResponse";

  fputs($smtpConnect, base64_encode($mhSmtpMail_Username) . $mhSmtpMail_newline);
  $smtpResponse = fgets($smtpConnect, 515);
  $logArray['authmhSmtpMail_username'] = "$smtpResponse";

  fputs($smtpConnect, base64_encode($mhSmtpMail_Password) . $mhSmtpMail_newline);
  $smtpResponse = fgets($smtpConnect, 515);
  $logArray['authmhSmtpMail_password'] = "$smtpResponse";

  fputs($smtpConnect, "HELO $mhSmtpMail_localhost" . $mhSmtpMail_newline);
  $smtpResponse = fgets($smtpConnect, 515);
  $logArray['heloresponse'] = "$smtpResponse";

  fputs($smtpConnect, "MAIL FROM: $mhSmtpMail_Username" . $mhSmtpMail_newline);
  $smtpResponse = fgets($smtpConnect, 515);
  $logArray['mailmhSmtpMail_fromresponse'] = "$smtpResponse";

  fputs($smtpConnect, "RCPT TO: $To" . $mhSmtpMail_newline);
  $smtpResponse = fgets($smtpConnect, 515);
  $logArray['mailtoresponse'] = "$smtpResponse";

  fputs($smtpConnect, "DATA" . $mhSmtpMail_newline);
  $smtpResponse = fgets($smtpConnect, 515);
  $logArray['data1response'] = "$smtpResponse";

  fputs($smtpConnect, "Subject: $Subject\r\n$Headers\r\n\r\n$Body\r\n.\r\n");

  $smtpResponse = fgets($smtpConnect, 515);
  $logArray['data2response'] = "$smtpResponse";

  fputs($smtpConnect,"QUIT" . $mhSmtpMail_newline);
  $smtpResponse = fgets($smtpConnect, 515);
  $logArray['quitresponse'] = "$smtpResponse";

}

?>
