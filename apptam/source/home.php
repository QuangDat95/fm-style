<?php
$_SESSION["dangnhap"]='ok';
	if(!$_SESSION["dangnhap"]){
		
		$template->parse("main.block_login");
		if(isset($_POST["btnLogin"]))
		{  
			echo $_POST["txtUserName"];
		  if ($us == "")
		  {
			$UserName =  chonghack($_POST["txtUserName"])  ;
			$password = md5($_POST["txtPassword"]);		
		   } else
		   {
			$UserName =  chonghack($us)  ;
			$password =  $pa  ;	
		   }
			$sql ="SELECT * FROM userac WHERE loai<> -1 and username='".$UserName."' AND password='".$password."'";
		 
			$query = $data->query($sql);
			$result_exist = $data->num_rows($query);
			
		
			$result = $data->fetch_array($query);
		 
			  
			if($result_exist > 0)
			{
				 $ipdn = $_SERVER["REMOTE_ADDR"] ;
				 $ipdn4 = "4".trim($_SERVER["REMOTE_ADDR"]) ;
				 
				 if($result["ID"]==2)$_SESSION["admmintuan"]=true;
				// echo $ipdn4 ."--". trim($result["image"]);
				if ( ( $result["image"] == "2" && substr($ipdn,0,7) != "192.168"  ) || ( $result["image"] == "3" && substr($ipdn,0,7) == "192.168"  ) || ( strlen($result["image"]) > 4 &&   $ipdn4 != trim($result["image"])  ) ) 
				{
					if ($result["image"] == '2')  {$template->parse("main.loaidangnhap2");}
					else if ($result["image"] == '3'){$template->parse("main.loaidangnhap3");}	
					else {$template->parse("main.loaidangnhap4");}
					$template->parse("main.login");
					
				} else
				{ 
			
				$template->assign("thanhcong","&#272;&#259;ng nh&#7853;p Th&#224;nh C&#244;ng" );				
				$template->assign("trang",$_SESSION["luu"]);	
				if ($_GET["act"] == "" ) {$template->assign("trang","main");	};
				$_SESSION["dangnhap"] = $result["UserName"] ;		
				$_SESSION["LoginID"] = $result["ID"];	
				if( $result["t1"]=='') $result["t1"]=1; ;	
				$_SESSION["nhac"] = "tb".$result["t1"];	
				$_SESSION["se_kho"] = $result["cuahang"] ;
				$_SESSION["admin"] = $result["admin"];	
				$_SESSION["UserName"] = $result["UserName"];
				$_SESSION["IDZalo"] = $result["IDZalo"];
				$_SESSION["S_MaNV"] = substr( trim($result["MaNV"]),strlen(trim($result["MaNV"])) -1,1);
				
				if (trim($result["MaNV"])=='')  $_SESSION["S_MaNV"] = "w";
				$_SESSION["MaNV"]  = $result["MaNV"] ;
				$_SESSION["TenUser"] = $result["Ten"];
				$_SESSION["PhanQuyen"] = $result["PhanQuyen"];	
				$_SESSION["giodangnhap"] = gmdate('H:i', time() + 3600*7) ;
				$_SESSION["loai_user"] = $result["Loai"];	
				$_SESSION["S_IDPhong"] = $result["IDPhong"];	
				$_SESSION["S_cmnd"]= $result["cmnd"];	
				$sql=" select Name,address,tel,Fax from cuahang where id = $result[cuahang] limit 1";
				$tam=getdong($sql);
				$_SESSION["S_TenPhong"] = getten("rooms",$_SESSION["S_IDPhong"],"Name") ;
				$_SESSION["S_tencuahang"] = $tam["Name"] ;
				 //	echo $sql.$_SESSION["S_tencuahang"].'44444444444' ; return;
				$_SESSION["S_diachi"] = $tam["address"] ;
				$_SESSION["S_tel"] = $tam["tel"] ;
				$_SESSION["S_giam"] = (100- laso($tam["Fax"]))/100 ;  
				
				
					$mangquyen['phieuthuch'] = false	 ;
					$mangquyen['phieuchich'] = false	 ;
					$mangquyen['thuchichbaocao'] = false	 ;
					$mangquyen['thuchi'] = false	 ;
					$mangquyen['thuchikhoa'] = false	 ;
					$mangquyen['thuchixoa'] = false	 ;
					 
					$_SESSION["quyen"]=unserialize($result["quyen"]);
				if ($result["Loai"]==4 ||$result["ID"]==1||$result["ID"]==2||$result["ID"]==179 ||$result["ID"]==167 )
				{
					$mangquyen['thuchi'] = true	 ;
					$mangquyen['phieuthuch'] = true	 ;
					$mangquyen['phieuchich'] = true	 ;
					$mangquyen['thuchichbaocao'] = true	 ;
					 
				} 
		 
			 
		//===================================================================
		 $sql = "select * from diemchietkhau order by tu " ; $mangc='';
	   $rec = $data->query($sql); 
	   $mangc=array();
	   while($re = $data->fetch_array($rec))
		{   
		  $mangc[$re['ID']] = array($re['tu'],$re['chietkhau']) ;
		}
		$_SESSION["mangck"]=$mangc;
		
		 
		//===================================================================
		//echo  $result["Loai"] ;
		
		
				if ($_SESSION["UserName"] == "admin")
				{
					$template->assign("loaidangnhap","md");	
				} 
				elseif ($result["Loai"] == 1 )
				{ 
					$template->assign("loaidangnhap","md");	
				}
				else
				{
					$template->assign("loaidangnhap","md");	
				}	
				
			 
				$template->parse("main.logint");
				}
				$_SESSION["mangmenu"]='';
				echo "<meta http-equiv='refresh' content='0;URL=default.php'>" ;
			//echo 123; return ;
			}
			else		
			{ 
				$act = "login" ;
				$_SESSION["administrator"] = "";			
				$_SESSION["LoginID"] = "";			
				$_SESSION["admin"] = "";	
				$_SESSION["name"] = "";		 		
				 $_SESSION["S_MaNV"] = "";
				$template->parse("main.login");
				$template->parse("main.loginf");
				$_SESSION["quyen"]=$result["quyen"];
		//		$template->out("main.loginf");
				$_SESSION["mangmenu"]="";
				$_SESSION["S_giam"] = "" ;
			}
		}
		return;
	}


	$template->parse("main.block_home");
	//echo "ok";
?>

