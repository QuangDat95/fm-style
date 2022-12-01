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
 				<b style="display:{q_them}"> [ <a href="default.php?act=dinhkhoanthuchi&id=-1">Thêm Mới</a>]&nbsp;&nbsp;</b><b style="display:{q_them}"> [ <a href="default.php?act=dinhkhoanthuchi">Danh Sách Định Khoản</a>]&nbsp;&nbsp;</b><b style="display:{q_them}"> [ <a href="default.php?act=dinhkhoanthuchi&id=tk&view=tk">Thêm Mới Tài khoản</a>]&nbsp;&nbsp;</b><b style="display:{q_them}"> [ <a href="default.php?act=dinhkhoanthuchi&id=dstk&view=tk">Danh Sách Tài khoản</a>]&nbsp;&nbsp;</b>[<a href="default.php?act=md">Đóng Lại</a>]&nbsp;
				
				<div style="padding:5px"> 
              
 
  <input type="text" name="ma"  placeholder="Mã DK_" ondblclick="this.value=''" id="ma" class="inpl"  style="width:55px"   value="{madk}" />
 &nbsp; 
<input type="text" name="ten" id="ten" ondblclick="this.value=''"  placeholder="Tên DK"  class="inpl"  style="width:65px" value="{tendk}" /> 


  
 
 

 
</span>
		<select class="compo"  name="sapxep" id="sapxep"    style="width:80px;"  >
	  <option  value="" >Sắp Xếp</option>
    <option {sapxepten} value="ten" >Sắp Xếp Tên </option>
	<option  {sapxepma} value="ma" >Sắp Xếp Mã</option> 
 
	 
 </select>            </span> 
 <input type="submit"   style="width:37px"  name="search5"  id="search5" value="Tìm" />
      <!-- onclick="timkiemkh(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value)"   -->
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
		  <td width="200" align="center" class="cothienthi" ><strong>Mã định khoản </strong></td>  
		  <td width="362" align="center" class="cothienthi"><strong><strong><strong>Tên định khoản </strong></strong></strong> </td> 	   
		  <td width="153" align="center" class="cothienthi"><strong><strong>Tài khoản nợ</strong></strong></td> 
		  <td width="160" align="center" class="cothienthi"><strong>Tài khoản có</strong></td>
		  <td width="178" align="center" class="cothienthi"><strong><strong>Xác nhận</strong> </strong></td>
		  <td width="178" align="center" class="cothienthi"><strong><strong>Loại</strong> </strong></td>
		   <td width="50" align="center" class="cothienthi"><strong><strong>cập nhật</strong> </strong></td>	    	       <td width="50" align="center" class="cothienthi"><strong><strong>xóa</strong> </strong></td>	
 		</tr>
		<!-- BEGIN:block_cusht -->
 			<tr  bgcolor="{color}" >
			 <td class="cothienthi"    align="center">{stt}</td>				
				<td class="cothienthi">{ma}</td>
				<td class="cothienthi">{ten}</td>
				<td class="cothienthi">{no}</td>
				<td class="cothienthi">{co}</td>
				
				<td class="cothienthi">{xacnhan}</td>
				<td class="cothienthi">{loaishow}</td>
				<td class="cothienthi" align="center"><a href = "default.php?act=dinhkhoanthuchi&id={ID}"> <img src = "images/book_addressHS.png" border = "0" ></a></td>
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
			window.location='default.php?act=dinhkhoanthuchi&Del='+id;
		}
	}
 </script>
</form>
<!-- End: block_cusht2 -->

<!-- BEGIN: block_dstaikhoan -->
<!-- BEGIN: block_cusht1 -->

<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="thongtinkhachhang.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>

 <form name="frmProduct1" method="post">
 
 <div >
 				<b style="display:{q_them}"> [ <a href="default.php?act=dinhkhoanthuchi&id=-1">Thêm Mới</a>]&nbsp;&nbsp;</b><b style="display:{q_them}"> [ <a href="default.php?act=dinhkhoanthuchi">Danh Sách Định Khoản</a>]&nbsp;&nbsp;</b><b style="display:{q_them}"> [ <a href="default.php?act=dinhkhoanthuchi&id=tk&view=tk">Thêm Mới Tài khoản</a>]&nbsp;&nbsp;</b><b style="display:{q_them}"> [ <a href="default.php?act=dinhkhoanthuchi&id=dstk&view=tk">Danh Sách Tài khoản</a>]&nbsp;&nbsp;</b>[<a href="default.php?act=md">Đóng Lại</a>]&nbsp;
				
				<div style="padding:5px"> 
              
 
  <input type="text" name="matks"  placeholder="Mã TK_" ondblclick="this.value=''" id="ma" class="inpl"  style="width:55px"   value="{madks}" />
 &nbsp; 
<input type="text" name="tentks" id="ten" ondblclick="this.value=''"  placeholder="Tên TK"  class="inpl"  style="width:65px" value="{tendk}" /> 


  
 
 

 
</span>
		<select class="compo"  name="sapxep" id="sapxep"    style="width:80px;"  >
	  <option  value="" >Sắp Xếp</option>
    <option {sapxepten} value="tendinhkhoan" >Sắp Xếp Tên </option>
	<option  {sapxepma} value="madinhkhoan" >Sắp Xếp Mã</option> 
 
	 
 </select>            </span> 
 <select class="compo"  name="loaitks" id="loaitks"    style="width:80px;"  >
	  <option  value="" >Loại tk</option>
    <option {loai_0} value="0" >Dư Có </option>
	<option  {loai_1} value="1" >Dư Nợ</option> 
	<option  {loai_2} value="2" >Lưỡng tính</option> 
	<!--<option  {loai_3} value="3" >Không xác định</option> -->
 </select>        
 <input type="submit"   style="width:37px"  name="searchtk"  id="searchtk" value="Tìm" />
 <button type="button" id="nhapexel" onclick="nhapexcel1()">Nhập exel</button>
      <!-- onclick="timkiemkh(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value)"   -->
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
		  <td width="200" align="center" class="cothienthi" ><strong>Mã tài khoản </strong></td>  
		  <td width="362" align="center" class="cothienthi"><strong><strong><strong>Tên tài khoản </strong></strong></strong> </td> 	
		  <td width="362" align="center" class="cothienthi"><strong><strong><strong>Tên tiếng anh </strong></strong></strong> </td> 	   
		  <td width="153" align="center" class="cothienthi"><strong><strong>Diễn giải</strong></strong></td> 
		  <td width="160" align="center" class="cothienthi"><strong>Loại</strong></td>
		   <td width="160" align="center" class="cothienthi"><strong>Ngừng theo dõi</strong></td>
		   <td width="50" align="center" class="cothienthi"><strong><strong>cập nhật</strong> </strong></td>	    	       <td width="50" align="center" class="cothienthi"><strong><strong>xóa</strong> </strong></td>	
 		</tr>
		<!-- BEGIN:block_cusht -->
 			<tr  bgcolor="{color}" >
			 <td class="cothienthi"    align="center">{stt}</td>				
				<td class="cothienthi">{ma}</td>
				<td class="cothienthi">{ten}</td>
				<td class="cothienthi">{tenen}</td>
				<td class="cothienthi">{ghichu}</td>
				
				<td class="cothienthi">{loai}</td>
				<td class="cothienthi">{ngungtheodoi}</td>
				<td class="cothienthi" align="center"><a href = "default.php?act=dinhkhoanthuchi&id={ID}&view=tk"> <img src = "images/book_addressHS.png" border = "0" ></a></td>
				<td class="cothienthi" align="center"><b onclick="xoaConftk('{ID}','{ten}','tk')"  ><img src="images/delete.gif" border = "0"></b></td>
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
			window.location='default.php?act=dinhkhoanthuchi&Del='+id;
		}
	}
		function xoaConftk(id,ten){
		if(confirm('Bạn có chắc muốn xóa '+ten+'!')){
			window.location='default.php?act=dinhkhoanthuchi&Del='+id+'&view=tk';
		}
	}
 </script>
</form>
<!-- End: block_dstaikhoan -->


<!-- BEGIN: block_cus -->
<!-- BEGIN:block_themdinhkhoan -->
<form name="frmProduct2" id="frmProduct2" method="post" >

<fieldset  class="nencon" id="khachhang" >
	<legend>   <h3>{t-c}</h3>  </legend>
<script language="javascript">
 var t =1 ;
  mTimer = setTimeout('doititle()',1000);
  function doititle()
  { 
     t= t+1 ;
  	 
	 if (t<18) 
	 {
		   if (document.title != '***'  )
		   {
			   document.title = "***" ;
		   }else
		   {
			   document.title = "Thêm Khách Hàng" ;
		   }
		  setTimeout('doititle()',500); 
	  }
  }
</script>

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
	 
		 
		<select onkeypress="return chuyentieps(event,'Name')" class="js-tkno" name="tkno"  id="tkno" requried >
			  <option value="0" >Chọn tài khoản nợ</option>
  			{tkno}
 		  </select>		 </td>
		<td width="17%">Tài khoản có </td>
	<td >
	 
		 
		<select onkeypress="return chuyentieps(event,'Name')" class="js-tkco" name="tkco"  id="tkco"  requried>
			  <option value="0" >Chọn tài khoản có</option>
  			{tkco}
 		  </select>		 </td>
</tr>
 <tr>
	<td width="17%">
		Mã định khoản</td>
	<td width="10%"><input onkeypress="return chuyentieps(event,'Name')" type="Text" name="madk" id="madk"  class="text" style="width:100%" value="{ma}"  requried />
	  </td>
	  <td width="17%">
		Tên định khoản</td>
	<td width=""><input onkeypress="return chuyentieps(event,'Name')" type="Text" name="tendk" id="tendk"  class="text" style="width:300px" value="{ten}" requried />
	 </td>
</tr>
<tr>
	<td width="17%">Xác nhận</td>
	<td><select onkeypress="return chuyentieps(event,'Name')" name="xacnhan" class="js-xacnhan" onchange="changexacnhan(event)" requried>
		<option value=""> </option>
		<option   value="1">Thủ quỷ XN</option>
		<option   value="2">Kế toán Online XN</option>
		<option  value="3">Kế toán cửa hàng XN</option>
	</select>
	<input onkeypress="return chuyentieps(event,'Name')" type="hidden" name="xacnhanc" id="xacnhanc"  class="" style="width:300px" value="{xacnhanc}" requried />
		</td>
	<td width="100px">Loại</td>
	<td><select onkeypress="return chuyentieps(event,'Name')" name="loai" style="width:300px" requried>
		<option value="1" {selectedloai1}>Thu</option>
		<option value="2" {selectedloai2}>Chi</option>
	</select></td>
</tr>
 
<tr>
	<td width="17%">Thông tin bắt buộc</td>
	<td  >
	
	</td>
 
	<td  align="right">&nbsp; </td>
	<td  >&nbsp; </td>
</tr>
<tr>
	<td width="17%"></td>
	<td colspan="3" >
	<div class="ttbb" style="  ">
	<div class="itemtt">
	<label for="ttbb_14">HĐBH:</label>
		<input  type="checkbox" id="ttbb_14" name="ttbb_14"  {ttbb_14} value="14"/>
	</div>
	<div class="itemtt">
	<label  for="ttbb_15">STKNH:</label>
	<input  type="checkbox" id="ttbb_15" name="ttbb_15" {ttbb_15}  value="15" />
	</div>
	<div class="itemtt">
	<label for="ttbb_16">Tên NH: </label>
		<input  type="checkbox" id="ttbb_16" name="ttbb_16" {ttbb_16} value="16" />
	</div>
	<div class="itemtt">
		<label for="ttbb_16">ĐVVC: </label>
		<input  type="checkbox" name="ttbb_17"  {ttbb_17} value="17" />
	</div>
	<div class="itemtt">
		<label for="ttbb_16">MÃ VĐ: </label>
		<input  type="checkbox" name="ttbb_18"  {ttbb_18} value="18" />
	</div>
	<!--<div class="itemtt itemtts_">
	<label>Mã vận đơn: </label>
		<label>GHTK/Viettel/Bưu điện: <input  type="checkbox" name="ttbb_17"  {ttbb_17} value="17" /></label>
		<label>Shoppe: <input  type="checkbox" name="ttbb_18"  {ttbb_18} value="18" /></label>
		<label>Lazada: <input  type="checkbox" name="ttbb_19" {ttbb_19}  value="19" /></label>
		<label>Tiki: <input  type="checkbox" name="ttbb_20"  {ttbb_20} value="20" /></label>
	</div>-->
	
	<div class="itemtt">
	<label for="ttbb_19" >NCC: </label>
		<input  type="checkbox"  id="ttbb_19" name="ttbb_19" {ttbb_19}  value="19" />
	</div>
	
	<div class="itemtt">
	<label for="ttbb_20">Họ và tên nhân viên: </label>
		<input  type="checkbox" id="ttbb_20" name="ttbb_20" {ttbb_20}  value="20" />
	</div>
	<div class="itemtt">
	<label for="ttbb_21">Mã nhân viên: </label>
		<input  type="checkbox" id="ttbb_21" name="ttbb_21" {ttbb_21} value="21" />
	</div>
	<div class="itemtt">
		<label for="ttbb_22">Phiếu xuất: </label>
		<input  type="checkbox" id="ttbb_22" name="ttbb_22" {ttbb_22} value="22" />
	</div>
	<div class="itemtt">
		<label for="duyetnhieu">Cho phép duyệt hàng loạt: </label>
		<input  type="checkbox" id="duyetnhieu" name="duyetnhieu" {duyetnhieu}/>
	</div>
	<!--	<div class="itemtt">
		<label for="ttbb_25">Số phiếu PM: </label>
		<input  type="checkbox" id="ttbb_25" name="ttbb_25" {ttbb_25} value="25" />
	</div>
	<div class="itemtt">
		<label for="ttbb_26">Chứng từ: </label>
		<input  type="checkbox" id="ttbb_26" name="ttbb_26" {ttbb_26}  value="26" />
	</div>-->
	
	</div>
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
 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
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

<!-- END:block_themdinhkhoan -->
<!-- BEGIN:block_capnhatdinhkhoan -->
<form name="frmProduct2" id="frmProduct2" method="post" >

<fieldset  class="nencon" id="khachhang" >
	<legend>   <h3>{t-c}</h3>  </legend>
<script language="javascript">
 var t =1 ;
  mTimer = setTimeout('doititle()',1000);
  function doititle()
  { 
     t= t+1 ;
  	 
	 if (t<18) 
	 {
		   if (document.title != '***'  )
		   {
			   document.title = "***" ;
		   }else
		   {
			   document.title = "Thêm Khách Hàng" ;
		   }
		  setTimeout('doititle()',500); 
	  }
  }
</script>

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
	 
		 
		<select onkeypress="return chuyentieps(event,'Name')" class="js-tkno" name="tkno"  id="tkno" requried >
			  <option value="0" >Chọn tài khoản nợ</option>
  			{tkno}
 		  </select>		 </td>
		<td width="17%">Tài khoản có </td>
	<td >
	 
		 
		<select onkeypress="return chuyentieps(event,'Name')" name="tkco" class="js-tkco"  id="tkco"  requried>
			  <option value="0" >Chọn tài khoản có</option>
  			{tkco}
 		  </select>		 </td>
</tr>
 <tr>
	<td width="17%">
		Mã định khoản</td>
	<td width="10%"><input onkeypress="return chuyentieps(event,'Name')" type="Text" name="madk" id="madk"  class="text" style="width:100%" value="{ma}"  requried />
	  </td>
	  <td width="17%">
		Tên định khoản</td>
	<td width=""><input onkeypress="return chuyentieps(event,'Name')" type="Text" name="tendk" id="tendk"  class="text" style="width:300px" value="{ten}" requried />
	 </td>
	  
</tr>
<tr>
	<td width="17%">Xác nhận</td>
	<td  ><select onkeypress="return chuyentieps(event,'Name')" name="xacnhan" class="js-xacnhan" onchange="changexacnhan(event)" requried>
		<option value=""> </option>
		<option  value="1">Thủ quỷ XN</option>
		<option   value="2">Kế toán Online XN</option>
		<option  value="3">Kế toán cửa hàng XN</option>
	</select><input onkeypress="return chuyentieps(event,'Name')" type="hidden" name="xacnhanc" id="xacnhanc"  class="" style="width:300px" value="{xacnhanc}" requried /></td>
	<td width="100px">Loại</td>
	<td  ><select onkeypress="return chuyentieps(event,'Name')" name="loai" style="width:300px" requried>
		<option value="1" {selectedloai1}>Thu</option>
		<option value="2" {selectedloai2}>Chi</option>
	</select></td>
</tr>
 
<tr>
	<td width="17%">Thông tin bắt buộc</td>
	<td  >
	
	</td>
 
	<td  align="right">&nbsp; </td>
	<td  >&nbsp; </td>
</tr>
<tr>
	<td width="17%"></td>
	<td colspan="3" >
	<div class="ttbb" style="  ">
	<div class="itemtt">
	<label for="ttbb_14">HĐBH:</label>
		<input  type="checkbox" id="ttbb_14" name="ttbb_14"  {ttbb_14} value="14"/>
	</div>
	<div class="itemtt">
	<label  for="ttbb_15">STKNH:</label>
	<input  type="checkbox" id="ttbb_15" name="ttbb_15" {ttbb_15}  value="15" />
	</div>
	<div class="itemtt">
	<label for="ttbb_16">Tên NH: </label>
		<input  type="checkbox" id="ttbb_16" name="ttbb_16" {ttbb_16} value="16" />
	</div>
	<div class="itemtt">
		<label for="ttbb_16">ĐVVC: </label>
		<input  type="checkbox" name="ttbb_17"  {ttbb_17} value="17" />
	</div>
	<div class="itemtt">
		<label for="ttbb_16">MÃ VĐ: </label>
		<input  type="checkbox" name="ttbb_18"  {ttbb_18} value="18" />
	</div>
	<!--<div class="itemtt itemtts_">
	<label>Mã vận đơn: </label>
		<label>GHTK/Viettel/Bưu điện: <input  type="checkbox" name="ttbb_17"  {ttbb_17} value="17" /></label>
		<label>Shoppe: <input  type="checkbox" name="ttbb_18"  {ttbb_18} value="18" /></label>
		<label>Lazada: <input  type="checkbox" name="ttbb_19" {ttbb_19}  value="19" /></label>
		<label>Tiki: <input  type="checkbox" name="ttbb_20"  {ttbb_20} value="20" /></label>
	</div>-->
	
	<div class="itemtt">
	<label for="ttbb_19" >NCC: </label>
		<input  type="checkbox"  id="ttbb_19" name="ttbb_19" {ttbb_19}  value="19" />
	</div>
	
	<div class="itemtt">
	<label for="ttbb_20">Họ và tên nhân viên: </label>
		<input  type="checkbox" id="ttbb_20" name="ttbb_20" {ttbb_20}  value="20" />
	</div>
	<div class="itemtt">
	<label for="ttbb_21">Mã nhân viên: </label>
		<input  type="checkbox" id="ttbb_21" name="ttbb_21" {ttbb_21} value="21" />
	</div>
	<div class="itemtt">
		<label for="ttbb_22">Phiếu xuất: </label>
		<input  type="checkbox" id="ttbb_22" name="ttbb_22" {ttbb_22} value="22" />
	</div>
	<div class="itemtt">
		<label for="duyetnhieu">Cho phép duyệt hàng loạt: </label>
		<input  type="checkbox" id="duyetnhieu" name="duyetnhieu" {duyetnhieu} />
	</div>
	</div>
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
var nhanvienxacnhan='{nhanvienxacnhan}';
$(document).ready(function () {

	
		
	});

 //  document.getElementById("type0").focus();
 //  document.getElementById('dachon').value ='0'
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

<!-- END:block_capnhatdinhkhoan -->

<!-- END: block_cus -->

<!-- BEGIN: block_tk -->
<!-- BEGIN: block_themtaikhoan -->
<form name="frmProduct2" id="frmProduct2" method="post" >

<fieldset  class="nencon" id="khachhang" >
	<legend>   <h3>{t-c}</h3>  </legend>
<script language="javascript">
 var t =1 ;
  mTimer = setTimeout('doititle()',1000);
  function doititle()
  { 
     t= t+1 ;
  	 
	 if (t<18) 
	 {
		   if (document.title != '***'  )
		   {
			   document.title = "***" ;
		   }else
		   {
			   document.title = "Thêm Khách Hàng" ;
		   }
		  setTimeout('doititle()',500); 
	  }
  }
</script>

	 <input name="dachon" type="hidden" id="dachon" value="{type}" />	 <input name="id" id="id" type="hidden"   value="{idtk}" /> 
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

		<td width="17%">Loại định khoản </td>
	<td ><select onkeypress="return chuyentieps(event,'Name')" name="loaitk"  id="loaitk"  requried>
      <option value="-1" >Loại định khoản</option>
      <option value="1" >Tài khoản nợ</option>
      <option value="0" >Tài khoản có</option>
	  <option value="2" >Tài khoản lưỡng tính</option>
	    <option value="3" >Không xác định</option>
    </select></td>
		  	<td width="13%">
		Mã định khoản</td>
	<td width="40%"><input onkeypress="return chuyentieps(event,'Name')" type="Text" name="matk" id="matk"  class="text" style="" value="{ma}"  requried />	  </td>
</tr>
 <tr>
	
	  <td width="17%">
		Tên định khoản</td>
	<td width="30%"><input onkeypress="return chuyentieps(event,'Name')" type="Text" name="tentk" id="tentk"  class="text" style="width:300px" value="{ten}" requried />	 </td>
	<td width="17%">
		Tên tiếng anh</td>
	 <td width="">
	 <input onkeypress="return chuyentieps(event,'Name')" type="Text" name="tenen" id="tenen"  class="text" style="width:300px" value="{tenen}" requried />
	 </td>
	
</tr>
<tr> <td width="13%">
		Ghi chú</td>
	<td width="40%"><textarea name="ghichutk" style="width:300px"></textarea>	  </td></tr>
</table>
<br />


	<div style="padding-left:105px;padding-bottom:8px">
	  <input type="submit" onfocus="setrong()" onclick="return kiemtratk()" class="text" id="btnUpdateTk" name="btnUpdateTk" value="Cập nhập" />
	  <input type="button" onclick="quaylaitk()"  name="cancel2" style="width:200px" value="Quay lại danh sách" /> 
      </div>
</fieldset>


 	
</form>
<!-- END:block_themtaikhoan -->
<!-- BEGIN: block_capnhattaikhoan -->
<form name="frmProduct2" id="frmProduct2" method="post" >

<fieldset  class="nencon" id="khachhang" >
	<legend>   <h3>{t-c}</h3>  </legend>
<script language="javascript">
 var t =1 ;
  mTimer = setTimeout('doititle()',1000);
  function doititle()
  { 
     t= t+1 ;
  	 
	 if (t<18) 
	 {
		   if (document.title != '***'  )
		   {
			   document.title = "***" ;
		   }else
		   {
			   document.title = "Thêm Khách Hàng" ;
		   }
		  setTimeout('doititle()',500); 
	  }
  }
</script>

	 <input name="dachon" type="hidden" id="dachon" value="{type}" />	 <input name="id" id="id" type="hidden"   value="{idtk}" /> 
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

		<td width="17%">Loại định khoản </td>
	<td ><select onkeypress="return chuyentieps(event,'Name')" name="loaitk"  id="loaitk"  requried>
      <option value="-1" >Loại định khoản</option>
      <option value="1" {loai1} >Tài khoản nợ</option>
      <option value="0" {loai0} >Tài khoản có</option>
	   <option value="2" {loai2}>Tài khoản lưỡng tính</option>
	   <!-- <option value="3" {loai3}>Không xác định</option>-->
    </select></td>
		  	<td width="13%">
		Mã định khoản</td>
	<td width="40%"><input onkeypress="return chuyentieps(event,'Name')" type="Text" name="matk" id="matk"  class="text" style="" value="{ma}"  requried />	  </td>
</tr>
 <tr>
	
	  <td width="17%">
		Tên định khoản</td>
	<td width="30%"><input onkeypress="return chuyentieps(event,'Name')" type="Text" name="tentk" id="tentk2"  class="text" style="width:300px" value="{ten}" requried /></td>
	<td width="17%">
		Tên tiếng anh</td>
	 <td width="">
	 <input onkeypress="return chuyentieps(event,'Name')" type="Text" name="tenen" id="tenen"  class="text" style="width:300px" value="{tenen}" requried />
	 </td>
	
</tr>
<tr> <td width="13%">
		Ghi chú</td>
	<td width="40%"><textarea name="ghichutk" style="width:300px">{ghichu}</textarea>	  </td></tr>
</table>
<br />


	<div style="padding-left:105px;padding-bottom:8px">
	  <input type="submit" onfocus="setrong()" onclick="return kiemtratk()" class="text" id="btnUpdateTk" name="btnUpdateTk" value="Cập nhập" />
	  <input type="button" onclick="quaylaitk()"  name="cancel2" style="width:200px" value="Quay lại danh sách" /> 
      </div>
</fieldset>


 	
</form>
<!-- END:block_capnhattaikhoan -->
<!-- END:block_tk -->


<!-- BEGIN:block_themtkthanhcong-->
<script language="JavaScript">
alert('Cập nhập thành công');
location.replace("default.php?act=dinhkhoanthuchi&id=dstk&view=tk");
</script>

<!-- END:block_themtkthanhcong-->

<!-- BEGIN: block_cusupdate -->
<script language="JavaScript">
alert('Cập nhập thành công');
location.replace("default.php?act=dinhkhoanthuchi");
</script>
<!-- END: block_cusupdate -->
 
 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">

<script language="javascript">

     var tinh='';
		var thanhpho='';
		$('.js-tkno').select2();
	$('.js-tkco').select2();
 	$(document).ready(function () {

			$('.js-tinh').select2();
			$('.js-ch').select2();
			$('.js-quan').select2();
			$('.js-phuong').select2();
 			$('.js-tinh').on('select2:selecting', function(e) {
				  /* console.log('Selecting: ' , e.params.args.data.id);
				   return;*/
				   tinh=e.params.args.data.id;
					var poststr = "TINH=" + encodeURIComponent(e.params.args.data.id) + "*@!";
					 
					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly9");
			});
					
			$('.js-quan').on('select2:selecting', function(e) {
  					var poststr = "THANH=" + encodeURIComponent(tinh) + "*@!"+ encodeURIComponent(e.params.args.data.id);
					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly8");
			});
		});
		function xuly9() {
			  
			var tam = document.getElementById('khonghienthi').innerHTML;
			//console.log(tam);
			
			var quan=document.getElementById("quan");
			
			if(tam!="")
			{
			
			quan.innerHTML=tam;
			quan.disabled=false;
				
			}
			
		
		}
		function xuly8() {
			 
			var tam = document.getElementById('khonghienthi').innerHTML;
			var phuong=document.getElementById("phuong");
			
			if(tam!="")
			{
			
			phuong.innerHTML=tam;
			phuong.disabled=false;
				
			}
			
		
		}		
		
 //============================================================
 function ask()
{
	var n = confirm("Bạn có muốn xóa không");
	if(n == false)
	{
		return false;
			
	}
}
function quaylai()
{
	location.replace("default.php?act=dinhkhoanthuchi");
}
function quaylaitk()
{
	location.replace("default.php?act=dinhkhoanthuchi&id=dstk&view=tk");
}
//=======================
function settype(valu)
{
	document.getElementById('dachon').value =  valu ;
 	 
}
 function kiemtra()
{
  // if (capnhap != '') { return false ;}

	if(document.getElementById('tkco').value == "0")
	{
		alert('Bạn chưa chọn tài khoản có') ;
		document.getElementById('tkco').focus() ;
		return false;			
	}
if(document.getElementById('tkno').value == "0")
	{
		alert('Bạn chưa chọn tài khoản nợ') ;
		document.getElementById('tkno').focus() ;
		return false;			
	}
 	if(document.getElementById('tendk').value == "")
	{
		alert('Bạn chưa nhập tên định khoản') ;
		document.getElementById('tendk').focus() ;
		return false;			
	}
 	if(document.getElementById('madk').value == "")
	{
		alert('Bạn chưa nhập mã madk') ;
		document.getElementById('madk').focus() ;
		return false;			
	}
	
	if(document.getElementById('xacnhan').value == "0")
	{
		alert('Bạn chưa chọn người xác nhận') ;
		document.getElementById('xacnhan').focus() ;
		return false;			
	}
	return true;
}

function kiemtratk()
{


	if(document.getElementById('loaitk').value == "-1")
	{
		alert('Bạn chưa chọn loại tài khoản') ;
		document.getElementById('loaitk').focus() ;
		return false;			
	}
if(document.getElementById('matk').value == "")
	{
		alert('Bạn chưa nhập mã tài khoản') ;
		document.getElementById('matk').focus() ;
		return false;			
	}
 	if(document.getElementById('tentk').value == "")
	{
		alert('Bạn chưa nhập tên tài khoản') ;
		document.getElementById('tentk').focus() ;
		return false;			
	}
 	
	return true;
}
function xuly5()
{
 document.getElementById("hiethithongbao").style.display = '' ;
}
function goidongthe()
{
 document.getElementById("hiethithongbao").style.display = 'none' ;
}

 

function goikhach(t1)
{ 	
   poststr="DATA="+ encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
   loadtrang('hienthihoso',"thongtinkhachhangmua", poststr,"xuly5") ;
}

function timkiemkh(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) +  "*@!"+ encodeURIComponent(t11) ;
    loadtrang('hienthinhacc', "khachhangtim", poststr,"") ;
	//alert('Luu xong !!!');
} 
function timthongke(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) +  "*@!"+ encodeURIComponent(t11) ;
    loadtrang('hienthinhacc', "khachhangthongke", poststr,"") ;
	//alert('Luu xong !!!');
} 
function timthongkediem(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) +  "*@!"+ encodeURIComponent(t11) ;
    loadtrang('hienthinhacc', "khachhangthongkediem", poststr,"") ;
	//alert('Luu xong !!!');
} 
function khachmua(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10)+  "*@!"+ encodeURIComponent(t11) ;
    loadtrang('hienthinhacc', "khachhangthongkemua", poststr,"") ;
	//alert('Luu xong !!!');
} 

function xephang(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) ;
    loadtrang('hienthinhacc', "khachhangxephang", poststr,"") ;
	//alert('Luu xong !!!');
} 

  
 function xuatkq()
{
	 
	 document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>'+ document.getElementById("hienthinhacc").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
}

function checkDate(strDate) {
	if(strDate=="") return;
	
    var comp = strDate.split('/')
    var d = parseInt(comp[0], 10)
    var m = parseInt(comp[1], 10)
	if (comp[2] != null) { 	if(comp[2].length==2 ) comp[2]= parseInt("19"+comp[2]) ; }
    var y = parseInt(comp[2], 10)
 
	if(d>31) alert('sai định dạng !')
	
     var date = new Date(y,m-1,d);
	 
    if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
      return true
    }
	
	alert('Bạn nhập sai chuẩn ngày sinh 01/01/1999 !');
	 document.getElementById("ngaysinh").focus();
    return false
}


function kiemtradung(v)
{ 	 var l;
   l=v.length ;
    if(l==0 ) return;
	
	 if(v[0]!=0) {
	 	thongbaomoi(' Bạn nhập không đúng chuẩn điện thoại di động bắt đầu bằng số 0!',"Thông báo !",2); document.getElementById("tel").focus(); return false;
	 }
	 
 
  
    if( l!=10) 
    {  thongbaomoi('Bạn nhập dư hoặc thiếu   số kiểm tra lại nhé !',"Thông báo !",2);
     document.getElementById("tel").focus();
     return;
   }
    document.getElementById('makh').value =  v ;
}

 function timkhmacode(v)
{ 	
   document.getElementById('search2').click();	 
 //   poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
//    loadtrang('khonghienthi', "khachhangtimtheoma", poststr,"xuly9") ;
} 
var timer;
  function  goikh(v)
  {
     clearTimeout(timer);
     timer=setTimeout( function validate() { timkhmacode(v) },500);
  }
  
/*function setkh(t1,t2,t3)
{
	return false ;
}*/
//document.getElementById("Name").focus(); 
</script>
<!-- BEGIN: block_khongxoa -->
<script language="JavaScript">
alert('Bạn không thể xóa khách hàng này do đã có nơi sử dụng  rồi !!! ');
 </script>
<!-- END: block_khongxoa --> 
<!-- BEGIN: block_xoa -->
<script language="JavaScript">
	alert('Xóa thành công !!! ');
	window.location="default.php?act=dinhkhoanthuchi";
 </script>
<!-- END: block_xoa --> 
<!-- BEGIN: block_xoatk -->
<script language="JavaScript">
	alert('Xóa tài khoản thành công !!! ');
	window.location="default.php?act=dinhkhoanthuchi&id=dstk&view=tk";
 </script>
<!-- END: block_xoatk --> 


<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
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
    <label>File danh sách tài khoản Excel *.xlsx</label>
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
		<p style="color:#FF0000;font-weight:bold">Tải danh sách tài khoản</p>
		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('taikhoan',1);" style="height:22px">Tải lên</button>
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
<script type="text/javascript" src="templates/ajaxfileupload.js"></script>

<script language="JavaScript">
  
 
  
function changexacnhan(e){
		 var target = e.target;
		var data=$(target).select2('val');
		var chuoi='';
		for(var i=0;i<data.length;i++){
			var el=data[i];
			if(el){
				chuoi+=el;
			}
		}
           document.getElementById("xacnhanc").value=chuoi;
	}	
	$(document).ready(function() {
		
	    $('.js-xacnhan').select2({
				placeholder:"Xác nhận",
				multiple:true,
			})
		if(nhanvienxacnhan){
			var tamang=[];
			nhanvienxacnhan=nhanvienxacnhan.split("###");
			
			$(".js-xacnhan").select2().val(nhanvienxacnhan);
			$(".js-xacnhan").trigger('change'); 
		}
	
		});
		
		
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
	var poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('resupdate', "thuchicheckdatataikhoan", poststr, "xuly2");

}

function xuly2(){
var tam=document.getElementByID("resupdate").innerHTML;

	if(tam){
	
		alert(tam);
	}
}

function hienthidulieu()
{ 	
	
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel','thuchitailentaikhoanhienthi', poststr,"") ;		
 
}
function xuatbaoloi(str){
	alert(str);
}

</script>
</div></fieldset></div>