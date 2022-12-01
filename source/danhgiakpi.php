<?php
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
 $idk=$_SESSION["LoginID"] ;
 
 
 
 $template->assign("cuahangtk", composx("cuahang","Name",$result["cuahang"],"") );	


 $quyenso  =   laso($_POST["quyenso"]) ;
 $template->assign("quyenso",$quyenso);
  $quyentk  =   laso($_POST["quyentk"]) ;
  $template->assign("quyentk",composx("menu","Name","$quyentk"," where 1=1 order by ID " ));
  $template->assign("khuvuc", composx("khuvuc","Name","0","") );	
  $manvtd= gmdate('y', time()) * gmdate('n', time()) * gmdate('d', time()) *  (gmdate('H',time())+10) * (gmdate('i',time())+10)   +rand(1,9) ;  
   $_SESSION['IDTV']=$manvtd ;
  $template->assign("MaNV","FM".$manvtd);
   $template->assign("calamviec",compoloai("calamviec","manhomhang","Name","","where 1 order by Name")); 	
//=======================================================
function HTPhong($id_root, $level,$select_i,$idcall)
{	
	global $data, $Caytm; 
	$space="&nbsp;&nbsp;&nbsp;&nbsp;";
	$name1="";	 
	for($i=0; $i<$level; $i++)
	{
		$name1.=$space;
	}
	$sql="SELECT * from rooms WHERE ChildID='$id_root' and ID <> 0";
	
	if($result=$data->query($sql)){			
		while($result_news = $data->fetch_array($result))
		{
			$id = $result_news["ID"] ;
			if ($result_news["ChildID"] == "0") { $name1 = "" ; }
			$name=$name1."".$result_news["Name"];
			$select = "" ;
			
			if ( trim($select_i) == trim($id) )
				{
					$select = "selected";	
				}				 
			if (trim($idcall)!= trim($id) ){ $Caytm.="<option value='$id' $select>$name</option> ";	}			
			else
			{ $Caytm.= "<optgroup label='$name'></optgroup>" ;}
		 
			HTPhong($id, $level+1,$select_i,$idcall);
		 
		}
	}
}
 
//get phong ban

$template->assign("phongban",compo1("rooms","Name",""));

?>