<?php
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"]["duyetdexuat"]]  ;  
  $idl=$_SESSION["LoginID"];
  $linkimg='https://image.fmstyle.com.vn/anhchamcong/anhsanpham/';
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
  $codepro   =$tmp[0];
		
$sql ="select * from products where codepro ='$codepro'";
$re = getdong($sql);

?>

<style>
#showanhtai  .col-50{
	margin-bottom:1em;
}
#showanhtai .img{
	width:20% ;
	
}
#showanhtai .img img{
	width:100%;
}
#showanhtai .choose{
	width:75%;
}
#showanhtaichinh{
	width:200px;
	margin-bottom:1em;
}

#showanhtaichinh .img{
	width:100%;
}
#showanhtaichinh .img img{
	width:100%;
}
@media all and (min-width: 1024px) {
#showanhtaichinh{
	width:100px;
}
}
</style>
  
        <div class="form" style="width:100%">
            <div class="block_i row"  style="width:100%">
                <div style="color:green" class="col-100" ><label>Tên sản phẩm</label><strong>: <?=$re['Name']?></strong></div>
                <!--<div><label>Ngày duyệt</label><strong>:</strong> </div>
                <div><label>Tên của hàng</label><strong>:</strong></div>-->
            </div>
           
			<form action="" method="post" style="width:100%;margin-top:1em">
			 <div class="block_i row" >
				<div class="col-50"><label class="ghichu">Ảnh chính:</label>
						<span class="break_w"><input type="file" name="anhchinh" id="anhchinh" onchange="showanhc(this)" accept="image/*"/></span>
						
				</div>
				<div class="col-50">
				<input type="hidden" id="anhchinhdaluu" value="<?=$re['images']?$re['images']:""?>" />
				<div id="showanhtaichinh">
				
					<?php if($re['images']){ ?>
				
							<div class="img" id="<?=$re['images']?>"><div class="xoachon"><button type="button" value="<?=$re['images']?>" onclick="xoachonanhchinh(event)">X</button></div><img src="<?php echo $linkimg; ?><?=$re['images']?>" /></div>
						<?php
						
						} ?>
				</div>
				</div>
            </div>
            <div class="block_i row" >
				<div class="col-50"><label class="ghichu">Chọn tệp:</label>
						<span class="break_w"><input type="file"   name="hinhs" id="hinhs" onchange="showchonmau(this)" accept="image/*"	 multiple/></span>
				</div>
            </div>
           
            <div class="block_i block_hinh row" style="flex-direction: column;">
				<div id="" class="row" >
                <label>Hình ảnh:</label>
				
				</div>
				<input type="hidden" id="hinhdaluu"   value='<?=$re['NameEN']?$re['NameEN']:""?>' />
				<div id="showanhtai" class="row" style="margin-top:1em;    flex-wrap: wrap;" >
				
								<?php
					if($re['NameEN']){
					
						$manghinh=json_decode($re['NameEN'],true);
						foreach($manghinh as $key => $value){?>
							<div class="block_i col-50" id="<?=$key?>">
								<div class="img">
									
									<div class="xoachon"><button type="button" value="<?=$key?>" onclick="xoachonanh(event,1)">X</button></div>
									<img src="<?php echo $linkimg; ?><?=$key?>" data-name="<?=$key?>" />
									
								</div>
								<div class="choose" style="padding:1em;display:none">
								<select id="mau" name="mau" class="js-mau" data-name="<?=$key?>" onchange="choosemau(event)">
								<option value="">Chọn màu</option>
									<option value="a" <?=$value=='a'?"selected":""?>>Màu a</option>
									<option value="b" <?=$value=='b'?"selected":""?>>Màu b</option>
									<option value="c" <?=$value=='c'?"selected":""?>>Màu c</option>
									<option value="d" <?=$value=='d'?"selected":""?>>Màu d</option>
									<option value="e" <?=$value=='e'?"selected":""?>>Màu e</option>
								</select></div>
							 </div>
						<?php }?>
						<!--<script>
							var hinhdaluu='';
						</script>-->
					<?php
					}	
				?>
					<!-- <div class="block_i col-50" >
					 	<div class="img">
							<img src="images/duyetmuasam/2512202135891_7203^789077_339741811.jpg" />
							
						</div>
						<div class="choose" style="padding:1em">
						<select id="mau" name="mau" class="js-mau">
						
							<option value="a">Màu a</option><option value="b">Màu b</option><option value="c">Màu c</option><option value="d">Màu d</option><option value="e">Màu e</option>
						</select></div>
					 </div>-->
				</div>
            </div>
          <div class="block_i row" >
		  		<button type="button" class="btn btn-warning" style="width:200px" onclick="luuanh(<?=$re['ID']?>)">Lưu</button>
		  <div id="resluu"></div>
		  </div>
 		</form>