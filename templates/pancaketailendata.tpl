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

<div id="poup_sua_du_lieu" style="">
<div class="form"><div id="closepop"><button  onclick="closePoup()">x</button></div>
<form>

<div>
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
	
		<label>Ngày sinh:</label>
		<input type="text" name="ngaysinh" id="ngaysinh" />
		
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
   </legend><div    > 
 

  
 
<form name="frmProduct2" id="frmProduct2" method="post" >

<fieldset  class="nencon" id="khachhang" >
	<legend>   <h3>
	  <input type="button" name="tm" style="width:100px;display:{q_themp}"    value="Nhập từ Excel" onclick="nhapexcel1()" />
	</h3>
</fieldset>
</form>
 
 

<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>
 
 <div   id="timexxcel" style="padding:10px">
 <div style="display: flex;
    flex-direction: row;    align-items: center;
    justify-content: center;padding-bottom:1em;">
	<a href="data/maupancake.xlsx" style="margin-right:1em">File mẫu pancke</a>
<a href="data/mauthuongmaidientu.xlsx">File mẫu thương mại điện tử</a>
</div>
 <div>
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="" />
    <label>File khách hàng Excel *.xlsx</label>
<input id="fileToUpload" type="file" accept=".xlsx"   size="35" name="fileToUpload" class="input" style="height:22px" />


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
    min-height: 120px;
    padding: 0.5em 1em;
    justify-content: space-between;
  
    margin-right: 1em;
	}
</style>
<div style="    margin: 0.5em;display: flex;
    justify-content: center;">
	<div class="chiao " style="  border: 1px solid red;">
		<p style="color:#FF0000;font-weight:bold">Tải lên Pancake</p>
		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('orders',1);" style="height:22px" >Tải lên pancake</button>
		 <button class="button" id="buttonUploadmoi" onclick="return hienthidulieumoi();" style="height:22px">Hiển thị</button> 
	</div>

	<div class="chiao" style="  border: 1px solid green;">
	
	<p style="color:green;font-weight:bold">Tải lên thương mại điện tử</p>
		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('tmdt',4);" style="height:22px;display:none">Tải lên Lazada</button>
		<div style="display:flex;justify-content: space-between;"><button class="button" id="buttonUpload" onclick="return ajaxFileUpload('tmdt',3);" style="height:22px;width:45%;">Tải lên shoppe</button> <button class="button" id="buttonUpload" onclick="return ajaxFileUpload('shoppe2',5);" style="height:22px;width:45%;background-color:#009933">Tải lên shoppe 2</button></div>
		  <button class="button" id="buttonUploadmoi" onclick="return hienthidulieumoitmdt();" style="height:22px">Hiển thị</button> 
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
<script type="text/javascript" src="templates/ajaxfileupload.js"></script>
<script>
var checksp=0;
function setData(loai=1){

if(loai==3){
	setDatatmdt();
	return;
}
	document.getElementById("reskhonghienthi").style.display="flex";
	var tenkh=$("#tenkh").val();
	var voucher=$("#voucher").val();
	var manv=$("#manv").val();
	var cuahang=$("#cuahang").val();
	var id=$("#ids").val();
	var giamgia=$("#giamgia").val();
	var sp=$("#sp").val();
	var sl=$("#sl").val();
	var ns=$("#ngaysinh").val();
	var tiengiam=$("#tiengiam").val();
	var tam=tenkh.trim()+"-"+voucher.trim()+"-"+manv.trim()+"-"+cuahang.trim()+"-"+ns.trim();
	updateData(id,tam,giamgia,sp,sl,tiengiam,checksp);
	
}

function showPoupSua(id,str,giamgia,texterror,sp,sl,tiengiamhople,check,loai=1){
$("#btn_sua_dulieu").val(loai);
	
checksp=check;

	var arrtam=str.split("-");
	var arrerr=texterror.split("|*|");
	console.log(arrerr);
	$("#voucher_err").html(inarray(1,arrerr)?"Voucher không hợp lệ":"");
	$("#manv_err").html(inarray(2,arrerr)?"Mã nhân viên không tồn tại":"");
	$("#cuahang_err").html(inarray(3,arrerr)?"Cửa hàng không tồn tại":"");
	$("#sp_err").html(inarray(4,arrerr)?"Sản phẩm không tồn tại":"");
	$("#sl_err").html(inarray(5,arrerr)?"Số lượng phải lớn hơn 0":"");
	$("#sl_err").html(inarray(8,arrerr)?"Số lượng không hợp lệ":"");
	$("#tiengiam_err").html(inarray(6,arrerr)?"Chú ý: Số tiền giảm giá không hợp lệ":"");
	
	$("#chuoigoc").html(str);
	
	if(inarray(6,arrerr) || inarray(1,arrerr)){
		$("#vouchergoc").html('voucher: ' +arrtam[1]+'='+tiengiamhople);
	}
	$("#tenkh").val(arrtam[0]);
	$("#voucher").val(arrtam[1]);
	$("#manv").val(arrtam[2]);
	$("#cuahang").val(arrtam[3]);
	$("#ngaysinh").val(arrtam[4]);
	$("#sp").val(sp);
	$("#sl").val(sl);
	$("#tiengiam").val(giamgia);
	$("#giamgia").val(giamgia);
	$("#ids").val(id);
	
	$("#poup_sua_du_lieu").css("display","flex");
	
}


function setDatatmdt(){
	document.getElementById("reskhonghienthi").style.display="flex";
	
	var id=$("#ids").val();
	var sp=$("#sp").val();
	var sl=$("#sl").val();
	var ch=$("#cuahang").val();
var ns=$("#ngaysinh").val();

	//var tam=tenkh.trim()+"-"+voucher.trim()+"-"+manv.trim()+"-"+cuahang.trim();
	updateDatatmdt(id,sp,sl,checksp,ch,ns);
	
}
/*
function showPoupSuaShopee(id,str,giamgia,texterror,sp,sl,tiengiamhople,check){
checksp=check;
	var arrtam=str.split("-");
	var arrerr=texterror.split("|*|");
	console.log(arrerr);
	$("#voucher_err").html(inarray(1,arrerr)?"Voucher không hợp lệ":"");
	$("#manv_err").html(inarray(2,arrerr)?"Mã nhân viên không tồn tại":"");
	$("#cuahang_err").html(inarray(3,arrerr)?"Cửa hàng không tồn tại":"");
	$("#sp_err").html(inarray(4,arrerr)?"Sản phẩm không tồn tại":"");
	$("#sl_err").html(inarray(5,arrerr)?"Số lượng phải lớn hơn 0":"");
	$("#tiengiam_err").html(inarray(6,arrerr)?"Chú ý: Số tiền giảm giá không hợp lệ":"");
	$("#chuoigoc").html(str);
	
	if(inarray(6,arrerr) || inarray(1,arrerr)){
		$("#vouchergoc").html('voucher: ' +arrtam[1]+'='+tiengiamhople);
	}
	$("#tenkh").val(arrtam[0]);
	$("#voucher").val(arrtam[1]);
	$("#manv").val(arrtam[2]);
	$("#cuahang").val(arrtam[3]);
	
	$("#chuoispshopee").val(sp);
	$("#sp").val(tachlaymasp(sp));
	$("#sl").val(sl);
	$("#tiengiam").val(giamgia);
	$("#giamgia").val(giamgia);
	$("#ids").val(id);
	
	$("#poup_sua_du_lieu").css("display","flex");
	
}*/
function tachlaymasp(chuoi){
	var result ='';
	var arrtam=chuoi.split(' ');
	result =arrtam[arrtam.length-1];
	return result;
}
function inarray(value,arr){
	var result='';
	for(var i=0;i<=arr.length;i++){
		var el=arr[i];
		if(el==value){
			result=i;
		}
	}
	return result;
}

function updateDatatmdt(id,sp,sl,checksp,ch){

	var poststr = "UPDATE=" + encodeURIComponent(id) +"*@!" + encodeURIComponent(sp)+"*@!" + encodeURIComponent(sl)+"*@!"+encodeURIComponent(checksp)+"*@!"+encodeURIComponent(ch);
	loadtrang('reskhonghienthi', "shoppetailendatahienthi", poststr, "xuly1");
}

function updateDatalazada(id,sp,sl,tiengiam,checksp){
	var poststr = "UPDATE=" + encodeURIComponent(id) +"*@!" + encodeURIComponent(sp)+"*@!" + encodeURIComponent(sl)+"*@!"+encodeURIComponent(checksp);
	loadtrang('reskhonghienthi', "lazadatailendatahienthi", poststr, "xuly1");
}

function updateData(id,str,giamgia,sp,sl,tiengiam,checksp){
	var poststr = "UPDATE=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(str)+ "*@!" + encodeURIComponent(giamgia)+"*@!" + encodeURIComponent(sp)+"*@!" + encodeURIComponent(sl)+"*@!" + encodeURIComponent(tiengiam)+"*@!" + encodeURIComponent(checksp);
	loadtrang('reskhonghienthi', "pancaketailendatahienthi", poststr, "xuly1");
}

function xuly1(){
	var tam=document.getElementById("reskhonghienthi").innerHTML;
	if(tam){
	
		if(tam==-1){
			alert("Nhân viên không tồn tại!");
			
		}
		else if(tam==-2){
			alert("Của hàng không tồn tại!");
			
		}
		else  if(tam==-3){
			alert("Mã giảm giá không hợp lệ!");
			
		}
		else  if(tam==-4){
			alert("Sản phẩm không hợp lệ!");
			
		}
		else  if(tam==-5){
			alert("Số lượng phải lớn hơn 0!");
			
		}
		else  if(tam==-6){
			alert("Số tiền giảm giá không hợp lệ!");
			
		}
		else  if(tam==-7){
			alert("Có lỗi xảy ra!");
			
		}
		else  if(tam==-8){
			alert("Số lượng không hợp lệ!");
			
		}
		else {
			var arr=tam.split('*');
			
			document.getElementById(arr[0]).style.color='green';
			document.getElementById(arr[0]).removeAttribute("onclick");
			if(arr[1]==0 && arr[2]==0){
			
				document.getElementById('btnlaydulieu_w').innerHTML='<input type="button" id="dulieue" name="dulieue"  onclick="laydulieuexel()" value="Lấy dữ liệu Excel"/>';
			}
			else if(arr[1]==0 && arr[2]!=0){
			document.getElementById('btnlaydulieu_w').innerHTML='<input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi(\'Vui lòng xác nhận voucher! Dòng màu xanh dương\')" value="Lấy dữ liệu Excel"/>';
			}
			
		//document.getElementById(tam).style.color="green";
			//document.getElementById("hienthiexcel").innerHTML=tam;
			$("#poup_sua_du_lieu").css("display","none");
		}
		document.getElementById("reskhonghienthi").style.display="none";
		
	}
}


function closePoup(){
	$("#poup_sua_du_lieu").css("display","none");

}
function xuatbaoloi(str)
{
	alert(str);
}
</script>
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
			  /*+ tt + '_'+ nn*/
			{
				url:'pancakefileuploaddata.php?us='+tenfile,
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
								
								if(loai==1)
								{
									
									 hienthidulieu();
								}
								
								if(loai==3)
								{
									 tmdthienthidulieu();
								}
								if(loai==4)
								{
									 lazadahienthidulieu();
								}
								if(loai==5)
								{
									 shoppe2hienthidulieu();
								}
								 
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


function thongbaoloisua(chuoi){
	if(chuoi){
		alert(chuoi);
	}
}	

function laydulieuexeltmdt(){
	var poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('resupdate', "shoppecheckdata", poststr, "xuly2");

}

function laydulieuexellazada(){
	var poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('resupdate', "lazadacheckdata", poststr, "xuly2");

}

function laydulieuexel(){
	var poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('resupdate', "pancakecheckdata", poststr, "xuly2");

}
function laydulieushoppe2(){
	var poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('resupdate', "shoppecheckdata2", poststr, "xuly2");

}
function xuly2(){
	var tam=document.getElementByID("resupdate").innerHTML;

	
}


/*function laydulieue()
{ 
 	  document.getElementById("tbht").innerHTML=document.getElementById("tbex").innerHTML;
	   goidongid('hiennhapexcel') ;
	  return;
	 var table = document.getElementById("tbex"); 
	 var totalRows = document.getElementById("tbex").rows.length;
 	var totalCol = 5; // enter the number of columns in the table minus 1 (first column is 0 not 1)
	 
	for (var x = 1; x <= totalRows; x++)
	  {
 	 
		  addpro(table.rows[x].cells[1].innerHTML,table.rows[x].cells[3].innerHTML,
		        table.rows[x].cells[2].innerHTML ,table.rows[x].cells[5].innerHTML,
				 table.rows[x].cells[6].innerHTML,table.rows[x].cells[4].innerHTML,0,table.rows[x].cells[7].innerHTML) ;
				
	  }
//To display a single cell value enter in the row number and column number under rows and cells below:
    goidongid('hiennhapexcel') ;
}*/	
function hienthidulieu()
{ 	
	
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel','pancaketailendatahienthi', poststr,"") ;		
 
}
function tmdthienthidulieu()
{ 
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel', "shoppetailendatahienthi", poststr,"") ;		
 
}
function lazadahienthidulieu()
{ 
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel', "lazadatailendatahienthi", poststr,"") ;		
 
}

function shoppe2hienthidulieu()
{ 
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel', "shoppe2tailendatahienthi", poststr,"") ;		
 
}

function hienthidulieumoi(){
 var t1 ;
 
 
	var poststr = "SHOW=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('hienthiexcel', "pancaketailendatahienthi", poststr, "");

} 

function hienthidulieumoitmdt(){
 var t1 ;
 
 
	var poststr = "SHOW=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('hienthiexcel', "shoppetailendatahienthi", poststr, "");

}
function hienthidulieumoilazada(){
 var t1 ;
 
 
	var poststr = "SHOW=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('hienthiexcel', "lazadatailendatahienthi", poststr, "");

}
</script>
 
</div></fieldset></div>