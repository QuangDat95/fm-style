<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--popup sưa du lieu -->
<style>
#poup_sua_du_lieu{
	  position: fixed;
    /* background-color: #ffffff; */
    width: 100%;
    height: 100vh;
    display: none;
	left:0;
	top:0;
    justify-content: center;
    align-items: center;
	z-index:10000;
}
#poup_sua_du_lieu .form{
	
	background-color: #ffffff;
    width: 39%;
    height: 300px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
	border:1px solid;
}
#poup_sua_du_lieu .form #closepop{
	    display: flex;
    justify-content: flex-end;
    width: 90%;
	
}
#poup_sua_du_lieu .form form{
    display: flex;
    width: 90%;
    height: 90%;
}
#poup_sua_du_lieu form >div{
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: space-around;
    flex-direction: column;
}
#poup_sua_du_lieu .form label{
	width:30%;
}
.tbchuan th, .tbchuan td{
    white-space: nowrap;
}
</style>
<!-- BEGIN: block_tudong -->
<div id="poup_sua_du_lieu" style="">
<div class="form"><div id="closepop"><button  onclick="closePoup()">x</button></div>
<form>


	<div>
	<div id="reskhonghienthi"></div>
		<label id="chuoigoc" style="width:100%;color:red"></label>
		<label id="vouchergoc" style="width:100%;color:green"></label>
	</div>
	<div>
	
		<label>Tên khách hàng:</label>
		<input type="text" name="tenkh" id="tenkh" />
		
	</div>
	<div>
		<label>Mã voucher:</label>
		<input type="text" name="voucher" id="voucher" />
		<span id="voucher_err"  style="color:red"></span>
	</div>
	<div>
		<label>Tiền giảm giá:</label>
		<input type="text" name="tiengiam" id="tiengiam" />
		<span id="tiengiam_err" style="color:#eb8316"></span>
	</div>
	<div>
		<label>Mã nhân viên:</label>
		<input type="text" name="manv" id="manv" />
		<span id="manv_err" style="color:red"></span>
	</div>
	
	<div>
		<label>cửa hàng / Team:</label>
		<input type="text" name="cuahang" id="cuahang" />
		<span id="cuahang_err" style="color:red"></span>
	</div>
	<div>
		<label>Mã sản phẩm:</label>
		<input type="text" name="sp" id="sp" />
		<span id="sp_err" style="color:red"></span>
	</div>
	<div>
		<label>Số lượng:</label>
		<input type="text" name="sl" id="sl" />
		<span id="sl_err" style="color:red"></span>
	</div>
	<input type="hidden" name="ids" id="ids" />
	<input type="hidden" name="chuoispshopee" id="chuoispshopee" />
	<input type="hidden" name="giamgia" id="giamgia" />
	<div>
		
		<button type="button" name="" id="btn_sua_dulieu" onclick="setData(this.value)">Lưu</button>
	</div>
</form>
</div>
</div>

</div>




<div class="top_space"></div>
<div class="nenbao">
<div style="padding:1px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;" >Tải lên data</label></a>
   </legend>
   
   <div>
   <!-- BEGIN: block_chinhngayquahan -->
<div>
	<form name="ngayquahanform" id="ngayquahanform" method="post" >
	<strong>Cho phép tải lên quá hạn</strong><strong> ngày</strong> 
	<select  id="ngayquahan" name="ngayquahan" value="{ngayquahanchophep}" style="width:80px" class="js-ngay">
		{ngaytrongthang}
	</select>

	<strong>Cửa hàng</strong><select onkeypress="return chuyentiep(event,'idnhan')" name="cuahang" class="js-cuahang" id="cuahang"  style="width:200px" title="Cửa hàng" onchange="getvalueselect2(event)">
   <option value="" ></option>
   {kho}
</select>
	<strong> Thời gian từ:</strong> <input type="datetime-local" name="loadtu"  value="{loadtu}"/>
	<strong> đến: </strong> <input type="datetime-local" name="loadden" value="{loadden}" />
	<input type="hidden" id="cuahangchuoi" name="cuahangchuoi"/>
<input type="submit" name="UpdateNQH" id="UpdateNQH" value="Lưu" />
</div>
  </form>
  
  
  	<!-- BEGIN:block_chinhngayquahanluu -->
		<script>
		
		alert("ĐÃ LƯU");
		window.location="default.php?act=thuchiketoantudong";
		</script>
	 <!-- END: block_chinhngayquahanluu -->
	 <!-- BEGIN:block_chinhngayquahanluufail -->
		<script>
		
		alert("KHÔNG THỂ LƯU");
		//thuchiketoantudong
		window.location="default.php?act=thuchiketoantudong";
		</script>
	 <!-- END: block_chinhngayquahanluufail -->
	 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
		 <script>
		   
		 $(document).ready(function() {
				 $('.js-ngay').select2({
						
						  placeholder: "ngày",
						  
					});
			  
				 $('.js-cuahang').select2({
						 multiple: true,
						  placeholder: "Cửa hàng",
						  
					});
					var mangch='{cuahangchophep}';
				mangch=mangch.split(",");
			console.log(mangch);
			
			console.log("ok");
				$('.js-cuahang').val(mangch);
				$('.js-cuahang').trigger("change");
		  });
			
				
				
	 function getvalueselect2(e){
  		var target =$(e.target).select2('val');
		var ch='';
		if(target){
				for(var i=0;i<target.length;i++){
					if(target[i]){
						if(ch){
							ch+=","+target[i];
						}
						else{
								ch+=target[i];
						}
					}
				}
			} 
			
			$("#cuahangchuoi").val(ch);
		//	console.log(ch);
	  }

			
		</script>
  <!-- END: block_chinhngayquahan -->
<form name="frmProduct2" id="frmProduct2" method="post" >

<fieldset  class="nencon" id="khachhang" >
	<legend>   <h3>
	  <input type="button" name="tm" style="width:100px;display:{q_themp}"    value="Nhập từ Excel" onclick="nhapexcel1()" />
	</h3>
</fieldset>
</form>

<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:100%; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>
 
 <div   id="timexxcel" style="padding:10px">
 <div style="display: flex;
    flex-direction: row;    align-items: center;
    justify-content: center;padding-bottom:1em;">
	<!--<a href="data/maupancake.xlsx" style="margin-right:1em">File mẫu pancke</a>
<a href="data/mauthuongmaidientu.xlsx">File mẫu thương mại điện tử</a>-->
</div>
 <div>
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="" />
    <label>File khách hàng Excel *.xlsx</label>
<input id="fileToUpload" type="file" accept=".xlsx"   size="35" name="fileToUpload" class="input" style="height:22px" />
<div><label style="color:#000066">Từ dòng:</label><input type="number" id="tudong" name="tudong" value="12"/>
<label style="color:#000066">Đến dòng:</label><input type="number" id="dendong" name="dendong"/></div>

</div>
<style>
   .chiao{     display: flex;
    flex-direction: column;
    width: 40%;
    min-height: 120px;
    padding: 0 1em;
    justify-content: space-between;
	    display: flex;
    flex-direction: column;
    width: 40%;
    min-height: 60px;
    padding: 0.5em 1em;
    justify-content: space-between;
  
    margin-right: 1em;
	}
</style>
<div style="    margin: 0.5em;display: flex;
    justify-content: center;">
	<div class="chiao " style="  border: 1px solid red;">
		<p style="color:#FF0000;font-weight:bold">Tải lên phiếu thu chi</p>
		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('thuchi',1);" style="height:22px">Tải lên</button>
		<!-- <button class="button" id="buttonUploadmoi" onclick="return hienthidulieumoi();" style="height:22px">Hiển thị</button> -->
	</div>

	
</div>

<div id="resupdate"></div>
 <div id="hienthiexcel" style="padding:5px">
 
 <table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
       
		  <td width="75" align="center" class="cothienthi" ><strong>Mã Thành Viên</strong></td>  
 		  <td width="360" align="center" class="cothienthi"><strong>Tên</strong> </td> 
          <td width="39" align="center" class="cothienthi"><strong>Điện thoại</strong></td>
          <td width="40" align="center" class="cothienthi"><strong>Ngày Sinh</strong> </td> 
 		  
		    
 		</tr>
        	<tr bgcolor="" style="color:#000">
		  <td align="center" class="cothienthi" height="23" width="32">5</td>
       
		  <td width="75" align="center" class="cothienthi" >2805210001</td>  
 		  <td width="360" align="center" class="cothienthi">Nguyễn Văn A</td> 
          <td width="39" align="center" class="cothienthi">0987654321</td> 
		  <td width="40" align="center" class="cothienthi">01/01/2000</td>
       
		    
		    
 		</tr>
        </table>
 
 
 </div> 
 
</div>
</div>
</div>
 
 
  
<div id="khonghienthiapp"></div>
<!-- END: block_tudong -->

<script type="text/javascript" src="templates/ajaxfileupload.js"></script>

<script language="JavaScript">


function goidongthe()
{
	 document.getElementById("hiethithongbao").style.display = 'none' ;
}

function timkiemkh(t1,t2,t3,t4,t5,t6,t7,t8,t9)
{ 	
     poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
     poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8)+ "*@!"+ encodeURIComponent(t9);
	 if(t6!=2)
	 {    
 		 loadtrang('hienthinhacc', "naptienapptim", poststr,"") ; 
	 } else
	 {
		 loadtrang('hienthinhacc', "naptienapptim", poststr,"") ; 
	 }
	//alert('Luu xong !!!');
} 


function xuatkq()
{
	 
	 document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>'+ document.getElementById("hienthinhacc").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
}
  	
function nhapexcel1()
{
    if (document.getElementById('hiennhapexcel').style.display =="")
	{
		document.getElementById('hiennhapexcel').style.display = "none";
		//document.getElementById('timkhachhanght').style.display = '' ;	
		//document.getElementById('timphieuxuat').style.display = 'none' ;	
 	} else
	{
		document.getElementById('hiennhapexcel').style.display = "";
		//document.getElementById('timkhachhanght').style.display = 'none' ;	
		//document.getElementById('timphieuxuat').style.display = '' ;	
	}

	
} 
function ajaxFileUpload(tenfile,loai)
{

	var  tt = id_user;
	
 	//$("#buttonUpload").val(loai);
	var  nn =   new Date().getTime(); ;
   		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});
		$.ajaxFileUpload
		(
			{
				url:'thuchifileuploaddata.php?us='+tenfile,
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				success: function (data, status)
				{
					
					
					
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
							{							
								alert(data.error);	
								return false ;
							}else
							{					
								 kq =data.msg ;
								 mkq = kq.split('*') ;
								
								 hienthidulieu();
								 
							}
						
					}
				},
				error: function (data, status, e)
				{		
					if ( data.e == 'vuotdungluong' )
					{
						alert("Vượt dung lượng cho phép 8M !!!");				 
					}
				}
			}
		)
		
		return false;

	}



function laydulieuexel(){
	document.getElementById("dulieue").disabled=true;
	var tudong=document.getElementById("tudong").value;
var dendong=document.getElementById("dendong").value;
	var poststr = "DATA=" + encodeURIComponent(tudong) + "*@!" + encodeURIComponent(dendong);
	loadtrang('resupdate', "thuchicheckdata", poststr, "xuly2");

}

function xuly2(){
var tam=document.getElementByID("resupdate").innerHTML;
document.getElementById("dulieue").disabled=false;
	if(tam){
	
		alert(tam);
		
	}
}

function hienthidulieu()
{ 	
var tudong=document.getElementById("tudong").value;
var dendong=document.getElementById("dendong").value;
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(tudong)+ "*@!"+ encodeURIComponent(dendong)+ "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel','thuchitailendatahienthi', poststr,"") ;		
 
}
function xuatbaoloi(str){
	alert(str);
}

</script>
 
</div></fieldset></div>