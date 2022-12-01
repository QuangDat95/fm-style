<div class="nenbao">
<fieldset  class="nencon" style="padding:5;margin:0">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >Thưởng Đề Xuất</label>
	</a></legend>
 
<!-- BEGIN: block_khht1 --><form name="frmProduct1" method="post" style="padding:0;margin:0">
	<table width="100%" border="0" cellpadding="0" class="tbchuan" cellspacing="0">		
 		<tr>
			<td colspan = "8">
				[ <a href="?act=thuong&id=-1">Thêm Mới</a>]&nbsp;&nbsp;[<a href="?act=md">Đóng Lại</a>]&nbsp;&nbsp;Tên 
				<input type="text" name="NameS" class="text" size="10" ondblclick="this.value=''" value="{NameS}" />&nbsp;
				<select id="thangtim" name="thangtim" >
                 <option value="0" >ALL</option>
                <!-- BEGIN: block_thang -->
				  <option value="{thangt}"  {thangse}>Tháng {thangt}</option> <!-- END: block_thang -->
                 
			  </select>
				&nbsp; Năm
                <select id="namtim" name="namtim" >
                <!-- BEGIN: block_nam -->
				  <option value="{namt}"{namse} >Năm {namt}</option> <!-- END: block_nam -->
                  <option value="0" >ALL</option>
			  </select>
				&nbsp;
				<input type="submit" name="search" id="search" value="Tìm kiếm" />
		  </td>
		</tr>	
		 		
		<tr bgcolor="#F8E4CB">
			<td align="center"  height="23" width="48"><b>STT</b></td>
<td width="76"  align="center"><strong>Tháng</strong></td>	  
 <td width="286"  align="center"><strong>Tên Nhân viên</strong></td>
  <td width="76"  align="center"><strong>Code</strong></td>  
 <td width="26"  align="center"><strong>Số Tiền</strong></td>  
  <td width="506"  align="center"><strong>Lý Do</strong></td>  
       <td width="94" align="center" style='' ><strong>C&#7853;p nh&#7853;p</strong></td>
      <td width="118" align="center" style=''><strong>X&#243;a</strong></td>
		</tr>	
<!-- End: block_khht1 -->	
<!-- BEGIN: block_khht -->	
				<tr bgcolor="{color}">
				<td  align="right">{stt}</td>
				<td >{thang} </td>
			    <td  >{ten} </td>
                <td> {code} </td>
				<td  align="right" >{sotien} </td>
                <td>{Name} </td>
				<td align="center"  > 
				<a href = "?act=thuong&id={ID}"> <img src = "images/book_addressHS.png" border = "0" ></a> </td>


				<td  align="center">  <a onclick='return ask()' href="?act=thuong&Del={ID}"><img src="images/delete.gif" border = "0"></a></td>								
				</tr>
<!-- End: block_khht -->	

<!-- BEGIN: block_khht2 -->	
	<tr style="padding-top:10"><td align="right" colspan="8"> {list_page}</td></tr>
	</table>
	<input type="hidden" name="currentPage" id="currentPage"/>
</form>
<!-- End: block_khht2 -->


<!-- BEGIN: block_kh -->
<div style="float:left;width:470px"> 
<form name="frmkho" method="post" style="width:470px">
<table width="100%" border="0" align="left">
<tr> 
	<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px" ><h3>{t-c}</h3><input name="id"  id="id" type="hidden" value="{idgoi}" /></td>
</tr>
<tr>
	<td width="22%"></td>
	<td width="78%">	 
	 
	  </td>
</tr>

<tr>
	<td width="22%">Tên nhân viên</td>
	<td width="78%">	 
	  <input type="Text" name="ten"  ID="ten"  class="text" size="40" value="{ten}" readonly="readonly" />
	  <span style="color:#FF6600;padding-bottom:10px">
	  <input name="idnhanvien"  id="idnhanvien" type="hidden" value="{idnhanvien}" />
	  </span>	  </td>
</tr>
<tr>
	<td width="22%">Code</td>
	<td width="78%"><input type="text" readonly="readonly" name="code"  id="code"  class="code" size="20" value="{code}" /></td>
</tr>
<tr>
	<td width="22%">Lý Do thưởng</td>
	<td width="78%">	 
	  <input type="Text" ID="Name" name="Name" class="text" size="40" value="{Name}" />
	  *      </td>
</tr>
<tr>
	<td width="22%">Số Tiền</td>
	<td width="78%">	 
	  <input type="Text" name="sotien"  ID="sotien"  class="text" size="10" value="{sotien}"   onkeyup ="txtFormat(this); "    onblur="txtFormat(this)"/>
	  </td>
</tr>
<tr>
	<td >Tháng </td>
	<td ><select id="ngay" name="ngay" >
       <option  value="{thangtruoc}" {ngay1}>{thangtruoc}</option>
       <option value="{thanghientai}" {ngay2}>{thanghientai}</option>
       
    </select>
    </td>
</tr>
<tr>
	<td colspan="2">
		<input type="Submit" class="text" name="btnUpdate" onclick="return kiemtra()"  value="Cập nhập"> <input type="button" onclick="nhay('thuong')" class="text" name="cancel" value="Quay Lại" />	</td>
</tr>
</table>	
</form>
</div>
<div style="float:right;width:480px;padding:3px;background-color:#F7FFF7;height:500px;border:1px solid #999 " align="left">
Tìm nhân viên
 <input type="Text" ID="tentim" name="tentim" class="text" size="20" value="{tentim}" /> Code <input type="Text" ID="codetim" name="codetim" class="text" size="10" value="{codetim}" />
	  <input type="button" class="text" name="tim" id="tim"  onclick="timnhanvien(0,tentim.value,codetim.value)"  value="Tìm" />
 <div id="htnhanvien"></div>
</div>

<!-- END: block_kh -->
<!-- BEGIN: block_khupdate -->
<script language="JavaScript">
alert('Cập nhập thành công');
location.replace("?act=thuong");
</script>
<!-- END: block_khupdate -->

 
<script language="javascript">
function nhay (trang)
{
 location.replace("?act="+ trang);
}
  
function ask()
{
	var n = confirm("Bạn có muốn xóa không");
	if(n == false)
	{
		return false;
 	}
}
 function setnhanvien(id,code,ten)
{
	document.getElementById('idnhanvien').value = id ;
	document.getElementById('ten').value = ten ;
	document.getElementById('code').value = code ;
}
 function timnhanvien(t,ten,code)
{
 
  poststr="DATA="+  t + "*@!"+  encodeURIComponent(ten)+  "*@!"+ encodeURIComponent(code)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
   loadtrang('htnhanvien',"timnhanvien", poststr,"") ;
  
}
 function kiemtra()
{
	 if (trim(document.getElementById('idnhanvien').value) =='')
	{
		alert ('Bạn chưa nhập chọn nhân viên ') ;
		document.getElementById('tim').click() ;
		return false ;

	}	
  if (trim(document.getElementById('Name').value) =='')
	{
		alert ('Bạn chưa nhập lý do ') ;
		document.getElementById('Name').focus() ;
		return false ;

	}	
  if (trim(document.getElementById('sotien').value) =='')
	{
		alert ('Bạn chưa nhập nhập số tiền ') ;
		document.getElementById('sotien').focus() ;
		return false ;

	}	

 	return true ;
}
 function goitim()
{
	document.getElementById('search').click() ;
}
{timkiem}
 </script>
 
 </fieldset></div>