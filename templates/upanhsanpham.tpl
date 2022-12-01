 
 <style>
 #poup_{
 	    width: 100%;
		height:100vh;
    top: 0;
    left: 0;
    position: fixed;
    background-color: #0000004a;
    z-index: 100;
    display: none;
    align-items: center;
    justify-content: center;
 }
 #duyetform{
 	font-size:16px !important;
	
	
 }
 
 #duyetform input, select, textarea{
 	font-size:unset;
	width:80%;
 }
 
 	#showform table td{
		font-size:1.4em;
		padding:0.5em;
	}
	#showform{
		width: 100%;
		height: 100%;
		margin-top: 2em;
		font-size: 3em;
		overflow:scroll;
		    height: 90vh;
	}
	
		#showform select {
			    font-size: 50px;
    width: 50%;
		
		}
	#duyetform{
		display:flex;
		width:100%;
		height:100%;
		background-color:#FFFFFF;
		flex-direction: column;
		padding:1em;
		
	}
	#duyetform .btn{
		padding:0.5em 0.8em;
		
		bordr-radius:10px;
	}
	#duyetform .btn-warning{
		background-color:#FF6600;
		color:#FFFFFF;
	}
	#duyetform .btn-warning:focus{
		transform:scale(0.9);
	}
	#duyetform .btn-warning:active{
		transform:scale(0.9);
	}
	#duyetform button{
			    background-color: unset;
			border: none;
			font-size: 1em;
	}
	#titl{
		    font-size: 3em;
    display: flex;
    flex-direction: column;	
	}
	#titl span{
		
	}
	
	#showform .form{
		    display: flex;
		flex-wrap: wrap;
		    flex-direction: column;
			
	}
	#showform .form >div{
		width:100%;
	}
	#showform .form .block_d{
	
	}
	#showform .form .block_d >div{
		width:100%;
		display: flex;
		
    flex-direction: column;
	}
	#showform .form .block_d  label{
		width:50% !important;
	}
	#showform .form .block_i >div{
		
		
	}
	
	#showform .form .block_i >div .break_w{
	word-break: break-all;
	display: inline-flex;
    width: 55%;
	}
	#showform .form .block_i label{
		
	}
	#showform .ghichu{
		width:410px;
	}
	#loading1{
		display:none;
	}
	.btn2{
		background-color: #ffc107 !important;
	}
	.btn3{
		background-color: #ff5722  !important;
	}
	
	.btn4{
		background-color: #4caf50 !important;
	}
	.btn{
		    font-size: 1em !important;
		padding: 0.5em;
		
		color: #ffffff;
	}
	.row{
	width:100% !important;
	display:flex;
	
}

.col-50{
	display:flex;
	width:100% !important;
}
.col-30{
display:flex;
	width:100% !important;
}
.col-100{
display:flex;
	width:100% !important;
}
#loading1{
	display:none;
}
	@media all and (min-width: 414px) {
		#duyetform{
		display:flex;
		width:100%;
		height:100%;
		background-color:#FFFFFF;
		flex-direction: column;
		padding:1em;
	}
	
	}
	@media all and (min-width: 600px) {
		#duyetform{
		font-size:16px !important;
		
	 }
		#showform table td{
			font-size:1.4em;
			padding:0.5em;
		}
		#showform{
			width: 100%;
			height: 100%;
			margin-top: 2em;
			font-size: 3em;
			overflow:scroll;
				height: 90vh;
		}
		
			#showform select {
					font-size: 50px;
		width: 50%;
			
			}
		#duyetform{
				display:flex;
			width:100%;
			height:100%;
			background-color:#FFFFFF;
			flex-direction: column;
			padding:1em;
		}
		
		#duyetform button{
					background-color: unset;
				border: none;
				font-size: 1em;
		}
		#titl{
				font-size: 3em;
		display: flex;
		flex-direction: column;	
		}
		#titl span{
			
		}
		
		#showform .form{
				display: flex;
			flex-wrap: wrap;
				flex-direction: column;
		}
		#showform .form >div{
			width:100%;
		}
		#showform .form .block_d >div{
			width:100%;
			display: flex;
		}
		#showform .form .block_d  label{
			width:50% !important;
		}
		#showform .form .block_i >div{
			
		}
		#showform .form .block_i label{
			
		}
		#closepo{
			font-size:3em !important;
		}
	}
	
	@media all and (min-width: 1024px) {
	#closepo{
			font-size:1.5em !important;
		}
	.col-50{
	width:50% !important;
}
.col-30{
	width:30% !important;
}
.col-100{
	width:100% !important;
}
		#duyetform{
		font-size:16px !important;
		
	 }
	 #showform .ghichu{
		width:20% !important;
	}
		#duyetform{
			width:90%;
			height:90%;
		}
		#showform{
			width: 97%;
			margin:0 auto;
			height: 100%;
			margin-top: 1em;
			font-size: 1em;
			overflow:scroll;
		}
		
			#showform select {
					font-size: 14px;
		width: 50%;
		margin-left:1em;
			
			}
		#duyetform{
				display:flex;
			width:90%;
			height:80vh;
			background-color:#FFFFFF;
			flex-direction: column;
			padding:1em;
		}
		
		#duyetform button{
					background-color: unset;
				border: none;
				font-size: 1em;
		}
		#titl{
			    font-size: 1em;
    display: flex;
    flex-direction: row;
}
		
		#titl span{
			margin-left:1em;
		}
		
		#showform .form{
				display: flex;
			flex-wrap: wrap;
				    flex-direction: row;
					padding:0.7em;
		}
		#showform .form >div{
			width:50%;
		}
		#showform .form .block_d{
			width:100%;
			display: flex;
		}
		#showform .form .block_d >div{
			    flex-direction: row;
		}
		#showform .form .block_d  label{
			width:30% !important;
		}
		#showform .form .block_i >div{
			
			
			
		}
		#showform .form .block_i label{
			
		}
		#showform .form .block_d .btn_w{
			width:60%;
		}
	}
	
	@media all and (min-width: 1280px){
		#duyetform{
			
		}
		#poupduyet{
				height:100vh;
		}
	}
	
	.xoachon{
		    display: flex;
    justify-content: flex-end;
	}
	.xoachon button{
		color: chocolate;
    font-weight: bold;
	}
 </style>
<div id="poup_">
 <div id="duyetform">
 
	<div style="    display: flex;
    width: 100%;
    justify-content: space-between;
    padding-bottom: 1em;
    align-items: center;
    border-bottom: 1px solid #148a1426;">
        <div id="titl"><span><strong style="color:#FF0000">Thêm ảnh sản phẩm </strong></span>
            
            <span id="loading1"><img src="images/loading.gif" />loading...</span>
			 <span id="khonghienthi"></span>
        </div>
		<button type="button" id="closepo" onclick="closepop()" style=" color: #ff9800;
    font-weight: bold;">x</button>
    </div>
	  <div id="showform"> </div>
   
</div>

</div>

<script>
function closepop(){
 	document.getElementById('poup_').style.display="none";
 }
 
 function showpop(){
 	document.getElementById('poup_').style.display="flex";
 }
  function showloading1(){
  	if(document.getElementById('loading1')){
 		document.getElementById('loading1').style.display="block";
	}
 }
  function closeloading1(){
  	if(document.getElementById('loading1')){
 	document.getElementById('loading1').style.display="none";
	}
 }
</script>

<div class="top_space"></div>
<div class="nenbao">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >Chọn hàng hóa bán</label> 
	</a></legend>
 
<form name="frmttk" method="post">
 <div style="display:none" id="hthuongdan"> </div>
<div id="codechinh">
<!-- BEGIN: block_proht1 -->


<div id="chon" >
  

<input onkeypress="return chuyentiep(event,'khachdua')"   placeholder="Mã SP" autocomplete="off" type="text" name="codeprotk"  id="codeprotk"   onkeyup="goisp(this.value)"  class="text" size="9" value=""  ondblclick="this.value=''"/>   
     <input onkeypress="return chuyentiep(event,'codeprotk')"  ondblclick="this.value=''"  placeholder=" Tên SP " type="text" name="NameTK"  id="NameTK" class="text" size="9" value="" />
      <input onkeypress="return chuyentiep(event,'codeprotk')"  ondblclick="this.value=''" placeholder="Mô tả" type="text" name="mota"  id="mota" class="text" size="9" value="" />
    <input   type="hidden" name="code"  id="code" class="text" size="10" value=""  />

  
<select onkeypress="return chuyentiep(event,'search')" name="IDGrouptk"  id="IDGrouptk" class="js-nhomsp" style="width:150px">
  <option value="0" >Nhóm sản phẩm</option>
 	{cay}
 </select>
&nbsp;
<input type="button"  style="width:45px"   onclick="timsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'','',mota.value)"   name="search"  id="search" value="Tìm"/> &nbsp; 
<input type="hidden" name="soluongcon"  value="" />
	   
	   <input type="button" name="cl" style="width:38px" onclick="clearchon()" value="clear" />
	  &nbsp;  <input type="hidden" name="cl2" style="width:45px" onclick="setkhuyenmai()" value="KM 1" /> 
	  <input type="button" name="cl22" style="width:80px;display:none"  onclick="setmua2tang1()" value="Mua 2 tặng 1" />
	   <input type="button" name="" style=""  onclick="toggleShow(true,'upanhsanphamnhieu')" value="Quản lý hình ảnh" />
</div> 
<div id="sanpham" >
  
</div>

</div>	
</form>
<style>
	#showanh{
		position: fixed;
    top: 0;
    left: 0;
    display: none;
    justify-content: center;
    align-items: center;
    width: 100%;
    z-index: 100000;
    background-color: #00000087;
    height: 100vh;
    backdrop-filter: blur(5px);
  		  -webkit-backdrop-filter: blur(5px);
	}

	#anhlon{
		    width: 60%;
		height: 500px;
		background-color: #ffffff;
		     display: flex;
    align-items: center;
    justify-content: center;
		    position: relative;
	}
	#close{
		
		    background-color: #FFFFFF;
		width: 60px;
		height: 60px;
		display: flex;
		color: #000000;
		align-items: center;
		justify-content: center;
		font-size: 2em;
		font-weight: bold;
		right: 0;
		top: 0;
		position: absolute;
	}
	#hienanh{
		height:100%
	}
	
</style>
<div id="showanh" class="" onclick="toggleShowanh(false,'showanh')">
	<div id="anhlon" >
		<div id="close" onclick="toggleShowanh(false,"showanh")">X</div>
		<img src="http://localhost/fm/images/products/3112202129725_12897_789077_1505114344___Copy.jpg" id="hienanh"/>
	</div>

</div>
<script>
var folder='';
var linkkiemtraanh='upanhsanphamluu';
</script>

{FILE "templates/upanhsanphamnhieu.tpl"}


<!--<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="baocaodoanhthu.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>-->

 
<!-- End: block_proht1 -->
 
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">

function showanhlon(e){
	var target=e.target;
		var src=target.getAttribute("src");
		//console.log(src);
		document.getElementById("hienanh").src=src;
		toggleShowanh(true,"showanh");
}
function toggleShowanh(type,id){
		
		if(type){
			document.getElementById(id).style.display="flex";
		}else{
			document.getElementById(id).style.display="none";
		}

}

 function readURL(input, id) {
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
                        img.style.width = 200 + "px";
                        $("#" + id).html(img);
                    };
                    reader.readAsDataURL(file);
                } else {
                    removeUpload();
                }
            }
        }
    }

    function ChooseImage(id) {
        document.getElementById(id).click();

    }
	
var mangtam=[];
var anhchinh='';/*
function showanhc(input){
 $("#showanhchinh").html('');
  showloading1();
 
  var xhr = new XMLHttpRequest();
    var formData = new FormData();
	 var anhchinhinp = $("#anhchinh").prop('files');
	//console.log(anhchinh[0]);return;
	 var totalfiles = anhchinhinp.length;
  //console.log(totalfiles);return;
   	for (var i=0;i<totalfiles;i++) {
      	formData.append("anhchinh[]", anhchinhinp[i]);
   	}
	formData.append("LUUANHCHINH", "LUUANHCHINH");
	 xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
           	console.log(xhr.responseText)
            if (xhr.responseText) {
               $("#showanhchinh").html('<div class="img"><img src="images/products/tamfile/'+xhr.responseText+'" /></div>');	
			   	anhchinh=xhr.responseText;
            }
		 closeloading1();
        }
		
    }
    // xhr.timeout = 5000;
    xhr.open("POST", 'http://image.fmstyle.com.vn/upanhsanphamluu.php');
    xhr.send(formData);
	
}*/


function showanhc(input){
 $("#showanhchinh").html('');
  showloading1();
 
  var xhr = new XMLHttpRequest();
    var formData = new FormData();
	 var anhchinhinp = $("#anhchinh").prop('files');
		var url="https://image.fmstyle.com.vn/upanhsanphamluu.php";var urlimg="https://image.fmstyle.com.vn/anhchamcong/anhsanpham/tamfile/";
	var urlimg="https://image.fmstyle.com.vn/anhchamcong/anhsanpham/tamfile/";
	 var totalfiles = anhchinhinp.length;
 
   	for (var i=0;i<totalfiles;i++) {
      	formData.append("anhchinh[]", anhchinhinp[i]);
   	}
	formData.append("LUUANHCHINH", "LUUANHCHINH");
	
	
	UploadfileApi(url,formData)
	.then(response => response.text())
      .then(result =>
      {
       	
    	  $("#showanhtaichinh").html('<div class="img"><img src="'+urlimg+result+'" /></div>');	
			   	anhchinh=result;
			closeloading1();
      }).catch(error => console
        .log('error', error));
		
		
	
}
function UploadfileApi(endpoint, data)
{
  var url = endpoint;
  

  return fetch(url, {
    method: "POST",
    body: data
  })

}
function showchonmau(input){

  showloading1();
 
  var xhr = new XMLHttpRequest();
    var formData = new FormData();
	 var hinh = $("#hinhs").prop('files');
		var url="https://image.fmstyle.com.vn/upanhsanphamluu.php";var urlimg="https://image.fmstyle.com.vn/anhchamcong/anhsanpham/tamfile/";
	 var totalfiles = hinh.length;
 
   	for (var i=0;i<totalfiles;i++) {
      	formData.append("hinh[]", hinh[i]);
   	}
	formData.append("LUUANHMAU", "LUUANHMAU");
	UploadfileApi(url,formData)
	.then(response => response.text())
      .then(result =>
      {
      		  
		  var manghinh=JSON.parse(result);
					
					  var chuoi='';
					  if(manghinh.length>0){
						for(var i =0;i<manghinh.length;i++){
						var fname=manghinh[i];
							mangtam[fname]='';
								chuoi+= '<div class="block_i col-50 " id="'+fname+'"><div class="img"><div class="xoachon"><button value="'+fname+'" onclick="xoachonanh(event)" type="button">X </button></div><img src="'+urlimg+fname+'" data-name="'+fname+'" /></div><div class="choose" style="padding:1em;display:none"><select id="mau" name="mau" class="js-mau" data-name="'+fname+'" onchange="choosemau(event)"><option value="">Chọn màu</option><option value="a">Màu a</option><option value="b">Màu b</option><option value="c">Màu c</option><option value="d">Màu d</option><option value="e">Màu e</option></select></div></div>';
							 
									  
							}
							 $("#showanhtai").append(chuoi);
							  closeloading1();
					}
      })
      .catch(error => console
        .log('error', error));
	
	
	return;
	
		
}
/*function showchonmau(input){

  showloading1();
 
  var xhr = new XMLHttpRequest();
    var formData = new FormData();
	 var hinh = $("#hinhs").prop('files');
	//console.log(hinh);return;
	 var totalfiles = hinh.length;
 
   	for (var i=0;i<totalfiles;i++) {
      	formData.append("hinh[]", hinh[i]);
   	}
	formData.append("LUUANHMAU", "LUUANHMAU");
	 xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
           
            if (xhr.responseText) {
              
			  var manghinh=JSON.parse(xhr.responseText);
			
			  var chuoi='';
			  if(manghinh.length>0){
			  	for(var i =0;i<manghinh.length;i++){
				var fname=manghinh[i];
			  		mangtam[fname]='';
						chuoi+= '<div class="block_i col-50 " id="'+fname+'"><div class="img"><div class="xoachon"><button value="'+fname+'" onclick="xoachonanh(event)" type="button">X</button></div><img src="images/products/tamfile/'+fname+'" data-name="'+fname+'" /></div><div class="choose" style="padding:1em"><select id="mau" name="mau" class="js-mau" data-name="'+fname+'" onchange="choosemau(event)"><option value="">Chọn màu</option><option value="a">Màu a</option><option value="b">Màu b</option><option value="c">Màu c</option><option value="d">Màu d</option><option value="e">Màu e</option></select></div></div>';
					 
							  
					}
					 $("#showanhtai").append(chuoi);
			  }
            }
		 closeloading1();
        }
		
    }
    // xhr.timeout = 5000;
    xhr.open("POST", 'http://image.fmstyle.com.vn/upanhsanphamluu.php');
    xhr.send(formData);
	
	
	return;
	
		
}*/
var tamvalue='';
function xoachonanh(e,loai=''){

	var target=e.target;
	var value=target.value;

	if(loai){
		
		tamvalue =value;
			 showloading1();
 
 
    var formData = new FormData();

		var url="https://image.fmstyle.com.vn/upanhsanphamluu.php";
		var urlimg="https://image.fmstyle.com.vn/anhchamcong/anhsanpham/tamfile/";
	
 
  
	formData.append("DATAXOAANH", value);
	
	
	UploadfileApi(url,formData)
	.then(response => response.text())
      .then(result =>
      {
      		 xuly2();
			closeloading1();
      }).catch(error => console
        .log('error', error));
		
	}
	else{
		delete mangtam[value];
		document.getElementById(value).remove();
	}

	
}
function xoachonanhchinh(e){
	var target=e.target;
	var value=target.value;
		tamvalue =value;
		 poststr= "DATAXOAANH="+ encodeURIComponent(value)+  "*@!";
	  	loadtrang('khonghienthi', "upanhsanphamluu", poststr,"xuly3") ;

	
}
function xuly3(){
		anhchinh='';
		document.getElementById(tamvalue).remove();
		
}
function xuly2(){
		delete mangtam[tamvalue];
		document.getElementById(tamvalue).remove();
		
}
function choosemau(e){
	var target =e.target;
	var name=target.getAttribute("data-name");
	var value=target.value;
	mangtam[name]=value;
	
}

var linktam='';
var idtam='';
function luuanh(id) {

	showloading1();
	
    var formData = new FormData();
	mangtam={ ...mangtam }
	var chuoihinh=JSON.stringify(mangtam);
	
	//console.log(chuoihinh)
	 var anhchinhtam = anhchinh;
	 formData.append("id",id);
	formData.append("chuoihinh",chuoihinh);
	formData.append("LUUTT","LUUTT");
	formData.append("anhchinh",anhchinhtam);
	
		var url="https://image.fmstyle.com.vn/upanhsanphamluu.php";
		var urlimg="https://image.fmstyle.com.vn/anhchamcong/anhsanpham/tamfile/";
	UploadfileApi(url,formData)
	.then(response => response.text())
      .then(result =>
      {
	  	
	  
            if (result >0) {
				 linktam=urlimg+anhchinhtam;
              
				 idtam=id;
				  poststr= "LUUTT="+ encodeURIComponent(chuoihinh)+  "*@!"+ encodeURIComponent(anhchinhtam)+  "*@!"+ encodeURIComponent(id)+  "*@!";
	  			loadtrang('resluu', "upanhsanphamluu", poststr,"xuly9") ;
				 
            } else {
                alert("Có lỗi xảy ra vui lòng thử lại!");
            }
         
		  closeloading1();
      }).catch(error => console
        .log('error', error));
	
   /* xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
           	console.log(xhr.responseText)
            if (xhr.responseText >0) {
                alert("Đã thêm thành công!");
				 mangtam=[];
				 closepop();
				 document.getElementById('addimg'+id).innerHTML='<img src="images/products/'+anhchinhtam+'" style="width:30px"/>';
				 
            } else {
                alert("Có lỗi xảy ra vui lòng thử lại!");
            }
         
		  closeloading1();
        }
		
    }
    // xhr.timeout = 5000;
    xhr.open("POST", 'https://image.fmstyle.com.vn/upanhsanphamluu.php');
    xhr.send(formData);*/
}
function xuly9(){
var tam=document.getElementById("resluu").innerHTML;

if(tam==1){
  alert("Đã thêm thành công!");
				 mangtam=[];
				 closepop();
				
				 document.getElementById('addimg'+idtam).innerHTML='<img src="'+linktam+'" style="width:80px"/>';
				 }
}


function getsp(codepro){
showpop();
	 poststr= "DATA="+ encodeURIComponent(codepro)+  "*@!";
	  loadtrang('showform', "upanhsanphamform", poststr,"xuly1") ;
}

function xuly1(){
	var hinhdaluu=document.getElementById("hinhdaluu").value;
	anhchinh=document.getElementById("anhchinhdaluu").value;
	if(hinhdaluu){
		var hinhdaluu=JSON.parse(hinhdaluu);
		mangtam=OtoAR(hinhdaluu);
		
		//mangtam=[ ...hinhdaluu ];
		console.log(mangtam)
	}
	
}	

function OtoAR(object){
var result=[];
	//convert object keys to array
	var k = Object.keys(object);
	//convert object values to array
	var v = Object.values(object);
	
	for(var i=0;i<k.length;i++){
		var key=k[i];
		var value=v[i];
		result[key]=value;
	}
	return result;
}
function clearchon() 
 {
 
	document.getElementById('NameTK').value= '' ;		
	document.getElementById('codeprotk').value= '' ;		
	document.getElementById('code').value= '' ;		
	document.getElementById('IDGrouptk').value = '0' ;		
 	document.getElementById('sanpham').innerHTML = document.getElementById('luutimsp').innerHTML ;
 }
 	$(document).ready(function() {
	    $('.js-nhomsp').select2();
		
	 
	});
	(timsanpham('','','','','','',''))();
	function timsanpham(t1,t2,t3,t4,t5,t6,t7){
	
	  poststr="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
	  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7);
	  loadtrang('sanpham', "upanhsanphamtim", poststr,"") ;
  
 } 
	function xuattimsanpham(t1,t2,t3,t4,t5,t6){
	
  poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr = poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6);
  loadtrang('sanpham', "upanhsanphamtim", poststr,"") ;
  
 } 

</script>
 
</fieldset></div>
