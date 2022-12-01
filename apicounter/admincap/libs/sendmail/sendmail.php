<?php
	//goi thu vien
	include('class.smtp.php');
	include "class.phpmailer.php"; 
function sendMail($title, $content, $nTo, $mTo,$diachicc=''){
global $nFrom, $mFrom, $mPass;
	$nFrom = "Nguoi gui";	//mail duoc gui tu dau, thuong de ten cong ty ban
	$mFrom = 'idev.online.net@gmail.com';	//dia chi email cua ban 
	$mPass = 'iDev369@';		//mat khau email cua ban
	//$nTo = 'Nguoi nhan';	//Ten nguoi nhan
	//$mTo = 'dichvu247.info@gmail.com';	//dia chi nhan mail
	$mail             = new PHPMailer();
	$body             = $content;	// Noi dung email
	//$title = 'test send mail';	//Tieu de gui mail
	$mail->IsSMTP();             
	$mail->CharSet  = "utf-8";
	$mail->SMTPDebug  = 0;	// enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;	// enable SMTP authentication
	$mail->SMTPSecure = "ssl"; 	// sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";	// sever gui mail.
	$mail->Port       = 465;			// cong gui mail de nguyen
	// xong phan cau hinh bat dau phan gui mail
	$mail->Username   = $mFrom;  // khai bao dia chi email
	$mail->Password   = $mPass;              // khai bao mat khau
	$mail->SetFrom($mFrom, $nFrom);
	//chuyen chuoi thanh mang
	$ccmail = explode(',', $diachicc);
	$ccmail = array_filter($ccmail);
	if(!empty($ccmail)){
		foreach ($ccmail as $k => $v) {
			$mail->AddCC($v);
		}
	}
	$mail->AddReplyTo('no-reply@gmail.com', 'No Reply'); //khi nguoi dung phan hoi se duoc gui den email nay
	$mail->Subject    = $title;// tieu de email 
	$mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
	$mail->AddAddress($mTo, $nTo);
	// thuc thi lenh gui mail 
	if(!$mail->Send()) {
		echo 'Co loi!';
		return 0;
	} else {		
		echo 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả.';
		return 1;
	}
}
$title = "test send lan 3";
 $content = " noi dung send";
 $nTo = "nguoi nhan";
 $mTo = "dichvu247.info@gmail.com";
 $diachicc = "idev.online.net@gmail.com";
sendMail($title, $content, $nTo, $mTo,$diachicc='');
?>