 
 
<form name="frmProduct1" id="frmProduct1" method="post">
<div class="nenbao">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:14px;" >Phiếu tăng ca</label></a>
    </legend>
 <!-- BEGIN: block_cusht1 -->

			<b style="display:{q_them}">	[<a href="?act=phieutangca&id=-1">Thêm Mới</a>]</b>&nbsp;&nbsp;&nbsp;[<a href="?act=md">Đóng Lại</a>] &nbsp;
			<div style="padding:5px">&nbsp;
              Mã NV
              <input type="text" name="manv" id="manv" class="inpl" ondblclick="this.value=''" style="width:110px" onkeypress="return chuyentiep(event,'nhacct')"   value="{manv}" />
	  Cửa hàng
	  <select onkeypress="return chuyentiep(event,'idnhan')" name="cuahangtim"  id="cuahangtim"  style="width:190px" title="cửa hàng">
  {tatca} 
  	{kho}
  </select>
<select onkeypress="return chuyentiep(event,'idnhan')" name="tinhtrang"  id="tinhtrang"  style="width:90px" title="cửa hàng">
  <option value="" >Tình trạng</option>
  <option  {tinhtrang1} value="1">Quản lý đã duyệt</option>
  <option  {tinhtrang2} value="2">Chưa duyệt</option>
  <option  {tinhtrang3} value="3">Không duyệt</option>
  <option  {tinhtrang4} value="4">Đã duyệt</option>
</select>
 Ngày
<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="tungay"   id="tungay" class="text" style="width:67px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmProduct1.tungay,'dd/mm/yyyy',this)" />đến<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="denngay"   id="denngay" class="text" style="width:67px"  value="{denngay}" /><img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmProduct1.denngay,'dd/mm/yyyy',this)" />		
<input type="submit"   onfocus="setrong()"   name="search"  id="search" value="Tìm kiếm" /></div>

	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
  		
    <tr bgcolor="#F8E4CB">
			<td align="center" height="23" width="38"><b>STT</b></td>
				<td align="center" height="23" width="38"><b>SP</b></td>
             <td width="75" align="center"><strong>Ngày Tạo</strong></td>  
              <td width="80" align="center"><strong>Ngày Duyệt</strong></td> 
 			 <td width="154" align="center" ><strong>Tên Của Hàng</strong></td>      
       <td width="80" align="center"><strong>Mã NV </strong></td>
	  <td width="114" align="center"><strong>Tên NV </strong></td>
      
      <td width="136" align="center"><strong>Thời gian tăng ca</strong></td> 
	  <td width="51"  align="center"><strong>Số Giờ</strong></td>
	   <td width="82" align="center" ><strong>Tình trạng</strong></td> 
	   <td width="150" align="center"><strong>Lý do</strong></td> 
		<td width="228" align="center"><strong>Lý do GS</strong></td> 
		<td width="78" align="center"><strong>Lý do NS</strong></td>       
		 <td width="36" align="center" ><strong>Cập nhập </strong></td>
      <td width="39" align="center" ><strong>Xóa</strong></td>
	  </tr>	
<!-- End: block_cusht1 -->	
<!-- BEGIN: block_cusht -->	
<tr bgcolor="{color}"><td align="right">{stt}</td>
<td  title="{tinhtranggoc}">{ID} </td>
<td >{ngaytao} </td>

<td >{ngayduyet} </td>

 <td >{tencuahang} </td>
 <td >{manhanvien} </td>		
<td ><strong>{tennhanvien}</strong> <br /> {chucvu} </td>
 
<td >{thoigiantangca} </td>
<td >{sogio} </td>
 <td >{tinhtrang} </td>		
 <td >{lydo}</td> 
 <td >{lydogs}</td>
 <td >{lydons}</td>
 <td align="center"   > <a href = "?act=phieutangca&id={ID}"><img src = "images/book_addressHS.png" border = "0" ></a> </td>
 <td align="center">  <a onclick='return ask()' href="?act=phieutangca&Del={XOA}"><img src="images/delete.gif" border = "0"></a></td>								
 </tr>
<!-- End: block_cusht -->	

<!-- BEGIN: block_cusht2 -->	
	<tr style="padding-top:10">
	  <td align="right" colspan="13"> {list_page}</td>
	</tr>
	</table>
	<input type="hidden" name="currentPage"/>
<!-- End: block_cusht2 -->


<!-- BEGIN: block_cus -->
 
<table width="100%" border="0" cellpadding="5">
<tr>
	<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px" ><h3>{t-c}</h3><input name="id" id="id" type="hidden" value="{idgoi}" /></td>
</tr>
 
<tr>
	<td width="14%">
		Tên cửa hàng </td>
	<td width="86%">
	<strong>{tencuahang} </strong>  <!-- BEGIN: block_admin --> 
	<select onkeypress="return chuyentiep(event,'search')" name="cuahang"  id="cuahang" style="width:360px">
    <option value="">Chọn cửa hàng</option>
       {kho}
  </select>
      <!-- END: block_admin --> 
      
      <!-- BEGIN: block_cuahang -->   
       <input id="cuahang" name="cuahang" type="hidden" value="{cuahang}"  />
       <!-- END: block_cuahang --> 
    </td>
</tr>
<tr>
	<td width="14%">Nhân viên</td>
	<td width="86%"> 
	   
	  <select onkeypress="return chuyentiep(event,'search')" class="js-nv" onchange="manv.value=this.value"  name="nhanvien"  id="nhanvien" style="width:360px">
	    <option value="">Chọn nhân viên</option>
        {nhanvienonline}
	  </select>
	  <input id="chonggoilai" name="chonggoilai" type="hidden" value="{chonggoilai}"  />
 
        </td>
</tr>
<tr>
	<td >Thời gian bắt đầu tăng ca</td>
	<td ><input id="thoigianbatdau" name="thoigianbatdau"  type="datetime-local" class="text"  ondblclick="this.value=''" value="{thoigianbatdau}">* SA: sáng trưa - CH: chiều tối</td>
</tr>
<tr>
	<td >Thời gian kết thúc tăng ca</td>
	<td ><input id="thoigianketthuc" name="thoigianketthuc"  type="datetime-local" class="text" ondblclick="this.value=''"  value="{thoigianketthuc}">* SA: sáng trưa - CH: chiều tối</td>
</tr>
<tr>
	<td >Lý Do</td>
	<td ><textarea id="lydo" name="lydo" class="texta" style='width:650px;height:70px'>{lydo}</textarea></td>
</tr>
<tr>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td height="34" colspan="2">
		<input type="Submit" onfocus="setrong()" onclick="return kiemtra()" class="text" name="btnUpdate" id="btnUpdate" value="Cập nhập"> <input type="submit" class="text" name="cancel" id="cancel" value="Quay Lại" /> 
		<input type="button" name="inan2" id="inan2"   onclick="window.close()" value="Đóng Lại" style="width:80px;display:{donglai}"/>		  </td>
</tr>
</table>	

 </fieldset>
 </div>
</form>

<script language="javascript">
document.getElementById('type1').focus();
</script>
<!-- END: block_cus -->

<div id="khonghienthi" style="display:none"></div>


<!-- BEGIN: block_cusupdate -->
<script language="JavaScript">
alert('Cập nhập thành công');
location.replace("?act=phieutangca");
</script>
<!-- END: block_cusupdate -->

<!-- BEGIN: block_khongxoa -->
<script language="JavaScript">
alert('Bạn không thể xóa cửa hàng này do đã có thông tin liên quan đến cửa hàng này!!! ');
 </script>
<!-- END: block_khongxoa -->
 
 
 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">
 
	$(document).ready(function() {
	    $('.js-nv').select2();
	 
	});
	
 
 

//============================================================

var  capnhap= '' ;
 
  
function ask()
{
	var n = confirm("Bạn có muốn xóa không");
	if(n == false)
	{
		return false;
			
	}
}
//=======================



function timkiem()
{
  document.getElementById('search').value = "search" ;
  document.forms.frmProduct1.submit() ;
}
function settype(valu)
{
	document.getElementById('dachon').value =  valu ;
}


function kiemtra()
{
//   if (capnhap != '') { return false ;}
 	if(document.getElementById('nhanvien').value == "")
	{
		alert('Bạn chưa chọn nhân viên') ;
		document.getElementById('nhanvien').focus() ;
		return false;			
	}
	if(document.getElementById('thoigianbatdau').value == ""   )
	{
		alert('Bạn chưa nhập thời gian bắt đầu !') ;
		document.getElementById('thoigianbatdau').focus() ;
		return false;			
	}
	if(document.getElementById('thoigianketthuc').value == ""   )
	{
		alert('Bạn chưa nhập thời gian kết thúc !') ;
		document.getElementById('thoigianketthuc').focus() ;
		return false;			
	}

	if(document.getElementById('lydo').value == ""   )
	{
		alert('Bạn chưa nhập lý do !') ;
		document.getElementById('lydo').focus() ;
		return false;			
	}

	return true;
}

function xuly1()
{
	var tam=document.getElementById('khonghienthi').innerHTML ;
  	var  n=tam.split("###"); 
 	if (n[1]=="-1") {alert(n[2]); document.getElementById('thongtin').innerHTML=''; document.getElementById('tuvansai').value=0;
	document.getElementById('sochungtu').value ='';return; }
	document.getElementById('thongtin').innerHTML= n[7];   
	document.getElementById('tuvansai').value= n[5]; 	
	document.getElementById('idcuahang').value= n[6]; 
	
  
   
}
function kiemtraphieu(t1)
{ 	
   if(t1=='') return;
   poststr="DATA="+ encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
  
   loadtrang('khonghienthi',"kiemtracobill", poststr,"xuly1") ;
}


</script>
