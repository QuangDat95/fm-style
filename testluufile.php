<?php

function gettrang($url)
{
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         $output = curl_exec($ch);
         curl_close($ch); 
		return $output ;
}

$url = "https://kimhoangvu.net/hoadon/index.php?uid=".$uid;
					gettrang($url);
					$link = "https://kimhoangvu.net/hoadon/uid/".$uid.".png";

?>