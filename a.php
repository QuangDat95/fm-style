<?php


$payload=array("ngaytu"=>"2022-05-01","ngayden"=>"2022-05-31");
	
			
			$curl = curl_init();
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://kimhoangvu.net/webhook/pancake/pancake.php?type=order',
			  CURLOPT_AUTOREFERER=>true,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_SSL_VERIFYPEER=>false,	
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{"ngaytu": "2022-05-01","ngayden":"2022-05-31"}',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: PHPSESSID=fsuk5rlju3eeh67ugo3t4hmkj6'
			  ),
			));
			
			$response = curl_exec($curl);
			//in(curl_error($curl));
			curl_close($curl);
			echo $response;