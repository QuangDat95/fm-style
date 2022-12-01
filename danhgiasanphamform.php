<?php
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"]["duyetdexuat"]]  ;  
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
if(isset($_POST['DATA'])){
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
  $codepro   =$tmp[0];
		
$sql ="select * from products where codepro ='$codepro'";
$re = getdong($sql);
$idnv=$_SESSION["LoginID"];
$idch=$_SESSION["se_kho"];
?>

<style>
#showanh  .col-50{
	margin-bottom:1em;
}
#showanh .img{
	width:20% ;
	
}
#showanh .img img{
	width:100%;
}
#showanh .choose{
	width:75%;
}
#showanhchinh{
	width:200px;
}
@media all and (min-width: 1024px) {
#showanhchinh{
	width:100px;
}
}
#showanhchinh .img{
	width:100%;
}
#showanhchinh .img img{
	width:100%;
}
</style>
  
        <div class="form" style="width:100%">
	
            <div class="block_i row"  style="width:100%">
                <div  class="col-50" ><label style="color:green;width:20%">Tên sản phẩm</label><strong>: <?=$re['Name']?></strong></div>
                <div class="col-50"><label style="color:green;width:20%" >Giá</label><strong>:</strong> <?=number_format($re['price'])?></div>
                <!--<div><label style="color:green">Chất liệu: </label><strong>:</strong></div>-->
            </div>
           
			<form action="" method="post" style="width:100%;margin-top:1em">
			 <div class="block_i row block_wr" >
				<div class="col-50" style="flex-direction: column;"><label class="ghichu" >Ảnh chính:</label>
					<div id="showanhchinh">
				
					<?php if($re['images']){ ?>
				
							<div class="img"><img src="images/products/<?=$re['images']?>" /></div>
						<?php
						
						} ?>
					</div>
				</div>
				<div class="col-50">
					<div id="" class="row" style="flex-direction: column;" >
               			 <label>Hình ảnh:</label>
				
					
				
					<div id="showanh" class="row" style="    flex-wrap: wrap;" >
				
								<?php
					if($re['NameEN']){
					
						$manghinh=json_decode($re['NameEN'],true);
						foreach($manghinh as $key => $value){?>
							
								<div class="img" style="margin-left:0.5em">
									
									<img src="images/products/<?=$key?>" data-name="<?=$key?>" />
									<span><?=$value?"Màu: ".$value:""?></span>
								</div>
								
						<?php }?>
						<!--<script>
							var hinhdaluu='';
						</script>-->
					<?php
					}	
				?>
					</div>
					</div>
				
				</div>
            </div>
           <!-- <div class="block_i row" >
				<div class="col-50"><label class="ghichu">Chọn tệp:</label>
						<span class="break_w"><input type="file" name="hinhs" id="hinhs" onchange="showchonmau(this)" multiple/></span>
				</div>
            </div>-->
           
            <div class="block_i row" style="flex-direction: column;">
				 <div  class="col-50" ><label style="color:green">Đánh giá chất liệu</label><strong style="color:green">: <input type="number" name="diemcl" id="diemcl" /></strong>
				 </div>
				 <div  class="col-50" ><label style="color:green">Đánh giá màu sắc</label><strong style="color:green">: <input type="number" name="diemmau" id="diemmau" /></strong>
				 </div>
            </div>
			 <div class="block_i row" style="flex-direction: column;">
				 <div  class="col-50" ><label style="color:green">Ghi chú</label><strong style="color:green">:</strong>
				 </div>
				 <div  class="col-50" >
				 	<textarea name="ghichu" id="ghichu" style="width:100%;min-height:200px"></textarea>
				 </div>
            </div>
          <div class="block_i row" >
		  		<button type="button" class="btn btn-warning" onclick="luuanh(<?=$re['ID']?>)">Lưu</button>
		  
		  </div>
 		</form>
<?php	
return;	
}



if(isset($_POST['DATAGOC'])){
  $data1 = $_POST['DATAGOC']; 
  $tmp = explode('*@!',$data1);
  $codepro   =$tmp[0];
		
$sql ="select * from products where code='$codepro'";
 
$query = $data->query($sql);
$idnv=$_SESSION["LoginID"];
$idch=$_SESSION["se_kho"];
?>

<style>
#showanh  .col-50{
	margin-bottom:1em;
}
#showanh .img{
	width:20% ;
	
}
#showanh .img img{
	width:100%;
}
#showanh .choose{
	width:75%;
}
#showanhchinh{
	width:200px;
}
@media all and (min-width: 1024px) {
#showanhchinh{
	width:100px;
}
}
#showanhchinh .img{
	width:100%;
}
#showanhchinh .img img{
	width:100%;
}
</style>
  
        <div class="form" style="width:100%">
		<form action="" method="post" style="width:100%;margin-top:1em">
			<?php while($re=$data->fetch_array($query)){
			
			?>
			
            <div class="block_i row"  style="width:100%">
                <div  class="col-50" ><label style="color:green;width:30%">Tên sản phẩm</label><strong>: <?=$re['Name']?></strong></div>
                <div class="col-50"><label style="color:green;width:20%" >Giá</label><strong>:</strong> <?=number_format($re['price'])?></div>
                <!--<div><label style="color:green">Chất liệu: </label><strong>:</strong></div>-->
            </div>
           
			
			 <div class="block_i row block_wr" >
				<div class="col-50" style="flex-direction: column;"><label class="ghichu" >Ảnh chính:</label>
					<div id="showanhchinh">
				
					<?php if($re['images']){ ?>
				
							<div class="img"><img src="images/products/<?=$re['images']?>" /></div>
						<?php
						
						} ?>
					</div>
				</div>
				<div class="col-50">
					<div id="" class="row" style="flex-direction: column;" >
               			 <label>Hình ảnh:</label>
				
					
				
					<div id="showanh" class="row" style="    flex-wrap: wrap;" >
				
								<?php
					if($re['NameEN']){
					
						$manghinh=json_decode($re['NameEN'],true);
						foreach($manghinh as $key => $value){?>
							
								<div class="img" style="margin-left:0.5em">
									
									<img src="images/products/<?=$key?>" data-name="<?=$key?>" />
									<span><?=$value?"Màu: ".$value:""?></span>
								</div>
								
						<?php }?>
						<!--<script>
							var hinhdaluu='';
						</script>-->
					<?php
					}	
				?>
					</div>
					</div>
				
				</div>
            </div>
           <!-- <div class="block_i row" >
				<div class="col-50"><label class="ghichu">Chọn tệp:</label>
						<span class="break_w"><input type="file" name="hinhs" id="hinhs" onchange="showchonmau(this)" multiple/></span>
				</div>
            </div>-->
           <?php
			} ?>
            <div class="block_i row" style="flex-direction: column;">
				 <div  class="col-50" ><label style="color:green">Đánh giá chất liệu</label><strong style="color:green">: <input type="number" name="diemcl" id="diemcl" /></strong>
				 </div>
				 <div  class="col-50" ><label style="color:green">Đánh giá màu sắc</label><strong style="color:green">: <input type="number" name="diemmau" id="diemmau" /></strong>
				 </div>
            </div>
			 <div class="block_i row" style="flex-direction: column;">
				 <div  class="col-50" ><label style="color:green">Ghi chú</label><strong style="color:green">:</strong>
				 </div>
				 <div  class="col-50" >
				 	<textarea name="ghichu" id="ghichu" style="width:100%;min-height:200px"></textarea>
				 </div>
            </div>
		
          <div class="block_i row" >
		  		<button type="button" class="btn btn-warning" style="width:100px" onclick="luuanhgoc('<?=$codepro?>')">Lưu</button>
		  
		  </div>
 		</form>
<?php	
return;	
}

?>