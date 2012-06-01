<?php 

$to      = "Info@adequant.ru"; // Адрес1 куда шлем письмо
// $to2      = "maxatma@ya.ru"; // Адрес2 куда шлем письмо
$subject = "Заявка на презентацию."; // Тема письма - заголовок


$last_name = $_POST['last_name'];
$name    = $_POST['name'];
$father_name = $_POST['father_name'];
$company = $_POST['company'];
$oc    = $_POST['oc'];
$phone_number = $_POST['phone_number'];
$email   = $_POST['email'];
$subject = "=?windows-1251?b?" . base64_encode($subject) . "?=";


/// Проверка правильности ввода E-MAIL

if (!preg_match("/[0-9a-z_]+@[0-9a-z_\-^\.]+\.[a-z]{2,6}$/i",$email)){
echo '<center><h1>неправильно введен адрес эл почты, или не введен !!</h1><br><b>Вы ввели:</b><i>';
$email=trim($email); //удал пробелы
$email=htmlspecialchars($email); //удаляем теги html
echo "$email</i>";
echo "<br><a href=# onClick='history.back()'>назад</a></center>";
exit();
}
// Проверка правильности ввода E-MAIL END


$To          = strip_tags($to);
$To2          = strip_tags($to2);
$FromName    =strip_tags($name);
$FromEmail   =strip_tags($email);
$last_name1 = strip_tags($last_name);
$father_name1 = strip_tags($father_name);
$company1 = strip_tags($company);
$oc1    = strip_tags($oc);
$phone_number1 = strip_tags($phone_number);
$Subject     =strip_tags($subject);


/***************************************************************
 Creating Email: Headers, BODY
 ***************************************************************/
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=windows-1251\r\n";
$headers .= "To: $to\r\n";
$headers .= "From: =?windows-1251?b?" . base64_encode($FromName) . "?=" . " <$FromEmail>";

// BODY Part
$message        =<<<AKAM
Фамилия: $last_name1
Имя: $FromName
Отчество: $father_name1
Компания: $company1
Должность: $oc1
Почта: $FromEmail
Телефон: $phone_number1 \n

AKAM;



/***************************************************************
 Sending Email
 ***************************************************************/
  require_once "smtpauth.php";
MailSmtp ($To, $Subject, $message, $headers);
// MailSmtp ($To2, $Subject, $message, $headers);
// mail($To, $Subject, $Body, $Headers);
header("Location: ok.html"); 
die();
///////////////////////////////////////////

?>
