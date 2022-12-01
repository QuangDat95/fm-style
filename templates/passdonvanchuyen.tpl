<style>
 	#showformhuy{
	    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 1;
    align-items: center;
    justify-content: center;
    background-color: #0000006e;
    top: 0;
    left: 0;
	}
	#showformhuy .content_form{
	        display: flex;
    flex-direction: column;
    width: 50%;
    height: 50%;
    align-items: center;
    background-color: #ffffff;
    justify-content: flex-start;
	padding:1em;

	}
	
	#showformhuy .content_form >div{
		width:100%;
		    display: flex;
    justify-content: flex-start;
	margin:0.5em 0;
	}
	#showformhuy .content_form #lydo{
		width:84%;
	}
	#showformhuy .content_form .title{
		color:#009999;
		font-weight:bold;
	}
	#showformhuy .content_form div span{
		color:#006699;
		font-weight:bold;
		margin-right:2em;
		
	}
	#show_images_huy {
		display:flex;
		width: 100%;
		min-height: 100px;
			
	}
	#show_images_huy div{
		width:15%;
		margin-right:0.5em;
	}
	#show_images_huy div img{
			width:100%;
	}
	.btn-action button{
			border:none;
			color:#ffffff;
			  
    padding: 0.5em;
    border-radius: 3px;
	margin-right:1em;

	}
 </style>
 <div id="showformhuy">
	<div class="content_form">
	<h4 class="title">Nhập lý do hủy đơn</h4>
	<input type="hidden" name="idpass" id="idpass" />
	<input type="hidden" name="loaipass" id="loaipass" />
	<div class=""><span >Đơn pass: </span><input type="text" name="soctpass" id="soctpass" /></div>
		<div class=""><span >Lý do hủy: </span><input type="text" name="lydo" id="lydo" /></div>
		<div class=""><span>Hình ảnh: </span><input type="file" name="hinhanh[]" id="hinhanh" onchange="readURL(this)" multiple/></div>
		<div id="show_images_huy">
			
		</div>
		<div class="btn-action"><button style="background-color:#009966" onclick="xacnhanhuy(event)">Xác nhận</button><button style="background-color:#FF9900" onclick="dongfom()">Đóng</button>
		<div id="loadinghuy" style="display:none"><img src="images/loading.gif" /></div>
		</div>
	</div>
 </div>
<script>
function xacnhanhuy(e){
var target=e.target;

	target.disabled=true;

	document.getElementById("loadinghuy").style.display="inline-block";
	var lydo=document.getElementById("lydo").value;
	var hinhanh =document.getElementById("hinhanh").files;
	if(!lydo){
		alert("Vui lòng nhập lý do!");
		document.getElementById("loadinghuy").style.display="none";
		return;
	}
	if(!hinhanh){
		alert("Vui lòng chọn ảnh!");
		document.getElementById("loadinghuy").style.display="none";
		return;
	}
		var soctpass =document.getElementById("soctpass").value;
		var idpass =document.getElementById("idpass").value;
	  var xhr = new XMLHttpRequest();
    var formData = new FormData();
	formData.append("huydon","huydon");
	formData.append("lydo",lydo);
	formData.append("soctpass",soctpass);
	formData.append("idpass",idpass);
	formData.append("loaipass",8);
	for(var i=0;i<hinhanh.length;i++){
			formData.append("hinh[]",hinhanh[i]);
	}
	
	
	//++++++++++++++++send
	  xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
           if(xhr.responseText){
		   		xulynhandon(xhr.responseText)
					dongfom();
					target.disabled=false;
				document.getElementById("loadinghuy").style.display="none";
		   }
           
        } else {
            console.log("fail");
			
        }
    }
    // xhr.timeout = 5000;
    xhr.open("POST", './passdonvanchuyenxuly.php');
    xhr.send(formData);
	
	//+++++++++++++
	//console.log(FormData);
}
function dongfom(){
	document.getElementById("showformhuy").style.display="none";
	document.getElementById("lydo").value='';
	document.getElementById("hinhanh").value='';
	document.getElementById("show_images_huy").innerHTML='';
	
}
function showfom(){
	document.getElementById("showformhuy").style.display="flex";
	document.getElementById("lydo").value='';
	document.getElementById("hinhanh").value='';
	document.getElementById("show_images_huy").innerHTML='';
	
}

function showFormhuy(soctpass,idpass,t1,t2,t3,t4){
document.getElementById('soctpass').value=soctpass;
document.getElementById('idpass').value=idpass;
document.getElementById('loaipass').value=t1;
	if(confirm("Bạn có chắc muốn hủy đơn này?")){
		showfom();
	
	}
}
function readURL(input) {

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
						// img.style.width=50+"px";
						// img.style.marginLeft=10+"px";
                        //img.setAttribute("class", "file-upload-image");
						var div = document.createElement("div");
						div.append(img);
                        $("#show_images_huy").append(div);
                    };
                    reader.readAsDataURL(file);
                } else {
                    removeUpload();
                }
            }
        }
    }
	
</script>

 <style>
 	.tinmoi{
    background-color: #1b6dff;
    box-shadow: 0px 1px 10px 0px #000000;
    color: #ffffff;
		}
		#thongbaodonmoi{
		font-size: 15px;
    font-weight: 800;
    position: absolute;
    top: -18px;
    right: 5px;
    background-color: #f44336;
    display: flex;
    width: 20px;
    height: 20px;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    border-radius: 5px;
		}
 </style>
<div class="top_space"></div>
<div class="nenbao" style="min-height:700px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >Các Phiếu pass đơn</label></a></legend>
 

 <form name="frmonline1" method="post" action="default.php?act=online" enctype="multipart/form-data">
<div style="padding-bottom:10px; ">&nbsp;<span style="padding-bottom:10px">

<input placeholder="Mã nhân viên"  style="width:90px"  ondblclick="this.value=''" onkeypress="return chuyentiep(event,'codeprotk')" type="text" name="manv"  id="manv" class="text"   value=""  style="display:none"/>
<input placeholder=" Mã VĐ"  style="width:90px"  ondblclick="this.value=''" onkeypress="return chuyentiep(event,'codeprotk')" type="text" name="mavd"  id="mavd" class="text"   value=""  />
<input placeholder=" Số phiếu"  style="width:120px"  ondblclick="this.value=''" onkeypress="return chuyentiep(event,'codeprotk')" type="text" name="sophieu"  id="sophieu" class="text"   value=""  />
<input  placeholder="khách hàng"    style="width:80px;display:none" onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="ten"  ondblclick="this.value=''" id="ten" class="text"   value=""/>
<input placeholder="Điện thoại"  onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="tel"  ondblclick="this.value=''" id="tel" class="text"   style="width:80px;display:none" value=""   />
<input  type="hidden" name="tinhtrang"  id="tinhtrang" class="text"   value="0"  />
<input    type="hidden" name="tinhtranghang"  id="tinhtranghang" class="text"   value="0"  />
<select onkeypress="return chuyentiep(event,'search')" name="nguoitao"   class="js-nguoitao"  id="nguoitao" style="width:210px;display:none">
  <option value="0" >Nhân viên online</option>
  
 	{nguoitao}
     
</select>
Từ
<input onkeypress="return chuyentiep(event,'denngay')" type="text" ondblclick="this.value=''"  name="tungay"   id="tungay" class="text" style="width:65px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmttk.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
<input onkeypress="return chuyentiep(event,'htchitiet')" type="text" ondblclick="this.value=''"  name="denngay"  id="denngay" class="text" style="width:65px" value="{denngay}" />
<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmttk.denngay,'dd/mm/yyyy',this)" />&nbsp;
<span style="position:relative"> <input type="button"    onclick="return submittk(manv.value,mavd.value,ten.value,tel.value,tinhtrang.value,tinhtranghang.value,tungay.value,denngay.value,nguoitao.value,0,sophieu.value)"   name="search" style="width:38px" id="search" value="Xem" /> <span id="thongbaodonmoi">0</span></span>
<input type="button" style="font-size: 12px; width: 40px;" id="xuat" value="Excel" name="xuat" onclick="xuatkq()" />
</span></div>


<div style="position:relative">
<div id="hienthongbao"  style="display:none; padding-top: 10px;  overflow: hidden; position: absolute; left: 168px; top: 38px;" align="center" >
  <div  style="width:600px; min-height:400px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#000;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidong()">( X Đóng lại )</b></div>
<div style="font-size:12px;font-weight:100">
 <table width="98%"><tr><td><strong>Hình Ảnh</strong></td><td><strong>Ghi Chú:</strong></td></tr>
 <tr><td width="360px"><img  id="hinhanh" style="border:1px solid #F60" src="images/sanpham/demo.jpg" width="350px"  /></td><td valign="top"><div id="thongtinspt"></div> </td></tr>
 </table>
</div>
</div>  </div>
<div id="htkq">

 	 
 
</div>
</div>
	<input type="hidden" name="currentPage"/>
</form>
<video style="display:none" id="nhac" src="images/ding.wav"></video>
<div style="height:10px"></div>
<script language="javascript">
document.getElementById('NameTK').focus();
</script>
 

 

 	<script type="text/javascript" src="templates/jquery.js"></script>
	<script type="text/javascript" src="templates/ajaxfileupload.js"></script>
     <script language="javascript" src="templates/passdonvanchuyen.js" > </script>
<script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/select2.min.js"></script>
    <link rel="stylesheet" media="screen" href="js/select2.min.css">
    
 
<form name="xuatketqua" id="xuatketqua" action="xuatkhoinmavach.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="inmavach.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>

 

</fieldset></div>
<div id="ketqualuu"  style="display:none"></div>
<div id="capnhapghichu"  class="thongbaott"   style="display:  ;overflow:hidden; position:fixed;    bottom: 10px;left:-10px;width:100%; " align="right" >
<div   style=" width:316px; border-radius: 6px 6px 6px 6px;  height:368px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:3px; color:#F00;" >
        <div style="color:#F00"  align="left">Đơn: <span style="color:#00F" id="donhang"></span></div>
  <div style="padding:4px " >
        <textarea name="chitiet" id="chitiet" style="width:300px;height:26px;font-size:11px;overflow:hidden;line-height:11px;color:#00F"></textarea>
    </div>
     <input name="idspghi" id="idspghi" type="hidden"     value=""   />
       <div name="ghichu2" id="ghichu2" style="overflow:scroll;width:310px;height:210px;border:1px solid #333;font-size:12px;text-align:left;padding:2px ;color:#000;"  ></div>
    <div style="padding-top:5px"><input name="noidungchat" id="noidungchat" type="text"  onkeypress=" return anenter(event)"   style="width:310px;"  value=""   /></div>
 
         <p>
           <input name="luughichu" id="luughichu" type="button"  onclick="luuchat(idspghi.value,noidungchat.value)" class="thanhtoan" value="Gởi tin" />
         &nbsp; &nbsp; &nbsp; &nbsp;
         <input name="boqua" id="boqua" type="button"  onclick="dongchat('capnhapghichu');" class="thanhtoan" value="Ẩn Chat" />
         </p>
      </div>
      
 </div> 


<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
<div id="khonghienthi" ></div>

	
 <div id="ketquaload" style="display:none"></div>
<script language="javascript">
   $(document).ready(function() {
	    $('.js-nvdonggoi').select2();
		 $('.js-nvban').select2();
	 
	});
    
 {chaymasp}
  anhienform('capnhapghichu');
  var chay =0 ;
  var donggoi=0;
 function dongchat(id)
{     chay=0 ;
 	   anhienform('capnhapghichu');
	    document.getElementById('ghichu2').innerHTML  ='';
	    
 } 
 
 
 var timebh
 
  function  chatgoi(v)
  {
       clearTimeout(timebh);
       timebh=setTimeout( function validate4() { goilaict4(v) },1200);
	 
   }
 function  xulytn()
  {
	   
       document.getElementById('ghichu2').innerHTML=ketqua ;
   }
  
function goilaict4(v)
{ 	
	if(chay==0)return;
	  
	//  document.getElementById('ketquatv').innerHTML='';
  	  poststr="DATA="+ encodeURIComponent(document.getElementById('idspghi').value)+"*@!"+encodeURIComponent(0)+"*@!"+ encodeURIComponent(0) ;
	  loadtrang('khonghienthi', "passdonchatlaynoidung", poststr,"xulytn") ;
 		 chatgoi(1);  
 }  


 
 function htchatch(id)
{     chay=1 ;
   	  document.getElementById('idspghi').value=id;  
	  chatgoi(1);
	  console.log(document.getElementById('dong_'+id).cells[6].innerHTML);
 	  document.getElementById('donhang').innerHTML  = document.getElementById('dong_'+id).cells[3].innerHTML;
	  document.getElementById('chitiet').innerHTML= document.getElementById('dong_'+id).cells[6].innerHTML;
  	  //document.getElementById('monht').innerHTML=ten;
	//  document.getElementById('ghichu2').value= document.getElementById('ghichu_'+id).innerHTML   ;  
	   anhienform('capnhapghichu');
	    
	 
}

 

function anenter(event)
{
//	alert(event.keyCode )
	
	 if (event.keyCode == 13) { document.getElementById('luughichu').click();
	  event.keyCode = '' ;
	  event.returnValue = false 
	 }
}
function xuly3()
{
   document.getElementById('noidungchat').value='' ;
  document.getElementById('ghichu2').innerHTML=ketqua ;
   document.getElementById('ghichu2').scrollTop =910;
  
}
 function luuchat(idsp,ghichu){ 
  if(trim(ghichu)=='') return ;
  ///document.getElementById('ghichu_'+idsp).innerHTML=ghichu ;
     poststr="DATA="+ encodeURIComponent(idsp)+  "*@!"+ encodeURIComponent(ghichu)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
    loadtrang('ketqualuu',"passdonchluuchat", poststr,"") ;
  } 
  
  var checkload=false;
  (()=>{submittk('','','','','','','','','','','');
  
  	setInterval(() => {
	if(checkload){
		submitRuntime(1);
	}
    	
}, 5000);
  })();
function submittk(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{
 	checkload=true;
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4); 
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7) + "*@!"+ encodeURIComponent(t8) + "*@!"+ encodeURIComponent(t9)+ "*@!"+ encodeURIComponent(t10)+ "*@!"+ encodeURIComponent(t11) ;
  loadtrang('htkq', "passdonvanchuyentim", poststr,"xuly3") ;
	
} 




function submitRuntime(t11=''){
	
//1 masp.value, 2 mavd.value,3 ten.value,4 tel.value,5 tinhtrang.value,6 tinhtranghang.value,7 tungay.value,8 denngay.value,9 nguoitao.value,0
var t1=document.getElementById('masp').value;
var t2=document.getElementById('mavd').value;
var t3=document.getElementById('ten').value;
var t4=document.getElementById('tel').value;
var t5=document.getElementById('tinhtrang').value;
var t6=document.getElementById('tinhtranghang').value;
var t7=document.getElementById('tungay').value;
var t8=document.getElementById('denngay').value;
var t9=document.getElementById('nguoitao').value;
var t10=0;
				 poststr="LOADLAI="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4); 
	 			 poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7) + "*@!"+ encodeURIComponent(t8) + "*@!"+ encodeURIComponent(t9)+ "*@!"+ encodeURIComponent(t10)+ "*@!"+ encodeURIComponent(t11) ;
	 			 loadtrang('ketquaload', "passdonvanchuyentim", poststr,'xuly2') ;
}



function xuly2(){
var tam=document.getElementById('ketquaload').innerHTML;
console.log(tam);
	if(tam){
		
				var cu=$("#thongbaodonmoi").html();
				if((1*cu)<(1*tam)){
					document.getElementById('nhac').play();
				}
		$("#thongbaodonmoi").html(tam);
		 
	}
	
	
}

function thongbaodahuydon(ngay){
		alert(ngay);
}
function xulynhandon(ketqua)
{  console.log(ketqua);
	 ketqua=ketqua.split("###");
	 
	 if(ketqua[1]=="8")
	{ 	if(ketqua[3]==-1){
				alert(ketqua[2]);
				return;
		}
		alert(ketqua[2]);
		document.getElementById("tinhtrang"+ketqua[3]).innerHTML="<span style='color:red;font-weight:bold'>Đã hủy</span>";
		document.getElementById("btnkhoa"+ketqua[3]).disabled=true;
	}
	
}


function cuahangnhandon(t1,t2,t3,t4,t5)
{
   donggoi=t1 ;
  
   
   if(t2==8){
  		  var lydo = prompt("Nhập Lý do: ");
		 
		if(!lydo)
		{
			return;
		}		
   }
   
   poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(lydo)+"*@!"+ encodeURIComponent(t4)+"*@!"+ encodeURIComponent(t5); 
   loadtrang('khonghienthires', "passdonvanchuyenxuly", poststr,"xulynhandon") ;

} 
function taovandon(t1)
{
  /* var tienship = prompt("Nhập Tiền ship: ");
			if(!tienship){
				alert("Vui lòng nhập phí ship");
				return;
			}*/
   poststr="TAOVANDON="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0); 
   loadtrang('khonghienthires', "passdonvanchuyenxuly", poststr,"xuly10") ;

} 

function xuly10(){
	var ketqua=document.getElementById("khonghienthires").innerHTML;
	 console.log(ketqua);
	 ketqua=ketqua.split("###");
	 
	 if(ketqua[1]=="8")
	{ 	if(ketqua[3]==-1){
				alert(ketqua[2]);
				return;
		}
		
		document.getElementById("vandon"+ketqua[3]).innerHTML=ketqua[4];
		document.getElementById("btntaovandon"+ketqua[3]).disabled=true;
	}
	

}
   </script>
    