<?php  
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 
 date_default_timezone_set('Asia/Ho_Chi_Minh');
$root_path =getcwd()."/"  ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php"); 
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include ($root_path . "ghtk.php");
include ($root_path . "viettel.php");
 
$MADK1="HCNVCOL";
 $MADK2="CNDHOL";
   
$data = new class_mysql();
$data->config();
$data->access();


if(isset($_POST["CAPNHATLYDO"])){
	$data1 = $_POST['CAPNHATLYDO']; 
	 $ngayduyet =gmdate('d-n-Y H:i:s', time() + 7*3600) ;
 	 $tmp = explode('*@!',$data1);
		$id   =  laso($tmp[0]) ;
		$lydo = $tmp[1];
 		if($lydo=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
		   
		   
		   
				$sql = "update thuchikt set lydoN='$lydo'  where ID = '$id'  " ;   
				$update=$data->query($sql);
				if($update){
					 echo  "###6###$ngayduyet###$id###$lydo###" ;
				}
				else{
						echo  "###-6###Có lỗi xảy ra vui lòng thử lại!###" ;
				}
	return;
}
if(isset($_POST["DUYETMUTIL"])){
	
	 $data1 = $_POST['DUYETMUTIL']; 
 	 $tmp = explode('*@!',$data1);
 	 $ngayduyet =gmdate('d-n-Y H:i:s', time() + 7*3600) ;
        $idphieu   =  chonghack($tmp[0]);
		$tinhtrang   =  laso($tmp[1]) ;
		$lydo = $tmp[2];
		
		$mangidphieu=explode("###",$idphieu);
		$tammang=[];
		foreach($mangidphieu as $key => $value){
			if($value){
				$value=explode("-",$value);
				if($value[0]=$MADK1 || $value[0]==$MADK2 ){
					array_push($tammang,$value[1]);
				}
			}
		}
		 if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
		   if($lydo=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
		   
		   	if($tammang && count($tammang)>0){
				foreach($tammang as $key => $value){
		   			$sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo'  where ID = '$value'  " ;    	$data->query($sql);
				}
			}
	   }else{
	   $chuoivalue='';
		if($tammang && count($tammang)>0){
			foreach($tammang as $key => $value){
				$sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo'  where ID = '$value'  " ; 
				
					$data->query($sql);
		$sql="select b.mavd as vdvc, a.mavandon as mvd,a.hdbh,a.psno,a.psco,c.ID as idbill,c.SoCT as sobill from thuchikt a left join phieunhapxuat c on a.hdbh=c.SoCT left join vanchuyenonline b on a.mavandon=b.mavd
			   where a.ID='$value'";
		 
				 $dongphieu=getdong($sql);
				
					
					if($dongphieu["vdvc"]){
				
						/*	$mvd=$dongphieu['mvd'];
							$madoitacarr=explode(".",$mvd);
							$madoitac=$madoitacarr[count($madoitacarr)-1]?$madoitacarr[count($madoitacarr)-1]:$mvd;
						$sql="update vanchuyenonline set mavd='$mvd',madh='$mvd',madoitac='$madoitac' where sobill='$dongphieu[sobill]'";
							$data->query($sql);*/
							// echo $sql;
							// echo $sql;
					}
					else{
							/*$sql_value=getvandon($dongphieu);
							if($sql_value){
								$sql="insert into vanchuyenonline (idbill,sobill,madh,mavd,madoitac,donvivc,phitravc,trigiadon,tongtien,dongthoigiantrangthaidon,dienthoai_kh,diachi,ngayhoanthanh) values $sql_value";
								$data->query($sql);
							}
							else{*/
				
								$mavd=$dongphieu["mvd"];
								if($mavd){
								
									$idbill=$dongphieu["idbill"];
									$sobill=$dongphieu["sobill"];
									$tongtien=$dongphieu["psno"]?$dongphieu["psno"]:$dongphieu["pscoo"];
									$madoitacarr=explode(".",$mvd);
									$madoitac=$madoitacarr[count($madoitacarr)-1]?$madoitacarr[count($madoitacarr)-1]:$mvd;
									$chuoivalue.="('$idbill','$sobill','$mavd','$mavd','$madoitac','$tongtien'),";
									
								}
							//}	
					}
					
			}
				$chuoivalue=rtrim($chuoivalue,",");
					
				if($chuoivalue){
					$sql="insert into vanchuyenonline (IDbill,sobill,madh,mavd,madoitac,tongtien) values $chuoivalue on DUPLICATE KEY UPDATE dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),mavd=VALUES(mavd),ngayhoanthanh=VALUES(ngayhoanthanh)";
					$data->query($sql);
				}				
								
		}
	   }
	   $tammang=implode("-",$tammang);
	    if($tinhtrang==4)    echo  "###4###Đã duyệt###$ngayduyet###$tammang###" ;
		 else  if($tinhtrang==2) echo  "###2###Yêu cầu chỉnh sửa###$ngayduyet###$tammang###$lydo###" ;
		 else  if($tinhtrang==3)    echo  "###3###Không duyệt###$ngayduyet###$tammang###$lydo###" ;
		  else  if($tinhtrang==1)  echo  "###1###Chưa duyệt###$ngayduyet###$tammang###$lydo###" ; 
return;
}

  $data1 = $_POST['DATAC']; 
  $tmp = explode('*@!',$data1);
 
        $idphieu   =  laso($tmp[0])   ;
		$tinhtrang   =  laso($tmp[1]) ;
		$lydo = $tmp[2];
		$tknokxd = $tmp[3];
		$tkcokxd = $tmp[4];		
		$ngayhuudung = $tmp[5];	
		
		
   
		//$sql="select mavandon,hdbh from thuchikt where ID=' $idphieu'";
		
		//$tkcokxd = $tmp[4];	
			/*$idlogin   =  laso($tmp[1])   ;
		$loai   =  ($tmp[2])   ;
		$tinhtrang= laso($tmp[3]) ;
		$lydo = $tmp[4];
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;*/
         $ngayduyet =date('Y-m-d H:i:s') ;
	
	  if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
		   if($lydo=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
		   $sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo'  where ID = '$idphieu'  " ;    	$data->query($sql);
	   }
	   else{
	   		
		   if($tkcokxd && $tknokxd){
		   	 $sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo',tkno='$tknokxd',tkco='$tkcokxd'  where ID = '$idphieu'  " ; 
		   }
		   else if($tkcokxd){
		    $sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo',tkco='$tkcokxd'  where ID = '$idphieu'  " ; 
		   }
		   else if($tknokxd){
		   	 $sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo',tkno='$tknokxd'  where ID = '$idphieu'  " ; 
		   }
		   else{
		   
			$sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo'  where ID = '$idphieu'  " ;   
			} 	
			//echo $sql;
			//return;
			$data->query($sql);
			
			if($ngayhuudung){
				$mats=getten("thuchikt","$idphieu","sochungtu");
				$sqls = "update taisan set ngayhuudung='$ngayhuudung'  where ma = '$mats'  " ; 
				$data->query($sqls);
			}
			//lấy ma vd phiếu
			$sql="select b.mavd as vdvc, a.mavandon as mvd,a.hdbh,a.psno,a.psco,c.ID as IDbill,c.SoCT as sobill from thuchikt a left join phieunhapxuat c on a.hdbh=c.SoCT left join vanchuyenonline b on a.mavandon=b.mavd
   where a.ID='$idphieu'";
  		 $dongphieu=getdong($sql);
		  //echo $sql;
		if(!$dongphieu["vdvc"])
		{
			$tamd= $dongphieu;
			$sql="select IDbill,sobill from vanchuyenonline where sobill=(select hdbh from thuchikt where id='$idphieu')";
			$dongphieu=getdong($sql);
			if($dongphieu["IDbill"]){
				$dongphieu["vdvc"]=1;
				$dongphieu["mvd"]=$tamd["mvd"];
				
			}
		}
		 	
	 
			
			if($dongphieu["vdvc"]){
				$mvd=$dongphieu['mvd'];
					$madoitacarr=explode(".",$mvd);
					$madoitac=$madoitacarr[count($madoitacarr)-1]?$madoitacarr[count($madoitacarr)-1]:$mvd;
				$sql="update vanchuyenonline set mavd='$mvd',madh='$mvd',madoitac='$madoitac' where sobill='$dongphieu[sobill]'";
					$data->query($sql);
					// echo $sql;
					// echo $sql;
			}
			else{
					$sql_value=getvandon($dongphieu);
					if($sql_value){
						$sql="insert into vanchuyenonline (IDbill,sobill,madh,mavd,madoitac,donvivc,phitravc,trigiadon,tongtien,dongthoigiantrangthaidon,dienthoai_kh,diachi,ngayhoanthanh) values $sql_value";
						$data->query($sql);
					}
					else{
						$mavd=$tamd["mvd"];
						if($mavd){
							$idbill=$tamd["IDbill"];
							$sobill=$tamd["sobill"];
							$tongtien=$tamd["psno"]?$tamd["psno"]:$tamd["pscoo"];
							$madoitacarr=explode(".",$mvd);
							$madoitac=$madoitacarr[count($madoitacarr)-1]?$madoitacarr[count($madoitacarr)-1]:$mvd;
							$sql="insert into vanchuyenonline (IDbill,sobill,madh,mavd,madoitac,tongtien) values ('$idbill','$sobill','$mavd','$mavd','$madoitac','$tongtien')";
							$data->query($sql);
						}
					}	
			}
	   }
	     if($tinhtrang==4)    echo  "###4###Đã duyệt###$ngayduyet###$idphieu###$lydo###" ;
		 else  if($tinhtrang==2) echo  "###2###Yêu cầu chỉnh sửa###$ngayduyet###$idphieu###$lydo###" ;
		 else  if($tinhtrang==3)    echo  "###3###Không duyệt###$ngayduyet###$idphieu###$lydo###" ;
		  else  if($tinhtrang==1)  echo  "###1###Chưa duyệt###$ngayduyet###$idphieu###$lydo###" ; 
	    return;	
		
   	  /*
  echo  "###-1###không duyệt###---###" ;*/
    $data->closedata() ;
	
	
function getvandon($r){
			$sql_value='';
			$mavd=$r["mvd"];
			$idbill=$r["idbill"];
			$sobill=$r["sobill"];
				$ghtk = new Ghtk("187c69cA1c3d49fE1B43573b335d67a7481e7181","https://services.giaohangtietkiem.vn/services/shipment/");
				$vc= $ghtk->GetStatusBill($mavd);
				if(!$vc["success"]){
					$ghtk = new Ghtk("dc263d53cd7BEdEe18A62998d8d7449d211ADc29","https://services.giaohangtietkiem.vn/services/shipment/");
					$vc= $ghtk->GetStatusBill($mavd);
					
				}
				if($vc["success"]){
				
					$ngaytaodon=strtotime($vc['order']["created"]);
					$ngaytaodon=$ngaytaodon?date("d/m/Y",$ngaytaodon):"";
					$ngaymoi=strtotime($vc['order']["modified"]);
					$ngaymoi=$ngaymoi?date("d/m/Y",$ngaymoi):"";
					$ngayhenlay=strtotime($vc['order']["pick_date"]);
					$ngayhenlay=$ngayhenlay?date("d/m/Y",$ngayhenlay):"";
					$ngaygiudon=strtotime($vc['order']["storage_day"]);
					$ngaygiudon=$ngaygiudon?date("d/m/Y",$ngaygiudon):"";
					$ngaygiao=strtotime($vc['order']["deliver_date"]);
					$ngaygiao=$ngaygiao?date("d/m/Y",$ngaygiao):"";
					$freeship=$vc['order']["is_freeship"]==1?"có":"không";
					$madh=$vc['order']['label_id'];
					$mvd=$vc['order']['partner_id'];
					$tenkh=$vc['order']['customer_fullname'];
					$dtkh=$vc['order']['customer_tel'];
					$dckh=$vc['order']['address'];
					$phiship=$vc['order']['ship_money'];
					$giatridon=$vc['order']['value'];
					$trangthai=$vc['order']['status_text'];
					$ngayhoanthanh='';
					if(in_array($vc['order']['status'],array(6,13,11,7))){
						$ngayhoanthanh=$vc['order']['modified'];
						
					}
					$madoitacarr=explode(".",$mvd);
					$madoitac=$madoitacarr[count($madoitacarr)-1]?$madoitacarr[count($madoitacarr)-1]:$mvd;
					$sql_value.="('$idbill','$sobill','$mavd','$mavd','$madoitac','GHTK','$phiship','$giatridon','$giatridon','$trangthai','$dtkh','$dckh','$ngayhoanthanh')";
					
					
}
	return $sql_value;
}
?>	