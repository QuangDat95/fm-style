<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
<div class="top_space"></div>
<div class="nenbao">
<div style="padding:1px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;" >Lương Tháng Báo Cáo</label></a>
   </legend><div    > 
 

 <form name="frmthuchich" method="post">
   <div style="padding-bottom:5px;padding-top:5px;">
<span style="padding-bottom:5px">
<select onkeypress="return chuyentieps(event,'nhomtk')" name="thang"  id="thang"  style="width:80px" >
   <option value="0" >- Tháng -</option>
  <!-- BEGIN: block_thang -->
				  <option value="{thangt}"  {thangse}>Tháng {thangt}</option>
      <!-- END: block_thang -->
</select>
&nbsp;  <select id="nam" name="nam" >
                <!-- BEGIN: block_nam -->
				  <option value="{namt}"{namse} >Năm {namt}</option> <!-- END: block_nam -->
                  <option value="0" >ALL</option>
			  </select>
</span>

  Mã NV
   <input type="text" title="Click đôi để xoá trắng" name="manv" id="manv"  class="text" size="5" value=""  onkeypress="return chuyentiep(event,'loaitk')" ondblclick="xoatrang(this)"/>
   
   Tên NV
   <input type="text" title="Click đôi để xoá trắng" name="tennv" id="tennv"  class="text" size="8" value=""  onkeypress="return chuyentiep(event,'loaitk')" ondblclick="xoatrang(this)"/>
   
   <select id="cuahang" name="cuahang" style="width:176px;height:20px" class="js-ch"   >
      <option value="0" >Cửa Hàng</option>
      {cuahang}
   </select>
    <select id="chucvu" name="chucvu" style="width:140px">
      <option value="0" >Chức vụ</option>
      {chucvu}
   </select>
   <select id="tinhtrang" name="tinhtrang" style="width:91px">
      <option value="" >Tình trạng</option>
      <option value="0" >Chưa nhận</option>
      <option value="1" >Đã nhận</option>
   </select>
   
<input type="button"   style="width:50px"  onclick="timphieu(thang.value,nam.value,tennv.value,manv.value,cuahang.value,chucvu.value,0,0,tinhtrang.value)"  name="search2"  id="search2" value="Tìm" />
<input type="button" name="tm" style="width:100px;display:{q_themp}"    value="Nhập từ Excel" onclick="nhapexcel1()" />
<input type="button" style="font-size: 12px; width: 50px;" id="xuat" value="Excel" name="xuat" onclick="xuatkq()" />
	    </div>
	  <div id="hienthitim" style="overflow:scroll;width:1070px;height:450px" align="center"   >
				  
	    
			 
	  </div>
	
</form>
  

<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="thuchichbaocao.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>




<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 50px;left:0;width:100%; " align="center" >
  <div  style=" width:1040px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>
 
 <div   id="timexxcel" style="padding:10px">
 
 
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="" />
    <label>File tính lương Excel *.xlsx</label>
<input id="fileToUpload" type="file" accept=".xlsx"   size="35" name="fileToUpload" class="input" style="height:22px" />
<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('tinhluong',1)" style="height:22px">Tải lên</button>&nbsp;  

 <div id="hienthiexcel" style="padding:5px">
 <table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
     <td width="154">Tên NV</td>
    <td width="61">Mã NV</td>
    <td width="76">Ngày <br />
      vào làm</td>
    <td width="62">Chức danh</td>
 		  
		    
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



  
</div></fieldset></div>
<div id="ketqualuu" style="display:"></div>
</div>

 

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<script type="text/javascript" src="templates/ajaxfileupload.js"></script>

<link rel="stylesheet" media="screen" href="js/select2.min.css">
   <script language="javascript">
   	$(document).ready(function() {
	   
	   $('.js-ch').select2();
	});

function xuatkq()
{
	 
	 document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>'+ document.getElementById("hienthitim").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
}
var mangsp = new Array() ;
var mangsp1 = new Array() ;
var mangtam = new Array() ;

var x ,h0,h1,h2,h3,h4,h5;
 
 function sapxep(t0)
{   
    poststr="SX="+   t0 ;
    loadtrang('hienthitim', "thuchichbaocaotim", poststr,"") ;
}
function xuatexcel()
{
	var st ;
	st = "thuchichexcel.php?h0=" + h0 + '&h1=' + h1+ '&h2=' + h2+ '&h3=' + h3+ '&h4=' + h4+ '&h5=' + encodeURIComponent(h5) ;
 	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;

}
function xuatexcelquy()
{
	var st ;
	st = "thuchichexcelquy.php?h0=" + h0 + '&h1=' + h1+ '&h2=' + h2+ '&h3=' + h3+ '&h4=' + h4+ '&h5=' + encodeURIComponent(h5) ;
 	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;

}
function goiin()
{ 		
	var st ;
	st = "thuchichin.php?t0=" + h0 + '&h1=' + h1+ '&h2=' + h2+ '&h3=' + h3+ '&h4=' + h4+ '&h5=' + encodeURIComponent(h5) ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;
}

function xuly1()
{
		document.getElementById('search2').click() ;
}
function xuly2()
{
		document.getElementById('search2').click() ;
}
 
function xoatc(tc)
{  //tungay,denngay,luachon,nhomtk,taikhoan2,lydo2,tr
 var cf = " Bạn có chắc chắn muốn xóa phiếu này hay không ? " ;
 if(thongbao(cf) == false) { return }	 
    poststr="DATAD="+   encodeURIComponent(tc)+  "*@!"+encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
    loadtrang('ketqualuu',"thuchichluu",poststr,"xuly1") ;		
}

function timphieu(t0,t1,t2,t3,t4,t5,t6,t7,t8)
{  //tungay,denngay,luachon,nhomtk,cuahang,lydo2,tr
 	 
    poststr="DATA="+   encodeURIComponent(t0)+  "*@!"+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3);
	poststr= poststr + "*@!"+encodeURIComponent(t4)+  "*@!" + encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8);
    loadtrang('hienthitim',"luongthangbaocaotim", poststr,"") ;		
}
   
function goikhoanhan(id,ma,ten)
{   
 
   if(thongbao("Bạn có muốn xác nhận đã trả lương cho '" +ten+"'  có mã NV: "+ma+ " rồi không ?") == true)
   {
  
    poststr="DATA="+   encodeURIComponent(id)+  "*@!"+encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
	
      loadtrang('hienthitim',"luongthangkhoa", poststr,"xuly2") ;
	 
   }
   		
}
  
 	
function nhapexcel1()
{
 
  
    if (document.getElementById('hiennhapexcel').style.display =="")
	{
		document.getElementById('hiennhapexcel').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '' ;	
		document.getElementById('timphieuxuat').style.display = 'none' ;	
 	}else
	{
		document.getElementById('hiennhapexcel').style.display = "";
		document.getElementById('timkhachhanght').style.display = 'none' ;	
		document.getElementById('timphieuxuat').style.display = '' ;	
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
				url:'luongthangupload.php?us='+tenfile,
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
function laydulieuexel()
{ 
 	 
	   poststr ="DATA="+encodeURIComponent(1)+  "*@!"+ encodeURIComponent(1) ;
 	   loadtrang('hienthiexcel', "luongthangbaocaohtexcel", poststr,"") ;		
}	
function hienthidulieu()
{ 
 
	   poststr ="DATA="+encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel', "tinhluongtailendatahienthi", poststr,"") ;		
 
}
	 
document.getElementById('search2').click() ;
 </script>
