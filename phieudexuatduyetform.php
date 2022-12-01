<?php  
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"]["duyetdexuat"]]  ;  
  $idl=$_SESSION["LoginID"];
$ql[5]=5;
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

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
 
        $idphieu   =  laso($tmp[0])   ;
		  $soct  =  $tmp[1]   ;
		/*$idlogin   =  laso($tmp[1])   ;
		$loai   =  ($tmp[2])   ;
		$tinhtrang= laso($tmp[3]) ;
		$lydo = $tmp[4];
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
         $ngayduyet =gmdate('d-n-Y H:i:s', time() + 7*3600) ;
	
		 */
		 
 $sql = "SELECT a.tinhtrang,a.ID as IDp,a.lydo1,a.lydo2,a.lydo3,a.sochungtu,a.idcuahang,a.thongtinsai,a.thongtindung,b.name as tencuahang,a.lydo,a.idtao,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngayxacnhan3,'%d/%m/%Y %H:%i') as ngayduyet,a.lydo FROM phieuyeucau a left join cuahang b on a.idcuahang=b.id where a.ID=$idphieu ORDER BY a.ID desc ";
 
		/*$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
		$mangteams=taomang("lydonhapxuat","ID","Name","")*/ ;
// echo $sql;
 //if($_SESSION['admintuan'] ) echo $sql ;
	//	$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		$re = getdong($sql);
		
		//$i = $page_start; 
//		$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
	

 // if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	 
	//==============================================================	
	//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
?>
 <style>
 #duyetform{
 	font-size:16px !important;
	
 }
 	#showform table td{
		font-size:1.4em;
		padding:0.5em;
	}
	#showform{
		width: 100%;
		height: 100%;
		margin-top: 2em;
		font-size: 3em;
		overflow:scroll;
		    height: 90vh;
	}
	
		#showform select {
			    font-size: 50px;
    width: 50%;
		
		}
	#duyetform{
			display:flex;
		width:100%;
		height:100%;
		background-color:#FFFFFF;
		flex-direction: column;
		padding:1em;
	}
	
	#duyetform button{
			    background-color: unset;
			border: none;
			font-size: 6em;
	}
	#titl{
		    font-size: 3em;
    display: flex;
    flex-direction: column;	
	}
	#titl span{
		
	}
	
	#showform .form{
		    display: flex;
		flex-wrap: wrap;
		    flex-direction: column;
	}
	#showform .form >div{
		width:100%;
	}
	#showform .form .block_d{
	
	}
	#showform .form .block_d >div{
		width:100%;
		display: flex;
		
    flex-direction: column;
	}
	#showform .form .block_d  label{
		width:50% !important;
	}
	#showform .form .block_i >div{
		margin-bottom:0.5em;
		width:100%;
		
	}
	
	#showform .form .block_i >div .break_w{
	word-break: break-all;
	display: inline-flex;
    width: 55%;
	}
	#showform .form .block_i label{
		width:410px;
	}
	#showform .ghichu{
		width:410px;
	}
	#loading1{
		display:none;
	}
	.btn2{
		background-color: #ffc107 !important;
	}
	.btn3{
		background-color: #ff5722  !important;
	}
	
	.btn4{
		background-color: #4caf50 !important;
	}
	.btn{
		    font-size: 1em !important;
		padding: 0.5em;
		
		color: #ffffff;
	}
	@media all and (min-width: 600px) {
		#duyetform{
		font-size:16px !important;
		
	 }
		#showform table td{
			font-size:1.4em;
			padding:0.5em;
		}
		#showform{
			width: 100%;
			height: 100%;
			margin-top: 2em;
			font-size: 3em;
			overflow:scroll;
				height: 90vh;
		}
		
			#showform select {
					font-size: 50px;
		width: 50%;
			
			}
		#duyetform{
				display:flex;
			width:100%;
			height:100%;
			background-color:#FFFFFF;
			flex-direction: column;
			padding:1em;
		}
		
		#duyetform button{
					background-color: unset;
				border: none;
				font-size: 6em;
		}
		#titl{
				font-size: 3em;
		display: flex;
		flex-direction: column;	
		}
		#titl span{
			
		}
		
		#showform .form{
				display: flex;
			flex-wrap: wrap;
				flex-direction: column;
		}
		#showform .form >div{
			width:100%;
		}
		#showform .form .block_d >div{
			width:100%;
			display: flex;
		}
		#showform .form .block_d  label{
			width:50% !important;
		}
		#showform .form .block_i >div{
			margin-bottom:0.5em;
			width:100%;
		}
		#showform .form .block_i label{
			width:410px;
		}
		
	}
	
	@media all and (min-width: 1024px) {
		#duyetform{
		font-size:16px !important;
		
	 }
	 #showform .ghichu{
		width:20% !important;
	}
		#duyetform{
		
		}
		#showform{
			width: 100%;
			height: 80%;
			margin-top: 1em;
			font-size: 1em;
			overflow:scroll;
				height: 90vh;
		}
		
			#showform select {
					font-size: 14px;
		width: 50%;
			
			}
		#duyetform{
				display:flex;
			width:60%;
			height:70%;
			background-color:#FFFFFF;
			flex-direction: column;
			padding:1em;
		}
		
		#duyetform button{
					background-color: unset;
				border: none;
				font-size: 2em;
		}
		#titl{
			    font-size: 1em;
    display: flex;
    flex-direction: row;
}
		
		#titl span{
			margin-left:1em;
		}
		
		#showform .form{
				display: flex;
			flex-wrap: wrap;
				    flex-direction: row;
		}
		#showform .form >div{
			width:50%;
		}
		#showform .form .block_d{
			width:100%;
			display: flex;
		}
		#showform .form .block_d >div{
			    flex-direction: row;
		}
		#showform .form .block_d  label{
			width:30% !important;
		}
		#showform .form .block_i >div{
			margin-bottom:1em;
			width:100%;
			
		}
		#showform .form .block_i label{
			width:40%;
		}
		#showform .form .block_d .btn_w{
			width:60%;
		}
	}
	
	@media all and (min-width: 1280px){
		#duyetform{
			
		}
		#poupduyet{
				height:100vh;
		}
	}
 </style>
<div id="duyetform">
		
			
   <?php
 
	 $result = $data->query($sql); 
$tong=0;$tongsl=0; $r =0 ; $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

  $cuahangtruong= 1; $giamsat= 2; $ketoan= 3;  // 4 là 12   5 là 13   6  là 23  7 là 123 
   //$mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
  $tongtien =0;
  $ngaynhap = gmdate('Y-n-d', time() + 7*3600) ; $mangtangca= array();  
  if($re)
	{   
 	    	 $mangtangca[$re['MaNV']]=1;
 			//thumua=cuahang,ketoan=giamsat,giamdoc=admin
 	 		    $giamdoc0='';$giamdoc1='';$giamdoc2='';$giamdoc3='';$giamdoc4='';$ketoan0='';$ketoan1='';$ketoan2='';$ketoan3='';$ketoan4='';$thumua0='';$thumua1='';$thumua2='';$thumua3='';$thumua4='';
				$tinhtrang=$re["tinhtrang"]."11";
				$thumua=$tinhtrang[0];
				$ketoan=$tinhtrang[1]; 
				$giamdoc=$tinhtrang[2];
				$tinhtrangduyet="Chưa duyệt" ;
				if($giamdoc==4) {$tinhtrangduyet="Đã duyệt" ;  }  
				elseif ($ketoan==3)  $tinhtrangduyet="Không duyệt" ;  
				elseif ($ketoan==2)  $tinhtrangduyet="Chờ thông tin" ;  
				elseif ($ketoan==4 )  $tinhtrangduyet="Chờ admin duyệt" ; 
				elseif (($ketoan==1||$ketoan==2) && $thumua==4)  $tinhtrangduyet="Chờ giám sát duyệt" ; 
				elseif ($thumua==3)  $tinhtrangduyet="Không duyệt" ;  
				elseif ($thumua==2)  $tinhtrangduyet="Chờ thông tin" ;  
				elseif ($thumua==4 )  $tinhtrangduyet="Chờ giám sát duyệt" ; 
				elseif ($thumua==1||$thumua==2)  $tinhtrangduyet="Chờ của hàng duyệt" ;
				$giamdocht=''; $ketoanht='disabled'; $thumuaht='disabled';
			
					if($thumua==4){
						$ketoanht='';
					}
					else if($thumua==3){
						$thumuaht='disabled';
						$ketoanht='disabled';
						$giamdocht='disabled';
					}
					else{
						$thumuaht='';
					}
					
					if($ketoan==4){
						$thumuaht='disabled';
						$ketoanht='disabled';
						
					}
					else if($ketoan==3){
						$thumuaht='disabled';
						$ketoanht='disabled';
						$giamdocht='disabled';
					}
					
				
				
				if($giamdoc==3 || $giamdoc==4){
						$thumuaht='disabled';
						$ketoanht='disabled';
						$giamdocht='disabled';
					}
					
					$arrdung=explode('&*!',$re["thongtindung"]);
				$arrsai=explode('&*!',$re["thongtinsai"]);
				$thongtindung='';
				$thongtinsai='';
				if($arrdung[1]==1){
					$thongtindung=$arrdung[0].': '.getten('userac',$arrdung[2],'Ten');
 					$thongtinsai=$arrsai[0].': '.getten('userac',$arrsai[2],'Ten');
				}
				else if($arrdung[1]==2){
					$thongtindung=$arrdung[0].': '.getten('userac',$arrdung[2],'Ten');
 					$thongtinsai=$arrsai[0].': '.getten('userac',$arrsai[2],'Ten');
				}
				else if($arrdung[1]==3){
				
					$thongtindung=$arrdung[0].': '.getten('lydonhapxuat',$arrdung[2],'Name');
 					$thongtinsai=$arrsai[0].': '.getten('lydonhapxuat',$arrsai[2],'Name');
				}
				else if($arrdung[1]==4){
				
					$thongtindung=$arrdung[0].': '.$arrdung[2];
 					$thongtinsai=$arrsai[0].': '.$arrsai[2];
				}
 				
				/*if($giamdoc==3||$giamdoc==4)   $giamdocht='disabled';  else  $giamdocht='';  
				if(($ketoan==4||$ketoan==3||$giamdoc==0||$giamdoc==1||$giamdoc==2||$giamdoc==3))   $ketoanht='disabled';  else  $ketoanht='';  
				if(($thumua==4||$giamdoc==0||$giamdoc==1||$giamdoc==2||$giamdoc==3 ||$ketoan==0||$ketoan==1||$ketoan==2||$ketoan==3))   $giamdocht='disabled'; $ketoanht='disabled';  else  $ketoanht='';  */
				$tam= "giamdoc$giamdoc='selected'; "; eval('$'.$tam);
 				$tam= "ketoan$ketoan='selected'; ";eval('$'.$tam);
				$tam= "thumua$thumua='selected'; ";eval('$'.$tam);
				$sotien=$re['sotien']* $re['loaihuong']/100 ;
				$tongtien += $sotien ;

	 ?>	
	 <div style="    display: flex;
    width: 100%;
    justify-content: space-between;
    padding-bottom: 1em;
    align-items: center;
    border-bottom: 1px solid #148a1426;">
	
	<div id="titl"><span><strong style="color:#FF0000">Số Phiếu: <?=$re['sochungtu']?></strong></span>
		<span><strong style="color:green">Tình trạng: <span class="tinhtrangform"> <?=$tinhtrangduyet?></span></strong></span>
		
		<span id="loading1"><img src="images/loading.gif"/>loading...</span>
	</div><button type="button" id="closepo" onclick="closepop()">x</button></div>
	<?php
		if($re['lydo1'] || $re['lydo2'] || $re['lydo3']){
			?>
			
			<div style="padding-top:0.5em"><strong style="color:red">Lý do không duyệt: <span class="tinhtrangform" style="font-style:italic"> <?php
				echo $re['lydo1']?$re['lydo1']:"";
						echo $re['lydo2']?$re['lydo2']:"";
						echo $re['lydo3']?$re['lydo3']:"";
			
			?></span></strong></div>
			<?php
		}
		?>
		 
						
	
	<div id="showform">
			<div class="form" style="width:100%">
	 			<div class="block_i">
					<div><label>Ngày tạo</label><strong>:</strong> <?=$re['ngaytao']?></div>
					<div><label>Ngày duyệt</label><strong>:</strong>  <?=$re['ngayduyet']?></div>
					<div><label>Tên của hàng</label><strong>:</strong>  <?=$re['tencuahang']?></div>
					
				</div>
				<div class="block_i">
					<div><label>Nhân viên tạo</label><strong>:</strong> <?=getten('userac',$re['idtao'],'Ten')?></div>
					<div><label>Lý do</label><strong>:</strong> <span class="break_w"> <?=$re['lydo']?></span></div>
						<div><label>Tình trạng</label><strong>:</strong> <span class="tinhtrangform"> <?=$tinhtrangduyet?></span></div>
				</div>
				
				
				<div class="block_i">
					<div><label style="color:green">Thông tin yêu cầu:</label></div>
					
					<div><label>Thông tin sai</label><strong>:</strong> <span class="break_w"> <?=$thongtinsai?></span></div>
						<div><label>Thông tin đúng</label><strong>:</strong> <span class=""> <?=$thongtindung?></span></div>
				</div>
				
				<!--<div class="block_i" style="width:100%">
					
					<div><label class="ghichu">Ghi chú</label><strong>:</strong><span class="break_w"><?=$re['ghichu']?></span></div>
				</div>-->
				
				
					 <?php  if($ql[1]) {  ?>
					 <div class="block_i block_d">
					<div><label>Cửa hàng duyệt:</label>
					<div style="    display: flex;
    justify-content: space-around;" class="btn_w">
						<button class="btn btn2 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','thumua',2,'cpthumua'),showloading1()" <?=$thumuaht?>>Chờ điều chỉnh</button>
						<button class="btn btn3 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','thumua',3,'cpthumua'),showloading1()" <?=$thumuaht?>>Không duyệt</button>
						<button class="btn btn4 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','thumua',4,'cpthumua'),showloading1()" <?=$thumuaht?>>Duyệt</button>
					</div>
					
						 </div>	
						</div>	  
					 <?php } ?> 	
					
						  <?php  if( $ql[2]) {  ?>
					<div class="block_i block_d">
					<div><label>Giám sát duyệt:</label>
						<div style="    display: flex;
    justify-content: space-around;" class="btn_w">
						<button class="btn btn2 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','ketoan',2,'cpketoan'),showloading1()" <?=$ketoanht?>>Chờ điều chỉnh</button>
						<button class="btn btn3 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','ketoan',3,'cpketoan'),showloading1()" <?=$ketoanht?>>Không duyệt</button>
						<button class="btn btn4 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','ketoan',4,'cpketoan'),showloading1()" <?=$ketoanht?>>Duyệt</button>
					</div>
						 </div>	
							  </div>
					 <?php } ?> 	 
					  <?php  if($ql[5]) { ?>
					<div class="block_i block_d">
					<div><label>Admin duyệt:</label><div style="    display: flex;
    justify-content: space-around;" class="btn_w">
						<button class="btn btn2 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamdoc',2,'cpgiamdoc'),showloading1()" <?=$giamdocht?>>Chờ điều chỉnh</button>
						<button class="btn btn3 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamdoc',3,'cpgiamdoc'),showloading1()" <?=$giamdocht?>>Không duyệt</button>
						<button class="btn btn4 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamdoc',4,'cpgiamdoc'),showloading1()" <?=$giamdocht?>>Duyệt</button>
					</div>
						</div>
						 </div>
						 <?php } 
							 
						 ?>  
				
 	 	
<?php	 			

	}
?>	
	</div>
		</div>
	</div>

  <?php				
    $data->closedata() ;
?>	
