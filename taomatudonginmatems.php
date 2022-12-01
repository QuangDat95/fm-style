<?php  
session_start();
 
  $idk =   $_SESSION["LoginID"]  ; 
   if ($idk  == "")  return ;  
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
   
  /*if(isset($_POST['DATA'])){

	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$kieuin=$tmp[0];
	
	}*/
	if(isset($_REQUEST['type'])){
			$kieuin=$_REQUEST['type'];
	}
	
  
  
 ?>

 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>

body {
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
   
}
.page {
     
  
} 
@page {
	 size: A4;
  /* margin-left: -5cm;
    margin-right: -5cm;
    size: 291mm 31mm;
    margin: 0;
    padding: 0;*/
}
@media print {
    .page_in {
          display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		padding:1em;
		width:100%;
		 background-color:#FFFFFF;
			
    } 
	.item{
		margin-bottom:0.5em;padding:0.5em;max-width:140px;
	}
	.items{
		display: flex;
    width: 100%;
	    justify-content: space-between;
	}
	.tensp{
		overflow:hidden;font-size:10px;padding-top:1px;padding-bottom:2px;line-height:11px;height:18px;margin-bottom:2px;font-weight:bold;text-align:center;
	}
	.rong{
		width:140px;height:30px; background-color:#000000;
	}
	.ma_{
		overflow: hidden;
		display: flex;
		width: 100%;
		justify-content: space-between;
	}
	.ma_mau{
		font-size:9px;font-weight:bold
	}
	.ma_ma{
		font-size:14px;font-weight:bold
	}
	.ma_size{
		font-size:9px;font-weight:bold
	}
	.ma_mota{
		width:140px;line-height:10px;font-size:10px;font-weight:bold;padding-bottom:2px;text-align:center;
	}
	.ma_mota_fm{
		font-size:9px;display: flex;align-items: flex-end;
	}
	.ma_mota_gia{
	font-size:14px;
	}
	.ma_mota_loaitien{
		font-size:9px;display: flex;align-items: flex-end;
	}
	.ma_mota_fm_{
		width:100%,line-height:10px;font-weight:bold;padding-bottom:2px;display:flex;    justify-content: space-between;
	}
}
  .page_in {
          display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		padding:1em;
		width:510px;
		 background-color:#FFFFFF;
			
    } 
	.item{
		margin-bottom:0.5em;padding:0.5em;width:33%;    max-width: 140px;height:126px;
	}
	.items{
		display: flex;
    width: 100%;
	    justify-content: space-between;
	}
	.tensp{
		overflow:hidden;font-size:10px;padding-top:1px;padding-bottom:2px;line-height:11px;height:18px;margin-bottom:2px;font-weight:bold;text-align:center;
	}
	.rong{
		width:140px;height:30px; background-color:#000000;
	}
	.ma_{
		overflow: hidden;
    display: flex;
    width: 100%;
    justify-content: space-between;
	}
	.ma_mau{
		font-size:9px;font-weight:bold
	}
	.ma_ma{
		font-size:14px;font-weight:bold
	}
	.ma_size{
		font-size:9px;font-weight:bold
	}
	.ma_mota{
		width:140px;line-height:10px;font-size:10px;font-weight:bold;padding-bottom:2px;text-align:center;
	}
	.ma_mota_fm{
		font-size:9px;display: flex;align-items: flex-end;
	}
	.ma_mota_gia{
	font-size:14px;
	}
	.ma_mota_loaitien{
		font-size:9px;display: flex;align-items: flex-end;
	}
	.ma_mota_fm_{
		width:100%,line-height:10px;font-weight:bold;padding-bottom:2px;display:flex;    justify-content: space-between;
	}
.active{
	background-color:#009900 !important;
}
</style>
 
  <div style="width:100%;background-color:#FFFFFF" align="center">  
  <div align="center" id="inra" style="background-color:#6C99AE">
    <input type="button" name="" id=""   style="width:78px"  onclick="doikieuin(1)" class="<?php echo $kieuin==1?"active":"" ?>" value="Kiểu thường" />
	  <input type="button" name="" id=""   style="width:78px"  onclick="doikieuin(2)" class="<?php echo !$kieuin || $kieuin==2?"active":"" ?>" value="Chia nhóm" />
     <input type="button" name="inan2" id="inan2"   style="width:78px"  onclick="donglai()" value="Đóng Lại" /><input type="button" name="inan" id="inan"   style="width:78px"  onclick="inhd4()" value="In Ra" />
 </div>	
 <div class="page_in" id="page_in">
<?php
 $mangmau = taomang("mausac","ID","manhomhang");
  $mangsize = taomang("size","ID","manhomhang");
  $mang=$_SESSION["mangchitiet"];
 $mamota=$_SESSION["mamota"];
 $tongslsp=$_SESSION["tongslsp"];
 /*  echo "<pre>"; 
  var_dump( $mang);
echo "</pre>";
return;*/
/*$tammau='';
$tammang=[];
$mpt=[];
$k=0;
   foreach($mang as $key =>  $rec)
   {
   		
    	if($tammau==''){
			$tammau=$rec["IDMau"];
			array_push($tammang,$rec);
			
		}
		else if($tammau!=$rec["IDMau"]){
		
			
					$mpt[$rec["IDMau"]]=$tammang;
					$tammau=$rec["IDMau"];
					$tammang=[];
			
		}
		array_push($tammang,$rec);
		if($k==count($mang)-1){
				$mpt[$tammau]=$tammang;
		}	
    	$k++;
   }*/
      
  $r = 0 ;  $tongcong = 0 ; $k=0; ; $dautrang = "padding-top:1px;";
 	foreach($mang as $key =>  $rec)
	{ 
	 $r = 0 ;
		// echo  $rec["IDmau"];
  	
		$dongin=0;
		if($kieuin==2){
			 if($rec["soluong"]%3==0){
					$dongin=$rec["soluong"]+3;
			 }else{
			  //echo $rec["soluong"];
				$dongin=ceil($rec["soluong"]/3)*3;
			 }
		 }
		 else{
		 	$dongin=$rec["soluong"];
		 }
		?>
			 
		<?php
		   for ($j=1;$j<=$dongin;$j++)
		   { 
		   	if($k==0){
			?>
			<div class="items">
			<?php
				}
		   	 $r++;
			$k++;	
		    	$ma =  $rec["codepro"] ; $tenpt= $rec["tensp"]; $LoaiTien="VND";$gia= $rec["gia"];
				 if($r<=$rec["soluong"]){
					 ?> 
                  
            <div class="item" > 
                 
                  <div class="tensp" ><?php   echo $tenpt;?></div>
                  <div class="ma_"><span  class="ma_mau" ><?php   echo $tongslsp.' '.$mangmau[$rec["IDMau"]];?></span><span class="ma_ma" ><?php   echo $ma;?></span><span class="ma_size"  ><?php   echo $mangsize[$rec["IDSize"]];?></span></div>
                  <img onerror="this.src='images/trang.jpg'"  style="-webkit-user-select: none" src="includes/ma.php?text=<?php echo $ma;?>" width="140px" height="30px"  > 
                  <div class="ma_mota" ><?php   echo $mamota;?></div>
				  <div class="ma_mota_fm_">
				 <span class="ma_mota_fm">FM</span> <span class="ma_mota_gia"><?php echo $gia ;?></span> <span class="ma_mota_loaitien"><?php echo $LoaiTien ;?></span></div>
                  </div>               
      
       

				<?php
                }
				else{
					?>
				   <div class="item" > 
                 
                  <div class="tensp" ></div>
                  <div class="ma_"><span  class="ma_mau" ></span><span class="ma_ma" ></span><span class="ma_size"  ></span></div>
				    <div class="rong" >//////////////</div>
                
                  <div class="ma_mota" ></div>
				  <div class="ma_mota_fm_">
				 <span class="ma_mota_fm"></span> <span class="ma_mota_gia"></span> <span class="ma_mota_loaitien"></span></div>
                  </div>   
					
					<?php
				}
				if($k%3==0){
					 ?>
					 </div>
					 <div class="items">
				<?php
				}
				
 		      }
			 
		  
 
 /*
   if ($r<3 && $r!=0)
   { 
   // $dautrang = "padding-top:11px;"; 
	     for ($j=$r+1;$j<=3;$j++) { $ma[$j] =  '' ; $tenpt[$j]=''; $LoaiTien[$j]= ''; $in[$j]  ='none';}
	?>
    
      <div  class="page"><table border="0" cellpadding="0" cellspacing="0" width="510px"   style=" padding:0;margin:0"> 
       <tr>
                   <td width="33%" height="74px" align="center" style="padding-right:6px;"  > 
              
<div style="max-width:140px;overflow:hidden;font-size:13px;padding-top:1px;padding-bottom:2px;line-height:12px;height:22px"><strong><?php   echo $tenpt[1];?></strong></div>
                  <div style="max-width:120px;overflow:hidden;font-size:11px;"><strong><?php   echo $mota[1];?></strong></div>
                     <img onerror="this.src='images/trang.jpg'" style="-webkit-user-select: none" src="includes/ma.php?text=<?php echo $ma[1] ;?>" width="140px" height="25px"  > 
                  <div style="width:140px;line-height:10px;font-size:13;font-weight:bold;padding-bottom:2px"><?php echo $ma[1] ;?></div>
                
                  </td>                 <td width="33%" height="74px" align="center"  > 
             
<div style="max-width:140px;overflow:hidden;font-size:13px;padding-top:1px;padding-bottom:2px;line-height:12px;height:22px"><strong><?php   echo $tenpt[2];?></strong></div>
 <div style="max-width:120px;overflow:hidden;font-size:11px;display:<?php echo $inra[2] ; ?>"><strong><?php echo $mota[2] ;?></strong></div>
                     <img onerror="this.src='images/trang.jpg'" style="-webkit-user-select: none" src="includes/ma.php?text=<?php echo $ma[2] ;?>" width="140px" height="25px"  > 
                  <div style="width:140px;line-height:10px;font-size:13;font-weight:bold;padding-bottom:2px"><?php echo $ma[2] ;?></div>
              
                  </td>       
                   
                     <td width="33%" height="74px" align="center" style="padding-left:6px" > 
              
<div style="max-width:140px;overflow:hidden;font-size:13px;padding-top:1px;padding-bottom:2px;line-height:12px;height:22pxline-height:10px;height:20px"><strong><?php   echo $tenpt[3];?></strong></div>
<div style="max-width:120px;overflow:hidden;font-size:11px; display:<?php echo $inra[3] ; ?>"><strong><?php echo $mota[3] ;?></strong></div>
                     <img onerror="this.src='images/trang.jpg'" style="-webkit-user-select: none" src="includes/ma.php?text=<?php echo $ma[3] ;?>" width="140px" height="25px"  > 
                  <div style="width:140px;line-height:10px;font-size:13;font-weight:bold;padding-bottom:2px"><?php echo $ma[3] ;?></div>
     
                  </td>              
                  </tr>
     </table>
      <table border="0" cellpadding="0" cellspacing="0" width="510px"   >
           <tr style="text-align:center">
           <td width="33%"><strong><?php   echo $LoaiTien[1] ;?></strong></td>
           <td width="34%"><strong><?php   echo $LoaiTien[2] ;?> </strong></td>
           <td width="33%"><strong><?php   echo $LoaiTien[3] ;?></strong> </td></tr>
           
           </table>
     
     </div>
    <?php
	}
	   */
   }
 ?>
  </div>
     
</div>
  <script src="js/jquery.min.js"></script>
 <script language="javascript">
 	 function inhd4()
  {
  
   var printContents = document.getElementById("page_in").innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
	/*return;
     document.getElementById('inra').style.display ="none" ;
	 javascript:window.print() ;*/
  }	
   function donglai()
  {
   window.close();
   }	
    function doikieuin(type){
  st = "taomatudonginmatems.php?type="+type    ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=720,height=600,titlebar=no') ;
return;
 	poststr="DATA="+ encodeURIComponent(type) ;
  loadtrang('show_ma', "taomatudonginmatems", poststr,"xuly7") ;
}
  document.getElementById('inan').focus() ;   
</script>  

 <?php    $data->closedata()   ;?> 
	 