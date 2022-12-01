<?php  
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"]["phieubugioduyet"]]  ;  
  $idl=$_SESSION["LoginID"];
	//$ql[4]=5;
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
		 
$sql = "SELECT a.tinhtrang,a.ID,DATE_FORMAT(a.ngaybu,'%d/%m/%Y') as ngaybu,a.hinhanhvao,a.hinhanhra,a.idcuahang,d.ten as nguoitao,d.chucvu as chucvutao,a.ngayxacnhan1,b.name as tencuahang,a.thoigianbatdau,a.thoigianketthuc,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngayxacnhan2,'%d/%m/%Y %H:%i') as ngayduyet,a.lydo,a.lydoNS,a.lydoGS,c.Ten, c.MaNV, c.ChucVu FROM phieubugio a left join cuahang b on a.idcuahang=b.id  left join userac c on a.IDNV = c.ID  left join userac d on a.IDtao = d.ID  where a.ID= $idphieu  ORDER BY a.ID desc ";
 	//echo $sql;
		/*$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
		$mangteams=taomang("lydonhapxuat","ID","Name","")*/ ;
// echo $sql;
 //if($_SESSION['admintuan'] ) echo $sql ;
	//	$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		$re = getdong($sql);
		$mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
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
 	 		  $giamsat1='';$giamsat2='';$giamsat3='';$giamsat4='';$quanly1='';$quanly2='';$quanly3='';$quanly4='';
				$tinhtrang=$re["tinhtrang"]."00";
				$giamsat=$tinhtrang[0];
				$quanly=$tinhtrang[1]; 
				$tinhtrangduyet="Mới tạo" ;
 				if( $giamsat==4 ) {$tinhtrangduyet="Giám sát/Nhân sự Đã duyệt" ;  }  
				elseif ($giamsat==3)  $tinhtrangduyet="Giám sát/Nhân sự Không duyệt" ;  
				elseif ($giamsat==2)  $tinhtrangduyet="Chờ thông tin" ;  
				elseif ($giamsat==4||$quanly==1)  $tinhtrangduyet="Chờ NS duyệt" ; 
				elseif ($quanly==3)  $tinhtrangduyet="Quản lý Không duyệt" ;  
				elseif ($quanly==2)  $tinhtrangduyet="Chờ thông tin" ;  
				elseif ($quanly==4)  $tinhtrangduyet="Chờ NS duyệt" ; 
				
				if($giamsat==3||$giamsat==4)   $giamsatht='disabled';  else  $giamsatht='';  
			 	if( $quanly==3||$quanly==4  )   $quanlyht='disabled';  else  $quanlyht='';  
				
				$tam= "giamsat$giamsat='selected'; "; eval('$'.$tam);
 				$tam= "quanly$quanly='selected'; ";eval('$'.$tam);
				 
				
				$ngaynghiphep = date("d-m-Y",strtotime($re["thoigianketthuc"]));
			    $sogio =   strtotime($re["thoigianketthuc"])- strtotime($re["thoigianbatdau"]);  
				$tongnghiphep += $sogio;
				$tam = floor($sogio/3600);			
				$sogio =   ($sogio- $tam*3600)/60 ;
				$sogio  =$tam.'h'.$sogio."'" ;

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
	</div><button type="button" id="closepo" onclick="closepop('poupduyetbugioct')">x</button></div>
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
					<div><label>Người tạo</label><strong>:</strong>  <?=$re['nguoitao']?></div>
					
				</div>
				<div class="block_i">
						<div><label>Chức vụ</label><strong>:</strong> <?=$mangchucvu[$re['chucvutao']]?></div>
					<div><label>Cửa hàng</label><strong>:</strong>  <?=$re['tencuahang']?></div>
					<div><label>Mã NV</label><strong>:</strong>  <?=$re['MaNV']?></div>
					
				</div>
				<div class="block_i">
						<div><label>Tên NV</label><strong>:</strong> <?=$re["Ten"]?></div>
					<div><label>Chức vụ</label><strong>:</strong>  <?=$mangchucvu[$re["ChucVu"]]?></div>
					<div><label>Ngày bù</label><strong>:</strong>  <?=$re['ngaybu']?></div>
					
				</div>
				<div class="block_i">
					<div><label>Giờ vào</label><strong>:</strong> <?=date('H:i  d/m',  strtotime($re["thoigianbatdau"]))?></div>
					<div><label>Giờ ra</label><strong>:</strong> <?=date('H:i d/m',  strtotime($re["thoigianketthuc"]))?></div>
					<div><label>Số giờ</label><strong>:</strong> <?=$sogio?></div>
				</div>
				
					<div class="block_i">
					<div><label>Lý do</label><strong>:</strong> <span class="break_w"> <?=$re['lydo']?></span></div>
						<div><label>Tình trạng</label><strong>:</strong> <span class="tinhtrangform"> <?=$tinhtrangduyet?></span></div>
				</div>
				
				
				<!--<div class="block_i" style="width:100%">
					
					<div><label class="ghichu">Ghi chú</label><strong>:</strong><span class="break_w"><?=$re['ghichu']?></span></div>
				</div>-->
				
				
					 <?php  if($ql[3] ||$ql[4]) {  ?>
					 <div class="block_i block_d">
					<div><label>Quản lý:</label>
					<div style="    display: flex;
    justify-content: space-around;" class="btn_w">
						<button class="btn btn2 btntrangthai" onclick="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','quanly',2,'cpthumua'),showloading1()" <?=$quanlyht?>>Xác nhận bù giờ</button>
						<button class="btn btn3 btntrangthai" onclick="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','quanly',3,'cpthumua'),showloading1()" <?=$quanlyht?>>Không duyệt</button>
						<button class="btn btn4 btntrangthai" onclick="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','quanly',4,'cpthumua'),showloading1()" <?=$quanlyht?>>Duyệt</button>
					</div>
					
						 </div>	
						</div>	  
					 <?php } ?> 	
					
						  <?php  if($ql[3] || $ql[4]) {  ?>
					<div class="block_i block_d">
					<div><label>Giám sát/Nhân sự:</label>
						<div style="    display: flex;
    justify-content: space-around;" class="btn_w">
						<button class="btn btn2 btntrangthai" onclick="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamsat',2),showloading1()" <?=$giamsat?>>Chờ điều chỉnh</button>
						<button class="btn btn3 btntrangthai" onclick="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamsat',3),showloading1()" <?=$giamsat?>>Không duyệt</button>
						<button class="btn btn4 btntrangthai" onclick="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamsat',4),showloading1()" <?=$giamsat?>>Duyệt</button>
					</div>
						 </div>	
							  </div>
					 <?php } ?> 	 
					 
						 <div class="block_i block_hinh">
				<label>Hình ảnh vào:</label>
				<?php
				if($re["hinhanhvao"]){
								$hinhanh=explode("*",$re["hinhanhvao"]);
								$chuoihinh='';
								foreach($hinhanh as $key => $value){
								if($value!=""){
									$chuoihinh.='<div style="width:200px">
									<img style="width:100%" src="images/bugio/'.$value.'" /></div>';
									}
								}
							 }
					echo $chuoihinh;
				?>
					
				</div>
				<div class="block_i block_hinh">
				<label>Hình ảnh ra:</label>
				<?php
				if($re["hinhanhra"]){
								$hinhanh=explode("*",$re["hinhanhra"]);
								$chuoihinh='';
								foreach($hinhanh as $key => $value){
								if($value!=""){
									$chuoihinh.='<div style="width:200px">
									<img style="width:100%" src="images/bugio/'.$value.'" /></div>';
									}
								}
							 }
					echo $chuoihinh;
				?>
					
				</div>
				
 	 	
<?php	 			

	}
?>	
	</div>
		</div>
	</div>

  <?php				
    $data->closedata() ;
?>	
