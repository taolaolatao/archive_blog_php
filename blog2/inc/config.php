<?php  
	define('BASE_URL', 'http://vhmblog2.com/');
	define('GUSER', 'vuhuynhminh9221@gmail.com');
	define('GPWD', 'Vuhuynhminh');

	// https://github.com/Synchro/PHPMailer
	// https://support.google.com/accounts/answer/6009563
	include('PHPMailer/src/PHPMailer.php');
	include('PHPMailer/src/Exception.php');
	include('PHPMailer/src/OAuth.php');
	include('PHPMailer/src/POP3.php');
	include('PHPMailer/src/SMTP.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	function send_mail($to, $from, $from_name, $subject, $body)
	{
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug = 2;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->Username = GUSER;
		$mail->Password = GPWD;
		$mail->CharSet = 'UTF-8';
		$mail->setFrom($from, $from_name);
		$mail->addAddress($to);

		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AltBody = '';

		if(!$mail->send())
		{
			echo 'Lỗi: ' . $mail->ErrorInfo;
			return false;
		}
		else
		{
			echo 'Gửi mail thành công!';
			return true;
		}
	}
?>