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
 
 	$sql = "SELECT a.ID as idthuchikt,a.IDcha,a.loaitk,a.sochungtu,a.NCC,a.luachon as loaithuchi,DATE_FORMAT(a.ngaytao,'%Y-%m-%d') as ngaytao,DATE_FORMAT(a.ngaythuchi,'%Y-%m-%d %H:%i:%s') as ngaythuchikt,DATE_FORMAT(a.ngayduyet,'%Y-%m-%d %H:%i:%s') as ngayduyettfhuchi,a.psco,a.psno,a.donvi,a.soluong,a.dongia,a.hdbh,a.sotknh,a.phithukh,a.tentknh,a.NCC,a.manv,a.phieuxuat,a.sophieupm,a.chungtu,a.mavandon,a.tinhtrang,a.lydoN,d.xacnhan as nguoixn,b.macuahang as tencuahang,a.luachon as loaiphieu,d.ma as madkhoan,d.ten as khoanmuctc,a.tkno,a.tkco,a.note as diengiai,a.donvivc,d.thongtin as thongtinsua,f.SoCT as phieuxuatf  FROM thuchikt a left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha  left join phieuxuat  f on a.phieuxuat=f.ID  where a.ID=$idphieu $wherequyen order by  a.ngaythuchi desc";
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
	
	#duyetform buttfon{
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
		margin-bottfom:0.5em;
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
		
		#duyetform buttfon{
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
			margin-bottfom:0.5em;
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
	#duyetform input,#duyetform select,#duyetform textarea{
	 	width:50%;
		margin:0;
		min-height:30px;
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
		
		#duyetform buttfon{
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
			margin-bottfom:1em;
			width:100%;
			
		}
		#showform .form .block_i label{
			width:30%;
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
  
	
$tong=0;$tongsl=0; $r =0 ; $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

  $cuahangtruong= 1; $giamsat= 2; $ketoan= 3;  // 4 là 12   5 là 13   6  là 23  7 là 123 
   //$mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
  $tongtien =0;
  $ngaynhap = gmdate('Y-n-d', time() + 7*3600) ; $mangtangca= array();  
  if($re)
	{   
 	    	 $mangtangca[$re['MaNV']]=1;
 			
 	 		   $thuquy0='';$thuquy1='';$thuquy2='';$thuquy3='';$thuquy4='';
				$ketoanOnL0='';$ketoanOnL1='';$ketoanOnL2='';$ketoanOnL3='';$ketoanOnL4='';
				$ketoanCH0='';$ketoanCH1='';$ketoanCH2='';$ketoanCH3='';$ketoanCH4='';
				$tinhtrang=$re["tinhtrang"];
				$tinhtrangduyet="Chưa duyệt" ;
				$select1='';
				$select2='';
				 $select4='';
				 $select3='';
				 $showchinhsua=false;
				if($tinhtrang==4) {
					$tinhtrangduyet="Đã duyệt"; 
					$select4="selected='selected'";
					//$disable='disable';
				}  
				elseif ($tinhtrang==1)  {
					$tinhtrangduyet="Chưa duyệt";
					 $select1="selected='selected'";
				 }  
				 elseif ($tinhtrang==3)  {
				$tinhtrangduyet="Không duyệt";
				 $select3="selected='selected'";
				 }  
				  elseif ($tinhtrang==2)  {
					$tinhtrangduyet="Yêu cầu chỉnh sửa";
					 $select2="selected='selected'";
					 $showchinhsua=true;
				 } 
				 elseif ($tinhtrang==5){
				 	$tinhtrangduyet="Đã chỉnh sửa";
				 }
				$disabled='';
			if($tinhtrang==4 || $tinhtrang==3 ||$tinhtrang==2 ){
					$disabled='disabled';
			} 
				
				/*$tam= "giamsat$giamsat='selected'; "; eval('$'.$tam);
 				$tam= "ketoan$ketoan='selected'; ";eval('$'.$tam);*/
				$sotien=$re['sotien'];
				$tongtien += $sotien ;
				$thongtinsua=explode("*",$re["thongtinsua"]);
				$show14="disabled='disabled'";
				$show15="disabled='disabled'";
				$show16="disabled='disabled'";
				$show17_18_19_20="disabled='disabled'";
				$show21="disabled='disabled'";
				$show22="disabled='disabled'";
				$show23="disabled='disabled'";
				$show24="disabled='disabled'";
						if(in_array(14,$thongtinsua)){
							$show14="";
						}
						if(in_array(15,$thongtinsua)){
							$show15="";
						}
						if(in_array(16,$thongtinsua)){
							$show16="";
						}
						if(in_array(17,$thongtinsua)){
							$show17="";
						}
						if(in_array(18,$thongtinsua)){
							$show18="";
						}
						if(in_array(19,$thongtinsua)){
							$show19="";
						}
						if(in_array(20,$thongtinsua)){
							$show20="";
						}
						if(in_array(21,$thongtinsua)){
							$show21="";
						}
						if(in_array(22,$thongtinsua)){
							$show22="";
						}
						if(in_array(23,$thongtinsua)){
							$show23="";
						}
					
		 $tkno = composx("dinhkhoan","madinhkhoan",$re["tkno"],"ID", '');
		  $cuahang = composx("cuahang","Name",$re["loaitk"],"ID", '');
		 $ncc = composx("nhacungcap","Name",$re["NCC"],"ID",'');
		  $dinhkhoan = composx("dinhkhoanthuchi","ten",$re["IDcha"],"ID",'');
			$tkco=composx("dinhkhoan","madinhkhoan",$re["tkco"],"ID",''); 
	 ?>	
	 <div style="    display: flex;
    width: 100%;
    justify-content: space-between;
    padding-bottfom: 1em;
    align-items: center;
    border-bottfom: 1px solid #148a1426;">
	<div id="titl"><span><strong style="color:#FF0000">Số Phiếu: <?=$re['sochungtu']?></strong></span>
		<span><strong style="color:green">Tình trạng: <span class="tinhtrangform"> <?=$tinhtrangduyet?></span></strong></span>
		<span id="loading1"><img src="images/loading.gif"/>loading...</span>
	</div><buttfon type="buttfon" id="closepo" onclick="closepop('poupduyet')">x</buttfon></div>
	<div id="showform">
			<div class="form" style="width:100%">
	 			<div class="block_i">
					<div><label>Ngày tạo</label><input type="date" id="ngaytao" disabled="disabled" name="ngaytao" value="<?=$re['ngaytao']?>"/><input type="hidden" id="ngaysua" disabled="disabled" name="ngaysua" value="<?=$ngaynhap?>"/> </div>
					
					<div><label>Cửa hàng</label><select id="cuahang" name="cuahang" class="js-cuahang" disabled="disabled">
					<option value="">Chọn cửa hàng</option>
						<?=$cuahang?>
					</select></div>
					<div><label>Khoản mục thu chi</label><select id="dinhkhoanthuchi" class="js-dinhkhoanthuchi" name="dinhkhoanthuchi" onchange="OnchangeDinhKhoan(this.value)">
					<option value="">Chọn định khoản</option>
						<?=$dinhkhoan?>
					</select></div>
				</div>
				<div class="block_i">
				<div><label>Phiếu xuất</label> <input type="text" id="phieuxuat" name="phieuxuat" class="ttf ttf_22" value="<?=$re["phieuxuatf"]?>" <?=$show22?>/></div>
					
					<div><label>PS nợ</label> 
					 <input type="text" id="psno" name="psno" value="<?=$re["psno"]?number_format($re["psno"]):""?>" onkeyup ="formatchuan(this)" onblur="formatchuan(this)" onchange="fomartso(event)"/></div>
					<div><label>PS có</label> 
					 <input type="text" id="psco" name="psco" value="<?=$re["psco"]?number_format($re["psco"]):""?>" onkeyup ="formatchuan(this)" onblur="formatchuan(this)" onchange="fomartso(event)"/></div>
				</div>
				
				<div class="block_i">
					
					<div><label>Đơn vị</label> <input type="text" id="donvi" name="donvi" value="<?=$re["donvi"]?>"/></div>
					<div><label>Số lượng</label> <input type="text" id="soluong" name="soluong" value="<?=$re["soluong"]?>"/></div>
					<div><label>Đơn giá</label> <input type="text" id="dongia" name="dongia" value="<?=$re["dongia"]?>" onkeyup ="formatchuan(this)" onblur="formatchuan(this)" onchange="fomartso(event)"/></div>
				</div>
				<div class="block_i">
					<div id="resgoitk" style="display:none"></div>
					<div><label>TK nợ</label><select id="tknosua" name="tknosua" class="js-tkno">
					<option value="">Chọn tài khoản</option>
						<?=$tkno?>
					</select>
						<div id="loadingtime" style="display:none"><img src="images/loading.gif"/>Loading...</div>
					</div>
					<div><label>TK có</label> <select id="tkcosua" name="tkcosua" class="js-tkco">
					<option value="">Chọn tài khoản</option>
						<?=$tkco?>
					</select>
					<div id="loadingtime1" style="display:none"><img src="images/loading.gif"/>Loading...</div>
					</div>
					<div><label>HĐBH</label> <input type="text"  id="hdbh" name="hdbh" class="ttf ttf_14" value="<?=$re["hdbh"]?>" <?=$show14?> /></div>
				</div>
				<div class="block_i">
					
					
					<div><label>Số TKNH</label> <input type="text" id="sotknh" name="sotknh" class="ttf ttf_15" onchange="goitenNH(this.value)" value="<?=$re["sotknh"]?>" <?=$show15?>/><div id="resgoitenh"></div></div>
					<div><label>Tên TKNH</label> <input type="text" class="ttf ttf_15" id="tentknh" name="tentknh" value="<?=$re["tentknh"]?>" disabled="disabled"/></div>
					<div><label>Mã vận đơn</label> <input type="text" class="ttf ttf_18" id="mavandon" name="mavandon" value="<?=$re["mavandon"]?>" <?=$show18?>/></div>
					<div><label>Đơn vị VC</label> <input type="text" id="dvvc" class="ttf ttf_17" name="dvvc" value="<?=$re["donvivc"]?>" <?=$show17?>/></div>
					<div><label>Phí thu KH</label> <input type="text" id="phithukh" class="ttf ttf_23" name="phithukh" value="<?=$re["phithukh"]?>" <?=$show23?>/></div>
				</div>
				<div class="block_i">
					
					
					<div><label>Nhà cung cấp</label> <select id="ncc" name="ncc" class="ttf ttf_19" class="js-tkno" <?=$show19?>>
					<option value="">Chọn nhà cung cấp</option>
						<?=$ncc?>
					</select></div>
					<div><label>Mã NV</label> <input type="text" id="manv" class="ttf ttf_21"  onchange="goitennv(this.value)" name="manv" value="<?=$re["manv"]?>" <?=$show21?>/>
						<div id="resgoitenv"></div>
					</div>
					<div><label>Tên nhân viên</label> <input type="text" class="ttf ttf_21"  id="tennv" name="tennv"  value="<?=gettfennv('userac',$re["manv"],"Ten")?>" disabled="disabled"/></div>
				</div>
				<div class="block_i">
				<div><label>Loại</label> 
					<select id="loaiphieu" name="loaiphieu" class="">
						<option value="">loại</option>
						<option value="1" <?php echo $re["loaiphieu"]==1?"selected='selected'":""; ?>>Thu</option>
						<option value="2" <?php echo $re["loaiphieu"]==2?"selected='selected'":""; ?>>Chi</option>
					</select>
				</div>
					<div><label>Diễn giải</label> <textarea id="diengiai" name="diengiai" style="
    height: 77px;"> <?=$re["diengiai"]?></textarea></div>
					
					
				</div>
			
				<div class="block_i">
					
					<div><label>Lý do Chỉnh sửa</label><span class="break_w">  <?php echo $re['lydoN']?$re['lydoN']:"";
							?></span></div>
				</div>
			
				<!--<div class="block_i" style="width:100%">
					
					<div><label class="ghichu">Ghi chú</label><span class="break_w"><?=$re['ghichu']?></span></div>
				</div>-->
				
				<?php 
					//$ql[5] =3;
				if($_SESSION["se_kho"]==$re["loaitk"] || $ql[5] || $_SESSION["LoginID"]==7576){
				?>
					 <div class="block_i  block_d">
					
						<div style="    display: flex;    justify-content: flex-start;
" class="btn_w">
							<buttfon class="btn btn2 btntrangthai" style="width:100px" onclick="luuchinhsua(<?php echo $re["idthuchikt"]?>)" <?=$thumuaht?>>Lưu</buttfon>
							<div id="resluusua"></div>
						</div>
					
					</div>	  
			
 	 	<?php
			}
				
		?>
<?php	 			

	}
?>	
	</div>
		</div>
	</div>

  <?php		
	
    $data->closedata() ;
	  function gettfennv($table,$ID,$cot)
{
   global $data ;
 	$sql = "select ID,$cot from $table where  MaNV='$ID' " ;
		
     $result = $data->query($sql) ;
 	$row = $data->fetch_array($result);	
	// echo  $sql ;			
		return $row[$cot] ;		
}	
?>	
