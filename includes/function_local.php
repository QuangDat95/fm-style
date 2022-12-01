<?php
//===========================================
// Group product &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//tim kiem SELECT * FROM name WHERE LOWER(CONVERT(name USING utf8)) LIKE '%".mb_strtolower($keyword,'utf-8')."%'"; 
function temp($IDG){
	$sql = "select Name from groupproduct where ID = '0$IDG'" ;
	$result = mysql_query($sql) or $this->error("Could not query. ".mysql_error());	
	$row = mysql_fetch_array($result);	
	return $row["temp"] ;
}
//=======================================================

function compo2($table,$ma,$Name,$cat_id){
	 global $data;
	$sql = "select $ma,$Name,ID from $table " ;
//	echo $sql ;
	$result = mysql_query($sql) or $this->error("Could not query. ".mysql_error());	
 	while($n = $data->fetch_array($result))
	{
	   $ma1 = trim($n[$ma]) ;
	   if (strlen($ma1)<11)
	   {
			
	   	 	for ($i = strlen($ma1);$i<11;$i++)
			{
				$ma1 .= "&nbsp;" ;  
			}
			$ma1 .= "  " ;  
	   }
		
		if($n["ID"] == $cat_id)
		{
			$output .= "<option value='".$n["ID"]."' selected>".$ma1.$n[$Name]."</option>\n";
		}
		else
		{
			$output .= "<option value='".$n["ID"]."'>".$ma1.$n[$Name]."</option>\n";
		}
	}
	return $output;

} 


function timten($table,$Name,$cat_id){
    global $data;
	$sql = "select $Name,ID from $table where ID = '0$cat_id'" ;
	$result = mysql_query($sql) or $this->error("Could not query. ".mysql_error());	
	$output ="" ;
 	while($n = $data->fetch_array($result))
	{
			$output  = $n[$Name];
	}
	return $output;

}

// end Group product &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
function donvi($so)
{
switch($so)
	{
 		case "1":
			return "C&#225;i";
 			break;	
 		case "2":
			return "B&#7897;";
			break;
 		case "3":
			return "M&#233;t";
			break;
 		case "4":
			return "T&#7845;m";
			break;
 		case "5":
			return "&#7888;ng";
			break;
		case "6":
			return "C&#226;y";
			break;
		case "7":
			return "B&#236;nh";
			break;
		case "8":
			return "";
			break;
		case "9":
			return "";
			break;
		case "10":
			return "";
			break;										
 
		default:
			return "C&#225;i";
			break;
	}
	

}
//*********************************************************************************************

//  product &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
function abc($table,$ID)
{
}
// end  product &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  Tong Hoa Hong &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
function TongHoaHong($IDNV,$Thang,$Nam)
{
	global $data;
	$sql="select sum(tongcong) as TongHoaHong from orderform where IDUser='$IDNV' and month(NgayTao)='$Thang' and year(NgayTao)='$Nam'";
	$result = mysql_query($sql) ;	
	$result = $data->fetch_array($result);
	$TongHoaHong=$result["TongHoaHong"];
	if($TongHoaHong=="")
		$TongHoaHong=0;
	return $TongHoaHong;
}
// end  Tong Hoa Hong &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

?>