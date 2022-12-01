 
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
		padding: 0.5em 0.8em;
		
		color: #ffffff;
	}
	.row{
	width:100% !important;
	display:flex;
	flex-direction: column;
}

.col-50{
	display:flex;
	width:100% !important;
	padding:0.5em;
}
.col-30{
display:flex;
	width:100% !important;
	padding:0.5em;
}
.col-100{
display:flex;
	width:100% !important;
	padding:0.5em;
}
#loading1{

}
.block_wr{
	    flex-direction: column !important;
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
	.block_wr{
	    flex-direction: column !important;
}
#closepo{
	font-size:3em !important;
}
		.row{
		
	width:100% !important;
	display:flex;
	flex-direction: row;
}
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
		
	}
	
	@media all and (min-width: 1024px) {
	#closepo{
	font-size:2em !important;
}
	.block_wr{
	    flex-direction: row !important;
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
			width: 100%;
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
            
            <span id="loading1"></span>
        </div>
		<button type="button" id="closepo" onclick="closepop()" style="   color: #ff9800;
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
	  
    <input   type="text" name="code"  id="code" class="text" size="10" value="" placeholder="code" />

  
<select onkeypress="return chuyentiep(event,'search')" name="IDGrouptk"  id="IDGrouptk" class="js-nhomsp" style="width:150px">
  <option value="0" >Nhóm sản phẩm</option>
 	{cay}
 </select>
&nbsp;
<input type="button"  style="width:45px"   onclick="timsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'','',mota.value)"   name="search"  id="search" value="Tìm"/> &nbsp; 
   <input type="button"  style="width:100px"   onclick="tongdiemsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'','',mota.value)"   name="search"  id="search" value="Tổng điểm"/> &nbsp; 
	   <input type="button" name="cl" style="width:38px" onclick="clearchon()" value="clear" />
	  
	 
	  
</div> 
<div id="sanpham" >
  
</div>

</div>	
</form>
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

function luuanh(id) {
	var diemmau=$("#diemmau").val();
	var diemcl=$("#diemcl").val();
	var ghichu=$("#ghichu").val();
	poststr= "DATA="+ encodeURIComponent(id)+  "*@!"+encodeURIComponent(diemcl)+  "*@!"+encodeURIComponent(diemmau)+  "*@!"+encodeURIComponent(ghichu);
	  loadtrang('loading1', "danhgiasanphamluu", poststr,"xuly1") ;
}


function luuanhgoc(code) {
	var diemmau=$("#diemmau").val();
	var diemcl=$("#diemcl").val();
	var ghichu=$("#ghichu").val();
	poststr= "DATAGOC="+ encodeURIComponent(code)+  "*@!"+encodeURIComponent(diemcl)+  "*@!"+encodeURIComponent(diemmau)+  "*@!"+encodeURIComponent(ghichu);
	  loadtrang('loading1', "danhgiasanphamluu", poststr,"xuly1") ;
}
function getsp(codepro){
showpop();
	 poststr= "DATA="+ encodeURIComponent(codepro)+  "*@!";
	  loadtrang('showform', "danhgiasanphamform", poststr,"xuly1") ;
}
function getspgoc(code){
	showpop();
	 poststr= "DATAGOC="+ encodeURIComponent(code)+  "*@!";
	  loadtrang('showform', "danhgiasanphamform", poststr,"xuly1") ;

}
function xuly1(){
	var tam=document.getElementById("loading1").innerHTML;
	
	
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
	  loadtrang('sanpham', "danhgiasanphamtim", poststr,"") ;
  
 }
 
 
 function tongdiemsanpham(t1,t2,t3,t4,t5,t6,t7){
	
	  poststr="DATATONGDIEM="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
	  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7);
	  loadtrang('sanpham', "danhgiasanphamtim", poststr,"") ;
  
 } 
	function xuattimsanpham(t1,t2,t3,t4,t5,t6){
	
  poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr = poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6);
  loadtrang('sanpham', "danhgiasanphamtim", poststr,"") ;
  
 } 

</script>
 
</fieldset></div>
