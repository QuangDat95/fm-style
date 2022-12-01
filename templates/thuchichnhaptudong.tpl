 
<div class="top_space"></div>
<div class="nenbao">
<div style="padding:1px">  
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;" >Tải dữ liệu thu chi cửa hàng từ Excel</label></a></legend><div    > 
 
<form name="frmcongnoncc" method="post" enctype="multipart/form-data"/>

<div style="padding-bottom:10px;padding-left:15px ">   
 <div >	 [<a href="default.php?act=md">Đóng Lại</a>]&nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
  <input id="luachon" name="luachon" value="2" type="hidden"  /> 

 
 </div>
 
 </div>
 <fieldset  class="nencon">
	<legend>
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" > Chọn loại tài khoản</label>
    </legend>
<table width="950px"   cellpadding="2" cellspacing="2" style="" class="tbthu">

 

<tr>
	<td width="62"  >Chọn kiểu ngày</td>
	<td width="62"  ><select   name="kieungay"  id="kieungay" style="width:120px"  >
	  <option value="0" {kieungay0}>dd-mm-yyyy</option>
	  <option value="1" {kieungay1}>mm-dd-yyyy</option>
      <option value="2" {kieungay2}>yyyy-mm-dd</option>
      <option value="3" {kieungay3}>Kiểu Số</option>
	  </select></td><td width="62"  >Loại </td>
	<td   colspan="4"><select   name="loaitaikhoan"  id="loaitaikhoan" style="width:120px"  >
	  <option value="0" {loaitaikhoan0} >Tiền mặt</option>
	  <option value="1" {loaitaikhoan1}>Ngân hàng</option>
 	  </select>
	  <select   name="nganhang"  id="nganhang" style="width:509px"  >
	    <option value="" ></option>
  	    {nganhang}
 	    </select></td>
</tr>

 
	
</table>
 
 <div align="center">
  Từ dòng  <input type="number" name="dong" id="dong" value="{dong}" style="width:50px"> 
  tới dòng  <input type="number" name="toi" id="toi" value="{toi}" style="width:50px"> 
  
     Chọn file excel
           <input type="file"  accept=".xlsx"  name="filehd" id="filehd">  
      <input type="submit" name="Submit" value="Gởi lên"  /> &nbsp; &nbsp;  
<input type="submit" name="luulai" value="Lưu lại" onclick="return kiemtra()" />     
	</div>
<div style="color:#F00;font-size:34px" align="center">{daluu}</div>
 <div style="width:990px;height:300px;overflow:scroll ">
 <table border="1" cellpadding="0" cellspacing="0" class="tbchuan" bgcolor="#FFFFFF" width="950px">
 <!-- BEGIN: block_tienmat -->	
           <tr height="60" style="background-color:#CCC">
            <td height="60" width="35">Cột</td>
            <td>1 Ngày</td>
            <td>2 Loai thu chi</td>
            <td>3 Mã Nhóm</td>
            <td>4 Loại TK</td>
            <td>5 Lý do</td>
            <td>6 Người nhận</td>
            <td>7 Người  Chi</td>
            <td>8 so tien </td>
            <td>9 Đơn vị</td>
            <td>10 Chi Chú</td>
            <td>11 Mã TK</td>
            </tr>
 <!-- END: block_tienmat -->	
 <!-- BEGIN: block_nganhang -->	
           <tr height="60" style="background-color:#CCC">
            <td height="60" width="35">Cột</td>
            <td width="37">1 Ngày</td>
            <td width="96">2 SoCT</td>
            <td width="230">3  Diễn giải</td>
            <td width="41">4 Giảm (-)</td>
            <td width="70">5 Tăng (+)</td>
            <td width="11">6 Còn lại</td>
            <td width="80"> 7 Nhóm</td>
             <td width="74"> 8 Cửa hàng</td>
            <td width="82"> 9 Nhóm</td>
            <td width="82"> 10  Cửa hàng</td> 
            <td width="82"> 11 </td> 
            </tr>
 <!-- END: block_nganhang -->	
   
	<!-- BEGIN: block_fileht -->		
      <tr style="color:{mau}"><td>{j}</td> 
        <td>{t1}&nbsp;</td> 
		 <td>{t2}&nbsp;</td> 
		  <td>{t3}&nbsp;</td> 
		   <td>{t4}&nbsp;</td> 
		    <td>{t5}&nbsp;</td> 
			 <td>{t6}&nbsp;</td> 
			  <td>{t7}&nbsp;</td> 
			  <td>{t8}&nbsp;</td> 
			  <td>{t9}&nbsp;</td> 
			  <td>{t10}&nbsp;</td> 
			  <td>{t11}&nbsp;</td> 
			  
      </tr>
	  <!-- END: block_fileht -->	
  </table>
  </div>
 
 </fieldset>

<div style="padding:5px">
<span style="padding-bottom:5px">Ngày
<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="tungay"   id="tungay" class="text" style="width:65px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmcongnoncc.tungay,'dd/mm/yyyy',this)" />&nbsp;đến 
<input onkeypress="return chuyentieps(event,'luachon')" type="text" name="denngay"  id="denngay" title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" class="text" style="width:65px" value="{denngay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmcongnoncc.denngay,'dd/mm/yyyy',this)" /></span>
<input value="1" type="hidden"  name="luachon2"  id="luachon2"  style="width:147px"   >
<select onkeypress="return chuyentieps(event,'loaitk2')" name="loaitkt"  id="loaitkt"  style="width:140px" >
 <option value="0" >Chọn loại tài khoản</option>
   	   	  <option value="1" >Nợ tiền hàng</option>
    	  <option value="2" >Thanh toán tiền hàng</option>
  </select>   
<select onkeypress="return chuyentieps(event,'loaitk2')" name="nhomtk"  id="nhomtk"  style="width:280px" >
 <option value="0" >Chọn nhà Cung Cấp</option>
   	  			{nhacungcap}
  </select>
</select>

 
    <input type="hidden" name="taikhoan2"  id="taikhoan2"  >
     
    
    
   Diễn giải
   <input type="text" title="Click đôi để xoá trắng" name="lydo2" id="lydo2"  class="text" size="20" value=""  onkeypress="return chuyentiep(event,'loaitk')" ondblclick="xoatrang(this)"/>
   <input type="button"   style="width:50px"  onclick="timphieu(tungay.value,denngay.value,2,nhomtk.value,loaitkt.value,lydo2.value,0)"  name="search2"  id="search2" value="Tìm" />
</div>
	  <div id="hienthitim" align="center">
 	    <table width="100%" border="0" cellpadding="0" cellspacing="0">		
				    <tr bgcolor="#F8E4CB">
				      <td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
				      <td width="131" align="center" class="cothienthi" title="Ngày chứng từ"><strong>Ngày CT</strong></td>  
				      <td width="150" align="center" class="cothienthi"><strong><strong><strong>Số chứng từ</strong></strong></strong> </td> 	   
				      <td width="140" align="center" class="cothienthi"><strong><strong>Số tiền</strong></strong></td> 
				      <td width="489" align="center" class="cothienthi"><strong>Lý do</strong></td>
				      <td width="164" align="center" class="cothienthi"><strong><strong>Người lập phiếu</strong> </strong></td>	    	      
	      </tr>
				    <tr bgcolor="#FFFFFF">
				      <td class="cothienthi"    align="right">&nbsp;</td>				
				      <td class="cothienthi">&nbsp;</td>
				      <td class="cothienthi">&nbsp;</td>
				      <td class="cothienthi">&nbsp;</td>
				      <td class="cothienthi">&nbsp;</td>
				      <td class="cothienthi">&nbsp;</td>
	      </tr>
	    </table>
				  <div style="height:300px"></div>
	  </div>
	
</form>
  



  
</div></fieldset></div>
<div id="ketqualuu" style="display:"></div>
</div>
  
 
<script language="javascript" type="text/javascript" >
function kiemtra()
{
	if (document.getElementById('loaitaikhoan').value==0 )
	{ 	
	 
		 
	}
	//var ob = document.getElementById('nhacungcap') ;
	// var ten =ob.options[ob.selectedIndex].text ;
	// var n = confirm("Bạn có muốn xóa hết dữ liệu cũ của " + ten + " để lấy dữ liệu mới không ?");
    //  if (n == false) return ;
}
 </script>
