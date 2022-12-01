<?php

	//Visist http://http://esms.vn/SMSApi/ApiSendSMSNormal for more information about API
	//� 2013 esms.vn
	//Website: http://esms.vn/
	//Hotline: 0901.888.484      
   
	//Huong dan chi tiet cach su dung API: http://esms.vn/blog/3-buoc-de-co-the-gui-tin-nhan-tu-website-ung-dung-cua-ban-bang-sms-api-cua-esmsvn
	//De lay Key cac ban dang nhap eSMS.vn v� vao quan Quan li API 
    $APIKey="AA19D1DBE53CCA1359B832951ADA10";
	$SecretKey="5620996B58F8794C065C92959A82A0";
	
if(isset($_POST["guitin"])){
	$YourPhone=$_POST["phone"];
	$Content=$_POST["noidung"];
	$Brandname=$_POST['brandname'];
	
	$resutsend=sendMes($APIKey,$SecretKey,$YourPhone,$Content,$Brandname);
	$resutsend=json_decode($resutsend,true);
	if($resutsend['CodeResult']==100){
		echo '<script>alert("Đã gửi tin nhắn thành công!");</script>';
		
	}
	else{
	
		echo '<script>alert("Có lỗi xảy ra!");</script>';
	}
	
	
}
///lấy danh sách brand name	
$brandnames=getBrandName($APIKey,$SecretKey);
if($brandnames){
	$brandnames=json_decode($brandnames,true);
	$brandnames=$brandnames['ListBrandName'];
	$brfirst=$brandnames[0]['Brandname'];
}	
?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>

<body>
<style>
table tr td{
	padding:0.2em;
}
form input{
	padding:0.5em;
}
#load-wrapp{
display:none;
}
.load-4 .ring-1 {
  animation: loadingD 1.5s 0.3s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
}
.ring-1 {
  width: 10px;
  height: 10px;
  margin: 0 auto;
  padding: 10px;
  border: 7px dashed #4b9cdb;
  border-radius: 100%;
}
@keyframes loadingD {
  0 {
    transform: rotate(0deg);
  }
  50% {
    transform: rotate(180deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
<form style="width:80%;margin:0 auto" action="" method="post">
<table bordercolor="#CC6666" style="width:80%;margin:0 auto;padding:0.3em">
	<tr>
	  <td bordercolor="#000000"><label>Chọn brandName</label></td>
	    <td><label>Nhập số điện thoại</label></td>
	<td></td>
	</tr>
	<tr>
		<td><select name="brandname" onChange="getSmsTemplate(event)" >
			<?php foreach($brandnames as $key => $value){
				echo '<option value="'.$value['Brandname'].'">'.$value['Brandname'].'</option>';
			}  ?>
		</select></td>
	<td><input type="text" name='phone' style="width:100%"/></td>
	<td></td>
	</tr>
	<tr>
		<td></td>
	<td><label>Nhập nội dung</label></td>
	<td></td>
	</tr>
	<tr>
		<td style="width:50%"><div id="showcontent" style="width:100%;word-break: break-word;height:170px;overflow-y:scroll"> </div></td>
	<td><textarea name='noidung' style="width:100%;height:100px" placeholder='Nhập nội dung giống mẫu có sẵn thay thế {} thành nội dung muốn gửi!'></textarea></td>
	<td></td>
	</tr>
	<tr>
		<td>  <div class="load-wrapp" id="load-wrapp">
      <!-- Loading 4 don't work on firefox because of the border-radius and the "dashed" style. -->
      <div class="load-4">
        
        <div class="ring-1"></div>
      </div>
    </div></td>
	<td><input type="submit" value="Gửi tin"  name="guitin" style="width:100%;"/></td>
		<td></td>
	</tr>
</table>
</form>
<script>
(getSmsTemplate('','<?=$brfirst?>'))();
function getSmsTemplate(e='',brfirst=''){
document.getElementById('load-wrapp').style.display='block';
var brandname='';

if(brfirst){
brandname=brfirst;

}
else{
 brandname=e.target.value;
}

var myHeaders = new Headers();
myHeaders.append("Content-Type", "application/json");
myHeaders.append("Cookie", "ASP.NET_SessionId=yhsv10yjoc2ozdgd0cklxgek");

var raw = JSON.stringify({
  "ApiKey": "<?=$APIKey?>",
  "SecretKey": "<?=$SecretKey?>",
  "Brandname": brandname,
  "SmsType": "2"
});

var requestOptions = {
  method: 'POST',
  headers: myHeaders,
  body: raw,
  redirect: 'follow'
};

fetch("http://restecom.esms.vn/MainService.svc/json/GetTemplate/", requestOptions)
  .then(response => response.text())
  .then(result =>{  showbranname(result);document.getElementById('load-wrapp').style.display='none';})
  .catch(error => {document.getElementById('showcontent').innerHTML=error;document.getElementById('load-wrapp').style.display='none';});
}

function showbranname(result){
result=JSON.parse(result);

var templates=result['BrandnameTemplates'];
var chuoihtml='';
	for(var i=0;i<templates.length;i++){
	 const el=templates[i];
		chuoihtml+='<p>'+el['TempContent']+'</p>';
	
	}
	document.getElementById('showcontent').innerHTML=chuoihtml;
}

</script>
</body>

</html>

<?php
function getBrandName($apikey,$secrectkey){
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://rest.esms.vn/MainService.svc/json/GetListBrandname/'.$apikey.'/'.$secrectkey.'',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER => array(
		'Cookie: ASP.NET_SessionId=t4fyl3hxxw5ph1yqzcltwbqn'
	  ),
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	return $response;
}


function sendMes($apikey,$secrectkey,$phone,$content,$brandname,$campaignid=''){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_post_json/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
 "ApiKey": "'.$apikey.'",
 "Content": "'.$content.'",
 "Phone": "'.$phone.'",
 "SecretKey": "'.$secrectkey.'",
 "IsUnicode": "1",
 "Brandname":  "'.$brandname.'",
 "SmsType": "2",
 "campaignid": "'.$campaignid.'"
 }
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: ASP.NET_SessionId=t4fyl3hxxw5ph1yqzcltwbqn'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}
?>