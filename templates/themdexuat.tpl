 
 
<form name="frmProduct1" id="frmProduct1" method="post" enctype="multipart/form-data">
<div class="nenbao">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:14px;" >Đề xuất</label></a>
    </legend>
 <!-- BEGIN: block_cusht1 -->

			<b style="display:{q_them}">	[<a href="?act=themdexuat&id=-1">Thêm Mới</a>]</b>&nbsp;&nbsp;&nbsp;[<a href="?act=md">Đóng Lại</a>] &nbsp;
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
<div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
  		
    <tr bgcolor="#F8E4CB">
			<td align="center" height="23" width="38"><b>STT</b></td>
				<td align="center" height="23" width="38"><b>SP</b></td>
             <td width="75" align="center"><strong>Ngày Tạo</strong></td>  
              <td width="80" align="center"><strong>Ngày Duyệt</strong></td> 
 			 <td width="154" align="center" ><strong>Tên Của Hàng</strong></td>      
       <td width="80" align="center"><strong>Mã NV </strong></td>
	  <td width="114" align="center"><strong>Tên NV </strong></td>
      
	  <td width="51"  align="center"><strong>Số Tiền</strong></td>
	   <td width="51"  align="center"><strong>Số lượng</strong></td>
	   <td width="82" align="center" ><strong>Tình trạng</strong></td> 
	   <td width="150" align="center"><strong>Lý do</strong></td> 
		<td width="228" align="center"><strong>Lý do thu mua</strong></td> 
		<td width="78" align="center"><strong>Lý do Kế toán</strong></td> 
		
		<td width="78" align="center"><strong>Lý do giám đốc</strong></td>       
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
 
<td >{sotien} </td>
<td >{soluong} </td>
 <td ><strong>{tinhtrang}</strong> </td>		
 <td style="    max-width: 200px;
    word-break: break-word;">{lydo}</td> 
 <td style="    max-width: 200px;
    word-break: break-word;">{lydothumua}</td>
 <td style="    max-width: 200px;
    word-break: break-word;">{lydoketoan}</td>
 <td style="    max-width: 200px;
    word-break: break-word;">{lydogiamdoc}</td>
 <td align="center"   > <a href = "?act=themdexuat&id={ID}"><img src = "images/book_addressHS.png" border = "0" ></a> </td>
 <td align="center">  <a onclick='return ask()' href="?act=themdexuat&Del={XOA}"><img src="images/delete.gif" border = "0"></a></td>								
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
	<td colspan="5" align="center" style="color:#FF6600;padding-bottom:10px" ><h3>{t-c}</h3><input name="id" id="id" type="hidden" value="{idgoi}" /></td>
	
</tr>
 
<!--<tr>
	<td width="14%">
		Tên cửa hàng </td>
	<td width="86%">
	<strong>{tencuahang} </strong> --> 
	<!-- BEGIN: block_admin --> 
<!--	<select onkeypress="return chuyentiep(event,'search')" name="cuahang"  id="cuahang" style="width:360px">
    <option value="">Chọn cửa hàng</option>
       {kho}
  </select>-->
      <!-- END: block_admin --> 
    <!--<td width="86%">-->
      <!-- BEGIN: block_cuahang -->   
     <!--  <input id="cuahang" name="cuahang" type="hidden" value="{cuahang}"  />-->
       <!-- END: block_cuahang --> 
   <!-- </td>
</tr>-->
<tr>
	<td ><strong>Lý Do</strong></td>
	<td ><input id="lydo" name="lydo" class="texta" value="{lydo}" style="width:100%" required/></td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td width="14%"><strong>Số tiền</strong></td>
	<td width="49%"> 
		<input type="text" onkeyup ="formatchuan(this)" onblur="formatchuan(this)" id="sotien" name="sotien" onchange="fomartso(event)" value="{sotien}" required/>
		
		
		<strong>Số lượng</strong><input type="number" onkeyup ="" onblur="" id="soluong" name="soluong" onchange="changesoluong(this.value)" value="{soluong}" required/> <strong>Tổng tiền: </strong><span id="tongtien" style="color:#FF0000">{tongtien}</span>
        </td>
		<td width="35%" >&nbsp;</td>
	<td width="1%" >&nbsp;</td>
	<td width="1%" >&nbsp;</td>
</tr>


<tr>
	<td ><strong>Ghi chú</strong></td>
	<td ><textarea id="ghichu" name="ghichu" class="texta" style='width:100%;height:70px'>{ghichu}</textarea></td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td ><strong>Hình ảnh</strong></td>
	<td ><input type="file" name="hinhanh[]" accept=".jpeg,.jpg,.png,.bitmap" id="hinhanh" onchange="readURL(this)" multiple /></td>
	<td ><input type="hidden" name="hinhanhc" id="hinhanhc" value="{hinhanhc}"/></td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td >&nbsp;</td>
	<td colspan="4" ><div id="showhinh" style="display:flex">{chuoihinh}</div></td>
	
</tr>
<tr>
	<td height="34" colspan="5">
		<input type="Submit" onfocus="setrong()" onclick="return kiemtra()" class="text" name="btnUpdate" id="btnUpdate" value="Cập nhập">
		 <input type="button" class="text" name="cancel" id="cancel" onclick="history.back()" value="Quay Lại" /> 
		<input type="button" name="inan2" id="inan2"   onclick="window.close()" value="Đóng Lại" style="width:80px;display:{donglai}"/>		  </td>
</tr>
</table>	
	</div>
 </fieldset>
 </div>
</form>

<style>
#showanh{
	display:none;
	width: 100%;
    height: 120vh;
    position: fixed;
    left: 0;
    top: 0;
    align-items: center;
    justify-content: center;
    z-index: 100;
    background-color: #00000045;
}
#showanh_content{
	width:60%;
	height:100%;
	background-color:#FFFFFF;
	
}
#anhdiv{
	    background-color: #FFFFFF;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
	margin-top:-4em;
}
#showanh_content #titl{
	    display: flex;
    justify-content: flex-end;
    padding: 1em;
}
@media all and (min-width: 600px){


}
@media all and (min-width: 1280px){


}
</style>
<div id="showanh">
	<div id="showanh_content"> 
	<div id="titl"><button type="button" id="closepo" onclick="closeshowanh()">x</button></div>
		<div id="anhdiv"></div>
	</div>
</div>



<script language="javascript">
function replaceAll(str, stfind, streplace) {
	var rs='';
 for(var i=0;i<str.length;i++){
 	if(str[i]!=stfind){
		rs+=str[i];
	}
 }
 return rs;
}
function changesoluong(value){
	var sotien =document.getElementById('sotien').value;

	sotien = replaceAll(sotien,',','');
	
	//sotien=sotien.replace(",","").replace(",","").replace(",","");
	sotien=sotien*value;
	
	var sof=txtFormat3(sotien.toString());
	//console.log(sof)
	document.getElementById('tongtien').innerHTML=sof;
	
}
function setimage(url){
	
	//var url =target()
	document.getElementById('anhdiv').style.backgroundImage="url("+url+")";
	showanh();
}

function showanh(){
	document.getElementById('showanh').style.display="flex";
}
function closeshowanh(){
	document.getElementById('showanh').style.display="none";
}
//document.getElementById('type1').focus();
function xoaanh(e){
	var target=e.target;
	var hinh=target.getAttribute("data-name");
	var chuoi='';
	if(confirm('Bạn có muốn xóa ảnh?')){
			var hinhcu= document.getElementById("hinhanhc").value;
				hinhcu=hinhcu.split("*");
				for(var i=0;i<hinhcu.length;i++){
					var el=hinhcu[i];
					if(el!='' && el!=hinh){
							chuoi+="*"+el;
					}
				}
			document.getElementById("hinhanhc").value=chuoi;
			target.parentElement.remove();
	}
}
function fomartso(e){
	var soluong =document.getElementById('soluong').value;
	var target=e.target;
	var value=target.value;
	
	var tien=0;
	if(soluong){
		value=replaceAll(value,',','');
		tien=value*soluong;
	}
	//console.log(tien);
	var sof1=txtFormat3(value.toString());
	var sof=txtFormat3(tien.toString());
	target.value=sof1;
	document.getElementById('tongtien').innerHTML=sof;
}

function readURL(input) {
var hinhcu= document.getElementById("hinhanhc").value;
if(!hinhcu){
	 $("#showhinh").html('');
}
 	
	
        if (input.files) {
            var files = input.files;
			console.log(files);
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = document.createElement("img");
                        img.setAttribute("src", e.target.result);
						 img.style.width=50+"px";
						 img.style.marginLeft=10+"px";
                        img.setAttribute("class", "file-upload-image");
						
                        $("#showhinh").append(img);
                    };
                    reader.readAsDataURL(file);
                } else {
                    removeUpload();
                }
            }
        }
    }
	
</script>
<!-- END: block_cus -->

<div id="khonghienthi" style="display:none"></div>


<!-- BEGIN: block_cusupdate -->
<script language="JavaScript">
alert('Cập nhập thành công');
location.replace("?act=themdexuat");
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
function quaylai(){
	
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
