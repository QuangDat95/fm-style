<?php
include("class.smtp.php");
include ("class.phpmailer.php"); 
$server= "localhost";
$username ="fmkt_hrm";
$password="Chucthanhcong";
$dbname ="fmkt_hrm";

$conn = new mysqli($server, $username, $password, $dbname);
$conn -> set_charset("utf8");


function generateKey($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function countTime($beginTime,$endTime){
$TimeStart = strtotime($beginTime);
$TimeEnd = strtotime($endTime);
$diffHours = round(($TimeEnd - $TimeStart) / 3600);
return $diffHours;
}
// create token
function token() {
$username    = "callapi";
$appID        = "FM";
$key          = "APICall";
//$key          = generateKey(12);
$secret       = '10112021';
$sign = "key:".$key."id:".$appID.":timestamp:".$username;
$authtoken = bin2hex(hash_hmac('sha256', $sign, $secret, true)); //7cb5c316244cf4d55f17facc0fd7b13f7d3f4540ab2afa2599607f6a61f4edac
return $authtoken;
}
//echo token();
function json($status, $data) {
        $cors = "*";
        header("Access-Control-Allow-Origin: $cors");
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($status);
        echo json_encode($data);
    }

function _requestStatus($code) {		
        $status = array(  
            200 => 'OK',
			400 => 'Invalid Request',
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ); 
		
        return ($status[$code]) ? $status[$code] : $status[500]; 
    }

//data read part are here
function getmethod($offset,$count){
   global $conn;
  $sql = "SELECT e.Id as ID, a.Id as Id_id, tenchiendich, machiendich, a.tendexuat as tendexuat, c.Name as htlamviec, b.Name as chucvu, d.name as tinh, nguoitao, ngaybatdau, ngayketthuc, motacongviec, a.min_price as luongtu, a.max_price as luongden, a.tutuoi as tutuoi, a.dentuoi as dentuoi, a.gioitinh as gioitinh, a.chieucao as chieucao, a.cannang as cannang, a.nguoiphutrach as phutrach, a.soluong as soluong, a.kinhnghiem as kinhnghiem, a.trinhdo as trinhdo FROM  cdtuyendung e INNER JOIN dxtuyendung a ON a.Id = e.tendexuat INNER JOIN chucvu b ON b.Id = a.chucvu_id INNER JOIN ht_lamviec c ON c.Id = a.htlamviec_id INNER JOIN tinh d ON d.Id = a.diachi_id ORDER BY ID DESC LIMIT ".$offset.",".$count;
 
 $result = mysqli_query($conn, $sql);
  $out_put = array();
  if (mysqli_num_rows($result) > 0) {
       $rows=array();
       while ($r = mysqli_fetch_assoc($result)) {
			$rows[] = $r;
          $out_put = $rows;
       }	   
       //echo json_encode($out_put);
	   return $out_put;
  }  else{
      echo '{"result": "no data found"}';
    }
}


function sendMail($title, $content, $nTo, $mTo,$diachicc=''){
global $nFrom, $mFrom, $mPass;
	/*$nFrom = $tenhienthi;
	$mFrom = $emailhienthi;	//dia chi email cua ban 
	$mPass = $matkhau;		//mat khau email cua ban
	*/
	$mail             = new PHPMailer();
	$body             = $content;
	$mail->IsSMTP(); 
	$mail->CharSet 	= "utf-8";
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;                  	// enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      	
	$mail->Port       = 465;
	$mail->Username   = $mFrom;  // GMAIL username
	$mail->Password   = $mPass;           	 // GMAIL password
	$mail->SetFrom($mFrom, $nFrom);
	//chuyen chuoi thanh mang
	$ccmail = explode(',', $diachicc);
	$ccmail = array_filter($ccmail);
	if(!empty($ccmail)){
		foreach ($ccmail as $k => $v) {
			$mail->AddCC($v);
		}
	}
	$mail->Subject    = $title;
	$mail->MsgHTML($body);
	$address = $mTo;
	$mail->AddAddress($address, $nTo);
	$mail->AddReplyTo($emailhienthi, $tenhienthi);
	if(!$mail->Send()) {
		return 0;
	} else {
		return 1;
	}
}

function sendMailAttachment($title, $content, $nTo, $mTo,$diachicc='',$file,$filename){
global $nFrom, $mFrom, $mPass;
	/*
	$nFrom = $tenhienthi;
	$mFrom = $emailhienthi;	//dia chi email cua ban 
	$mPass = $matkhau;		//mat khau email cua ban
	*/
	$mail             = new PHPMailer();
	$body             = $content;
	$mail->IsSMTP(); 
	$mail->CharSet 	= "utf-8";
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;                  	// enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      	
	$mail->Port       = 465;
	$mail->Username   = $mFrom;  // GMAIL username
	$mail->Password   = $mPass;           	 // GMAIL password
	$mail->SetFrom($mFrom, $nFrom);
	//chuyen chuoi thanh mang
	$ccmail = explode(',', $diachicc);
	$ccmail = array_filter($ccmail);
	if(!empty($ccmail)){
		foreach ($ccmail as $k => $v) {
			$mail->AddCC($v);
		}
	}
	$mail->Subject    = $title;
	$mail->MsgHTML($body);
	$address = $mTo;
	$mail->AddAddress($address, $nTo);
	$mail->AddReplyTo($emailhienthi, $tenhienthi);
	$mail->AddAttachment($file,$filename);
	if(!$mail->Send()) {
		return 0;
	} else {
		return 1;
	}
}


?>