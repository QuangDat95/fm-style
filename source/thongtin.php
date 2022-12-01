<?php

$id=chonghack($_REQUEST['id']);


$sql = 'select user_fullname,user_email,user_address,vang,bac 
from kh_user where kh_user.ID='.$id;
$dong=getdong($sql);
$user_address=json_decode($dong["user_address"],true);
$addressarr='';
if(is_array($user_address))
{
	foreach($user_address as $key => $value){
		if($value["default_addr"]==1)
		{
			$addressarr=$value;
		}
	}

}

// $tinh=getten("province",$addressarr["tinh"],"_name");
// $thanhpho=getten("district",$addressarr["thanhpho"],"_prefix")." ".getten("district",$addressarr["thanhpho"],"_name");

$user_fullname=$dong["user_fullname"];
$user_email=$dong["user_email"];
$vang=$dong["vang"]?$dong["vang"]:"chưa có";
$bac=$dong["bac"]?$dong["bac"]:"chưa có";
$voucher=$dong["voucher"]?$dong["voucher"]:"chưa có";
$ngayhethan=$dong["ngayhethan"]?$dong["ngayhethan"]:"";
$loai=$dong["loai"]==1?"%":"<span class='vnd'></span>";
$trigia=$dong["trigia"]?$dong["trigia"]:"";
$address=$addressarr?$addressarr["diachi"]." ".$thanhpho." ".$tinh:"chưa có";
$template->assign("user_fullname",$user_fullname);
$template->assign("user_email",$user_email);
$template->assign("vang",$vang);
$template->assign("bac",$bac);
$template->assign("voucher",$voucher);
$template->assign("trigia",$trigia);
$template->assign("loai",$loai);
$template->assign("address",$address);
$template->assign("ngayhethan",date("d/m/Y H:i:s",strtotime($ngayhethan)));
?>