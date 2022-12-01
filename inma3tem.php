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
    size: 291mm 31mm;
    margin: 0;
    padding: 0;
}
@media print {
    .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
         page-break-after: always;
    }
}
 .subpage {
    padding: 0cm;
 }

</style>
 
  <div style="width:100%; " align="center">  
  <div align="center" id="inra" style="background-color:#6C99AE">
    <input type="button" name="inan" id="inan"   style="width:78px"  onclick="inhd4()" value="In Ra" />
     <input type="button" name="inan2" id="inan2"   style="width:78px"  onclick="donglai()" value="Đóng Lại" />
 </div>	
 
<?php
 $mang = $_SESSION["mangin"] ;
 //var_dump($mang);
    foreach($mang as $x)
   {
    
    	$mpt[$i] = explode('|*|',$x);
        $i  = $i + 1 ;	
   }
  $r = 0 ;  $tongcong = 0 ; $k=0; ; $dautrang = "padding-top:1px;";
 	foreach($mpt as $rec)
	{ // echo  $rec["4"].  $rec["5"]. $rec["6"];
	
  		   for ($j=1;$j<=$rec["3"];$j++)
		   {  
		   $k =$k+1 ;    $r=$r+1 ;$ma[$r] =  $rec["1"] ; $tenpt[$r]= $rec["2"]; $LoaiTien[$r]= $rec["4"]." VND"; $mota[$r]= $rec["18"];
		 // echo $k ."<br>" ;
		 	// $dautrang ='';
		
			     if ($r<3)
 				  {
				        $dautrang = " ";    
				  }else
				  {  
	 			    $r=0; 
				     if ($k>3) {  $dautrang = " "; }
					 ?> 
                    <div  class="page">
                                       <table border="0" cellpadding="0" cellspacing="0" width="510px"  style=" padding:0;margin:0">
  					<tr>  <td width="33%" height="74px" align="center"  style="padding-right:6px" > 
                 
                  <div style="max-width:140px;overflow:hidden;font-size:13px;padding-top:1px;padding-bottom:2px;line-height:11px;height:22px"><b><?php   echo $tenpt[1];?></b></div>
                  <div style="max-width:120px;overflow:hidden;font-size:11px;"><strong><?php   echo $mota[1];?></strong></div>
                  <img onerror="this.src='images/trang.jpg'" style="-webkit-user-select: none" src="includes/ma.php?text=<?php echo $ma[1] ;?>" width="140px" height="25px"  > 
                  <div style="width:140px;line-height:10px;font-size:13;font-weight:bold;padding-bottom:2px"><?php echo $ma[1] ;?></div>
                  </td>                 <td width="33%" height="74px" align="center"  > 
             
<div style="max-width:140px;overflow:hidden;font-size:13px;padding-top:1px;padding-bottom:2px;line-height:12px;height:22px"><b>
  <?php   echo $tenpt[2];?>
</b></div>
 <div style="max-width:120px;overflow:hidden;font-size:11px;"><strong><?php   echo $mota[2];?></strong></div>
                    <img onerror="this.src='images/trang.jpg'" style="-webkit-user-select: none" src="includes/ma.php?text=<?php echo $ma[2] ;?>" width="140px" height="25px"  > 
                  <div style="width:140px;line-height:10px;font-size:13;font-weight:bold;padding-bottom:2px"><?php echo $ma[2] ;?></div>
                  
                  </td>                
                  <td width="33%" height="74px" align="center"  style="padding-left:6px"> 
         
<div style="max-width:140px;overflow:hidden;font-size:13px;padding-top:1px;padding-bottom:2px;line-height:12px;height:22px"><b>
  <?php   echo $tenpt[3];?>
</b></div>
     <div style="max-width:120px;overflow:hidden;font-size:11px;display:<?php echo $inra[3] ; ?>"><strong><?php echo $mota[3] ;?></strong></div>
                    <img onerror="this.src='images/trang.jpg'" style="-webkit-user-select: none" src="includes/ma.php?text=<?php echo $ma[3] ;?>" width="140px" height="25px"  > 
                  <div style="width:140px;line-height:10px;font-size:13;font-weight:bold;padding-bottom:2px"><?php echo $ma[3] ;?></div>
                 
                  </td>               
                         
         </tr> </table>
           <table border="0" cellpadding="0" cellspacing="0" width="510px"   >
           <tr style="text-align:center">
           <td width="33%"><strong><?php   echo $LoaiTien[1] ;?></strong></td>
           <td width="34%"><strong><?php   echo $LoaiTien[2] ;?></strong></td>
           <td width="33%"><strong><?php   echo $LoaiTien[3] ;?></strong></td></tr>
           
           </table>
         </div>

				<?php
                 }
 		      }
		  
 
   } /// het whileE
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
 ?>
  
     
</div>
 
 <script language="javascript">
 
  function inhd4()
  {
     document.getElementById('inra').style.display ="none" ;
	 javascript:window.print() ;
  }	
   function donglai()
  {
   window.close();
   }	
    document.getElementById('inan').focus() ;   
 
</script>  

 <?php    $data->closedata()   ;?> 
	 