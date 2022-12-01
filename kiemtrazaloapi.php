<?php
session_start();

$root_path = getcwd() . "/";
// include($root_path."biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");

$data = new class_mysql();
$data->config();
$data->access();

if (isset($_POST["DATA"])) {
	$data1 = chonghack($_POST['DATA']);

	$tmp = explode('*@!', $data1);
	$idzalo = $tmp[0];

	$datazalo = get_message_recent($idzalo);

	$datazalo = json_decode($datazalo, true);

	$customer_name = $datazalo['data'][0]['src'] == 1 ? $datazalo['data'][0]['from_display_name'] : $datazalo['data'][0]['to_display_name'];
	$response_print = "<pre style='line-height: 0.6;'>
		<div>Tên khách hàng: $customer_name </div>
		<div>Zalo ID: $idzalo </div>
		<div><b>Tin nhắn khách đã gửi: </b><div>
		<pre>
	";

	for ($i = 0; $i < count($datazalo['data']); $i++) {
		$data_zalo = $datazalo['data'][$i];

		if ($data_zalo['src'] == 0) $class_style = "right";
		else $class_style = "left";

		switch ($data_zalo['type']) {
			case 'text':
				$response_print .= "<div class='text-$class_style' ><span class='text-border-$class_style' >" . $data_zalo['message'] . "<span class='date-send-$class_style' >" . date("d/m/Y H:i:s",round($data_zalo['time']/1000)) . "</span></span></div>";
			break;
			case 'photo':
				$response_print .= "<div class='text-$class_style' >
				<span class='text-border-$class_style' ><div><img class='image-thumb' src='".$data_zalo['url']."'></div><div>" . $data_zalo['description'] . "</div><span class='date-send-$class_style' >" . date("d/m/Y H:i:s",round($data_zalo['time']/1000)) . "</span></span></div>";
			break;
			case 'links':
				for ($j=0; $j < count($data_zalo['links']); $j++) { 
					$response_print .= "<div class='text-$class_style' >
					<span class='text-border-$class_style' >
					<div class='contains-images'><img class='image-thumb' src='".$data_zalo['links'][$j]['thumb']."'></div><div>". $data_zalo['links'][$j]['description'] . "</div><span class='date-send-$class_style' >" . date("d/m/Y H:i:s",round($data_zalo['time']/1000)) . "</span></span></div>";
				}
			break;
		
			default:
				$response_print .= "<div class='text-$class_style' ><span class='text-border-$class_style' >" . $data_zalo['message'] . "<span class='date-send-$class_style' >" . date("d/m/Y H:i:s",round($data_zalo['time']/1000)) . "</span></span></div>";
			break;
		}
		
	}
	$response_print .= "</pre></pre>";
	echo $response_print;
}

function get_message_recent($idzalo)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://openapi.zalo.me/v2.0/oa/conversation?data={"user_id":' . $idzalo . ',"offset":0,"count":10}',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'access_token: RgLZKu4CpYbeeM9MWWh8A6oWP5Y14gvX5RXpGQvegMikWMH0nqI8JtgNGsBGGOb4RvbvO-zprXzHkXm-otdBFtAJ6Y-RVEWJSjWnAU4TdrHcy6ihrpZ53KZc4XReIjblGRaA4FD4_Wf2db8PrMwSFJwRRXkVHQPW4-Xr4Qm3gJKZvt4TbKo6B7ItBmZTOOSWIujf8jzui1ypqniWgGl06ptQ3sJT1FTORwqX8CPLy5fkfWDmuWojINBtVKFU8x1hFibZGQrjbqmbc4nqkcQHTrMhV4wvJgnb0B5gPfrWecmcjdDMQTYSdac55ymg'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;
}
