<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
<!--
.style1 {color: #FF0000}
-->

</style><div class="top_space"></div>
<div class="nenbao">
<div style="padding:1px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;" >Danh Sách Định Khoản Thu Chi</label>
	</a></legend>
   <div    > 
 <!-- BEGIN: block_cusht2 -->
<!-- BEGIN: block_cusht1 -->

<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="thongtinkhachhang.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>

 <form name="frmProduct1" method="post">
 
 <div >
 				<b style="display:{q_them}"> [ <a href="default.php?act=thuchiktsodudauky&id=-1">Thêm Mới</a>]&nbsp;&nbsp;</b>&nbsp;&nbsp;</b>[<a href="default.php?act=md">Đóng Lại</a>]&nbsp;
				
				<div style="padding:5px"> 
             

 
</span>
		<select  name="cuahangs" id="cuahangs"  class="js-cuahang "   style="width:auto;"  >
	  <option  value="" >Cửa hàng</option>
 		{cuahang}
 
	 
 </select>            </span> 
 <input type="submit"   style="width:37px"  name="search5"  id="search5" value="Tìm" />
    
		  </div>
 </div>
 <!-- END: block_cusht1 -->
 
 <style>
 .cothienthi{
	font-size:16px !important;
}	
 </style>
	<div id="hienthinhacc"  >
	
 <table width="100%" border="0" cellpadding="0" cellspacing="0">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="33"><b>STT</b></td>
		  <td width="200" align="center" class="cothienthi" ><strong>Mã Của hàng </strong></td>  
		  <td width="362" align="center" class="cothienthi"><strong><strong><strong>Tên cửa hàng </strong></strong></strong> </td> 	   
		  <td width="153" align="center" class="cothienthi"><strong><strong>Số dư đầu kì</strong></strong></td> 
		  <td width="160" align="center" class="cothienthi"><strong>Ngày tạo</strong></td>
		   <td width="160" align="center" class="cothienthi"><strong>Cập nhật</strong></td>
		     <td width="160" align="center" class="cothienthi"><strong>xóa</strong></td>
 		</tr>
		<!-- BEGIN:block_cusht -->
 			<tr  bgcolor="{color}" >
			 <td class="cothienthi"    align="center">{stt}</td>				
				<td class="cothienthi">{ma}</td>
				<td class="cothienthi">{ten}</td>
				<td class="cothienthi">{soddk}</td>
				
				<td class="cothienthi">{ngayt}</td>
				<td class="cothienthi" align="center"><a href = "default.php?act=thuchiktsodudauky&id={ID}"> <img src = "images/book_addressHS.png" border = "0" ></a></td>
				<td class="cothienthi" align="center"><b onclick="xoaConf('{ID}','{ten}')"  ><img src="images/delete.gif" border = "0"></b></td>
			</tr>
			<!-- END:block_cusht -->
 	</table>
	<div style="height:300px">{list_page}</div>
 	</div>
	
<div id="hiethithongbao"    style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div   style=" width:850px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:5px; color:#F00;" >

  <div  >
 <fieldset >
	<legend align="center">   <b style="color:#FF0000;cursor:pointer;font-size:18px" onclick="goidongthe()">&nbsp; Thông tin mua hàng &nbsp;   ( X )</b> 	 </legend><br />

 <div  style="padding:2px" id="hienthihoso"> </div>
  </fieldset>    
 </div></div></div> 
 <script>
 	function xoaConf(id,ten){
		if(confirm('Bạn có chắc muốn xóa '+ten+'!')){
			window.location='default.php?act=thuchiktsodudauky&Del='+id;
		}
	}
	
 </script>
</form>
<!-- End: block_cusht2 -->


<!-- BEGIN:block_cusht3 -->
<form name="frmProduct2" id="frmProduct2" method="post" >

<fieldset  class="nencon" id="khachhang" >
	<legend>   <h3>{t-c}</h3>  </legend>

	 <input name="dachon" type="hidden" id="dachon" value="{type}" />	 <input name="id" id="id" type="hidden"   value="{ID}" /> 
	<style>
	table tr td {
		padding:0.2em;
	}
	table tr td input,table tr td select{
		padding:0.5em;
		
	}
	.ttbb{
		  width: 100%;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-between;
	}
	.ttbb .itemtt{
		padding:0.5em
		
	}
	.ttbb .itemtt  input{
		
		cursor:pointer !important;
	}
	.ttbb .itemtt label{ 
		margin-right:0.5em
	}
	.ttbb .itemtt label input{
		margin-left:0.5em;
		cursor:pointer !important;
	}
	</style>
	
<table width="100%" border="0">
 
 
	  	 

<tr>
	<td width="17%">Tài khoản nợ </td>
	<td width="10%" >
	 
		 
		<select onkeypress="return chuyentieps(event,'Name')" class="js-cuahang" name="cuahang"  id="cuahang" requried >
			  <option value="" >Cửa hàng</option>
  			{cuahang}
 		  </select>		 </td>
		<td width="17%">Số Dư đầu kỳ</td>
	<td >
	 	<input onkeypress="return chuyentieps(event,'Name')" type="Text" name="soddk" id="soddk"  class="text" style="width:150px" value="{soddk}"  requried />
		 </td>
</tr>
 

</table>
<br />


	<div style="padding-left:105px;padding-bottom:8px">
	  <input type="Submit" onfocus="setrong()" onclick="return kiemtra()" class="text" id="btnUpdate" name="btnUpdate" value="Cập nhập" />
	  <input type="button" onclick="quaylai()"  name="cancel2" style="width:200px" value="Quay lại danh sách" /> 
      </div>
</fieldset>


 	
</form>
<div id="khonghienthi" style="display:none"></div>

<script language="JavaScript">
   document.getElementById("type0").focus();
   document.getElementById('dachon').value ='0'
  var kh = "" ;
  var tm = "1" ;
  {makh}
   

 

 
	
 
 
 var tieptuc = ""  ;
function setlai()
{
 tieptuc = '' ;
} 
function tamdung()
{

   tieptuc = 'dung' ;
  	var mTimer = setTimeout('setlai()',2000);
}

 
  
function goithem()
{
  if (document.getElementById('themmoi').value == "Thêm mới" )
  {
	 document.getElementById('soxe').value = "" ;
	 document.getElementById('nhomxe').value = "" ;
	 document.getElementById('model').value = "" ;
	 document.getElementById('taixe').value = "" ;
	 document.getElementById('diachit').value = "" ;
	 document.getElementById('dienthoait').value = "" ;
	 document.getElementById('sokhung').value = "" ;
	 document.getElementById('somay').value = "" ;
	 document.getElementById('mauson').value = "" ;
	 document.getElementById('ghichuxe').value = "" ; 
	  	nochange(false) ;
		document.getElementById('themmoi').value = "Lưu" ;
		return ;
  }
  if (document.getElementById('themmoi').value == "Lưu" )
  {
		luuxe()
		return ;
  }
  if (document.getElementById('themmoi').value == "Cập nhập" )
  {
   		tm = '0' ;	
		luuxe()
		return ;
  }
    
  
}
   
function chuyen(event,tieptheo,th)
{
     capnhap = tieptheo ;
	 
    if (event.keyCode == 13 && 	document.getElementById('dachon').value=='0' ) 
   { 
       	document.getElementById(tieptheo).focus();
		capnhap = tieptheo ;
		
   } else
   {
        document.getElementById(th).focus();
		capnhap = th ;
   }
    event.keyCode = '' ;
}
   
</script>

<!-- END:block_cusht3 -->


<!-- BEGIN:block_themtkthanhcong-->
<script language="JavaScript">
alert('Cập nhập thành công');
location.replace("default.php?act=thuchiktsodudauky&id=dstk&view=tk");
</script>

<!-- END:block_themtkthanhcong-->

<!-- BEGIN: block_cusupdate -->
<script language="JavaScript">
alert('Cập nhập thành công');
location.replace("default.php?act=thuchiktsodudauky");
</script>
<!-- END: block_cusupdate -->
 
 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">

<script language="javascript">
   
 		$(document).ready(function () {
			$('.js-cuahang').select2();
			
		});
		
 </script>
</div></fieldset></div>