<?php 

$to      = "Info@adequant.ru"; // �����1 ���� ���� ������
// $to2      = "maxatma@ya.ru"; // �����2 ���� ���� ������
$subject = "������ �� �����������."; // ���� ������ - ���������


$last_name = $_POST['last_name'];
$name    = $_POST['name'];
$father_name = $_POST['father_name'];
$company = $_POST['company'];
$oc    = $_POST['oc'];
$phone_number = $_POST['phone_number'];
$email   = $_POST['email'];
$subject = "=?windows-1251?b?" . base64_encode($subject) . "?=";


/// �������� ������������ ����� E-MAIL

if (!preg_match("/[0-9a-z_]+@[0-9a-z_\-^\.]+\.[a-z]{2,6}$/i",$email)){
echo '<center><h1>����������� ������ ����� �� �����, ��� �� ������ !!</h1><br><b>�� �����:</b><i>';
$email=trim($email); //���� �������
$email=htmlspecialchars($email); //������� ���� html
echo "$email</i>";
echo "<br><a href=# onClick='history.back()'>�����</a></center>";
exit();
}
// �������� ������������ ����� E-MAIL END


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
�������: $last_name1
���: $FromName
��������: $father_name1
��������: $company1
���������: $oc1
�����: $FromEmail
�������: $phone_number1 \n

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
