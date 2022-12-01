<?php
$server= "localhost";
$username ="fmkt_user";
$password="Counting@2021";
$dbname ="fmkt_counting";

$cookie_name = 'siteAuth';
$cookie_time = (3600 * 24 * 30); // 30 days


//$conn = new mysqli($server, $username, $password, $dbname);
$conn = new mysqli($server, $username, $password, $dbname) or die ('{error:"bad_request"}');
$conn->set_charset("utf8"); 
/*
// Hàm kết nối
function access(){
 	global $conn ; 
 	       $ip =  $_SERVER["REMOTE_ADDR"] ;
 	       $conn = new mysqli($server, $username, $password, $dbname);
		   $conn->set_charset("utf8"); 
			if (mysqli_connect_errno()) {
				 printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			 }
 		    
}*/
// Hàm đóng kết nối
function disconnect(){
    global $conn;
    if ($conn){
        mysqli_close($conn);
    }
}
function query($query){
 	   global $conn ;
		 $sqlQuery = $conn->query($query);
		 return $sqlQuery;
}
function fetch_rows($query){ 		  
        if(!$query) return;		
		return   mysqli_fetch_row($query); 
	}
function fetch_array($query ){
        if(!$query) return ;
		return  $query->fetch_array(); 
	}

function num_rows($query) {
		$num_rows = @mysqli_num_rows($query);
 		return $num_rows;
	}
function getIDTable($data_name,$table_name) { // tao ma so
	global $conn;
	$sql = "SELECT AUTO_INCREMENT as number FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$data_name' AND TABLE_NAME = '$table_name'";
	$result = mysqli_query($conn, $sql); 
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		//$out_put = $row["number"];
		if (strlen($row["number"]) == 1) { $out_put = "000".$row["number"]; }
		if (strlen($row["number"]) == 2) { $out_put = "00".$row["number"]; }
		if (strlen($row["number"]) == 3) { $out_put = "00".$row["number"]; }
		if (strlen($row["number"]) == 4) { $out_put = "0".$row["number"]; }
		if (strlen($row["number"]) > 4) { $out_put = $row["number"]; }
		return $out_put;
	}
}
function callAPI($method, $url, $data){
   
    $curl = curl_init();
    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                              
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
	$CURLOPT_HTTPHEADER =array(
    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
    "Accept-Language: en-US,en;q=0.5",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Cookie: ht=7635aa7ceda60bf1",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0"
  );
	   $user_agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)' ;
	 // $user_agent = $_SERVER['HTTP_USER_AGENT'];
	  
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	 
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $CURLOPT_HTTPHEADER);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $status = curl_error($curl);
    $result = curl_exec($curl);
    if(!$result){
        die("Connection Failure");
    }
    curl_close($curl);
	 
   return array(
        'status' => $status,
        'result' =>  json_decode($result, true)
    );
}

function jsonDecode($json){
	$json = file_get_contents('php://input');
    $json_arr = json_decode($json, true);
    return $json_arr;
}
function jsonDecodeURL($url,$json){
$json = file_get_contents($url);
$json_arr = json_decode($json, true);
return $json_arr;
}
function getJson ($url) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$obj = json_decode($result);
//echo $obj->access_token;
return $obj;
}
/*function dangkysuatan($manhanvien){
global $conn;
	$sql = "INSERT INTO booking_meal (id_department,id_employee,name_employee,position,shift,lunch,dinner,late_night,create_date,create_by) values(?,?,?,?,?,?,?,?,?,?)";
	$result = mysqli_query($conn, $sql);
	
}
*/
function dangkysuatan($maphongban, $tennhanvien, $chucvu, $manhanvien, $comtrua, $comtoi, $ngaydangky)
{
    global $conn, $uid;

        //use a prepared statement        
		$stmt = $conn->prepare("INSERT INTO suat_an (maphongban, tennhanvien, chucvu, manhanvien, comtrua, comtoi, ngaydangky, ngaytao, nguoitao) VALUES(?,?,?,?,?,?,?,NOW(),'$uid')");

            //fill the Values           
			$stmt->bind_param('ssssiis',$maphongban, $tennhanvien,$chucvu,$manhanvien,$comtrua,$comtoi,$ngaydangky);

            //but only if every Value is defined to avoid NULL fields in the Database
            if ($maphongban && $tennhanvien && $chucvu && $manhanvien) {

                $inserted = $stmt->execute(); //added $inserted

                //this is still clumsy and user unfriendly but serves my needs 
               /*if ($inserted) {//changed $insert->execute() to $inserted
                    echo 'success';

                } else {

                    echo 'failed' . $inserted->error;
                }*/
            } 

}
function capnhatdangkysuatan($comtrua, $comtoi, $manhanvien, $ngaydangky)
{
    global $conn, $uid;
			
        //use a prepared statement        
		$stmt = $conn->prepare("UPDATE suat_an SET capnhat = NOW(), nguoicapnhat = '$uid', comtrua = ?, comtoi = ? WHERE manhanvien = ? AND ngaydangky = ?");

            //fill the Values
            $stmt->bind_param('iiss', $comtrua, $comtoi, $manhanvien, $ngaydangky);
			
            //but only if every Value is defined to avoid NULL fields in the Database
            if ($manhanvien && $ngaydangky) {

				 //$q->execute(array($user,$hash,$salt,$pname,$email,$phone,$categoryid));
                $updateted = $stmt->execute(); //added $inserted

                //this is still clumsy and user unfriendly but serves my needs 
                /*if ($updateted) {//changed $insert->execute() to $inserted
                    echo 'success';

                } else {

                    echo 'failed' . $updateted->error;
                }*/
            } 

}
function login($username,$password){
global $conn;
		if($username && $password) {
			$sqlQuery = "SELECT * FROM tbl_users WHERE username = ? AND password = ?";			
			$stmt = $conn->prepare($sqlQuery);
			$password = md5($password);
			$stmt->bind_param("ss", $username, $password);	
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["userid"] = $user['id'];
				$_SESSION["role"] = $user['role'];
				$_SESSION["name"] = $user['name'];					
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
}
	
function loggedIn(){
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
}
function logout(){
	@session_start();
	$_SESSION["user_id"] = "";
	$_SESSION["role"] = "";
	$_SESSION["name"] = "";
	session_destroy();		
}
function getDeparment($id_phongban){
global $conn;
		if(!empty($id_phongban)) {
			$sqlQuery = "SELECT * FROM rooms WHERE ID = ?";			
			$stmt = $conn->prepare($sqlQuery);			
			$stmt->bind_param("i",$id_phongban);	
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$department = $result->fetch_assoc();
				echo $department['ID'];				
				echo $department['Name'];					
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
}
function getListEmployee($id_phongban){
$curl = curl_init();
$baomat = "!@92cffe4a34ccc4f9c6ec755843593458b!@926";
$field = array("idphong" => $id_phongban,"baomat" => $baomat); //{"idphong":".$id_phongban.","baomat":"!@92cffe4a34ccc4f9c6ec755843593458b!@926"}
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://siandchip.vn/apinhanvien.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($field),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
return $response;
}
function saveListEmployee($maphongban, $idnv, $tennhanvien, $chucvu, $manhanvien){
global $conn;
	$stmt = $conn->prepare("INSERT INTO nhan_vien (maphongban, idnv, tennhanvien, chucvu, manhanvien, capnhat) VALUES(?,?,?,?,NOW())");

            //fill the Values           
			$stmt->bind_param('iisis',$maphongban, $idnv, $tennhanvien, $chucvu, $manhanvien);

            //but only if every Value is defined to avoid NULL fields in the Database
            if ($maphongban && $tennhanvien && $chucvu && $manhanvien) {

                $inserted = $stmt->execute();
				}
}


function saveListEmployee2($id,$maphongban, $tennhanvien, $chucvu, $manhanvien){
global $conn;
	$stmt = $conn->prepare("INSERT INTO nhan_vien (id,maphongban, tennhanvien, chucvu, manhanvien, capnhat) VALUES(?,?,?,?,?,NOW())");

            //fill the Values           
			$stmt->bind_param('iisis',$id,$maphongban, $tennhanvien, $chucvu, $manhanvien);

            //but only if every Value is defined to avoid NULL fields in the Database
            if ($id && $maphongban && $tennhanvien && $chucvu && $manhanvien) {

                	$inserted = $stmt->execute();
				}
}

function userList(){
global $conn;		
		$stmt = $conn->prepare("SELECT * FROM users ORDER BY id DESC");				
		$stmt->execute();			
		$result = $stmt->get_result();
		//return $result;
		while ($record = $result->fetch_assoc()){
			$output[] = $record;
		}
		return $output;		
		//echo json_encode($output);	
	}
	
function managerList(){		
global $conn;
		$stmt = $conn->prepare("SELECT * FROM users WHERE role='manager'");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
// Hàm tạo URL
function base_url($uri = ''){
    return 'http://localhost/folder/'.$uri;
}
 
// Hàm redirect
function redirect($url){
    @header("Location:{$url}");
	echo '<script>location.reload()</script>';
    exit();
}
 
// Hàm lấy value từ $_POST
function input_post($key){
    return isset($_POST[$key]) ? trim($_POST[$key]) : false;
}
 
// Hàm lấy value từ $_GET
function input_get($key){
    return isset($_GET[$key]) ? trim($_GET[$key]) : false;
}
 
// Hàm kiểm tra submit
function is_submit($key){
    return (isset($_POST['request_name']) && $_POST['request_name'] == $key);
}
 
// Hàm show error
function show_error($error, $key){
    echo '<span style="color: red">'.(empty($error[$key]) ? "" : $error[$key]). '</span>';
}
function db_user_get_by_username($username){
    $username = addslashes($username);
    $sql = "SELECT * FROM tb_users where username = '{$username}'";
    return db_get_row($sql);
}

function getMenuAll(){
global $conn;
$sql = "Select *  from  tbl_menu_office  where  active = '1'  order by id";

$result = mysqli_query($conn, $sql);

$categories = array();

while ($row = mysqli_fetch_assoc($result)){
    $categories[] = $row;
}
return $categories;
}


//function showMenu($categories, $parent_id = 0, $char = ''){   
function showMenu($parent_id = 0, $char = ''){    
global $conn;
$sql = "SELECT *  FROM  tbl_menu_office  WHERE  active = '1'  ORDER BY id";
$result = mysqli_query($conn, $sql);
$categories = array();
//echo '<li class="nav-header"></li>';
while ($row = mysqli_fetch_assoc($result)){
    $categories[] = $row;
}
    $cate_data = array();
    foreach ($categories as $key => $item){
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id){
            $cate_data[] = $item;
            unset($categories[$key]);
        }
    }

    if ($cate_data){ 
		//
       // echo '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';
        foreach ($cate_data as $key => $item){  
		
			//echo $item['name'];
			//showMenu($item['id'], $char.'|---');
			echo '<li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-edit"></i><p>'.$item['name'].'<i class="right fas fa-angle-left"></i></p></a></li>';
			//echo '<ul class="nav nav-treeview">';
              	echo '<li class="nav-item"><a href="'.$item['link'].'" class="nav-link"><i class="far fa-circle nav-icon"></i><p>';
			  	showMenu($item['id'], $char.'|---');
				echo '</p></a></li>';
			 
           
            
        }
       //echo '</ul></li>';
		
    }
	//echo '</ul></li>';
	return $categories;
}


function getListEmployeeDoWork($id_phongban){
$curl = curl_init();
$baomat = "!@92cffe4a34ccc4f9c6ec755843593458b!@926";
$field = array("idphong" => $id_phongban,"baomat" => $baomat); //{"idphong":".$id_phongban.","baomat":"!@92cffe4a34ccc4f9c6ec755843593458b!@926"}
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://siandchip.vn/apinhanvienquetthe.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($field),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
return $response;
}
function danhsachtenphongban($id_phongban){
global $conn;
$sql = "Select Name,ID  from  rooms  where  ID = '$id_phongban'  order by id";

$result = mysqli_query($conn, $sql);

$record = array();

while ($row = mysqli_fetch_assoc($result)){
    $record[] = $row;
}
return $record;
}
function danhsachnhanvien($id_phongban){
global $conn;
$sql = "Select *  from  suat_an  where  maphongban = '$id_phongban'  order by id";

$result = mysqli_query($conn, $sql);

$record = array();

while ($row = mysqli_fetch_assoc($result)){
    $record[] = $row;
}
return $record;
}
function thongkevao($data) {
global $conn;
	$macuahang = $data["code"];
	$ngayvao = $data["date"];
	//$sql= "SELECT count(check_in) as demvao FROM people_in WHERE log_ci like '%$ngayvao%' AND code = '$macuahang'";
	$sql= "SELECT count(check_in) as demvao FROM people_in WHERE log_ci like '%$ngayvao%'";
	$result = mysqli_query($conn, $sql);
		   
		   while ($r = mysqli_fetch_assoc($result)) {
				$rows = $r;
			  //$rows["result"][] = $r;
		   }
		   //echo json_encode($rows);
		  return $rows;	 		 
}
function thongkera($data) {
global $conn;
	$macuahang = $data["code"];
	$ngayra = $data["date"];
	//$sql= "SELECT count(check_in) as demvao FROM people_in WHERE log_ci like '%$ngayra%' AND code = '$macuahang'";
	$sql= "SELECT count(check_out) as demra FROM people_out WHERE log_co like '%$ngayra%'";
	$result = mysqli_query($conn, $sql);
		   
		   while ($r = mysqli_fetch_assoc($result)) {
				$rows = $r;
			  //$rows["result"][] = $r;
		   }
		   //echo json_encode($rows);
		  return $rows;	 		 
}
?>