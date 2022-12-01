<?php
session_start();

if ($_SESSION["dangnhap"]=="") return ;
include(getcwd()."/cauhinhtailenvandonluubien.php");
$IDTao = $_SESSION["LoginID"]  ;

     $_SESSION["frm_xuathang"] = "" ;
	if (!defined("IN_SITE")) 	{    	die('Hacking attempt!');	}
	 
 //echo "ok";
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In

//=====================================================
  $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
 if(!($ql[0]||$idl==1)) {echo "Bạn không có phân quyền"; exit; return ;}
 
 	   if($ql[1]>0||$idl==1)     {  $template->assign("q_luu","");   }  else {  $template->assign("q_luu","none");   }
	   if($ql[2]>0||$idl==1)     {  $template->assign("q_khoa","");   }   else {  $template->assign("q_khoa","none");   }	
	   if($ql[3]>0||$idl==1)     {  $template->assign("q_huy","");  } else {  $template->assign("q_huy","none");   }
	   if($ql[4]>0||$idl==1)     {  $template->assign("q_xoa","");  } else {  $template->assign("q_xoa","none");   }
//=====================================================	   

 
 if ($_POST["cancel"] != "")
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 
if(!$mangcauhinhvc){
					$mangcauhinhvc=[];
				}
				else{
					$mangcauhinhvc=json_decode($mangcauhinhvc,true);
				}
				
				
		//in($mangcauhinhvc);
		$chuoioption='';		
	foreach($mangcauhinhvc as $key => $value){
			$chuoioption.="<option value='$key'>$value[tennvc]</option>";
	}
	$template->assign("chuoioption",$chuoioption);	
	$template->assign("mangcauhinhvc",json_encode($mangcauhinhvc));	
if ($_POST["btnUpdate"] != ""   )
{ 	
	     
			//echo "ok";ngayquahan
				$manvc=$_POST["manvc"];
				$manvcc=$_POST["manvcc"];
				
					//echo $cuahang;
				$tennvc=$_POST["tennvc"];	
				$socot=$_POST["socot"];	
				$sodong=$_POST["sodong"];
				$cotdl=$_POST["cotdl"];
				$mangtam=[];
		
				foreach($socot as $key => $value){
					$mangtam[$cotdl[$value]]=array("ma"=>$cotdl[$value],"cot"=>$value);
				
				}
				
				
				$tam=array('manvc'=>$manvc,'tennvc'=>$tennvc,'socot'=>$mangtam,'sodong'=>$sodong);	
				if($manvcc){
						$mangcauhinhvc[$manvcc]=$tam;
				}
				else{
				
				$mangcauhinhvc[$manvc]=$tam;
				
				}
				$tamp.="\$mangcauhinhvc='".json_encode($mangcauhinhvc,JSON_UNESCAPED_UNICODE)."';";
				$filename=getcwd()."/cauhinhtailenvandonluubien.php";
			if(file_exists($filename))
			{
					$chuoimoi="<?php ".$tamp." ?>";
				file_put_contents($filename,$chuoimoi);
				$template->parse("main.block_capnhat.block_chinhluu");	
			}else {
	
				$template->parse("main.block_capnhat.block_chinhluufail");	
			}
		
			
			  $template->parse("main.block_capnhat");
	
}	

if ($_GET["del"] != ""   ){
		$tam=[];
	foreach($mangcauhinhvc as $key => $value){
		if($key!=$_GET['del']){
			$tam[$key]=$value;
		}
	}
			$tamp.="\$mangcauhinhvc='".json_encode($tam,JSON_UNESCAPED_UNICODE)."';";
				$filename=getcwd()."/cauhinhtailenvandonluubien.php";
			if(file_exists($filename))
			{
					$chuoimoi="<?php ".$tamp." ?>";
					file_put_contents($filename,$chuoimoi);
				$template->parse("main.block_xoa");	
			}else {
	
				$template->parse("main.block_xoa");	
			}
	
}
if (isset($_GET['key'])) {
	if($_GET['key']==-1){
	
		
			$sodong='';
			$socot='';
		
	}
	else{
			$row=$mangcauhinhvc[$_GET['key']];
		
			$template->assign("manvcc",$row["manvcc"]);
			$template->assign("manvc",$row["manvc"]);
			$template->assign("tennvc",$row["tennvc"]);
			$sodong=$row["sodong"];
			$socot=$row["socot"];
			
			
			
	}

	$chuoicot='';
	
	for($i=0;$i<500;$i++){
		$check='';
		
		$displayselect='display:none';
		if($socot){
			foreach($socot as $key => $value){
				if($i==$value['cot']){
					$check="checked='checked'";
					$displayselect="display:flex";
					$selectedmdh=$key=='madh'?"selected":"";
					$selectemavd=$key=='mavd'?"selected":"";
					$selectesobill=$key=='sobill'?"selected":"";
					$selectephitravc=$key=='phitravc'?"selected":"";
					$selectetongtien=$key=='tongtien'?"selected":"";
					$selecteddongthoigiantrangthaidon=$key=='dongthoigiantrangthaidon'?"selected":"";
					$selectedgiatrihanghoa=$key=='giatrihanghoa'?"selected":"";
					$selectedngayhoanthanh=$key=='ngayhoanthanh'?"selected":"";
					$selectedngayhuy=$key=='ngayhuy'?"selected":"";
					$selectedngaygiaohang=$key=='ngaygiaohang'?"selected":"";
					$selectedngaygiaohang=$key=='ngaylayhang'?"selected":"";
					$selectedngaytaodon=$key=='ngaytaodon'?"selected":"";
					$selectedngaygiaolan1=$key=='ngaygiaolan1'?"selected":"";
					$selectedngaygiaolan2=$key=='ngaygiaolan2'?"selected":"";
					$selectedngaygiaolan3=$key=='ngaygiaolan3'?"selected":"";
					$selectedthongtintrahoan=$key=='thongtintrahoan'?"selected":"";
					$selecteddonvivc=$key=='donvivc'?"selected":"";
				}	
			}
		}
			
	
		$chuoicot.='<div><label for="socot'.$i.'" class="container_c">'.($i+1).'
					<input type="checkbox" id="socot'.$i.'" name="socot[]" value="'.$i.'" '.$check.' onclick="checkColum(event)"/>
					 <span class="checkmark"></span>
				</label>	<select name="cotdl[]" id="cotdl'.$i.'" style="'.$displayselect.'">
						<option value="madh" '.$selectedmdh.' >Mã đơn hàng</option>
						<option value="mavd" '.$selectemavd.'  >Mã vận đơn</option>
						<option value="sobill" '.$selectesobill.'  >Số bill</option>
						<option value="phitravc" '.$selectephitravc.'  >Phí vận chuyển</option>
						<option value="tongtien" '.$selectetongtien.'  >Tiền thu hộ</option>
							<option value="dongthoigiantrangthaidon" '.$selecteddongthoigiantrangthaidon.' >Trạng thái đơn hàng</option>
							<option value="giatrihanghoa" '.$selectedgiatrihanghoa.' >Giá trị hàng hóa</option>	
							<option value="ngayhoanthanh" '.$selectedngayhoanthanh.' >Ngày hoàn thành</option>
							<option value="ngayhuy" '.$selectedngayhuy.' >Ngày hủy</option>
							<option value="ngaytaodon" '.$selectedngaytaodon.' >Ngày tạo đơn</option>
							<option value="ngaylayhang" '.$selectedngaylayhang.' >Ngày lấy hàng</option>
							<option value="ngaygiaohang" '.$selectedngaygiaohang.' >Ngày giao hàng</option>
							<option value="ngaygiaolan1" '.$selectedngaygiaolan1.' >Ngày giao hàng lân 1</option>
							<option value="ngaygiaolan2" '.$selectedngaygiaolan2.' >Ngày giao hàng lần 2</option>
							<option value="ngaygiaolan3" '.$selectedngaygiaolan3.' >Ngày giao hàng lần 3</option>
							<option value="thongtintrahoan" '.$selectedthongtintrahoan.' >Cột thông tin hoàn đơn</option>
							<option value="donvivc" '.$selecteddonvivc.' >Đơn vị vận chuyển</option>
					</select></div>';
	}
	
	 $template->assign("chuoicot",$chuoicot);
	 $chuoidong='';
	for($i=0;$i<500;$i++){
		$check='';
	if($sodong && in_array($i,$sodong)){
			$check="checked='checked'";
		}
		$chuoidong.='<div><label for="sodong'.$i.'" class="container_c">'.($i+1).'
					<input type="radio" id="sodong'.$i.'" name="sodong[]" value="'.$i.'" '.$check.'  />
					 <span class="checkmark"></span>
				</label>
				
				</div>
				';
	}
	$template->assign("chuoidong",$chuoidong);
	$template->parse("main.block_update");
	
}
else{
$chuoitable='';
	foreach($mangcauhinhvc as $key => $value){
		$cot='';
		$dong='';
			if($value['socot']){
				foreach($value['socot'] as $kc => $vc){
					$cot.=($vc['cot']+1).',';
				}
			}
		if($value['sodong']){
			foreach($value['sodong'] as $kd => $vd){
				$dong.=($vd+1).',';
			}
		}
		$chuoitable.='<tr>
									<td class="text-center">'.$key.'</td>
									<td class="text-center">'.$value['tennvc'].' </td>
									<td class="text-center">'.$cot.'</td>
									<td class="text-center">'.$dong.'</td>
										<td class="text-center">
										<a href="?act=cauhinhtailenvandon&del='.$key.'">Xóa</a>
									</td>
									<td class="text-center">
										<a href="?act=cauhinhtailenvandon&key='.$key.'">Cập nhật</a>
									</td>
								</tr>';
	}
	$template->assign("chuoitable",$chuoitable);
	$template->parse("main.block_cus");
}



 


?>