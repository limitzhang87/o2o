<?php 
/**
* 邮件类
*/
class Email
{
	public static function send($address = '', $title = '无标题', $content = '您好！')
	{
		if($address == ''){
			
			return false;
		}
		try {

			date_default_timezone_set('PRC');
			$mail = new \phpmailer\Phpmailer;

			$mail->isSMTP();
			//mail->SMTPDebug = 2;

			$mail->Debugoutput = 'html';

			$mail->Host = config('email.host');

			$mail->Port = 25;

			$mail->SMTPAuth = true;

			$mail->Username = config('email.username');

			$mail->Password = config('email.password');

			$mail->setFrom(config('email.username'), config('email.sendName'));

			$mail->addAddress($address);

			$mail->Subject = $title;

			$mail->msgHTML($content);

			if (!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}catch(phpmailerException $e){
			return false;
		}
	}
}


 ?>