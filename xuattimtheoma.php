<?php  
session_start();
if ($_SESSION["LoginID"]=="") return ;
 
  
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

 
  
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
        $macode   = trim($tmp[0])   ;
        $codeprotk  = trim($tmp[1])  ;
		$code = trim($tmp[2]) ;
		$IDGrouptk = trim($tmp[3]) ;
		$trang = laso($tmp[4]) ;
		$kho=   $_SESSION["se_kho"] ; ;
	    $ngaytao=gmdate('Y-n-d H:i', time() + 7*3600) ;
		//$sql_where=" where a.congtho = '0' ";
	  // and c.ngaybatdau<= '$ngaytao' and c.ngayketthuc >= '$ngaytao' and b.IDcuahang= '$kho'
		$sql = " SELECT a.ID,a.Name,a.NameN, b.SoLuong,  a.NameEN,a.codepro,a.code,a.price ,a.giamgia,a.giachan,c.giamgia as giam,a.giabinhquan,c.ghichu ";
		$sql = $sql . " from products  a left join hanghoacuahang b  on (a.ID = b.IDSP )   left join giamgiacuahang c on (c.IDSP = a.ID and  c.IDcuahang =$kho   )		
		  where a.codepro = '$macode'    " ;	
		  
		if($macode=='giamgia') $sql="SELECT a.ID,a.Name,a.SoLuong,a.NameEN,a.codepro,a.code,a.price ,a.giamgia,a.giachan,'0' as giam,a.giabinhquan from products a where a.id= 2 " ;	   
		 
		
	//	$sql = " SELECT a.ID,a.Name, b.SoLuong, a.NameEN,a.codepro,a.code,a.price ,a.giamgia,a.giabinhquan ";
	//	$sql = $sql . " from products a left join hanghoacuahang b  on (a.ID = b.IDSP )   " ;		
	//	$sql = $sql . "  where 1=1 $sql_where  order by a.Rank desc    " ;			
//		$query_rows = $data->query($sql);
//		$result_rows = $data->num_rows($query_rows);
//		$result = $data->query($sql);
//   echo $sql ;
 	//========================================================
	 
	 $result = $data->query($sql); 
  
     $re = $data->fetch_array($result);
	  if(laso($re['ID'])==0)  { echo "##"; return ; }
 $ten = stripslashes($re['Name']) ;
 $ma = stripslashes($re['codepro']) ;
 
 
  if (laso($re['giam']) > laso($re['giamgia']) ) $giamgia = $re['giam'] ; else $giamgia = $re['giamgia'] ;
 $baohanh = $re['baohanh'] ;
 $gia = formatso($re['price']) ;
 $dvt = $re['DV'] ;
 
  if ($gia =='0.00') $gia = "";
 
 
   echo "##".  $re['ID'] ."##". $ten ."##". $ma ."##".$gia ."##". $dvt."##". $giamgia."##". $baohanh."##". $re['SoLuong'] ."##".formatso($re['giachan']) ."##".formatso($re['giabinhquan']) ."##$re[NameN]##"."##$re[ghichu]##";
	
 				
    $data->closedata() ;
?>