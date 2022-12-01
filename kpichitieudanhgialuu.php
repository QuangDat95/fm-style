<?php  
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION["act"]]]  ;  
  $idl=$_SESSION["LoginID"];
//$ql[5]=5;
 if( !($ql[0] || $idl==1) ){return;}
$root_path =getcwd()."/"  ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php"); 
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");

   
$data = new class_mysql();
$data->config();
$data->access();

if(isset($_POST['LOADCHITIEU'])){
  $data1 = $_POST['LOADCHITIEU']; 
  $tmp = explode('*@!',$data1);
  $IDphongban = laso($tmp[0]);
  printtree1($IDcha, 1, 0, '', false, " and IDphongban='$IDphongban'");
  echo "<option value=' '>Gốc</option>".$Caytm;
  return;
}


if(isset($_POST['DATA'])){
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
 
        //$idphieu   =  laso($tmp[0])   ;
		$ID = laso($tmp[0]);
		$IDcha = laso($tmp[1]);
		$ten =chonghack($tmp[2]);
		$ghichu =chonghack($tmp[3]);
		$chucvu = laso($tmp[4]);
		$kpi_dexuat = laso($tmp[5]);
		$Rank = laso($tmp[6]);
		$idphongb =laso($tmp[7]);
		$loai = laso($tmp[8]);
		if (trim($Rank) == "") { $Rank = "1" ; } 
		$w='';
		if($ID){
			$w=" and ID <> $ID ";
		}
		$sql="select kpi_dexuat,ten from kpi_danhgia where ID=$IDcha";
		
		$dong=getdong($sql);
		$diemtong=$dong["kpi_dexuat"]?$dong["kpi_dexuat"]:0;
		$tencha=$dong["ten"];
		$sql="select kpi_dexuat from kpi_danhgia where IDCha=$IDcha $w";
		$dong=getdong($sql);
		$diemthanhphan=$dong["kpi_dexuat"]?$dong["kpi_dexuat"]:0;
		$diemconlai=$diemtong-$diemthanhphan;
		if($diemconlai<$kpi_dexuat){
			echo "###-1###Số điểm vượt quá tổng điểm của nhóm kpi này\n$tencha\nĐiểm tổng: $diemtong\nĐiểm còn lại: $diemconlai ###";
			return;
		}
		if($ID ==0)
		{
		  $sql ="insert into  kpi_danhgia (IDcha,ten,ghichu,chucvu,kpi_dexuat,IDphongban) values ('$IDcha','$ten','$ghichu','$chucvu','$kpi_dexuat','$idphongb')";
		} else
		{
		  $sql ="UPDATE  kpi_danhgia SET  IDcha='$IDcha', ten ='$ten',ghichu ='$ghichu',chucvu ='$chucvu',kpi_dexuat='$kpi_dexuat',IDphongban='$idphongb'   where  ID != 1 and   ID='0$ID'" ;			
		} 
		
		
		$update = $data->query($sql);
		
		if($update){
		echo "###1###Đã lưu###";
			/*$sql="select ID from kpi_danhgia where IDcha='$IDcha' and ten='$ten' and ghichu='$ghichu' and chucvu='$chucvu' and kpi_dexuat='$kpi_dexuat' and IDphongban='$idphongb'";
			var_dump($sql);
			$dong=getdong($sql);
			$idnew=$dong["ID"];
			var_dump($dong);*/
			/*printtree1(0, 1, "" ,"",false,$idphongb);
		 
			$cay =$Caytm;	
			$chuoihtml=loadform($ID,$IDcha,$ten,$ghichu,$chucvu,$kpi_dexuat,$Rank,$idphongban,$loai,$cay);
			echo $chuoihtml;*/
		}
		else{
			echo "###-1###lỗi###";
		}
 	return;
}


function loadform($ID,$IDcha,$ten,$ghichu,$chucvu,$kpi_dexuat,$Rank,$idphongban,$loai,$cay){
		$kh_chucvu=composx("kh_chucvu","Name",$chucvu,"");
		$rooms=composx("rooms","Name",$idphongban,"");
	$chuoihtml='<input name="loai" id="loai" type="hidden" value="'.$loai.'" />
<table width="100%" border="0">
<tr>
	<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px" ><h2>{t-c}</h2></td>
</tr>
<tr>
	<td width="14%"> Phòng ban &nbsp;&nbsp;</td>
	<td width="">
		
		
		 <select name="phongban" id="phongban"  onkeypress="return chuyentiep(event,\'Name\')" class="js-phongban" >
           <option value="" >phòng ban</option>
 				'.$rooms.'
          </select>
		  
		
	</td>
	</tr>
<tr>
	<td width="14%">Nhóm Cha </td>
	<td width="">
	
	<select name="IDcha" id="IDcha"  onkeypress="return chuyentiep(event,\'Rank\')" class="js-caykpi"> 
	<option value="" >Nhóm ngành Gốc</option>
 
	'.$cay.'
	</select>
	<input name="id" type="hidden" value="{idgoi}" />	
	</td>
	</tr>
	
	<tr>
	
	<td width="14%"> Chức vụ &nbsp;&nbsp;</td>
	<td width="">
		
		
		 <select name="chucvu" id="chucvu"  onkeypress="return chuyentiep(event,\'Name\')" class="js-chucvu" >
           <option value="" >Chức vụ</option>
 				'.kh_chucvu.' 
          </select>
		  
		 &nbsp;&nbsp; Kpi đề xuất &nbsp;&nbsp;
	
		<input type="Text" onkeypress="return chuyentiep(event,\'ma\')"  name="kpi_dexuat"  id="kpi_dexuat" class="text" size="19" value="'.kpi_dexuat.'">
		 	
		</td>
		
		
		
		 
</tr>
<tr>
	<td>
		Tên Nhóm	</td>
	<td>
		<input type="Text" onkeypress="return chuyentiep(event,\'ma\')"  name="ten"  id="ten" class="text" size="70" value="'.ten.'">
		
		 </td>
		
</tr>
 
<tr>
	<td  > 
 		Ghi Chú	</td>
 
 
 
	<td colspan="2" ><textarea id="ghichu" name="ghichu" style="width:550px; height:100px">'.ghichu.'</textarea> 	</td>
</tr>
 
<tr>
	<td colspan="2">
	<!--return kiemtra()-->
		<input type="Submit" class="text" onfocus="setrong()" onclick="" name="btnUpdate" id="btnUpdate" value="Cập nhập"> <input type="submit" class="text" name="cancel" value="Quay Lại" onclick="return window.location=\'?act=chitieudanhgiakpi\'" />
		<div id="khonghienthi" style="display:inline-block"></div>
			</td>
</tr>
</table>';
return $chuoihtml;
}




function printtree1($id_root, $level,$select_i,$idcall,$action,$where)
	{			
		global $data, $Caytm;  
		$space="&nbsp;";
		$ten1="";	 	
		for($i=0; $i<$level; $i++)
		{
			$ten1.=$space;
		}
		$sql="SELECT ten,ID,IDcha,kpi_dexuat,chucvu FROM  kpi_danhgia WHERE IDcha='$id_root' and ID != 0 $where";
		
        // echo "test1".$sql;
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
			{
				$id = $result_news["ID"] ;
				if (trim($result_news["IDcha"]) == "0") { $ten1 = "" ; }
				$ten=$result_news["ten"];
				$ma =  $ten1."".$result_news["ma"] ;
				$select = "" ;
				 
				if ( trim($select_i) == trim($id) )
					{
						$select = "selected";	
 					}				 
				if (trim($idcall)!= trim($id) &&   $action ==false )
				   { $Caytm.="<option value='$id' $select>$ma - $ten</option> ";}			
				   else
				   {	 $Caytm.= "<optgroup label='$ma - $ten'></optgroup>" ; $action = true ;}
				printtree1($id, $level+1,$select_i,$idcall,$action,$idphongban);	
					 $action = false ;	 
			 }
		 }
	}

//===========================================================================
    $data->closedata() ;
	
?>	
