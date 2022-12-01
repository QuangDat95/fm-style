
<?php
$template -> assign("homnay", date("l, F j, Y"));
if (extract($_POST) > 0){
	//if(!empty($_POST["email"]) && !empty($_POST["password"])) {	
	$username = $_REQUEST["username"];
	$password = md5($_POST["password"]);
	$sql = "SELECT * FROM tbl_users WHERE userName = '".$username."' AND userPass = '".$password."' ";
    $result = mysqli_query($conn, $sql); 

    if (mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
         if($row['userStatus'] == 1){
             $_SESSION['user'] = array(
			 					   'uid' => $row['user_id'],
          	                       'userLevel' => $row['userType'],
								   'username' => $row['userName'],
                                   'fullname' => $row['userFullname'],
								   'department' => $row['userDept'],
                                   'IsLoggeD' => true 
          	                       );
  
             $response = array("response" => "Success",
                              "User" => $row['userType']);
			 header("Location: ?act=dashboard");	
         }else{
         	$response = array("response" => "Lock","Message" => "Your Account is Temporarily Locked");
         }
     
     }else{

     	    $response = array("response" => "Invalid",
     	    	               "message" => "Invalid Password");
     }

     $message = json_encode($response);
	 //echo '<div class="alert-box warning"><span>warning: </span>'.$message.'</div>';
	 echo "<script>alert('".$message."')</script>";
}
?>
