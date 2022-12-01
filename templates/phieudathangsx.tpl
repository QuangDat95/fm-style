 <style> .wrapper{ 	width:100%; 	height:140vh; } .header { width:100%; }</style>
 <form name="frmxuat" id="frmxuat"  method="get" >
<div class="nenbao">
<div style="padding:0px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt;" >Phiếu Đặt Hàng Sản Xuất</label>
	</a> </legend>
   
	
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td valign="top">
	<div style=" height:499px;width:270px">
		<div style="margin-top:5px;margin-bottom:5px">
	 <fieldset style="height:113px;width:250px" >
	<legend>  
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;" >Thông Tin Phiếu <select   name="chonnhac"  id="chonnhac" style="width:95px" onchange="doinhac(this.value)">
              <option value="0" >TB mặc định</option>
              <option value="1" >1</option>
              <option value="2" >2</option>
              <option value="3" >3</option>
              <option value="4" >4</option>
              <option value="5" >5</option>
              <option value="6" >6</option>
              <option value="7" >7</option>
              <option value="8" >8</option>
              <option value="9" >9</option>
            </select> </label>
	 </legend>
 	<table   width="100%" border="0" cellpadding="1" cellspacing="2" style="padding-top:0px">		
		 <tr  >
			<td width="33%" valign="middle">Người đặt </td>
			<td>:{ten}</td>
		  </tr>

		<tr  >
			<td width="33%" valign="middle">Ngày Đặt </td>
		    <td width="67%">:
		      <input type="text" name="ngaynhap" id="ngaynhap" class="inpl" readonly="" onkeyup="return chuyentiep(event,'sochungtu')"  style="width:70px" value="{ngaynhap}" />
		    <img  src="images/img.gif" id="Lichtungaytao" style="display:none;cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmnhap.ngaynhap,'dd/mm/yyyy',this)"     />
		    <input name="idgoi" id="idgoi" type="hidden"  value="" /></td>
		</tr>
		<tr><td>Số C.Từ</td>
		<td>:<input type="text" name="sochungtu"  class="inpl" id="sochungtu" readonly="" onkeyup="return chuyentieps(event,'kho')"  style="width:100px" value="{sochungtu}"   /></td>
		</tr>
 		<tr>
			<td height="20px" valign="top"  >Chi Nhánh 
		  <input type="hidden" name="kho" id="kho"  value="1"  >
		  <input type="hidden" name="TiGia" id="TiGia"   value="{TiGia}"  /><input type="text" name="VAT" id="VAT"   style="display:none"  >		 </td><td valign="top" ><textarea id="textarea" name="textarea" readonly="readonly"  style='width:150px;height:20px;overflow:auto;background-image: url("../images/dot_xanh.gif");border:0px; font-family: verdana; font-size: 1.1em; color:#0000FF'>:{tencuahang}</textarea>
		     
		    
		    
		 </td>
		</tr>
  </table>
</fieldset>
</div> 
 

<fieldset style="height:378px;width:250px;margin:0">
	<legend> <a style="cursor:pointer" onClick=" anhienform('obj') ">
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;cursor:pointer" onclick="goikhach()">Thông tin Nơi Đặt</label>
	</a></legend>
	
	
	 
		<div  >
		<div style="padding-top:2px"> 
		
		<div style="padding-top:5px;padding-bottom:5px"><span style="padding-bottom:2px">
		 NVĐ <select name="nhanviendat" id="nhanviendat"  style="width:186px"  class="js-nhacc" >
		    <option value="">Chọn nhân viên đặt</option>
   			  {nhanviendat} 
 		    </select>		
		<div style="padding-top:5px;padding-bottom:5px"><span style="padding-bottom:2px">
		 NCC <select name="nhacc" id="nhacc"  style="width:186px"  class="js-nhacc" >
		    <option value="">Chọn nhà cung cấp</option>
   			  {nhacc} 
 		    </select>
		</span></div>
		</span></div>
		<input type="hidden" name="idkh"  id="idkh"    value="1" />		
		</div> 
	 </div>
	 
	 <div style="padding-bottom:2px">Đặt cho tháng  &nbsp; &nbsp;  
       <select name="datthang" id="datthang"  style="width:125px;height:25px" onkeypress="return chuyentiep(event,'nguoigiao')" >
  			{thangnam}
       </select>
	   <div style="padding-top:5px">
	  Ngày Giao hàng: <input id="ngaygiaohang" name="ngaygiaohang" value=""  type="date" style="width:123px;height:30px" />
	  </div> 
       </div><span style="display:"><b id="nhanqua" style="display: none ;color:red; ">Nhận quà
      <input type="checkbox" id="chonnhanqua" name="chonnhanqua"  style="cursor:pointer"   value="1" />
       Điểm   <input type="text" id="diem" name="diem" disabled="disabled" size="6"    value="" /></b></span>
	<div style="margin-bottom:5px; "></div>
	 <div style="padding-bottom:5px">Chương trình: <span id="tt"></span>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;</div>
		<textarea id="note" name="note" class="texta" style='width:230px;height:40px;overflow:auto'></textarea>
		
	Ghi chú:	<textarea id="ghichu" name="ghichu" class="texta" style='width:230px;height:40px;overflow:auto'></textarea>
	<div style="font-size:16px">
	<div > &nbsp; 
	  <input type="hidden"  name="makm" id="makm"   style="font-size:16px;background: url(../images/nenbh.jpg);width:120px;color:#FF0000" onblur="kiemtrama(this.value)" ondblclick="this.value=''" maxlength="15"  onkeypress="return chuyentiep(event,'luu')"   value=""     />
	 </div>	
	<div class="tinhtien"> &nbsp;Tổng Tiền: <strong><span id="tongtien" style="font-size:20px;color:#FF0000"></span></strong> </div>	
    
	 
	 </div>
</fieldset>	
	</div> </td>



<td style="padding-left:0px" valign="top">  <!-- chọn hàng hóa -->
	<div style=" height:450px;width:700px; margin-top:5px;">
 	<fieldset style="padding-top:5px">
	<legend> <a style="cursor:pointer" onClick="anhienform('chon')">
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Chọn Hàng Hóa Cần Đặt</label>
	</a> </legend>
	
<div id="chon" >
  

<input onkeypress="return chuyentiep(event,'khachdua')"  placeholder="Mã SP" autocomplete="off" type="text" name="codeprotk"  id="codeprotk"   onkeyup="goisp(this.value)"  class="text" size="9" value=""  ondblclick="this.value=''"/>   
     <input onkeypress="return chuyentiep(event,'codeprotk')"  placeholder=" Tên SP " type="text" name="NameTK"  id="NameTK" class="text" size="9" value="" />
      <input onkeypress="return chuyentiep(event,'codeprotk')"  placeholder="Mô tả" type="text" name="mota"  id="mota" class="text" size="9" value="" />
    <input   type="hidden" name="code"  id="code" class="text" size="10" value=""  />

  Nhóm
<select onkeypress="return chuyentiep(event,'search')" name="IDGrouptk"  id="IDGrouptk" style="width:180px">
  <option value="0" ></option>
 	{cay}
 </select>
&nbsp;
<input type="button"  style="width:37px"   onclick="timsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'',kho.value,mota.value)"   name="search"  id="search" value="Tìm" />
<input type="hidden" name="soluongcon"  value="" />
	   
	   <input type="button" name="cl" style="width:38px" onclick="clearchon()" value="clear" /></div> 
	   

<div style="height:16px"  id="cho" >    </div>
	 

	   <div id="sanpham" style="padding-top:4px">	  </div> 
 </fieldset>
 
 
 <div style="padding-bottom:5px">  
   <fieldset style="display:">
	<legend> 
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Hàng Hóa Đăt</label></legend>	

 
	<div >Tên SP:  
	  <input type="text" name="tensp" id="tensp" class="inpl"  style="width:290px" readonly=""  value="" />
	  &nbsp;&nbsp;Mã SP:  	<input type="text" name="masp"  id="masp"class="inpl"  style="width:100px" readonly=""   value="" /> Mô tả <input type="text" name="mt"  id="mt" class="inpl"  style="width:100px" readonly=""   value="" />
 	<input type="hidden" name="idsp"  id="idsp"    value="" />
	 <input type="hidden" name="sl"  id="sl"    value="" />
	 <input type="hidden" name="giachan"  id="giachan"    value="0" />
	</div>  
 		 Giá  
 		 <input type="text" name="dongia" id="dongia"   maxlength="12" class="text" style="width:75px;" value="0"  onkeydow=" onlyinta(this)"  onkeyup ="return chuyentiep(event,'soluong')"  onkeypress ="txtFormata(this)" onblur="txtFormat(this)"/> 
	  <select name="loaitien" id="loaitien"  onkeyup ="return chuyentiep(event,'soluong')" style="display:none">
        <option value="VND">VND</option>
        <option value="USD">USD</option>		
      </select>
	  SL 
	<input type="text" name="soluong" id="soluong"  onkeyup ="return chuyentieps(event,'chietkhau')"  class="text" style="width:35px" value="1" />
	 
	<input  name="chietkhau" ondblclick="goick()" id="chietkhau"  value="" type="hidden" style="width:33px"   />
 	 
	 &nbsp;
	
	  Ghi chú:  
	  <input type="text" name="ghichu"  id="ghichu"   onkeyup ="return chuyentiep(event,'add')"     style="width:250px"  value="" />
     <input type="button" name="add"  id="add" style="width:50px" onclick="addpro(idsp.value,tensp.value,masp.value,dongia.value,loaitien.value,soluong.value,chietkhau.value,ghichu.value,giachan.value,mt.value)" value="ADD"   onkeyup ="return chuyentiep(event,'NameTK')"  /> 
 </fieldset>
  </div>
<div style=" max-height:350px;overflow:scroll">
  <div id="sanphamxuat" >
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr bgcolor="#F8E4CB">
       <td width="29"  align="center" class="cothienthi" height="23"><b>STT</b></td>
       <td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td>
       <td width="310" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td>
       <td width="48"  align="center" class="cothienthi"><strong>SL</strong></td>
       <td width="152" align="center" class="cothienthi"><strong>Đơn Giá </strong></td>
        <td width="164" align="center" class="cothienthi"><strong>Thành Tiền </strong></td>
       <td width="250" align="center" class="cothienthi"><strong>Ghi Chú </strong></td>
        <td width="45"  align="center" class="cothienthi"><strong>X&#243;a</strong></td>
     </tr>
        <tr bgcolor="{color}">
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td> 
         <td  class="cothienthi" >&nbsp;</td>
        
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td>
       </tr>
   </table>
 </div> 
</div>
    </div></td><td valign="top">
	<style>
	.note {
  width: 500px;
  margin: 50px auto;
  font-size: 1.1em;
  color: #333;
  text-align: justify;
}
#drop-area {
  border: 2px dashed #ccc;
  border-radius: 20px;
 
     height: 479px;
  padding: 20px;
  min-width:280px;
  margin-left:0.5em;
}
#drop-area.highlight {
  border-color: purple;
}
p {
  margin-top: 0;
}
.my-form {
  margin-bottom: 10px;
}
#gallery {
    margin-top: 10px;
    display: flex;
    flex-wrap: wrap;
}
#gallery img {
  width: 100%;
 
}
.button {
  display: inline-block;
  padding: 10px;
  background: #ccc;
  cursor: pointer;
  border-radius: 5px;
  border: 1px solid #ccc;
}
.button:hover {
  background: #ddd;
}
#fileElem {
  display: none;
}
	.block_i{
		width:40%;
		position:relative;
	}
	
	.xoachon button{
		position: absolute;
    right: 0;
    color: #FF0000;
    background-color: unset;
    border: none;
    font-size: 16px;
    font-weight: bold;
	}	
	</style>
	
		<div style="" class="drop-area" id="drop-area">
				Chọn Ảnh
 
			<form class="my-form">
			
			<input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
			  <input type="hidden" id="idk" name="idk" value="{idk}">
				<label class="button" for="fileElem">Select some files</label>
		  </form>
			 <div id="loadings" style="display:none"><img src="images/loading.gif"/>loading...</div>
		  <div id="gallery" />  
		  
		  </div>
 	</div>
	
 </td>
</tr>

</table>

<script>
var mangtam=[];
let dropArea = document.getElementById("drop-area")
// Prevent default drag behaviors
;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, preventDefaults, false)   
  document.body.addEventListener(eventName, preventDefaults, false)
})

// Highlight drop area when item is dragged over it
;['dragenter', 'dragover'].forEach(eventName => {
  dropArea.addEventListener(eventName, highlight, false)
})

;['dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, unhighlight, false)
})

// Handle dropped files
dropArea.addEventListener('drop', handleDrop, false)

function preventDefaults (e) {
  e.preventDefault()
  e.stopPropagation()
}

function highlight(e) {
  dropArea.classList.add('highlight')
}

function unhighlight(e) {
  dropArea.classList.remove('active')
}

function handleDrop(e) {

  var dt = e.dataTransfer
  var files = dt.files
	
  handleFiles(files)
}

let uploadProgress = []
let progressBar = document.getElementById('progress-bar')

function initializeProgress(numFiles) {
  progressBar.value = 0
  uploadProgress = []

  for(let i = numFiles; i > 0; i--) {
    uploadProgress.push(0)
  }
}

function updateProgress(fileNumber, percent) {
  uploadProgress[fileNumber] = percent
  let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length
  progressBar.value = total
}

function handleFiles(files) {
isloading(true,"loadings");
	// var hinh = $("#fileElem").prop('files');
	 uploadFile(files);
  
}

function previewFile(file) {
  let reader = new FileReader()
  reader.readAsDataURL(file)
  reader.onloadend = function() {
    let img = document.createElement('img')
    img.src = reader.result
    document.getElementById('gallery').appendChild(img)
  }
}

function isloading(type,id){
	 document.getElementById(id).style.display=type?'inline-block':"none";
}	

function uploadFile(hinh) {
	 var url = 'https://image.fmstyle.com.vn/upanhsanphamluu.php?type=dathangsx'
 	
 	var iduser=document.getElementById("idk").value;
	if(!iduser){
		alert("lỗi!");
		return;
	}
	
	  var xhr = new XMLHttpRequest();
		var formData = new FormData();
		
		 var totalfiles = hinh.length;
 
			for (var i=0;i<totalfiles;i++) {
				formData.append("hinh[]", hinh[i]);
			}
		formData.append("iduser", iduser);
		UploadfileApi(url,formData)
		.then(response => response.text())
		  .then(result =>
		  {
				    console.log(result);
			  var result=JSON.parse(result);
			
			var manghinh=result.data;
				var urlimg=result.link;
						  var chuoi='';
						 if(manghinh.length>0){
							for(var i =0;i<manghinh.length;i++){
							var fname=manghinh[i];
								mangtam[fname]='';
									chuoi+= '<div class="block_i col-50 " id="'+fname+'"><div class="img"><div class="xoachon"><button value="'+fname+'" onclick="xoachonanh(event)" type="button">X </button></div><img src="'+urlimg+fname+'" data-name="'+fname+'" /></div></div>';
								 
										  
								}
								 $("#gallery").append(chuoi);
								isloading(false,"loadings"); 
						}
		  })
		  .catch(error => console
			.log('error', error));
		
		
		return;
}

function UploadfileApi(endpoint, data)
{
  var url = endpoint;
  

  return fetch(url, {
    method: "POST",
    body: data
  })

}

var tamvalue='';
function xoachonanh(e,loai=''){

	var target=e.target;
	var value=target.value;
	var iduser=document.getElementById("idk").value;
	if(!iduser){
		alert("lỗi!");
		return;
	}
	
	if(loai){
		if(!confirm("Bạn có chắc muốn xóa ảnh này!")){
			return;
		}
			tamvalue =value;
			isloading(true,"loadings"); 
 
 
    var formData = new FormData();

		 var url = 'https://image.fmstyle.com.vn/upanhsanphamluu.php?type=dathangsx';
		 formData.append("iduser", iduser);
		formData.append("delete", value);
		UploadfileApi(url,formData)
	.then(response => response.text())
      .then(result =>
      {
      			delete mangtam[tamvalue];
				 var chuoianhluu='';
			
			  if(mangtam){
				
			 
				  mangtam={ ...mangtam };
					chuoianhluu=JSON.stringify(mangtam);
			  }
				var idgoi= document.getElementById('idgoi').value ; 
		
				 poststr="UPDATEHINH="+ "*@!" +encodeURIComponent(chuoianhluu)+  "*@!"+ encodeURIComponent(idgoi)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
			  loadtrang('khonghienthi', "phieudathangsxluu", poststr,"xuly11") ;
		//console.log(result);
      }).catch(error => console
        .log('error', error));
		
	}
	else{
		delete mangtam[value];
		//console.log(mangtam);
		document.getElementById(value).remove();
	}

	
}

function xuly11(){
			
		document.getElementById(tamvalue).remove();
		isloading(false,"loadings"); 
		
}


function luuanh(){

	
	var iduser=document.getElementById("idk").value;
	if(!iduser){
		alert("lỗi!");
		return;
	}

			isloading(true,"loadings"); 
 
 
    var formData = new FormData();
	
		 var url = 'https://image.fmstyle.com.vn/upanhsanphamluu.php?type=dathangsx';
		formData.append("save", 1);
		 var chuoianhluu='';
    
		  if(mangtam){
		 
			  mangtam={ ...mangtam };
				chuoianhluu=JSON.stringify(mangtam);
		  }

			formData.append("data", chuoianhluu);
			formData.append("iduser", iduser);
	UploadfileApi(url,formData)
	.then(response => response.text())
      .then(result =>
      {
      		 console.log(result);
			isloading(false,"loadings"); 
      }).catch(error => console
        .log('error', error));

	

	
}



function showhinhUpdate(mangtam){

var manghinh=Object.keys(mangtam);
var urlimg = 'https://image.fmstyle.com.vn/anhchamcong/anhsanpham/phieudathangsx/';
var chuoi='';
		for(var i =0;i<manghinh.length;i++){
							var fname=manghinh[i];
			chuoi+= '<div class="block_i col-50 " id="'+fname+'"><div class="img"><div class="xoachon"><button value="'+fname+'" onclick="xoachonanh(event,1)" type="button">X </button></div><img src="'+urlimg+fname+'" data-name="'+fname+'" /></div></div>';
								 
										  
		}
					$("#gallery").html(chuoi);
								isloading(false,"loadings"); 
}
</script>

<div style="padding-top:4px;font-size:16px;padding-bottom:10px" > 
	  <input class="chucnang" type="button" name="luu" id="luu" style="width:70px;display:{q_luu}"  onclick="return  luuphieuxuat()" value="Lưu" {}  />
      <input class="chucnang" type="button" name="themmoi"  id="themmoi" style="width:75px;display:{q_them}"  onclick="window.open('default.php?act=phieudathangsx','_self')" value="Thêm Mới" />
      <input class="chucnang" type="button" name="copy" id="copy"  onclick="copyp()"  disabled="disabled" value="Copy" style="display:none;width:70px" />
      <input type="button" name="khoa" id="khoa" disabled="disabled" style="width:80px;display:{q_khoa}"  onclick="khoaphieu()" value="Khóa Phiếu" />
	  <input type="button" class="chucnang" name="inan"  id="inan" style=" width:100px;display:{q_in}" disabled="disabled"  onclick="goiin()" value="In Phiếu" />
	  <input type="button" class="chucnang" name="huyphieu" id="huyphieu" disabled="disabled" style="width:80px; "  onclick="goihuyphieu(idgoi.value,'nk')" value="Hủy Phiếu" />
	  <input type="button" class="chucnang" name="timxuat" id="timxuat" style="width:105px;display:{q_tim}"  onclick="timphieu()" value="Tìm Phiếu " />
	  <input type="button" class="chucnang" name="timxuat32" id="timxuat32"  style="display:none;width:80px"  onclick="huongdan()" value="Hướng Dẫn" />
	  <input type="button" class="chucnang" name="timxuat3" id="timxuat3" style="width:80px"  onclick="matdinh()" value="Đóng lại" /> <!-- BEGIN: block_admin1 -->
      <input type="button" class="chucnang" name="phuchoi" id="phuchoi"   style="width:80px"  onclick="goiphuchoi(idgoi.value,note.value)" value="Phục hồi" />
     
      <input type="button" class="chucnang" disabled="disabled"  name="xoaphieu" id="xoaphieu"  style=" width:90px;display:none"  onclick="xoaphieux(sochungtu.value)" value="Xóa phiếu" /><!-- END: block_admin1 -->
</div>

 
  <div id="ketqualuu" style="width:800"></div>
  <div id="luutimsp" style="display:none"></div>
  <div id= "luubd"  style="display:none"></div>
  <div id= "tenform"  style="display:none">phieudathangsx</div>
<!-- =================================KT 33333====================================== -->
 <div style="clear:left;display:none" id="khonghienthi"></div>
 
</fieldset></div></div>  
 

<div id="hienthongbao"  style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:980px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidong()">( X Đóng lại )</b></div>
 
 <div   id="timphieuxuat">
 <fieldset >
	<legend align="center"><label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer" onclick="anhien2f('ankhachhang','khachangchitiet')" >Tìm phiếu đặt hàng </label>
	 </legend>
 

   <div style="padding-bottom:5px"><br />

<select name="khoaphieut" id="khoaphieut" style="width:89px"    onkeypress="return chuyentiep(event,'sophieut')" >
   <option value="1">Đã Khóa</option>
 <option value="0">Chưa khóa</option>
  <option value="">Tất Cả</option>
</select>
Số phiếu
       
  <input type="text" name="sophieut" id="sophieut" class="inpl"  style="width:100px" onkeypress="return chuyentiep(event,'tungay')"   value="" />
  &nbsp;	  Từ ngày
  <input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay"   id="tungay" class="text" style="width:68px"  value="{tungay}" />
  <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmxuat.tungay,'dd/mm/yyyy',this)" />&nbsp;đến ngày
  <input onkeypress="return chuyentiep(event,'timk')" type="text" name="denngay"  id="denngay" class="text" style="width:68px" value="{denngay}" />
  <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmxuat.denngay,'dd/mm/yyyy',this)" />&nbsp; 
       
     &nbsp;<input type="button"   onclick="timdsphieuxuat(0,sophieut.value,'',tungay.value,denngay.value,khoaphieut.value,0)"   style="width:68px"   name="timk"  id="timk" value="Tìm kiếm" />
      
     <input type="button" name="timxuat2" id="timxuat2" style="width:68px"  onclick="timphieu()" value="Quay Lại" />
      </div>
   <div id="httimxuat" style="color:#000000" >
     <table width="100%" border="0" cellpadding="0" cellspacing="0">
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="111"><b>Số Phiếu </b></td>
		  <td width="79" align="center" class="cothienthi" ><strong>Ngày nhập </strong></td>  
		 	   
		  <td width="296" align="center" class="cothienthi"><strong>Lý Do </strong> </td> 
		  <td width="185" align="center" class="cothienthi"><strong>Người giao hàng </strong></td>
		   <td width="398" align="center" class="cothienthi"><strong>Nhà cung cấp </strong></td>
		    <td width="162" align="center" class="cothienthi"><strong>Người Tạo</strong></td>
 		</tr>
     </table>
   </div>
   <div id="httimlai"></div>


   </fieldset>
 </div>


<div id="timkhachhanght">
Mã KH 
  <input type="text" name="ma" ondblclick="this.value=''" id="ma" onkeyup="goikh(this.value)"  class="inpl"  style="width:80px" onkeypress="return chuyentieps(event,'kv')"   value="" />

Tên
<input type="text" name="ten" id="ten" ondblclick="this.value=''" class="inpl"  style="width:80px" onkeypress="return chuyentiep(event,'diachitim')"   value="" />
Số ĐT
<input type="text" name="dt" ondblclick="this.value=''" id="dt" class="inpl"  style="width:80px" onkeypress="return chuyentieps(event,'cmnd')"   value="" />
CMND
<input type="text" name="mc" ondblclick="this.value=''" id="cm" class="inpl"  style="width:80px" onkeypress="return chuyentieps(event,'kv')"   value="" />
 
 
<select class="compo"  name="nhom" id="nhom"  onkeypress="return chuyentieps(event,'search2')"  style="width:100px;"  >
    <option value="" >Nhóm KH</option>
	<option value="0" >Nhóm mặc định</option>
  	  {nhomkh}
 </select>
                </span> <span style="padding-bottom:10px">
                <input type="button"   style="width:40px"  onclick="timkiemkh(ten.value,dt.value,ma.value,'',nhom.value,cm.value)"   name="search2"  id="search2" value="Tìm" />
             &nbsp;   <input type="button"   style="width:70px"  onclick="timkiemkh(ten.value,dt.value,ma.value,'',nhom.value,cm.value,1)"   name="search2"  id="search2" value="Tìm Lưu" />
               
 <div id="hienthikh" style="padding-top:5px;color:#333">
 
 </div>
 </div>   
 </div>
</div> 
 
	
<div id="hiethithongbao"    style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
      <div   style=" width:950px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:5px; color:#F00;" >
       <div  >
     <fieldset >
        <legend align="center">   <b style="color:#FF0000;cursor:pointer;font-size:18px" onclick="goidongthe()">&nbsp; Thông tin mua hàng &nbsp;   ( X )</b> 	 </legend><br />
    
     <div  style="padding:2px" id="hienthihoso"> </div>
      </fieldset>    
     </div></div>
</div> 


 
 
<div id="hiengoick"    style="display:none; overflow:hidden; position:absolute;   top: 201px;left:-10px;width:100%; " align="center" >
  <div   style=" width:200px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;" >
  	<div style="padding-bottom:5px"> Giảm giá mới</div><input type="text" id="ckmoi" name="ckmoi" value="{chietkhaugiam}"  onkeyup="formatchuan(this)" style="width:100px" /> <br /> <br /><input id="luutg" name="luutg" value="Lưu chiết khấu" onclick="luuck(ckmoi.value)" type="button" /> 
      
 
<input id="boqua" name="boqua" value="Bỏ qua" onclick="anhienform('hiengoick')"  type="button" /> 
  </div>
 </div>
</form>
<script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/select2.min.js"></script>
    <link rel="stylesheet" media="screen" href="js/select2.min.css">

<script language="JavaScript">
 $(document).ready(function() {
	   
		 $('.js-nhacc').select2();
	 
	});
	
var  ck = "{chietkhaugiam}" ;

function donglai()
 {
	  document.getElementById('hiengoick').style.display = "none";
 }
function xuly3()
 {
	  var tam =  document.getElementById('ketqualuu').innerHTML ;  
      var  n=tam.split("##");
       if (n[1]=="1")   ck = formatso(n[2]) ; else alert('Lưu chiết khấu không thành công !');
 	  document.getElementById('hiengoick').style.display = "none";
	  
 }
 
 function setchietkhaugiam()
{
	document.getElementById('chietkhau').value = ck ;
	 document.getElementById('add').click() ;
	
}
 function luuck(d)
 {
 	   poststr="DATA="+   encodeURIComponent(d)+  "*@!"+ encodeURIComponent("0") ;
	    loadtrang('ketqualuu',"chietkhauluu", poststr,"xuly3") ;	
		 
 } 
 function goick()
 {
     document.getElementById('hiengoick').style.display = ""; 
	 document.getElementById('ckmoi').focus() ;
 }
 document.getElementById('sochungtu').focus() ;
 document.getElementById('luubd').innerHTML = document.getElementById('sanphamxuat').innerHTML ; 
 document.getElementById('luutimsp').innerHTML = document.getElementById('sanpham').innerHTML ;
 document.getElementById('timphieuxuat').style.display = 'none' ;
  document.getElementById('hienthongbao').style.display = 'none' ;
 document.getElementById('codeprotk').select() ;
 </script>
<script language="javascript" src="templates/phieudathangsx.js" > </script>