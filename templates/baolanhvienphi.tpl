 <style>
 #poup_info{
 	    position: fixed;
    width: 100%;
    height: 100vh;
    top: 0;
    display: none;
    left: 0;
    align-items: center;
    justify-content: center;
    flex-direction: column;
	
 }
 .text-danger{
 	color:#ed2c29 !important;
 }
 .text-info{
 	color:#31708f !important;
 }
 .btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.btn-danger {
    color: #fff;
    background-color: #d9534f;
    border-color: #d43f3a;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
.btn-warning {
    color: #fff;
    background-color: #f0ad4e;
    border-color: #eea236;
	}
#responsivetable {
    width: 60%;
    background-color: #ffffff;
    border: 1px solid;
    padding: 1em;
    height: 90%;
    overflow-y: scroll;
 }
  #responsivetable table tr th{
  	border:1px solid #999999;
	padding-left:1em;
	    text-align: left !important;
  }
  #responsivetable table tr th input{
  	    border: none;
    min-height: 30px;
    width: 100%;
	font-size:14px;
  }
  #responsivetable table tr th input:focus{
  	border:none;
  }
  #responsivetable table {
  	width:100%;
  }
  
  #close_pop{
  	display:flex;
	justify-content: flex-end;
  }
  .action button{
  	margin:1em;
  }
 </style>
	
   <!-- BEGIN: block_kh_poup -->
    <div style="margin: 10px 0px 10px 10px;" id="poup_info" class="poup_info" data-id="{ID}">
        
         <div id="responsivetable">
		  <table>
             <tr>
                 <th colspan="13" id="close_pop"><button class="btn btn-warning" onclick="closepoup()">Đóng</button></th>
             </tr>
         </table>
		
             <form action="" method="post">
                 <table>
                     <tr>
                         <th class="text-danger"> Số hợp đồng </th>
                         <th><input type="text" value="{sohopdong}" /></th>
                     </tr>
                     <tr>
                         <th class="text-danger"> Thời hạn </th>
                         <th><input type="date" value="{thoihanhieuluc}" /></th>
                     </tr>
                     <tr>
                         <th class="text-danger">Năm sinh </th>
                         <th><input type="date" value="{namsinh}"  /></th>
                     </tr>
                     <tr>
                         <th class="text-danger"> Tên công ty </th>
                         <th><input type="text"  value="{tencongty}"  />
                         </th>
                     </tr>
                     <tr>
                         <th class="text-danger"> Số CMND </th>
                         <th><input type="text"  value="{socmnd}"  /></th>
                     </tr>
                     <tr>
                         <th class="text-danger"> Ngày khám </th>
                         <th><input type="date" class="text-info" value="{ngaykhambenh}" />
                         </th>
                     </tr>
                     <tr>
                         <th class="text-danger"> Chuẩn đoán</th>
                         <th><input type="text" class="text-info"  value="{chuandoanbenh}"  /></th>
                     </tr>
                     <tr>
                         <th class="text-danger"> Tiền khám</th>
                         <th><input type="text" class="text-info" value="{tienkham}"  /></th>
                     </tr>
					   <tr>
                     <th class="text-danger"> Xét nghiệm</th>
                     <th><input type="text" class="text-info"  value="{xetnghiem}"  /></th>
                     	 </tr>
					 <tr>
                         <th class="text-danger"> Tiền thuốc</th>
                         <th><input type="text"  class="text-info"  value="{tienthuoc}"  /></th>
                     </tr>
                     <tr>
                         <th class="text-danger"> Chi phí khác</th>
                         <th><input type="text" class="text-info"  value="{chiphikhac}"  /></th>
                     </tr>
                     <tr>
                         <th class="text-danger"> Tổng tiền</th>
                         <th><input type="text" class="text-info" value="{tongcong}" /></th>
                     </tr>
					  <tr>
                         <th class="text-danger"> Ghi chú</th>
                         <th><input type="text" class="text-info" name="ghichu{ID}" id="ghichu{ID}" value="{ghichubaohiem}" /></th>
                     </tr>
					    <tr>
                         <th >Thời gian chờ</th>
                         <th><input type="text" class="text-info" name="" id=""/></th>
                     </tr>
					    <tr>
                         <th >Có tham gia năm trước</th>
                         <th><input type="text" class="text-info" name="" id=""/></th>
                     </tr>
					    <tr>
                         <th >Tình trạng xác minh phí</th>
                         <th><input type="text" class="text-info" name="" id="" /></th>
                     </tr>
					    <tr>
                         <th >Xác nhận của nhân sự</th>
                         <th><input type="text" class="text-info" name="" id=""/> </th>
                     </tr>
					  <tr>
                         <th >BMI đồng ý bảo lãnh</th>
                         <th><input type="text" class="text-info" name="" id=""/></th>
                     </tr>
                     <tr>
                         <th></th>
                         <th class="action">
						  <div id="reskhonghienthi"></div>
						 <button type="button" class="btn btn-danger" name="" id="tuchoi" onclick="tuchoibh({ID})">Từ chối</button>
						 <button type="button" class="btn btn-success" name="" id="xacnhan" onclick="xacnhanbh({ID})">Xác nhận</button>
						 </th>
                     </tr>
                 </table>
             </form>
			
         </div>
     </div>
   <!-- END: block_kh_poup -->

 <script>
 	function showpoup(id){
		$(".poup_info").each((index,item)=>{
			var dataid=item.getAttribute("data-id");
			if(dataid==id){
				item.style.display="flex";
			}
		});
	}
 	function closepoup(){
		$(".poup_info").css("display","none");
	}	
	
	
	function xacnhanbh(id){
		if(checkGhichu(id)){
			var ghichu=checkGhichu(id);
			if(thongbao("Bạn muốn xác nhận bảo lãnh!")){
				
				guiaction(id,1,ghichu);
			}
		}
		return;
	}
	
	
	function tuchoibh(id){
		if(checkGhichu(id)){
			var ghichu=checkGhichu(id);
			if(thongbao("Bạn có muốn từ chối!")){
				guiaction(id,0,ghichu);
			}
		}
		return;
	}
	function checkGhichu(id){
		var ghichu=$("#ghichu"+id).val();
		
		if(!ghichu){
			$("#ghichu"+id).css("border","1px solid red");
			return;
		}
		return ghichu;
	}
	function guiaction(id,sign,ghichu){
		var poststr = "TINHTRANG=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(sign)+"*@!" + encodeURIComponent(ghichu);
			loadtrang('reskhonghienthi', "updatetinhtrangbh", poststr, "xuly1");
	}
	
	function xuly1(){
		var tam=document.getElementById("reskhonghienthi").innerHTML;
		if(tam){
			if(tam[0]==-1){
				alert("Có lỗi xảy ra!");
			}
			else{
				tam=tam.split("-");
				
				if(tam[0]==0){
					alert("Từ chối thành công!");
					$("#ghichu_ht"+tam[1]).html("Không xác nhận");
				}
				if(tam[0]==1){
					alert("xác nhận thành công!");
					$("#ghichu_ht"+tam[1]).html("Đã xác nhận");
					
				}
				$("#ghichu"+tam[1]).val("");
				closepoup();
			}
		}
		
	}
	function thongbao(str){
		return confirm(str);
	}
 </script>
<div class="nenbao">
<fieldset  class="nencon"> 
	<legend>Bảo Lãnh Viện Phí</legend>
 <!-- BEGIN: block_khht1 --><form name="frmbaolanhvienphi1" method="post">
 <div style="padding:5px;">
<b style="display:{q_them}"> [ <a href="?act=baolanhvienphi&id=-1">Thêm Mới</a>]</b> [<a href="?act=md">Đóng Lại</a>]Tên
        <input type="text" name="NameS" class="text" size="10" value="{NameS}" />
        Mã
        <input type="text" name="manhomhangS" class="text" size="10" value="{manhomhang}" />
        
        <input type="submit" name="search" value="Tìm kiếm" /></div>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">
     
    <tr bgcolor="#F8E4CB">
      <td align="center" style='' height="23" width="77"><b>STT</b></td>
      <td width="380" align="center"><strong>Số hợp đồng</strong></td>
      <td width="178" align="center"><strong>Thời gian hiệu lực</strong></td>
      <td width="178" align="center"><strong>Năm sinh</strong></td>
      <td width="385" align="center"><strong>Tên công ty</strong></td>
      <td width="178" align="center"><strong>Số CMDD</strong></td>
      <td width="113" align="center" style='display:{q_luu};' ><strong>Ngày khám</strong></td>
      <td width="79" align="center" style='display:{q_xoa;'><strong>Chuẩn đoán bệnh</strong></td>
       <td width="79" align="center" style='display:{q_xoa;'><strong>Tiền khám</strong></td>
	   <td width="79" align="center" style='display:{q_xoa;'><strong>Xét nghiệm</strong></td>
	   <td width="79" align="center" style='display:{q_xoa;'><strong>Tiền thuốc</strong></td>
	   <td width="79" align="center" style='display:{q_xoa;'><strong>Tiền khác</strong></td>
            <td width="79" align="center" style='display:{q_xoa;'><strong>Đồng ý-từ chối</strong></td>
                         
        <td width="60" align="center" style='display:{q_capnhap};' ><strong>C&#7853;p nh&#7853;p</strong></td> 
      <td width="79" align="center" style='display:{q_xoa;'><strong>Xóa</strong></td>
    </tr>
    <!-- End: block_khht1 -->
    <!-- BEGIN: block_khht -->
    <tr bgcolor="{color}" onclick="showpoup('{ID}')" style="cursor:pointer">
      <td  align="left">&nbsp;{stt}</td>
      <td valign="middle"   >&nbsp;{sohopdong}</td>
      <td valign="middle"   >&nbsp;{thoihanhieuluc}</td>
      <td valign="middle"   >&nbsp;{namsinh}</td>
      <td valign="middle"   >&nbsp;{tencongty}</td>
      <td valign="middle"   >&nbsp;{socmnd}</td>
    <td valign="middle"   >&nbsp;{ngaykhambenh}</td>
    <td valign="middle"   >&nbsp;{chuandoanbenh}</td>
      <td valign="middle"   >&nbsp;{tienkham}</td>
        <td valign="middle"   >&nbsp;{xetnghiem}</td>
		 <td valign="middle"   >&nbsp;{tienthuoc}</td>
		  <td valign="middle"   >&nbsp;{chiphikhac}</td>
           <td valign="middle"  id="ghichu_ht{ID}" >&nbsp;{dongy_tuchoi}</td>
      			<td align="center"  style="display:{q_capnhap};">
				<a href = "default.php?act=baolanhvienphi&id={ID}"> <img src = "images/book_addressHS.png" border = "0" ></a></td>
                
      <td  align="center" style="display:{q_xoa}; mso-border-alt:solid windowtext .5pt;">  <a onclick='return ask()' href="default.php?act=baolanhvienphi&Del={ID}"><img src="images/delete.gif" border = "0"></a></td>	
      
    </tr>
    <!-- End: block_khht -->
    <!-- BEGIN: block_khht2 -->
  </table>
  <input type="hidden" name="currentPage"/>
</form>
<!-- End: block_khht2 -->


<!-- BEGIN: block_kh -->
<form name="frmnhomhang" method="post">
<table width="100%" border="0">
<tr>
	<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px" ><h3>{t-c}</h3><input name="id" type="hidden" value="{idgoi}" /></td>
</tr>
<tr>
	<td width="14%">mã hồ sơ</td>
	<td width="86%"><input type="Text" name="idhoso" class="text" size="50" value="{sohopdong}" />    
	  * 	</td>
</tr>
<tr>
	<td width="14%">mã bệnh viện</td>
	<td width="86%">	<input type="Text" name="idbv" class="text" size="10" value="{thoihanhieuluc}"> 
	  * 	</td>
</tr>
<tr>
	<td width="14%">viện phí ước tính</td>
	<td width="86%">	<input type="Text" name="vienphiuoctinh" class="text" size="10" value="{namsinh}"> 
	  </td>
</tr>
<tr>
	<td>nguyên nhân</td>
	<td>
		<input type="Text" name="nguyennhan" class="text" size="90" value="{tencongty}">	</td> 
</tr>
 <tr>
	<td>dự toán viện phí</td>
	
	<td>
		<input type="Text" name="dutoanvienphi" class="text" size="90" value="{socmnd}">	</td> 
</tr>
 <tr>
	<td>dự toán chi phí</td>
	
	<td>
		<input type="date" name="dutoanchiphi" class="text" size="90" value="{ngaykhambenh}">	</td> 
</tr>
<tr>
	<td>dự toán chi phí</td>
	
	<td>
		<input type="Text" name="dutoanchiphi" class="text" size="90" value="{chuandoanbenh}">	</td> 
</tr>
<tr>
	<td>dự toán chi phí</td>
	
	<td>
		<input type="Text" name="dutoanchiphi" class="text" size="90" value="{tienkham}">	</td> 
</tr>
<tr>
	<td>dự toán chi phí</td>
	
	<td>
		<input type="Text" name="dutoanchiphi" class="text" size="90" value="{xetnghiem}">	</td> 
</tr>
<tr>
	<td>dự toán chi phí</td>
	
	<td>
		<input type="Text" name="dutoanchiphi" class="text" size="90" value="{tienthuoc}">	</td> 
</tr>
<tr>
	<td>dự toán chi phí</td>
	
	<td>
		<input type="Text" name="dutoanchiphi" class="text" size="90" value="{chiphikhac}">	</td> 
</tr>

 <tr>
	<td>đồng ý-từ chối</td>
	
	<td>
		<input type="Text" name="dongy_tuchoi" class="text" size="90" value="{dongy_tuchoi}">	</td> 
</tr>

<tr>
	<td>ngày ký</td>
	
	<td>
		<input type="date" name="ngayky" class="text" size="90" value="{ngayky}">	</td> 
</tr>
<tr>
	<td>ngày tạo</td>
	
	<td>
		<input type="date" name="ngaytao" class="text" size="90" value="{ngaytao}">	</td> 
</tr>
<tr>
	<td>nhân viên</td>
	
	<td>
		<input type="Text" name="nhanvien" class="text" size="90" value="{nhanvien}">	</td> 
</tr>

<tr>
	<td>note</td>
	
	<td>
		<input type="Text" name="note" class="text" size="90" value="{ghichubaohiem}">	</td> 
</tr>

<tr>
	<td>dự toán bảo lãnh viện phí</td>
    <td>
    	<input type="text" name="dtbaolanhvienphi" class="text" size="90" value="{dtbaolanhvienphi}" /></td>
</tr>
<tr>
	<td>dự toán bảo lãnh chi phí</td>
    <td>
    	<input type="text" name="dtbaolanhchiphi" class="text" size="90" value="{dtbaolanhchiphi}" /></td>
        </tr>

<tr>
<tr>
	<td>ngày làm bảo lãnh</td>
    <td>
    	<input type="text" name="ngaylambl" class="text" size="90" value="{ngaylambl}" /></td>
        </tr>

<tr>
	<td colspan="2">
		<input type="Submit" class="text" name="btnUpdate" onclick="return kiemtra()"  value="Cập nhập"> <input type="submit" class="text" name="cancel" value="Quay Lại" />	</td>
</tr>
</table>	
</form>

<!-- END: block_kh -->
<!-- BEGIN: block_khupdate -->
<script language="JavaScript">
alert('Cập nhập  thành công');
location.replace("default.php?act=baolanhvienphi");
</script>
<!-- END: block_khupdate -->

<!-- BEGIN: block_ajack -->
<script language="javascript">

function makeObject(){
var x;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
x = new ActiveXObject("Microsoft.XMLHTTP");  
}else{
x = new XMLHttpRequest();
}
return x;
}
 
var request = makeObject();
 

//============================================================

 
function findtemp(id)
{		
   	request.open('get', 'findtemp.php?id='+id);
 
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = outputfindtemp;
 
	request.send('');
}

function outputfindtemp()
{ 
	if(request.readyState == 1)
	
	{ 		//You can add animated gif while loading //
		//document.getElementById('temp').innerHTML = "<p>&nbsp;</p><p align='left' style='padding-left:200'><img               src='images/downloading.gif'></p>";
	}
	if(request.readyState == 4)
	{ 
 		var data = request.responseText;
 
       document.getElementById('templa').innerHTML =data;
   	}
}
 
function ask()
{
	var n = confirm("Bạn có muốn xóa không");
	if(n == false)
	{
		return false;
			
	}
}
 

</script>
<!-- END: block_ajack -->
<script language="JavaScript">

function trim(str)
{
	ch = '';
	for(i=0;i<str.length;i++)
	{
		cha = str.charAt(i);
		if(cha != ' ')
		{
			ch = ch + cha;
		}
	}
	return ch;
}

 function kiemtra()
{

  if (trim(document.forms['frmnhomhang'].Name.value) =='')
	{
		alert ('Bạn chưa nhập Tên !') ;
		document.forms['frmnhomhang'].Name.focus() ;
		return false ;

	}
  if (trim(document.forms['frmnhomhang'].manhomhang.value) =='')
	{
		alert ('Bạn chưa nhập mã  loại hàng') ;
		document.forms['frmnhomhang'].manhomhang.focus() ;
		return false ;

	}	
	return true ;
}

 </script>
 <!-- BEGIN: block_khongxoa -->
<script language="JavaScript">

function thongbaoxoa()
{
	var n = confirm("Bạn có chắc chăn xóa sản phảm này không ?");
	if(n == false)
	{
		return false;
 	}
}

  
 
function ask()
{
	var n = confirm("Bạn có muốn xóa không ?");
	if(n == false)
	{
		return false;
 	}
}
 
alert('Bạn không thể xóa nhóm hàng này do đã có nơi   sử dụng nhóm hàng này rồi !!! ');
 </script>
<!-- END: block_khongxoa -->
 </fieldset></div>