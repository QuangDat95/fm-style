<?php
function khongdau($str) {
$str = preg_replace("/(à|á|ả|ã|ạ|â|ấ|ầ|ẩ|ẫ|ậ|ă|ắ|ằ|ẳ|ẵ|ặ)/", 'a', $str);
$str = preg_replace("/(é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ)/", 'e', $str);
$str = preg_replace("/(í|ì|ỉ|ĩ|ị)/", 'i', $str);
$str = preg_replace("/(ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ộ)/", 'o', $str);
$str = preg_replace("/(ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự)/", 'u', $str);
$str = preg_replace("/(ý|ỳ|ỷ|ỹ|ỵ)/", 'y', $str);
$str = preg_replace("/(đ)/", 'd', $str);

$str = preg_replace("/(Á|À|Ả|Ã|Ạ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ)/", 'A', $str);
$str = preg_replace("/(É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ)/", 'E', $str);
$str = preg_replace("/(Í|Ì|Ỉ|Ĩ|Ị)/", 'I', $str);
$str = preg_replace("/(Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ)/", 'O', $str);
$str = preg_replace("/(Ú|Ù|Ủ|Ũ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Ự)/", 'U', $str);
$str = preg_replace("/(Ý|Ỳ|Ỷ|Ỹ|Ỵ)/", 'Y', $str);
$str = preg_replace("/(Đ)/", 'D', $str);
$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
return $str;
}
?>
