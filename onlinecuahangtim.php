<?php  
session_start();
 $idk=$_SESSION["LoginID"];
 $idcuahang=$_SESSION["se_kho"];
if ($idk =='') { return ; }

$root_path =getcwd()."/"  ;
include($root_path."biensession.php");

include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
    
$data = new class_mysql();
$data->config();
$data->access();
$data->setdangnhap($idk,$us) ;

//================================
 $mangdaco['0']='1';
 $chuoitrave='';
 
 function chuyen($tam)
  { global $mangdaco ;
	global $chuoitrave;
	global $mauve;
 	 if ( $tam != '')
     {
	   $tam = explode("&*!",$tam) ;
		$k =0; $sopt = count ($tam) ;
		 
		if ($sopt <2)  $chuoisp = $result_news["masp"] ;
		else
		{
			$mang = ''; $chuoisp='';
			for($i=1 ;$i<=$sopt ;$i++)
			{   if ($k==0)  {$idm = $tam[$i]; $k =1 ; } 
				else if($k==1) 
				{
					if(laso($mangdaco[$idm])=='0')
					{
					 $sql = " select sum(a.soluong) as sl from hanghoacuahang a left join products b on a.idsp=b.id where a.soluong>0 and a.idcuahang>1 and b.codepro='$idm'  ";$tamsl=getdong($sql);
				     $mangdaco[$idm]=$tamsl['sl'];
					}
					if($mangdaco[$idm]>0) { $soluongco=  " <b  style='color:red' > Về:".$mangdaco[$idm]."</b>"; $mauve="blue";}
					else  {$soluongco= "";$mauve="";}
					if($chuoisp=='') {$chuoisp =$tam[$i] .$soluongco ;} else { $chuoisp .= "<br>".$tam[$i] .$soluongco ;} 
					 $mang["$idm"]=$tam[$i]; $k =2 ;
						
				}
				elseif( $k==2) { $sl = $tam[$i] ; $k =3 ; }
 				elseif( $k==3)  {$gia = $tam[$i]; $k =0 ; }
 		
			}
		}
       }	
	   return $chuoisp;
  }
  //======================================
  
 
 
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
   $masp=    ($tmp[0])    ;
   $madonvan =addslashes(trim($tmp[1]));
   $tenkhach= addslashes($tmp[2]);
   $tel= $tmp[3];   
   $tinhtrang= $tmp[4];
   $tinhtranghang= $tmp[5];
   $tu= $tmp[6];
   $den= $tmp[7];
   $nguoitao= $tmp[8];
   $trang= $tmp[9];
   $NgayTao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
   
   if(  $tel=='-1')
   {   $NgayTao = gmdate('Y-n-d H:i:', time() + 7*3600) ;
        $NgayTao .=$tinhtrang ;
	
		if($madonvan!='') $madonvan = ",madonvan='$madonvan'";
		 
	   $sql = " update online set ngaychotdon='$NgayTao',IDchotdon='$idk',tinhtrang='8',ghichuchotdon='$tenkhach' $madonvan where id= '$masp' and idtn=0 and idlayhang>0    ";
	 
	   $tam=getdong($sql);
	  ?>
        <script type="text/javascript" language="javascript" id="dulieu">
			alert("đã chốt đơn có mã đơn vận: '" + madonvan+ "'");
        </script>
      <?php
 	   $sql = $_SESSION['sqlluu'];  
   }
   else
   {
		$sql_where=" where 1=1  ";
		if($masp!="") $sql_where.=" and a.masp like '%".$masp."%'";
		if($madonvan!="") $sql_where.=" and a.madonvan  like '%".$madonvan."%'";
		if($tenkhach !="")  $sql_where.=" and a.tenkhach  like '%".$tenkhach."%'";
		if($tel!="") { $tam=$tel ; if($tel[0]==0 )  $tam[0]=""; $sql_where.=" and a.tel  like '%".trim($tam)."%'";   } 
		if($tinhtrang >0) { 	$sql_where.=" and a.tinhtrang= $tinhtrang  "; 		}
		if($tinhtranghang >0) { 	$sql_where.=" and a.tinhtranghang= $tinhtranghang  "; 	}	
		if($nguoitao >0) { 	$sql_where.=" and a.idtao= $nguoitao  "; 	}	
		if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.ngaytao >= '$ngay[2]-$ngay[1]-$ngay[0] 00:01'";
		}
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.ngaytao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		} 
		
		$sql = "SELECT  a.*,DATE_FORMAT(a.ngaytao,'%d/%m/%y %h:%i') as ngaytao,u.ten,u.manv,c.Name as tenKH   
FROM passdon a left join userac u on a.idtao=u.id left join customer c on a.IDNhaCC=c.ID".$sql_where." ORDER BY  a.idtn ,a.ngaytao desc   ";
   }

  
		
   	  $_SESSION['sqlluu']=$sql ;
	    $mangtinhtrangmau = taomang("tinhtrang","ID","mau");
		$mangtinhtrang = taomang("tinhtrang","ID","manhomhang");	
	    $mangtinhtrangten = taomang("tinhtrang","ID","name");	 
 if($_SESSION["admintuan"]) echo $sql ; 
 	//========================================================
  if (!is_numeric($trang) ) $trang = 1 ;
   		if ($trang * 1  <= 0 ) $trang = 1 ;	
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	 $pagesize = 400; 
	 if ($trang == '') $trang = 1 ;
	  
	 	 if ($num > $pagesize )
	 {
		 if ( $trang != '')
		 {	
			$paging_two = ($trang -1) * $pagesize; 	
			$sql .=  " LIMIT ".$paging_two.", ".$pagesize;
			$result = $data->query($sql); 
			
			for ($i=1;$i<($num/$pagesize)+1;$i++)
			{
				if ( $i == $trang) 
				{ $pt = $pt . " &nbsp;". "  <label style=\"color:#FF0000\">$i</label> " ;  	}
				 else { $pt = $pt . " &nbsp;". "<a style='cursor:pointer' onclick=\"timkiemkh('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$i','$tmp[6]')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	  $r = $pagesize * $trang - $pagesize + 1  ;
	//==============================================================	
 

?><div   style=" overflow:auto;width:99%;height:400px" >
 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 			<tr bgcolor="#F8E4CB">
			<td align="center"  height="23" width="11"><b>STT</b></td>
             <td width="42" align="center"><strong>Ngày tạo</strong></td>	    
                <td width="252" align="center"><strong>NV Tạo</strong></td>	  	  
      <td width="194" align="center"><strong>Tên khách / ĐT</strong></td>  
	     <td width="90" align="center"><strong>Số chứng từ</strong> </td> 
	 <!-- <td width="62" align="center"><strong>Tình trạng xử lý</strong> </td> -->
     
  
	  <td width="158" align="center"><strong>Mã HH </strong> </td> 
        
 	  

   <td width="82" align="center"><strong>Tiền </strong></td>
 <td width="81" align="center"><strong>Tổng Tiền</strong></td>    
 <td width="189" align="center"><strong>Ghi chú </strong></td>	
 <td width="79" align="center"><strong>Chat</strong></td>	  
      <td width="49" align="center" style='display:{q_capnhap}; ' ><strong>Nhận đơn</strong></td>
      <td width="65" align="center" style='display:{q_xoa}; '><strong>Bỏ đơn</strong></td>
		</tr>	
<?php
  $mangnhanvien =taomang("userac","ID","ten"," where ID >0    ");	//  loai in (16,5,6,10) 
 $mangnhanvien[1]='admin';
 
 $mangchotdon[1]="Chưa gọi được ca 1";
 $mangchotdon[2]="Đã gọi khách";
 $mangchotdon[3]="Đã hủy đơn gọi 3 ca";
 $mangchotdon[4]="Chưa gọi được ca 2";
 $mangchotdon[5]="Chưa gọi được ca 3";
 $mangchotdon[6]="Đã hủy đơn khách mua thêm";
 
while($re = $data->fetch_array($result))
	{
 if($mau == "white")
{	{
	 $mau = "#EEEEEE";
	 $hl = "Normal4" ;
	 $hl2 = "Highlight4";
	}
	 $hl = "Normal4" ;
	 $hl2 = "Highlight4"; 
}else { 
$mau = "white";
$hl = "Normal5" ;
$hl2 = "Highlight5";
} 
  
   $maspve= chuyen($re['masp']);
  
 if ($re['IDchotdon']>0)  $dachotdon="<b style='color:blue'>Đã chốt đơn</b>";else $dachotdon="";
 $re['tinhtrangchotdon']=$re['tinhtrangchotdon']*1;
 $tinhtrangten1='';$tinhtrangten2='';$tinhtrangten3='';
 eval('$tinhtrangten' . $re['tinhtrangchotdon']."='selected';");
 
   
 $nvtao  ="<table class='hienthiol' ><tr><td  class='hienthiol1'>1: $re[ten]</td> ";
 $nvtao .= "<td  class='hienthiol2'>Đã tạo đơn</td></tr>"  ;
if( $re['IDlayhang']>0) {$nvtao .="<tr   ><td >2: ".$mangnhanvien[$re['IDlayhang']]."</td> "  ;
 $nvtao .="<td>" .  $mangtinhtrangten[$re['tinhtranglayhang']*1]."</td></tr> "  ;
}
if( $re['IDchotdon']>0) {$nvtao .="<tr  ><td>3: ".$mangnhanvien[$re['IDchotdon']] ."</td> "  ;
 $nvtao .="<td>"  . $mangchotdon[1*$re['tinhtrangchotdon']] ."</td></tr> "  ;
}
if( $re['IDTN']>0)    {  $nvtao .="<tr ><td>4: ".$mangnhanvien[$re['IDTN']] ."</td> "  ;
 $nvtao .="<td >" .   $mangtinhtrangten[5]  ."</td></tr> "  ;
	}
 $nvtao  .="</table>";

 	 ?>
 	 	<tr id="dong_<?php echo  $re['ID'] ; ?>">  title="<?php echo addslashes($re['note']) ?>"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>"  style="color:<?php echo $mangtinhtrangmau[$re['tinhtrang']] ; ?>"   >
		  <td     align="right"> <?php echo $r ;?> </td>		
		  <td ><?php echo $re['ngay'] ;?><br /><a target="_blank" href="<?php echo $re['facebook'] ;?>" ><img src="images/facebook.png" width="20px"  /></a></td>		
           <td ><?php echo $nvtao ;?></td>			
				<td ><?php echo  "<b>".$re['tenkhach']. "</b><br>" . $re['tel'] ."<br />". $re['diachi']  ;?></td>
  				<td >MVD <input   onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="MVD<?php echo $re['ID'];?>"  ondblclick="this.value=''" id="MVD_<?php echo $re['ID'];?>" class="text"   style="width:135px" value="<?php echo $re['madonvan'] ;?>"   /><br />HĐTN:<?php echo $re['sohdtn'];?>
  				 </td>
            <!--  <td > <div style="padding-bottom:5px">
                   <input   onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="ghichu_<?php echo $re['ID'];?>"  ondblclick="this.value=''" id="ghichu_<?php echo $re['ID'];?>" class="text"   style="width:155px" value="<?php echo $re['ghichuchotdon'] ;?>"   /></div>
              
                   <select name="tinhtrang<?php echo $re['ID'];?>" id="tinhtrang_<?php echo $re['ID'];?>" style="width:110px" >
                     <option value="0"  > Chưa chọn</option>
                     <option value="1" <?php echo $tinhtrangten1;?> >Chưa gọi được ca 1</option>
                      <option value="4" <?php echo $tinhtrangten4;?> >Chưa gọi được ca 2</option>
                       <option value="5" <?php echo $tinhtrangten5;?> >Chưa gọi được ca 3</option>
                       <option value="2" <?php echo $tinhtrangten2;?> >Đã gọi khách</option>
                        <option value="6" <?php echo $tinhtrangten6;?> >Hủy đơn khách chốt thêm</option>
                       <option value="3" <?php echo $tinhtrangten3;?> >Đã hủy đơn gọi 3 ca</option>
                      
                     
                  </select>
                   <span style="padding-bottom:10px">
                   <input type="button"    onclick="return setlayhang('<?php echo $re['ID'] ;?>',tinhtrang<?php echo $re['ID'] ;?>.value,MVD<?php echo $re['ID'];?>.value,ghichu<?php echo $re['ID'];?>.value)"   name="search" style="width:38px" id="search" value="Lưu" />
                 </span></td>-->
                
                
                <td ><?php echo $maspve  ;?></td>
  				  			
                <td><?php echo " T : &nbsp;".formatso($re['tongbill'])."<br> S : &nbsp;".formatso($re['ship'])."<br>CK: ".formatso($re['dachuyenkhoan']);?></td>    			<td ><?php echo formatso($re['tongbill']+$re['ship']-$re['dachuyenkhoan']) ;?></td> 
                <td ><?php echo $re['note'] ;?></td>    
              
               <td   align="right"  >  <img src = "images/chat-2-icon.png" border = "0" style="cursor:pointer" onclick="htchatch(<?php echo $re['ID'] ;?>)" ?>   <?php echo $re['chatngan'] ;?></td>		
		
				<td align="center"  style="display:{q_capnhap};">
                <?php if($re['IDTN']==0) { ;?>
			  <img src = "images/tich.jpg" border = "0" style="cursor:pointer" onclick="cuahangnhandon(<?php echo $re['ID'].",0" ;?>)" > 
 				<?php } else {  
                        echo $re['IDTN']. ' "'.$mangnhanvien[$re['IDTN']] .'"  nhận' ;
                 } ?>
          </td>
		  <td  align="center"  > <img src="images/del.jpg" border = "0"  onclick="cuahangnhandon(<?php echo $re['ID'].",8" ;?>)" style="cursor:pointer"  > </td>	  
              
              
    </tr>
<?php				
	$r++;
	}
?>	
</table>
</div>
<div style="padding:5px;" ><?php 
//==============================================================	
    if ( $num != 0 ) {
 ?>
  Tìm thấy  <?php echo  $num ; ?>   phiếu ! &nbsp;   <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm thấy phụ khách hàng, bạn có thể tìm theo từ ngắn hơn hoặc bấm vào nút '<b>Thêm </b>' để thêm khách hàng !!!</font> " ;
  }
 //==============================================================	
 ?> 

 </div>
 
 
<?php				
    $data->closedata() ;
?>	