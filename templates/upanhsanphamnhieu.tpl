<style>

#upanhsanphamnhieu{
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
</style>

<div id="upanhsanphamnhieu" class="" >
	<style>
	.folder-fist{
		border: 1px solid #3498db;
		padding: 15px 10px;
		border-radius: 3px;
		margin: 10px 0px;
		color: #161e27;
		font-size: 14px;
	}
	.folder-fist:hover{
		background-color: #3498db5d;
		color: #0e1218;
	}

	.active{
		background-color: #3498db5d;
	}

	.folder-child{
		padding: 0;
		display: flex;
		align-items: center;
	}
	.btn-folder{
		width: 80%;
		border: none;
		background: none;
		padding: 15px 0px;
		font-size: 14px;
	}
	#span-folder{
		margin-right: 10px;
		background-color: #3498db;
		width: 15px;
		height: 15px;
		font-size: 10px;
		display: flex;
		align-items: center;
		justify-content: center;
		border-radius: 50px;
		color: #fff;
		
	}

	#number-image{
		display: flex !important;
		align-items: center !important;
	}
	.gid-item{
		display: grid;
		grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr; 
		grid-column-gap: 20px;
		height: 310px;
    	overflow: auto;
	}

	.gid-item .grid-next{
		margin-top: 10px;
		position: relative;
	}

	.grid-next-alone{
		margin-top: 15px;
		padding: 10px;
		box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
		border-top: 1px solid;
	}

	.grid-next-alone img{
		width: 100px !important;
		height: 130px;
		object-fit: cover;
	}

	.refCheck{
		position: absolute;
	}

	.gid-item .grid-next img{
		width: 100%;
    object-fit: cover;
    height: 100px;
    border-radius: 5px;
    box-shadow: rgb(149 157 165 / 20%) 0px 8px 24px;
	}
	.input-sm{
		border: 1px solid #8888;
	}
	

	.input-sm:focus-visible{
		border: 1px solid rgba(34, 34, 34, 0.533);
		outline: none;
	}

	.header-folder{
		display: flex;
		justify-content: space-around;
		margin-bottom: 10px;
	}

	.button-folder-sm{
		height: 30px;
		padding: 5px 10px;
		font-size: 12px;
		line-height: 1.5;
		border-radius: 3px;
		border: none;
	}

	.col-layout{
		height: calc(100vh - 50px) !important;
	}
</style>
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
	#upanhsanphamnhieu .block_i{
		    width: 120px !important;
    position: relative;
    margin-right: 10px;
    display: flex;
    flex-direction: column;
		}
	
	#upanhsanphamnhieu .xoachon button{
		position: absolute;
	right: 0;
	color: #FF0000;
	background-color: unset;
	border: none;
	font-size: 16px;
	font-weight: bold;
	}	
	#upanhsanphamnhieu .folder-child{
		display:none;
	}
 #upanhsanphamnhieu	.row{
		display:flex;
	}
	#upanhsanphamnhieu .title_{
		display:flex;
		    justify-content: space-between
	}
	#upanhsanphamnhieu .title_ span{
		cursor: pointer;
    font-size: 25px;
    color: #FF0000;
    font-weight: bold;
	}
	</style>
<div name="frmxuat" id="frmxuat" method="get" style="height: calc(100vh - 80px)">
	<div class="nenbao">
		<div style="padding:0px">
			<fieldset class="nencon" style="padding: 10px;">
			<div class="title_"><h3 style="margin: 0;">UPLOAD IMAGE</h3> <span onclick="toggleShow(false,'upanhsanphamnhieu')">X</span></div>
				
				<div class="container" style="padding:0">
					<div class="row">
						<div class="col-md-4">
							<div class="folder-fist folder-child">
								<button class="btn-folder">
									<span>
										<i class="icofont-folder"></i> 
										sản phẩm
									</span>
								</button>
								<div id="number-image">
									<span  id="span-folder">4</span>
									<span><i class="icofont-listine-dots"></i></span>
								</div>
							</div>

						
							<div class="folder-fist folder-child">
								<button class="btn-folder"  disabled="disabled">
									<span>
										<i class="icofont-folder"></i> 
										Ảnh văn phòng
									</span>
								</button>
								<div id="number-image">
									<span  id="span-folder">4</span>
									<span><i class="icofont-listine-dots"></i></span>
								</div>
							</div>
							<div class="folder-fist folder-child">
								<button class="btn-folder" disabled="disabled">
									<span>
										<i class="icofont-folder"></i> 
										Ảnh nhân viên
									</span>
								</button>
								<div id="number-image">
									<span  id="span-folder">4</span>
									<span><i class="icofont-listine-dots"></i></span>
								</div>
							</div>
							<div class="folder-fist folder-child">
									<button class="btn-folder" disabled="disabled">
										<span>
											<i class="icofont-folder"></i> 
											Tạo thư mục mới
										</span>
									</button>
									
								</div>
							</div>
						<div class="col-md-8" style="width:90%;padding:0">
							<div class="header-folder" style="display:none">
								<input type="text" placeholder="Tìm kiếm bằng tên" class="input-sm" >
								<button style="background-color: #2ecc71;color: #fff;" class="button-folder-sm" title="Bỏ chọn tất cả">
										Bỏ chọn tất cả
								</button>
								<button style="background-color: red;color: #fff;" class="button-folder-sm" title="Xoá ảnh khỏi thư mục">
										
											Xoá ảnh đã chọn
								</button>
							</div>
							<div class="gid-item_load" id="gid-item_load">
									<div style="" class="drop-area" id="drop-area">
												Chọn Ảnh <span style="color:#FF0000;font-style:italic;    font-weight: bold;font-size:15px">(*) đặt tên ảnh theo quy tắc  "mã mô tả hoặc mã sản phẩm" + "-" +"màu"+"-"+"size" <br />Ảnh hiện lên màu xanh sẽ được tải lên, ảnh màu đỏ sẽ không được tải lên<br/>(*)VD: NS01PKU0601-XL-XL.jpg
												</span>
								 
											<form class="my-form">
											
											<input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
											  <input type="hidden" id="idk" name="idk" value="{idk}">
												<label class="button" for="fileElem">Select some files</label>
										  </form>
											 <div id="loadings" style="display:none"><img src="images/loading.gif"/>loading...</div>
										  <div id="gallery" />  
										  
										  </div>
										</div>
							</div>
							<div class="gid-item" id="gid-item" style="display:none">
							
									
										
								<label class="grid-next" for='check0'>
									<input type="checkbox" class="refCheck" name="" id="check0" value="" style="cursor:pointer">
									<img src="https://kimhoangvu.net/webhook/facebook/imagesfb/Quan%20hung/1644979359_313135100_bggreen.jpg" alt="">
								</label>
								<label class="grid-next" for='check0'>
									<input type="checkbox" class="refCheck" name="" id="check0" value="" style="cursor:pointer">
									<img src="https://kimhoangvu.net/webhook/facebook/imagesfb/Quan%20hung/1644979359_313135100_bggreen.jpg" alt="">
								</label>
							</div>
							
						</div>
					</div>
				</div>
				<div class="form-group col-12" id="hinhanhbanner">
	<button style="margin-left: 10px;" type="button" name="btnlogo" class="btn-success btn-upload btn btn-primary" onclick="luuanhnhieu()">
		<i class="fa fa-camera-retro" aria-hidden="true" style="font-size: 1.5em;"></i>Tải lên</button>
	<!--<input type="file" name="logoss" id="logoss" class="form-group" style="display:none" onchange="readURL(this,'review_img2')" />-->
	<button style="margin-left: 10px;display:none" type="button" class="btn btn-primary" > Đăng ảnh</button>
	
			</fieldset>
			
		</div>
		
	</div>


</div>
</div>
<div id="reskiemtrahinh" style="display:none" ></div>
<script>
var mangtam=[];
var mangtamluu=[];
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
	 var url = 'https://image.fmstyle.com.vn/upanhsanphamluu.php?type=checksp'
 	
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
				    checkTenhinh(result);
			  var result=JSON.parse(result);
			
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


function checkTenhinh(manghinh){
	 poststr= "KIEMTRAHINH="+ encodeURIComponent(manghinh)+  "*@!";
	  	loadtrang('reskiemtrahinh',linkkiemtraanh, poststr,"xuly5") ;

}

function xuly5(){
		var tam=document.getElementById("reskiemtrahinh").innerHTML;
		
		
		if(tam && tam!=-1){
		tam=JSON.parse(tam);
	
			var manghinh=tam.data;
			
				var urlimg=tam.link;
						  var chuoi='';
						 if(manghinh.length>0){
							for(var i =0;i<manghinh.length;i++){
							var fnametam=manghinh[i];
							mangtam[fnametam]='';
							var masp=fnametam.split("--");
							
							var color="#1dc9c9";
							var fname='';
							if(masp[0]==fnametam){
								color="red";
								fname=masp[0];
							}
							else{
								fname=masp[1];
								
								
							}
							
								
									chuoi+= '<div class="block_i col-50 " id="'+fname+'"><div class="img"><div class="xoachon"><button value="'+fname+'" onclick="xoachonanh(event)" type="button">X </button></div><img src="'+urlimg+fname+'" data-name="'+fname+'" /></div><span style="color:'+color+';    font-weight: bold;display: flex;width: 90%;word-break: break-all;">'+fname+'</span></div>';
								 
										  
								}
								 $("#gallery").append(chuoi);
								isloading(false,"loadings"); 
						}
		}
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
		
			tamvalue =value;
			isloading(true,"loadings"); 
 
 
    var formData = new FormData();

		 var url = 'https://image.fmstyle.com.vn/upanhsanphamluu.php?type=checksp';
		 formData.append("iduser", iduser);
		 formData.append("folder", folder);
		formData.append("delete", value);
	UploadfileApi(url,formData)
	.then(response => response.text())
      .then(result =>
      {
      		 xuly2();
			isloading(false,"loadings"); 
      }).catch(error => console
        .log('error', error));
		
	}
	else{
		delete mangtam[value];
		//console.log(mangtam);
		document.getElementById(value).remove();
	}

	
}

function xuly2(){
		delete mangtam[tamvalue];
	
		document.getElementById(tamvalue).remove();
		
}

function luuanhnhieu(){

	
	var iduser=document.getElementById("idk").value;
	if(!iduser){
		alert("lỗi!");
		return;
	}

 if(mangtam){
 
	  mangtam={ ...mangtam };
		
  }
  else{
  	alert("Chưa chọn ảnh!");
		return;
  }
		 
 if(mangtam.length<=0){
 	alert("Chưa chọn ảnh!");
		return;
 }
			isloading(true,"loadings"); 
 
 
    var formData = new FormData();
	
		 var url = 'https://image.fmstyle.com.vn/upanhsanphamluu.php?type=checksp';
		formData.append("save", 1);
		 var chuoianhluu='';
    
		
	chuoianhluu=JSON.stringify(mangtam);
			formData.append("data", chuoianhluu);
			formData.append("iduser", iduser);
			 formData.append("folder", folder);
	UploadfileApi(url,formData)
	.then(response => response.text())
      .then(result =>
      {
      		 UpdateDulieuAnh(JSON.stringify(mangtam));
			
      }).catch(error => console
        .log('error', error));

}

function UpdateDulieuAnh(manghinh){
	 poststr= "UPDATEHINH="+ encodeURIComponent(manghinh)+  "*@!";
	  	loadtrang('reskiemtrahinh', linkkiemtraanh, poststr,"xuly6") ;
}

function xuly6(){
	var tam=document.getElementById("reskiemtrahinh").innerHTML;
	if(tam){
		tam=tam.split("###");
		alert(tam[2]);
		isloading(false,"loadings"); 
	}
}
</script>


<script language="JavaScript">

function loadanh(thumuc){
		
}
getAllFolderRequest = () =>
{
  return (dispatch) =>
  {
    return GetApiMyhost('getfile.php?type=getfolder', '', 'GET', '')
      .then(response => response.text())
      .then(result =>
      {
	  	console.log(result);
      })
      .catch(error => console
        .log('error', error));
  };
};

function GetApiMyhost(endpoint, accesstoken = null, method = "GET", join = "&", data)
{
  var url = LinkApi.LinkApiMyhost;
  url += endpoint;
  var raw = JSON.stringify(data);
  // console.log(url);
  var myHeaders = new Headers();

  myHeaders.append("Content-Type", "application/json");
  myHeaders.append("Cookie", "sb=7yC7YPRdvUTACsPMzGr1Z0iH");

  // myHeaders.append("Cookie", "PHPSESSID=3qrv5f6t6ahqbifi808040m5s1");

  var requestOptions = {
    method: method,
    headers: myHeaders,
    redirect: 'follow'
  };
  if (method === "POST") {
    requestOptions = {
      method: method,
      headers: myHeaders,
      redirect: 'follow',
      body: raw,
    };
  }

  return fetch(url, requestOptions);

}
</script>

<script>
	var selector = '.folder-fist';

	$(selector).on('click', function(){
		$(selector).removeClass('active');
		$(this).addClass('active');
	});
	
	function toggleShow(type,id){
		
		if(type){
			document.getElementById(id).style.display="flex";
		}else{
			document.getElementById(id).style.display="none";
		}

}
</script>