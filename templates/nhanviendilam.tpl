<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
<div class="top_space"></div>	
<style>	
#action_form {	
display: flex;	
justify-content: space-between;	
width: 100%;	
}	
#action_form #form {	
width: 35%;	
}	
#action_form #form #note {	
width: 100% !important;	
height: 120px;	
}	
#video_camnera {	
width: 60%;	
min-height: 100px;	
position: relative !important;	
/* top: -120px;	
right: -300px; */	
/* float: unset !important; */	
/* float: right; */	
}	
#video_camnera video {	
width: 55%;	
height: 100%;	
position: absolute;	
top: -0.8em;	
left: 1em;	
}	
#video_camnera #img {	
width: 45%;	
height: 210px;	
border: 1px solid rgb(167, 167, 167);	
position: absolute;	
top: -0.8em;	
right: 0;	
}	
#video_camnera #img #img_cap {	
width: 100%;	
height: 100%;	
}	
#video_camnera #img #capture {	
display: none;	
}	
</style>	
<div class="nenbao">	
<div style="padding:1px">	
<fieldset class="nencon">	
<legend>	
<a style="cursor:pointer">	
<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Nhập thông tin làm việc nhân viên</label>	
</a>	
</legend>	
<div>	
<!-- BEGIN: block_proht1 -->	
<script src="js/jquery.min.js"></script>	
<form name="frmProduct1" method="post">	
<div id="khonghienthi" style="display:none"></div>	
<div id="action_form">	
<div id="form"> &nbsp;&nbsp; [<a href="default.php?act=md">Đóng Lại</a>]&nbsp;	
<div style="padding:5px"> Mã Nhân Viên  
<input type="text" name="ma" id="ma" class="inpl"  style="width:90px"  autocomplete="off" value="fm0705" />	

<!-- onkeyup="goikh(this.value,note.value)" onkeydown="khonggo1(event)  " onmousedown="this.value=''" onmouseup="this.value=''" onmousemove="this.value=''"  ondblclick="this.value=''" -->
<div id="khonghienthi"></div>	 
<br /> &nbsp; &nbsp; &nbsp; &nbsp; Ghi chú &nbsp; <input type="text"   name="note" ondblclick="this.value=''" id="note" class="inpl" style="width:850px" value="" />	
</div>	
</div>	

<button type="button" onclick="timkhmacode(ma.value,'')">chụp</button>
<!-- hiện video -->	
<div id="video_camnera">	
	<video id="video" playsinline autoplay></video>	
	<div id="img">	
	<canvas id="capture"></canvas>	
	<img id="img_cap" src="" alt="">	
</div>	
</div>	
</div>	
<br />	
<div id="hienthiquet">	
<table width="100%" border="0" cellpadding="0" cellspacing="0">	
<tr bgcolor="#F8E4CB">	
<td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>	
<td width="231" align="center" class="cothienthi"><strong> Giờ Quét Thẻ </strong></td>	
<td width="266" align="center" class="cothienthi"><strong>Tên Nhân Viên </strong></td>	
<td width="214" align="center" class="cothienthi"><strong><strong><strong>Mã	
NV</strong></strong>	
</strong>	
</td>	
<td width="110" align="center" class="cothienthi"><strong>Điện thoại </strong></td>	
<td width="357" align="center" class="cothienthi"><strong>Cửa hàng </strong></td>	
<td width="357" align="center" class="cothienthi"><strong>Ghi Chú</strong></td>	
</tr>	
<tr bgcolor="#FFFFFF">	
<td class="cothienthi" align="right">&nbsp;</td>	
<td class="cothienthi">&nbsp;</td>	
<td class="cothienthi">&nbsp;</td>	
<td class="cothienthi">&nbsp;</td>	
<td class="cothienthi">&nbsp;</td>	
<td class="cothienthi">&nbsp;</td>	
<td class="cothienthi">&nbsp;</td>	
</tr>	
</table>	
<div style="height:300px"></div>	
</div>	
<div id="hienthongbao" style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center">	
<div style=" width:200px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;">	
<div>	
<fieldset>	
<legend align="center"> <b style="color:#00F;cursor:pointer" onclick="goidongthe()">&nbsp; Thông Báo &nbsp; ( X )</b> </legend>	
<div align="center" style="padding:10px"> Cám ơn bạn đã quét thẻ ! <br /><br />	
</div>	
</fieldset>	
</div>	
</div>	
</div>	
</form>	
<img id="imgrt" src="" alt="">	
<script src="js/nhandienface.js"></script>	
<script language='JavaScript'>	
var timer;	
var msg = "No Click!!!";	
function disableIE() {	
if (document.all) {	
alert(msg);	
return false;	
}	
}	
function disableNS(e) {	
if (document.layers || (document.getElementById && !document.all)) {	
if (e.which == 2 || e.which == 3) {	
alert(msg);	
return false;	
}	
}	
}	
if (document.layers) {	
document.captureEvents(Event.MOUSEDOWN);	
document.onmousedown = disableNS;	
} else {	
document.onmouseup = disableNS;	
document.oncontextmenu = disableIE;	
}	
document.oncontextmenu = new Function("alert(msg);return false")	
</script>	
<script language="javascript">	
function hienthicuahang() {	
	poststr = "DATA=" + encodeURIComponent(1) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);	
	loadtrang('hienthiquet', "nhanvienquetthetim", poststr, "");	
}	
function goichungcuahang(){	
	clearTimeout(timer); 	
	timer = setTimeout(function validatech(){	
	hienthicuahang() ;	
	},100);	
}	
function timkhmacode(v, n) {	
	if (v.length < 3) {	
		document.getElementById("ma").value = '';	
		return;	
	}	
	var src=snapPicture();
	//++++++++++++
	 var fileSize = checkimgSize(src);
	 if(fileSize<=7622){
	 		alert('Không có ảnh chụp!');
			return;
	 }	
	
	 
	poststr = "DATA=" + encodeURIComponent(v) + "*@!" + encodeURIComponent(n) + "*@!" + encodeURIComponent(0);	
	loadtrang('khonghienthi', "nhanvienquettheluu", poststr, "xuly9");	
}	
var anhnv='' ;


function checkcap(idNew){
	var src=snapPicture();
	//++++++++++++
	 var fileSize = checkimgSize(src);
	 if(fileSize<=5583){
	 		alert('Không có ảnh chụp!');
			return;
	 }	
	
	 var dataImg = {	
		id: idNew,	
		url: anhnv	
	};
	luuanhnhanvien(dataImg);
}	
function snapPicture() {	
	// navigator.webkitGetUserMedia(constraints, function(stream) {	
	const canvas = window.canvas = document.getElementById('capture');	
	anhnv = ConvertCanvasToImg(canvas, video);	
	var img = document.getElementById("img_cap");	
	img.src = anhnv;	
	
	return anhnv;
	
}	


function checkimgSize(src){
	
	var base64str = src.substr(22);
	var decoded = atob(base64str);
	
	return decoded.length;
}

function luuanhnhanvien(poststr) {	
	var LinkApi = "/fm/nhanvienluuanh.php";	
	// var LinkApi = "https://localhost/fmstylemoi.vn/nhanvienluuanh.php/";	
	// send ajax	
	//   alert(LinkApi) ; return ;	
	const sendimg = sendAjax(LinkApi, "POST", {	
		data: JSON.stringify(poststr)	
	});	
	sendimg.done(function(response, textStatus, jqXHR) {
		
	
		luuAnhTam(poststr);
		
		if(response.data==-2){
			alert('Hình ảnh chưa được tạo vui lòng chụp lại!');
		}
		if(response.data==0){
			guilaianh();
			localStorage.setItem("kiemtraham", 1);
		}
		else{
			var hinhtam=localStorage.getItem("hinhtam");
			if(hinhtam){
				hinhtam=JSON.parse(hinhtam);
				var tama=hinhtam.filter((element, index)=>{
					return element.id!= poststr.id;
				});
				localStorage.setItem("hinhtam", JSON.stringify(tama));
			}	
		}
		localStorage.setItem("imguser", response.data);	
	});	
	sendimg.fail(function(jqXHR, textStatus, errorThrown) {	
		console.error("The following error occurred: " + textStatus, errorThrown);	
	});	
}
var vitrihinh=0;

function guilaianh(){
localStorage.setItem("kiemtraham",1);
var hinhtam=localStorage.getItem("hinhtam");
	if(hinhtam){
		hinhtam=JSON.parse(hinhtam);
		if(hinhtam.length>0){
			
			var LinkApi = "/fm/nhanvienluuanh.php";	
		
			const sendimg = sendAjax(LinkApi, "POST", {	
				data: JSON.stringify(hinhtam[0])	
			});	
			sendimg.done(function(response, textStatus, jqXHR) {
				
				if(response.data!=0){
						vitrihinh++;
						console.log('tải thành công');
						var tama=hinhtam.filter((element, index)=>{
							return index > 0;
						});
						
						localStorage.setItem("hinhtam", JSON.stringify(tama));
						setTimeout(()=>{
									guilaianh();
						},5000);
				}
				else{
				
						console.log('tải lại');
						localStorage.setItem("kiemtraham",0);
						setTimeout(()=>{
								kiemtraanhloi();
						},5000);
					
				}	
				
				
			});	
			sendimg.fail(function(jqXHR, textStatus, errorThrown) {	
				console.error("The following error occurred: " + textStatus, errorThrown);	
			});	
		}	
	}
	
}

function luuAnhTam(poststr){
	var hinhtam=localStorage.getItem("hinhtam");
	
	if(hinhtam){
		hinhtam=JSON.parse(hinhtam);
			
	}
	else{
		hinhtam=[];
	}
	var index=-1;
	if(hinhtam.length>0){
		for(var i=0;i<hinhtam.length;i++){
			if(hinhtam[i].id==poststr.id){
				
				index=i;
			}	
		}
	
	}
	
	if(index!=-1){
		hinhtam[index].url=poststr.url;
	}
	
	if(index==-1){
		hinhtam.push(poststr);
	}
	
	if(hinhtam.length==0){
		hinhtam.push(poststr);
	}
	
	localStorage.setItem("hinhtam", JSON.stringify(hinhtam));	

}	
(kiemtraanhloi(2))();
var clearinte='';
function kiemtraanhloi(trt=''){
	clearinte=setInterval(()=>{
		var kiemtrahinh=localStorage.getItem("kiemtraham");
		var hinhtam=localStorage.getItem("hinhtam");
		
		if(hinhtam){
		if(trt==2){
			guilaianh();
			clearInterval(clearinte);
		}
			hinhtam=JSON.parse(hinhtam);
			if(kiemtrahinh!=1){
				if(hinhtam.length>0){
					guilaianh();
				}
			}
			else{
				clearInterval(clearinte);
			}
		}
		else{
			return;
		}
		
	},5000);
		
};

function goidongthe() {	
	document.getElementById('hienthongbao').style.display = 'none';	
	document.getElementById("ma").focus();	
}	
//============================================================	
function ask() {	
	var n = confirm("Bạn có muốn xóa không");	
	if (n == false) {	
		return false;	
	}	
}	
function quaylai() {	
	location.replace("default.php?act=nhanvien");	
}	
//=======================	
function xuly9() {	
	tam = document.getElementById('khonghienthi').innerHTML;	
	var n = tam.split("**#");	
	if (n.length <= 1) document.getElementById("ma").value = '';	
	if (n[1] != "" && n.length > 1) {	
	if (n[1] == '2') {	
	alert("Bạn đã quét trong thời gian cách đây khoản 30 phút !!!");	
	} else document.getElementById('hienthongbao').style.display = '';	
	document.getElementById("ma").value = '';	
	document.getElementById("note").value = '';	
	document.getElementById('khonghienthi').innerHTML = '';	
	poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);	
	if (n[2] != "") {	
	var idNew = n[2];	
	//   var url = localStorage.getItem("ImgBase4");	
	var dataImg = {	
		id: idNew,	
		url: anhnv	
	};	
		// alert(anhnv)	
		luuanhnhanvien(dataImg);	
		//goichungcuahang(); 	
	}	
		document.getElementById("ma").focus();	
	}	
}	
function goikh(v, n) {	
	var tam = document.getElementById("ma").value.substring(1, 2);	
	if (tam == '#') {	
		document.getElementById("ma").value = '';	
	}	
	clearTimeout(timer);	
		timer = setTimeout(function validate() {	
		timkhmacode(v, n)	
	}, 40);	
}	
function khonggo(event) {	
//if ( event.keyCode != 13 )  document.getElementById("ma").value =''; else 	
// alert (event.keyCode)	
if (event.ctrlKey == 1) {	
	document.getElementById("ma").value = '###';	
}	
// console.log("ok")	
}	
function sendAjax(LinkApi, method, data) {	
	return $.ajax({	
	type: method ? method : "GET", // http method	
	url: LinkApi,	
	dataType: 'json',	
	data: data, // data to submit	
	});	
}	
hienthicuahang();	
document.getElementById("ma").focus();	
</script>	
</div>	
</fieldset>	
</div>	
<!-- END: block_proht1 -->