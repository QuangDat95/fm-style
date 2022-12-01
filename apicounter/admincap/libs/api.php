<?php
require_once("api_handles.php"); 
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header('content-type: application/json');

// authtoken: 7cb5c316244cf4d55f17facc0fd7b13f7d3f4540ab2afa2599607f6a61f4edac
//echo $_SERVER['Authorization'];
$authtoken = token();
if (!empty($_REQUEST["token"])) {
if (isset($_SERVER['REQUEST_METHOD']) && ($_REQUEST["token"] == token())):

   switch ($_SERVER['REQUEST_METHOD']) {
   	case 'GET':
		$data=json_decode(file_get_contents('php://input'),true);
		//checkmethod();
		echo  _requestStatus(400);
		
   	break;   	
   	case 'POST':
   		$data=json_decode(file_get_contents('php://input'),true);			 
		$data_status = getmethod($data["offset"],$data["count"]);
		json($status, $data_status);
   	break;
	case 'PUT':
          $data=json_decode(file_get_contents('php://input'),true);	
		 echo  _requestStatus(405);	 
   	break;
   	case 'DELETE':
   		$data=json_decode(file_get_contents('php://input'),true);
         echo  _requestStatus(405);
   	break;
   	
   	default:
   		//echo '{"result": "data not found"}';	
		echo _response(500);	
   		break;
   }
endif;
} else { echo '{"result": "data not found"}'; }
?>
