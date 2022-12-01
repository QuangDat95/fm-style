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
<div  class="nencon">
<div style="width:100%;padding:0.5em">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >Các Phiếu pass đơn</label></a></legend>
 

 <form name="frmonline1" method="post" action="default.php?act=online" enctype="multipart/form-data">
<div style="padding-bottom:10px; ">&nbsp;<span style="padding-bottom:10px">
<input placeholder="Mã Sp" onkeypress="return chuyentiep(event,'IDGrouptk')"   type="text" name="masp"  ondblclick="this.value=''" id="masp" class="text" value=""  style="width:70px;display:none"  />
<input placeholder="Số chứng từ"  style="width:90px"  ondblclick="this.value=''" onkeypress="return chuyentiep(event,'codeprotk')" type="text" name="mavd"  id="mavd" class="text"   value=""  />
<input  placeholder="khách hàng"    style="width:80px;display:none" onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="ten"  ondblclick="this.value=''" id="ten" class="text"   value="" />
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


<select id="trangthai" name="trangthai">
	<option value="">Tất Cả</option>
	<option value="1">Đã nhận</option>
	<option value="2">Chưa nhận</option>
	<option value="3">Đã khóa</option>
	<option value="4">Chưa khóa</option>
	<option value="5">Đã hủy</option>
</select>
<select onkeypress="return chuyentiep(event,'search')" name="lydo"   class="js-lydo"  id="lydo" style="width:100px;">
  <option value="" >Lý do nhập xuất</option>
  
 	{lydonhapxuat}
     
</select>
<select onkeypress="return chuyentiep(event,'search')" name="cuahang"   class="js-cuahang"  id="cuahang" style="width:100px">
<option value="" >Cửa hàng</option>
  
 	{kho}
     
</select>

<span style="position:relative"> <input type="button"    onclick="return submittk(masp.value,mavd.value,ten.value,tel.value,tinhtrang.value,tinhtranghang.value,tungay.value,denngay.value,nguoitao.value,0,trangthai.value,cuahang.value,lydo.value)"   name="search" style="width:38px" id="search" value="Xem" /> <span id="thongbaodonmoi">0</span></span>
 <input type="button"    onclick="return submitketoan(masp.value,mavd.value,ten.value,tel.value,tinhtrang.value,tinhtranghang.value,tungay.value,denngay.value,nguoitao.value,0,trangthai.value)"   name="search" style="" id="search" value="Xem Kế toán" />
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
     <script language="javascript" src="templates/passdonbaocao.js" > </script>
<script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/select2.min.js"></script>
    <link rel="stylesheet" media="screen" href="js/select2.min.css">
    
 
 <form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="passdonbaocao.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>

 
</div>
</div></div>
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
	 	 $('.js-cuahang').select2();
		  $('.js-lydo').select2();
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
totalpage= document.getElementById("totalpage").value;
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
  (()=>{submittk('','','','','','','','','','','','','');
  
  	setInterval(() => {
	if(checkload){
		submitRuntime(1);
	}
    	
}, 5000);
  })();
  
var curentpage=1;
var totalpage=0;
var type=1;
var t1tam='';t2tam='';t3tam='';t4tam='';t5tam='';t6tam='';t7tam='';t8tam='';t9tam='';t10tam='';t11tam='';t12tam='';t13tam='';
function submittk(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11,t12,t13,t14=1)
{
type=1;
t1tam=t1;t2tam=t2;t3tam=t3;t4tam=t4;t5tam=t5;t6tam=t6;t7tam=t7;t8tam=t8;t9tam=t9;t10tam=t10;t11tam=t11;t12tam=t12;t13tam=t13;t14tam=t14;
 	checkload=true;
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4); 
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7) + "*@!"+ encodeURIComponent(t8) + "*@!"+ encodeURIComponent(t9)+ "*@!"+ encodeURIComponent(t10)+ "*@!"+ encodeURIComponent(t11)+ "*@!"+ encodeURIComponent(t12)+ "*@!"+ encodeURIComponent(t13)+"*@!"+ encodeURIComponent(t14) ;
  loadtrang('htkq', "passdonbaocaotim", poststr,"xuly3") ;
	
} 

function submitketoan(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11,t12,t13,t14=1)
{
//console.log(t11)

type=2
t1tam=t1;t2tam=t2;t3tam=t3;t4tam=t4;t5tam=t5;t6tam=t6;t7tam=t7;t8tam=t8;t9tam=t9;t10tam=t10;t11tam=t11;t12tam=t12;t13tam=t13;t14tam=t14;
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4); 
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7) + "*@!"+ encodeURIComponent(t8) + "*@!"+ encodeURIComponent(t9)+ "*@!"+ encodeURIComponent(t10)+ "*@!"+ encodeURIComponent(t11)+ "*@!"+ encodeURIComponent(t12)+ "*@!"+ encodeURIComponent(t13)+"*@!"+ encodeURIComponent(t14) ;
  loadtrang('htkq', "passdonbaocaokt", poststr,"") ;
	
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
	 			 loadtrang('ketquaload', "passdonbaocaotim", poststr,'xuly2') ;
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
function xulynhandon()
{ 
	 ketqua=ketqua.split("###");
	  console.log(ketqua);
	if(ketqua[1]=="1")
	{		
			if(ketqua[5]==-1){
				alert(ketqua[2]);
				return;
			}
			if(ketqua[7]){
				
				alert("Đã nhận\n"+ketqua[7].replace("*","\n"));
				document.getElementById('xacnhan'+ketqua[3]).style.display="none";
				document.getElementById('huy'+ketqua[3]).style.display="block";
				document.getElementById('huy'+ketqua[3]).setAttribute("data-id",ketqua[8]);
				$('#tinhtrangnhandon'+ketqua[3]).append('<span id="ttnhandonch'+ketqua[5]+'">'+ketqua[4]+'nhận  SP</span><br>');
				//
				var idsp=ketqua[8].split("*");
				for(var i=0;i<idsp.length;i++){
					var elsp=idsp[i];
					
					if(elsp){
						$('#sp'+elsp+" .infsp").each((index,item)=>{
								item.style.color="#c1c1c1";
						});	
							document.getElementById('sp'+elsp).style.backgroundColor="unset";
							$('#sp'+elsp).append('<span id="spchnhan'+elsp+'" style="color:#4caf50;font-weight:500"><span style="color:#4caf50;font-weight:500"> Cửa hàng nhận:</span>'+ketqua[4]+'</span>');				
								
						}
				}
			
			
			}
			else{
				alert('Không thể nhận đơn!');
			}
			if(ketqua[6]){
				var kqtam=ketqua[6].split("*");
					alert("Sản phẩm "+kqtam[0]+"-"+kqtam[1]+" Đã được nhận bởi "+kqtam[2]);
			}
	
 	}
	else if(ketqua[1]=="8")
	{ 	if(ketqua[5]==-1){
				alert(ketqua[2]);
				return;
		}
		
		if(ketqua[7]){
			var idsp=ketqua[8].split("*");
					for(var i=0;i<idsp.length;i++){
						var elsp=idsp[i];
						
						if(elsp){
							$('#sp'+elsp+" .infsp").each((index,item)=>{
									item.style.color="#0066FF";
							});	
								document.getElementById('sp'+elsp).style.backgroundColor="#03a9f45c";
							
								document.getElementById('spchnhan'+elsp).remove();			
							}		
							
					}
			alert("Đã hủy nhận đơn thành công\n"+ketqua[7].replace("*","\n"));
			if(document.getElementById('xacnhan'+ketqua[3])){
			document.getElementById('xacnhan'+ketqua[3]).style.display="block";
			document.getElementById('xacnhan'+ketqua[3]).setAttribute("onclick","thongbaodahuydon('Bạn vừa hủy đơn này!')");
			}
			
			if(document.getElementById('huy'+ketqua[3])){
			document.getElementById('huy'+ketqua[3]).setAttribute("onclick","thongbaodahuydon('Bạn vừa hủy đơn này!')");
			document.getElementById('huy'+ketqua[3]).style.display="block";
			}
			document.getElementById('tencuahangxacnhan'+ketqua[4]).remove();
			document.getElementById('sp'+ketqua[8]).style.backgroundColor="#03a9f45c";
			  //alert('Bạn đã hủy nhận đơn thành công !');
		}
		
	}
	else if(ketqua[1]=="4")
	{ 
		if(ketqua[6]=="-1"){
			alert(ketqua[2]);
			return;
		}
		else if(ketqua[6]=="1"){
			alert(ketqua[2]);
			if(document.getElementById('xacnhan'+ketqua[3])){
			document.getElementById('xacnhan'+ketqua[3]).style.display="none";
			}
			if(document.getElementById('huy'+ketqua[3])){
				document.getElementById('huy'+ketqua[3]).style.display="none";
			}
			document.getElementById('btnkhoa'+ketqua[3]).disabled="true";
			document.getElementById('tinhtrangkhoa'+ketqua[3]).innerHTML="<span style='color:#ff9800;font-weight:bold'>Phiếu đã khóa<span>";
			//document.getElementById('tinhtrangkhoa'+ketqua[3]).style.color="#ff9800";
			return;
		}
	}
	else if (ketqua[1]=="-1")
	{ alert('có lỗi xảy ra! Vui lòng thử lại');   }
	else if  (ketqua[1]=="***0***")
	{  alert('Bạn không thể hủy nhận đơn này!'); }
}


function cuahangnhandon(t1,t2,t3,e=null,t4,t5)
{
   donggoi=t1 ;
   if(e){
   
   		t3=e.target.getAttribute("data-id");
   }
   
   if(t2==8){
  		  var lydo = prompt("Nhập Lý do: ");
		 
		if(!lydo)
		{
			return;
		}		
   }
    if(t2==1){
		if(!confirm("Bạn có chắc muốn xác nhận đơn này!")){
			return;
		}
	}
	if(t2==4){
		if(!confirm("Bạn có chắc khóa phiếu này!")){
			return;
		}
	}
   poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(lydo)+"*@!"+ encodeURIComponent(t4)+"*@!"+ encodeURIComponent(t5); 
   loadtrang('khonghienthires', "passdonbaocaonhandon", poststr,"xulynhandon") ;

} 



function xuatkq()
{
 	 document.getElementById("noidung").value = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><html><body>'+ document.getElementById("htkq").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
}

function phantrangAjax(value){
	
		if(value==-1){
			if(curentpage==1){
				value=1;
			}
			else{
				value=curentpage-1;
			}
		}
		else if(value==-2){
			if(curentpage==totalpage){
				value=totalpage;
			}
			else{
				value=curentpage+1;
			}
		}
		
		  $("#loading1").css("display", "inline-block");
		 // submitketoan(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11,t12,t13,t14=1)
		 if(type==1){
				submittk(t1tam,t2tam,t3tam,t4tam,t5tam,t6tam,t7tam,t8tam,t9tam,t10tam,t11tam,t12tam,t13tam,value);
		}
		else{
			 submitketoan(t1tam,t2tam,t3tam,t4tam,t5tam,t6tam,t7tam,t8tam,t9tam,t10tam,t11tam,t12tam,t13tam,value);
		}
     
		curentpage=parseInt(value);
		
	}
   </script>
    