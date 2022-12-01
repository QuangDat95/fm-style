<?php
session_start();
$_SESSION["LoginID"]=1;$_SESSION["UserName"]='zalo';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: text/html; charset=utf-8');
//if ($_SESSION["LoginID"]=="") return ;
 
  
$root_path =getcwd()."/"  ;
include($root_path."../../biensession.php");
include($root_path."../../includes/config.php");
include($root_path."../../includes/removeUnicode.php");
include($root_path."../../includes/class.paging.php");
include($root_path."../../includes/class.mysql.php");
include($root_path."../../includes/function.php");
include($root_path."../../includes/function_local.php");
  include($root_path."chamcongapi.php");
$data = new class_mysql();
$data->config();
$data->access();

 $json = file_get_contents('php://input');
 	
 if(isset($_REQUEST["type"])){
 	$rq=chonghack($_REQUEST["type"]);
 		switch($rq){
			case 'mess':
			
				//  $sendOption=array("messaging_type"=>"UPDATE",
				// 					"recipient"=>array("id"=>$recipientID),
				// 					"message"=>array("text"=>"không tìm thấy user"),
				// 				);
				// 				 sendMessAuto($sendOption);
			$json=json_decode($json,true);
			if($json["fbid"]){
		
					$arr["fbmail"]=$json["fbmail"];
					$arr["fbid"]= $json["fbid"];
				   	$arr["timestamp"]= $json["timestamp"];
					$arr["mid"]=$json["mid"];
					$arr["text"]=$json["text"];
					$arrtext=explode("###",$json["text"]);
					if(strtolower($arrtext[1])=="update"){
						//var_dump($arrtext);
							 $manv=$arrtext[2];
							 
							  
							  $recipientID=$json["fbid"];
							 
								$update=insertNewResID($recipientID,$manv);
								if($update){
									$sendOption=array("messaging_type"=>"RESPONSE",
										"recipient"=>array("id"=>$recipientID),
										"message"=>array("text"=>"Đã cập nhật user"),
									);
									sendMessAuto($sendOption);
								}
								else{
									$sendOption=array("messaging_type"=>"RESPONSE",
												"recipient"=>array("id"=>$recipientID),
												"message"=>array("text"=>"không tìm thấy user"),
											);
									sendMessAuto($sendOption);
								}
							
						 
					}
						if(strtolower($arrtext[1])=="chamcong"){
									 $manv=$arrtext[2];
							 	 $recipientID=$json["fbid"];
								// 	$sendOption=array("messaging_type"=>"RESPONSE",
								// 			"recipient"=>array("id"=>$recipientID),
								// 			"message"=>array("text"=>"không tìm thấy user"),
								// 		);
								// sendMessAuto($sendOption);
							$update=GetChamcong($recipientID,$manv);
							if($update){
								$sendOption=array("messaging_type"=>"RESPONSE",
											"recipient"=>array("id"=>$recipientID),
											"message"=>array("text"=>$update),
										);
								sendMessAuto($sendOption);
							}
							else{
								$sendOption=array("messaging_type"=>"RESPONSE",
											"recipient"=>array("id"=>$recipientID),
											"message"=>array("text"=>"không tìm thấy user"),
										);
								sendMessAuto($sendOption);
							}
						

					}
					//   $arr["attachments"]='';
				  	$arr["type"]=$json["type"];
					$arr["url"]=$json["url"];
         			$update=insertFbConvertsation($arr);
						if($update){
							$res=array("code"=>200,"message"=>"Thêm thành công!");
						}
						else{
							$res=array("code"=>201,"message"=>"Thêm thất bại!");
						}
				}else{
							$res=array("code"=>201,"message"=>"Thêm thất bại!");
						}
							
			break;
			case 'getmess':
					$time=$_REQUEST["time"];
					// echo $time;
					$data=getMess($time);
						if($data){
							$res=array("code"=>200,"data"=>$data);
						}
						else{
							$res=array("code"=>201,"message"=>"Không có tin nhắn mới!");
						}
				
							
			break;
			case 'savetag':
					
					// echo $time;
					$data=getMess($time);
						if($data){
							$res=array("code"=>200,"data"=>$data);
						}
						else{
							$res=array("code"=>201,"message"=>"Không có tin nhắn mới!");
						}
				
							
			break;
			case 'gettags':
			
				$data=getTags();
					if($data){
						$res=array("code"=>200,"data"=>$data);
					}
					else{
						$res=array("code"=>201,"message"=>"Không có tag!");
					}
				
			break;
			case 'settaghis':
			
				$json=json_decode($json,true);
				if($json["idcon"]){
					$update=setTagHistory($json);
					if($update){
						$update=setTag($json);
						if($update){
						$res=array("code"=>200,"message"=>"Đã cập nhật tag");
						}else{
						$res=array("code"=>201,"message"=>"lỗi!");
					}
					}
					else{
						$res=array("code"=>201,"message"=>"lỗi!");
					}
				}
				else{
						$res=array("code"=>201,"message"=>"lỗi!");
				}
			
			break;
			case 'gettagofcon':
		
				$json=json_decode($json,true);
				if($json){
					$data=getTagOfCon($json);
					if($data){
						$res=array("code"=>200,"data"=>$data);
					}
					else{
						$res=array("code"=>201,"message"=>"không có tags!");
					}
				}
				else{
						$res=array("code"=>201,"message"=>"lỗi!");
				}
			
			break;
			case 'gettaghisofcon':
				$idcon=$_REQUEST["idcon"];
			//	$json=json_decode($json,true);
				if($idcon){
					$data=getTagHisOfCon($idcon);
				
					if($data){
						$res=array("code"=>200,"data"=>$data);
					}
					else{
						$res=array("code"=>201,"message"=>"không có tags!");
					}
				}
				else{
						$res=array("code"=>201,"message"=>"lỗi!");
				}
			
			break;
			case 'createtag':
			
				$json=json_decode($json,true);
				if($json){
					$update=createTag($json);
					if($update){
								$res=array("code"=>200,"message"=>"Thêm thành công!");
							}
							else{
								$res=array("code"=>201,"message"=>"Thêm thất bại!");
							}
					}
				else{
						$res=array("code"=>201,"message"=>"Thêm thất bại!");
				}
			
			break;
			case 'updatetag':
			
				$json=json_decode($json,true);
				if($json){
					$update=updatetag($json);
					if($update){
								$res=array("code"=>200,"message"=>"Thêm thành công!");
							}
							else{
								$res=array("code"=>201,"message"=>"Thêm thất bại!");
							}
					}
				else{
						$res=array("code"=>201,"message"=>"Thêm thất bại!");
				}
			
			break;
			case 'test':
				$res=array("code"=>201,"message"=>"test!");
			break;
			default:
				$res=array("code"=>201,"message"=>"Thêm thất bại!");
			break;
		}
 }
 
echo json_encode($res);


function insertFbConvertsation($arr){
    global $data;
    // date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngaytao = date('Y-n-d H:i:s') ;
	$sql= "insert into fbConversationdetail (fbmail,fbid,timestamp,mid,text,attachments,type,url,ngaytao) values ('$arr[fbmail]','$arr[fbid]','$arr[timestamp]','$arr[mid]','$arr[text]','$arr[attachments]','$arr[type]','$arr[url]','$ngaytao')";
	
	$update=$data->query($sql);
    return $update;
}
function getMess($time){
     global $data;
	$sql="select * from fbConversationdetail where ngaytao>'$time' order by ngaytao";
     $arrRes=[];
	 $query=$data->query($sql);
	 while($re=$data->fetch_array($query)){
 		array_push($arrRes, $re);
	 }
    
    if(count($arrRes)>0){
		  return $arrRes;
	}
	else{
		return false;
	}
   
}
function getTags(){
     global $data;
	$sql="select * from fbConversationTag order by ngaytao";
     $arrRes=[];
	 $query=$data->query($sql);
	 while($re=$data->fetch_array($query)){
 		array_push($arrRes, $re);
	 }
    
    if(count($arrRes)>0){
		  return $arrRes;
	}
	else{
		return false;
	}
   
}
function setTagHistory($arr){
     global $data;
	  date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngaytao = date('Y-n-d H:i:s') ;
	$sql="insert into fbConversationHistory (idcon,fbid,tag,ngaytao,loai,NVTao) values('$arr[idcon]','$arr[fbid]','$arr[tag]','$ngaytao','$arr[loai]','$arr[idnv]')";
	 $update=$data->query($sql);
	return $update;
   
}
function setTag($arr){
     global $data;
	date_default_timezone_set('Asia/Ho_Chi_Minh');
    $ngaytao = date('Y-n-d H:i:s') ;
	if($arr["loai"]==1){
		$sql="insert into fbConversation (idcon,fbid,tag,ngaytao,loai,NVTao) values('$arr[idcon]','$arr[fbid]','$arr[tag]','$ngaytao','$arr[loai]','$arr[idnv]')";
	 $update=$data->query($sql);
	}
	else{
		$sql="delete from fbConversation where idcon='$arr[idcon]' and tag='$arr[tag]'";
		$update=$data->query($sql);
	}
	
	return $update;
   
}
function getTagOfCon($arr){
     global $data;
	 $chuoiwhere='';
	 foreach ($arr as $key => $value) {
		$chuoiwhere.="'".$value."',";
	 }
	 $chuoiwhere=rtrim($chuoiwhere,",");
	 
		$sql="select a.*,b.ten as tagten,b.color as tagcolor from fbConversation a left join fbConversationTag b on a.tag=b.ID where idcon in ($chuoiwhere) order by idcon";
	//  echo $sql;
	 $query=$data->query($sql);
	 $numrow=$data->num_rows($query);
	
	 $tammang=[];
	 $idcontam='';
	 $i=0;
	 $tam1=[];
	 while($re=$data->fetch_array($query)){
		if($i==0){
			$idcontam=$re["idcon"];
				array_push($tam1,array(
				"ngaytao"=>$re["ngaytao"],
				"tag"=>$re["tag"],
				"NVTao"=>$re["NVTao"],
				"tagten"=>$re["tagten"],
				"tagcolor"=>$re["tagcolor"],
			));
		}
		 else if($i>0){
		
			if($idcontam!=$re["idcon"]){
				
				$tammang[$idcontam]=$tam1;
				 $tam1=[];
				$idcontam=$re["idcon"];
			}
				array_push($tam1,array(
				"ngaytao"=>$re["ngaytao"],
				"tag"=>$re["tag"],
				"NVTao"=>$re["NVTao"],
				"tagten"=>$re["tagten"],
				"tagcolor"=>$re["tagcolor"],
			));
			 if($i==($numrow-1)){
				// 	array_push($tam1,array(
				// 	"ngaytao"=>$re["ngaytao"],
				// 	"tag"=>$re["tag"],
				// 	"NVTao"=>$re["NVTao"],
				// 	"tagten"=>$re["tagten"],
				// 	"tagcolor"=>$re["tagcolor"],
				// ));
					// echo json_encode($idcontam);
					$tammang[$idcontam]=$tam1;
					$tam1=[];
					
			}
		}
		 
			
		// $tam=[];
		  $i++;
	 }
	 	//  echo json_encode($tammang);
	return $tammang;
   
}


function getTagHisOfCon($idcon){
     global $data;
		$sql="select a.*,DATE_FORMAT(a.ngaytao,'%d-%m-%Y %h:%m:%s %p') as ngaytaof, b.ten as tagten,b.color as tagcolor,c.Ten as tennv from fbConversationHistory a left join fbConversationTag b on a.tag=b.ID left join userac c on a.NVTao=c.ID where idcon = '$idcon' order by a.ngaytao desc";
	
	 $query=$data->query($sql);
	 $numrow=$data->num_rows($query);
	 $tammang=[];
	 if($numrow>0){
		 while($re=$data->fetch_array($query)){
			array_push($tammang,$re);
		}
	 }
	
	 	//  echo json_encode($tammang);
	return $tammang;
   
}


function createTag($json){
     global $data;
	  $ngaytao = date('Y-n-d H:i:s') ;
		$sql="insert into fbConversationTag (IDNV,MaNV,ten,color,ngaytao,Rank) values('$json[IDNV]','$json[MaNV]','$json[ten]','$json[color]','$ngaytao','$json[Rank]')";
	
	 $update=$data->query($sql);
	return $update;
   
}

function updateTag($json){
     global $data;
//   $ngaytao = date('Y-n-d H:i:s') ;
	$sql="update fbConversationTag set Rank='$json[Rank]',color='$json[color]',ten='$json[ten]' where ID='$json[ID]'";
	 $update=$data->query($sql);
	return $update;
   
}

function insertNewResID($recipientID,$manv){
	global $data;
	return true;
	$sql="select ID from userac where MaNV='$manv' limit 1";
	$query=$data->query($sql);
	$dong=$data->fetch_array($query);
	//var_dump($sql);
	if($dong["ID"]){
			$sql="update userac set IDfb='$recipientID' where ID='$dong[ID]'";
				// var_dump($dong["ID"]);
			if($data->query($sql)){
					// var_dump($sql);
				return true;
			}
			else{
				return false;
			}
		
	}
	else{
		 return false;
	 }
	
	
}
function GetChamcong($recipientID,$manv){
	 global $data;
	$sql="select ID from userac where MaNV='$manv' limit 1";
	$query=$data->query($sql);
	$dong=$data->fetch_array($query);
	
	if($dong["ID"]){
			$sql="update userac set IDfb='$recipientID' where ID='$dong[ID]'";
				// var_dump($dong["ID"]);
			if($data->query($sql)){
					// var_dump($sql);
				$chamcong= baochamcongText($manv);
				// echo  $chamcong;
				// return;
				return $chamcong;
			}
			else{
				return false;
			}
		
	}
	else{
		 return false;
	 }
	

	
}

function sendMessAuto($data){
	// $ACCESS_TOKEN ='EAAOFnsGIUHYBAMuys1ZCSnZBZApyZAwZCofJu9wosuIuz4TvFBlqkt8CZCZBL5ZAsKQNS5BIgpBAYsDZCM69bqiZAs6wziMtOuBUgprc8qZCSzpX33YN2aDwRt9hUUPTUbuQyFKkhgBx0nLrXQg3d1jt6dqaRQdYpZBJAs8ZC0MdL4rWSg2RRMZCsc7HdpZCz4uzH9DLCMoYz7FazsCTwZDZD';
	// $ACCESS_TOKEN ='EAAOFnsGIUHYBACcJZC2erkZB8uxLEH3jOUvoaLTZCvvD8KfDrz5kcuIitfZBHZCi9bZBnuZBRWtPhzEjCFeceeSVV6bEpkGoMZAOJu2TJ8sFFsTrJe8bQUdGXYu8seZCSvzEyCGQQGUtZC6MO3mc7kZAZCMvKUSrq5VLZBL9XlYdoFhZCBKnCZBE4XAmode';
 $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

	 $mangaccesstoken=['EAAOFnsGIUHYBACcJZC2erkZB8uxLEH3jOUvoaLTZCvvD8KfDrz5kcuIitfZBHZCi9bZBnuZBRWtPhzEjCFeceeSVV6bEpkGoMZAOJu2TJ8sFFsTrJe8bQUdGXYu8seZCSvzEyCGQQGUtZC6MO3mc7kZAZCMvKUSrq5VLZBL9XlYdoFhZCBKnCZBE4XAmode'];
// $mangtrave=array();
	// foreach ($mangaccesstoken as $key => $accesstoken) {
			$curl = curl_init();
			// '{
			//   "messaging_type": "UPDATE",
			//   "recipient": {
			//     "id": "4712811502139254"
			//   },
			//   "message": {
			//     "text": "hello, world!"
			//   }
			// }'
			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://graph.facebook.com/v12.0/me/messages?access_token='.$mangaccesstoken[0],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_USERAGENT => $agent,
			CURLOPT_POSTFIELDS =>json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: sb=7yC7YPRdvUTACsPMzGr1Z0iH'
			),
			));

			$response = curl_exec($curl);
			curl_close($curl);
			// echo "<pre>";
			// var_dump(json_decode($response,true));
			// echo "</pre>";
			// array_push($mangtrave,json_decode($response,true));
	// }
	
	return json_decode($response,true);
}
?>