<?php  
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;  
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
		/*$idlogin   =  laso($tmp[1])   ;
		$loai   =  ($tmp[2])   ;
		$tinhtrang= laso($tmp[3]) ;
		$lydo = $tmp[4];
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
         $ngayduyet =gmdate('d-n-Y H:i:s', time() + 7*3600) ;
	
		 */
 
 	$sql = "SELECT a.ID as IDp, a.soct,a.lydo,a.sotien,a.tinhtrang,a.hinhanh,a.ID,a.idcuahang,c.Ten as nguoitao,a.chucvu,a.manv , b.name as tencuahang ,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngaynghidexuat,'%d/%m/%Y') as ngaynghidx,DATE_FORMAT(a.ngaynghiduyet,'%Y-%m-%d') as ngaynghid,DATE_FORMAT(a.ngaynghithuc,'%Y-%m-%d') as ngaynghit,DATE_FORMAT(a.ngaygiamdoc,'%d/%m/%Y %H:%i') as ngayduyet,a.ghichu,a.lydothumua,a.lydoketoan,a.lydogiamdoc FROM duyetbaohiemyte a left join cuahang b on a.idcuahang=b.id  left join userac c on a.IDTV = c.ID    where a.ID=$idphieu";
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
			width:80%;
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
 			
 	 		    $giamdoc0='';$giamdoc1='';$giamdoc2='';$giamdoc3='';$giamdoc4='';$ketoan0='';$ketoan1='';$ketoan2='';$ketoan3='';$ketoan4='';$thumua0='';$thumua1='';$thumua2='';$thumua3='';$thumua4='';
				$tinhtrang=$re["tinhtrang"]."11";
				
				
				$tinhtrangduyet="Chưa duyệt" ;
					$ketoan=$tinhtrang[0]; 
				$giamdoc=$tinhtrang[1];
				$tinhtrangduyet="Chưa duyệt" ;
				if($giamdoc==4) {$tinhtrangduyet="Nhân sự đã duyệt" ;  }  
				elseif ($giamdoc==3)  $tinhtrangduyet="Nhân sự không duyệt" ; 
				elseif ($ketoan==3)  $tinhtrangduyet="Giám sát không duyệt" ;  
				elseif ($ketoan==2)  $tinhtrangduyet="Giám sát chờ thông tin" ;  
				elseif ($ketoan==4 )  $tinhtrangduyet="Chờ nhân sự duyệt" ;
				elseif ($ketoan==1)  $tinhtrangduyet="Chờ giám sát duyệt" ; 
				//ke toán = giám sát
				// giám đốc = nhấn sự
				
				if(!$ql[5]){
				$giamdocht='disabled'; $ketoanht='';
				$d=''; 
				if($ketoan==4){
					$ketoanht='disabled';
						$giamdocht='';
				}
				elseif($ketoan==3){
						$ketoanht='disabled';
						$giamdocht='disabled';
				}
				if($giamdoc==3 || $giamdoc==4){
						
						$ketoanht='disabled';
						$giamdocht='disabled';
					}
				}
				if(!$ql[5]){
				if(($giamdoc==3 || $giamdoc==4) || ($ketoan==3 || $ketoan==4) ){
						
						$d='disabled';
						
					}
					}
				/*if($giamdoc==3||$giamdoc==4)   $giamdocht='disabled';  else  $giamdocht='';  
				if(($ketoan==4||$ketoan==3||$giamdoc==0||$giamdoc==1||$giamdoc==2||$giamdoc==3))   $ketoanht='disabled';  else  $ketoanht='';  
				if(($thumua==4||$giamdoc==0||$giamdoc==1||$giamdoc==2||$giamdoc==3 ||$ketoan==0||$ketoan==1||$ketoan==2||$ketoan==3))   $giamdocht='disabled'; $ketoanht='disabled';  else  $ketoanht='';  */
				$tam= "giamdoc$giamdoc='selected'; "; eval('$'.$tam);
 				$tam= "ketoan$ketoan='selected'; ";eval('$'.$tam);
				
				$sotien=$re['sotien']* $re['loaihuong']/100 ;
				$tongtien += $sotien ;

	 ?>	
	 
	 <div style="    display: flex;
    width: 100%;
    justify-content: space-between;
    padding-bottom: 1em;
    align-items: center;
    border-bottom: 1px solid #148a1426;">
	<div id="titl"><span><strong style="color:#FF0000">Số Phiếu: <?=$re['soct']?></strong></span>
		<span><strong style="color:green">Tình trạng: <span class="tinhtrangform"> <?=$tinhtrangduyet?></span></strong></span>
		<span id="loading1"><img src="images/loading.gif"/>loading...</span>
	</div><button type="button" id="closepo" onclick="closepop()">x</button></div>
	<div id="showform">
			<div class="form" style="width:100%">
	 			<div class="block_i">
					<div><label>Ngày tạo</label><strong>:</strong> <?=$re['ngaytao']?></div>
					<div><label>Ngày duyệt</label><strong>:</strong>  <?=$re['ngayduyet']?></div>
					<div><label>Tên của hàng</label><strong>:</strong>  <?=$re['tencuahang']?></div>
					
				</div>
				<div class="block_i">
				<div><label>Mã NV</label><strong>:</strong> <?=$re['manv']?></div>
					<div><label>Tên NV</label><strong>:</strong>  <?=$re['nguoitao']?></div>
					<div><label>Chức vụ</label><strong>:</strong>  <?=$re['chucvu']?></div>
					
				</div>
				
				<div class="block_i">
					
					<div><label>lý do</label><strong>:</strong> <span class="break_w"> <?=$re['lydo']?></span></div>
					<div><label>Ngày nghỉ đề xuất</label><strong>:</strong> <?=$re['ngaynghidx']?></div>
					
				</div>
				<div class="block_i">
					<div><label>Tình trạng</label><strong>:</strong> <span class="tinhtrangform"> <?=$tinhtrangduyet?></span></div>
					
					<div><label>Lý do không duyệt</label><strong>:</strong><span class="break_w">  <?php 
						echo $re['lydoketoan']?$re['lydoketoan']:"";
						echo $re['lydogiamdoc']?$re['lydogiamdoc']:"";
						
							?></span></div>
				</div>
				
				<div class="block_i" style="width:100%">
					
					<div><label class="ghichu">Ghi chú</label><strong>:</strong><span class="break_w"><?=$re['ghichu']?></span></div>
				</div>
				
				<div class="block_i" style="width:100%;display:flex">
					<div><label>Ngày nghỉ duyệt</label><strong>:</strong> <span class="tinhtrangform"><input type="date" id="ngaynghiduyet"  name="ngaynghiduyet" <?=$d?> value="<?=$re["ngaynghid"]?>"/></span></div>
					
					<div><label>Ngày nghỉ thực</label><strong>:</strong> <span class="tinhtrangform"><input type="date" id="ngaynghithuc"  name="ngaynghithuc" <?=$d?> value="<?=$re["ngaynghit"]?>"/></span>
					 <?php  if($ql[5]) {  ?>
					
						<button class="btn btn4 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','ketoan',4,'cpketoan',ngaynghiduyet.value,ngaynghithuc.value,1),showloading1()" <?=$ketoanht?>>Lưu</button>
						
					 <?php } ?> 
					</div>
				</div>
				  <?php  if( $ql[1] || $ql[5]) {  ?>
					<div class="block_i block_d">
					<div><label>Giám sát duyệt:</label>
						<div style="    display: flex;
    justify-content: space-around;" class="btn_w">
						<button class="btn btn2 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','ketoan',2,'cpketoan'),showloading1()" <?=$ketoanht?>>Chờ điều chỉnh</button>
						<button class="btn btn3 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','ketoan',3,'cpketoan'),showloading1()" <?=$ketoanht?>>Không duyệt</button>
						<button class="btn btn4 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','ketoan',4,'cpketoan',ngaynghiduyet.value),showloading1()" <?=$ketoanht?>>Duyệt</button>
						
					</div>
						 </div>	
							  </div>
					 <?php } ?> 	 
					  <?php  if($ql[2] || $ql[5]) { ?>
					<div class="block_i block_d">
					<div><label>Nhân sự duyệt:</label><div style="    display: flex;
    justify-content: space-around;" class="btn_w">
						<button class="btn btn2 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamdoc',2,'cpgiamdoc'),showloading1()" <?=$giamdocht?>>Chờ điều chỉnh</button>
						<button class="btn btn3 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamdoc',3,'cpgiamdoc'),showloading1()" <?=$giamdocht?>>Không duyệt</button>
						<button class="btn btn4 btntrangthai" onclick="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamdoc',4,'cpgiamdoc'),showloading1(),ngaynghiduyet.value" <?=$giamdocht?>>Duyệt</button>
					</div>
						</div>
						 </div>
						 <?php } 
							 
						 ?>  
						
				<div class="block_i block_hinh">
				<label>Hình ảnh:</label>
				<?php
				if($re["hinhanh"]){
								$hinhanh=explode("*",$re["hinhanh"]);
								$chuoihinh='';
								foreach($hinhanh as $key => $value){
								if($value!=""){
									$chuoihinh.='<div style="width:200px">
									<img style="width:100%" src="images/duyetnghi/'.$value.'" /></div>';
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
