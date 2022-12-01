 
 
<form name="frmProduct1" id="frmProduct1" method="post">
<div class="nenbao">
<fieldset  class="nencon"  > 
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >Duyệt  Bảo hiểm y tế</label></a>
    </legend>
			<div style="padding:5px">&nbsp;	
              
                <input type="text" name="tuvan" placeholder="Mã NV"  id="tuvan" class="inpl" ondblclick="this.value=''" style="width:60px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />
	&nbsp;
                <input type="text" name="ten" id="ten"  placeholder="Tên NV"  class="inpl" ondblclick="this.value=''" style="width:60px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />
                <input type="hidden" name="sotien" placeholder="Số tiền"  id="sotien" class="inpl" ondblclick="this.value=''" style="width:60px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />
                <input  type="hidden" name="hoadon" placeholder="Số hóa đơn"  id="hoadon" class="inpl" ondblclick="this.value=''" style="width:70px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />
                 
	  <select   onkeypress="return chuyentiep(event,'idnhan')" name="cuahang"  id="cuahang"  class="js-ch" style="width:110px" title="cửa hàng">
  {tatca} 
  	{kho}
  </select>
<select onkeypress="return chuyentiep(event,'idnhan')" name="tinhtrang"  id="tinhtrang"  style="width:115px" title="Tình trạng">
   <option value="" selected="selected">Tình trạng Duyệt</option>
   <option value="1">Chưa duyệt</option>
    <option value="4">Đã duyệt</option>
   <option value="3">Không duyệt</option>
  
</select>
Tháng
<select id="thangtim" name="thangtim"><option value="">Chọn tháng</option>{chuoithang}</select>
Năm
<select id="namtim" name="namtim"><option value="">Chọn năm</option>{chuoinam}</select>
<input type="button"  onclick="return timphieu(tuvan.value ,cuahang.value,thangtim.value,namtim.value,tinhtrang.value,ten.value,0,sotien.value ,hoadon.value)"   name="search" style="width:65px" id="search" value="Tim kiếm" />
<input type="button"  onclick="return timphieu(tuvan.value ,cuahang.value,thangtim.value,namtim.value,tinhtrang.value,ten.value,1,sotien.value ,hoadon.value)"   name="search2" style="width:65px;display:none" id="search2" value="Gộp NV" />
 <input type="button" name="tm" style="width:100px;display:{q_themp}"    value="Nhập từ Excel" onclick="nhapexcel1()" />
<input type="button"  onclick="xuatkq()"   name="search3" style="width:65px" id="search3" value="Excel" />
<div id="httim" >
  
</div>
<div id="khonghienthi" style="display: "></div>
</div> 
 
 </fieldset>
 </div> 
 </form>
 <form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="phieutangca.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>
<style>
	#poupduyet{
		    display: none;
		width: 100%;
		height: 100vh;
		position: fixed;
		left: 0;
		top: 0;
		align-items: center;
		justify-content: center;
		z-index:100;
		  background-color: #00000045;
	}
	
	
</style>


<div id="poupduyet">
	<!--<div id="duyetform">
		<div style="    display: flex;
    width: 100%;
    justify-content: flex-end;"><button type="button" id="closepo" onclick="closepop()">x</button></div>
	<div id="showform">
			<table style="width:100%">
				<tr>
					<td>lable 1: </td>
					<td>lable 1: </td>
					<td>lable 1: </td>
					<td>lable 1: </td>
				</tr>
				<tr>
					<td>lable 1: </td>
					<td>lable 1: </td>
					<td>lable 1: </td>
					<td>lable 1: </td>
				</tr>
				<tr>
					<td>lable 1: </td>
					<td>lable 1: </td>
					<td>lable 1: </td>
					<td>lable 1: </td>
				</tr>
				<tr>
					<td>lable 1: </td>
					<td>lable 1: </td>
					<td>lable 1: </td>
					<td>lable 1: </td>
				</tr>
			</table>
		</div>
	</div>
-->
</div>


<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
   <div  style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>
 
 <div   id="timexxcel" style="padding:10px">
 <div style="display: flex;
    flex-direction: row;    align-items: center;
    justify-content: center;padding-bottom:1em;">
	<!--<a href="data/maupancake.xlsx" style="margin-right:1em">File mẫu pancke</a>
<a href="data/mauthuongmaidientu.xlsx">File mẫu thương mại điện tử</a>-->
</div>
 <div>
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="" />
    <label>File khách hàng Excel *.xlsx</label>
<input id="fileToUpload" type="file" accept=".xlsx"   size="35" name="fileToUpload" class="input" style="height:22px" />


</div>
<style>
   .chiao{     display: flex;
    flex-direction: column;
    width: 40%;
    min-height: 120px;
    padding: 0 1em;
    justify-content: space-between;
	    display: flex;
    flex-direction: column;
    width: 40%;
    min-height: 60px;
    padding: 0.5em 1em;
    justify-content: space-between;
  
    margin-right: 1em;
	}
</style>
<div style="    margin: 0.5em;display: flex;
    justify-content: center;">
	<div class="chiao " style="  border: 1px solid red;">
		<p style="color:#FF0000;font-weight:bold">Tải lên phiếu thu chi</p>
		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('baohiemyte',1);" style="height:22px">Tải lên</button>
		<!-- <button class="button" id="buttonUploadmoi" onclick="return hienthidulieumoi();" style="height:22px">Hiển thị</button> -->
	</div>

	
</div>

<div id="resupdate"></div>
 <div id="hienthiexcel" style="padding:5px">
 
 <table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
       
		  <td width="75" align="center" class="cothienthi" ><strong>Mã Thành Viên</strong></td>  
 		  <td width="360" align="center" class="cothienthi"><strong>Tên</strong> </td> 
          <td width="39" align="center" class="cothienthi"><strong>Điện thoại</strong></td>
          <td width="40" align="center" class="cothienthi"><strong>Ngày Sinh</strong> </td> 
 		  
		    
 		</tr>
        	<tr bgcolor="" style="color:#000">
		  <td align="center" class="cothienthi" height="23" width="32">5</td>
       
		  <td width="75" align="center" class="cothienthi" >2805210001</td>  
 		  <td width="360" align="center" class="cothienthi">Nguyễn Văn A</td> 
          <td width="39" align="center" class="cothienthi">0987654321</td> 
		  <td width="40" align="center" class="cothienthi">01/01/2000</td>
       
		    
		    
 		</tr>
        </table>
 
 
 </div> 
 
</div>
</div>
</div>
 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<script type="text/javascript" src="templates/ajaxfileupload.js"></script>

<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">
 
	$(document).ready(function() {
	    $('.js-nv').select2();
	 
	});
	
		$(document).ready(function() {
	    $('.js-ch').select2();
	 
	});
 
 function closepop(){
 	document.getElementById('poupduyet').style.display="none";
 }
 
 function showpop(){
 	document.getElementById('poupduyet').style.display="flex";
 }
  function showloading1(){
  	if(document.getElementById('loading1')){
 		document.getElementById('loading1').style.display="flex";
	}
 }
  function closeloading1(){
  	if(document.getElementById('loading1')){
 	document.getElementById('loading1').style.display="none";
	}
 }
 function showchitiet(id){
 	showpop();
 	poststr="DATA="+    encodeURIComponent(id)+  "*@!"+ encodeURIComponent(0)
	  loadtrang('poupduyet', "duyetbhytform", poststr,"xuly4") ;
 }
 
 function xuly4(){
 	showpop();
	setMintoday();
 }
 function xuatkq()
{
 	 document.getElementById("noidung").value = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><html><body>'+ document.getElementById("httim").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
}


//============================================================

var  capnhap= '' ;
 var elselect='';
  
function ask()
{
	var n = confirm("Bạn có muốn xóa không");
	if(n == false)
	{
		return false;
			
	}
}
//=======================
 


function timphieu(t1,t2,t3,t4,t5,t6,t7,t8,t9)
{
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4); 
  poststr= poststr +"*@!"+ encodeURIComponent(t5)+"*@!"+ encodeURIComponent(t6)+"*@!"+ encodeURIComponent(t7)+"*@!"+ encodeURIComponent(t8)+"*@!"+ encodeURIComponent(t9)  ;
  
  if(t7==1)  loadtrang('httim', "duyetbhytgoptim", poststr,"") ;
  else       loadtrang('httim', "duyetbhyttim", poststr,"") ;

}
function settype(valu)
{
	document.getElementById('dachon').value =  valu ;
}


function kiemtra()
{
//   if (capnhap != '') { return false ;}
	if(document.getElementById('tuvandung').value == "0"   )
	{
		alert('Bạn chưa nhập tư vấn đúng') ;
		document.getElementById('tuvandung').focus() ;
		return false;			
	}

  
	return true;
}
 
function duyet(tc,sp,loai,tennv,lydo)
{  //tungay,denngay,luachon,nhomtk,taikhoan2,lydo2,tr
 if(loai==0) return;
capnhap=tc;
 var cf = " Bạn có chắc chắn muốn duyệt phiếu cho nhân viên "+tennv+" này hay không ? " ;
 	if(thongbao(cf) == false) { 
 		return 
	} 
 	else {	 
    	poststr="DATAC="+   encodeURIComponent(tc)+  "*@!"+encodeURIComponent(idlogin)+  "*@!"+ encodeURIComponent(loai)+ "*@!"+ encodeURIComponent(lydo)+  "*@!"+ encodeURIComponent(0);
     	loadtrang('khonghienthi',"duyetbhytduyet",poststr,"xuly1") ;	
	}	
}

function xuly1()
{
	closeloading1();
	//console.log('ok');
	tam=document.getElementById('khonghienthi').innerHTML ;
	 //alert(tam);
   	var  n=tam.split("###"); 
	 console.log(tam);
 	if (n[1]=="-1") {alert(n[2]);  return;}
	if (n[1]) 
	{    
		if(n[1]!='1'){
  		 	document.getElementById('tinhtrang_'+capnhap).innerHTML=n[2];
				var tinhtrangform= document.getElementsByClassName('tinhtrangform');
				for(var i=0;i<tinhtrangform.length;i++){
					var elbtn=tinhtrangform[i];
					elbtn.innerHTML=n[2];
				}
			
		}  
		 if(n[1]=="3" || n[1]=="1"){
		 	document.getElementById('lydo'+capnhap).innerHTML=n[4];
		 }
 		//document.getElementById('duyetad'+capnhap).innerHTML= n[3];  
	    alert(n[2]);
		if (n[1]=="4" || n[1]=="3") 
		{ 
			document.getElementById(elselect).disabled =true;
			var btntrangthai= document.getElementsByClassName('btntrangthai');
				for(var i=0;i<btntrangthai.length;i++){
					var elbtn=btntrangthai[i];
					elbtn.disabled =true;
				}
			
		}
		return;
	}
	
	
	
 }
function goiduyet(id,idl,tennv,loai,vl,el,ngayd='',ngayt='',loaid='') {
 		capnhap=id;
		elselect=el+id;
		if(loaid){
			showloading1(); 
				poststr="DATAC="+encodeURIComponent(id)+"*@!"+encodeURIComponent(idl)+"*@!"+encodeURIComponent(loai)+"*@!"+encodeURIComponent(vl)+"*@!"+encodeURIComponent(0)+"*@!"+encodeURIComponent(ngayd)+"*@!"+encodeURIComponent(ngayt)+"*@!"+encodeURIComponent(loaid);
				loadtrang('khonghienthi',"duyetbhytduyet",poststr,"xuly1") ;
				
			return;
		}
	 	if(vl==4)
		{
			var cf = "Bạn có chắc chắn muốn duyệt phiếu cho nhân viên "+tennv+" này hay không ? " ;
			if(thongbao(cf) == false) { return } 
			else
		    {	showloading1(); 
				poststr="DATAC="+encodeURIComponent(id)+"*@!"+encodeURIComponent(idl)+"*@!"+encodeURIComponent(loai)+"*@!"+encodeURIComponent(vl)+"*@!"+encodeURIComponent(0)+"*@!"+encodeURIComponent(ngayd)+"*@!"+encodeURIComponent('');
				loadtrang('khonghienthi',"duyetbhytduyet",poststr,"xuly1") ;	
			}	
		}
		else 
		{
		      var lydo = prompt("Nhập Lý do: ");
			  if( lydo==null)return ;
			  showloading1();
		 	 poststr="DATAC="+encodeURIComponent(id)+"*@!"+encodeURIComponent(idl)+"*@!"+encodeURIComponent(loai)+"*@!"+encodeURIComponent(vl)+"*@!"+encodeURIComponent(lydo);
			 loadtrang('khonghienthi',"duyetbhytduyet",poststr,"xuly1") ;	
 		}
 	
 	//duyet(idphieu,idlogin,tinhtrang,tennv,lydo);
	
}

function thongtinlydo(lydo){
	alert(lydo);
}

		function setMintoday(){
				var today = new Date().toISOString().split('T')[0];
				document.getElementById("ngaynghiduyet").setAttribute('min', today);
				document.getElementById("ngaynghithuc").setAttribute('min', today);
					
		}
		function nhapexcel1()
{
    if (document.getElementById('hiennhapexcel').style.display =="")
	{
		document.getElementById('hiennhapexcel').style.display = "none";
		//document.getElementById('timkhachhanght').style.display = '' ;	
		//document.getElementById('timphieuxuat').style.display = 'none' ;	
 	} else
	{
		document.getElementById('hiennhapexcel').style.display = "";
		//document.getElementById('timkhachhanght').style.display = 'none' ;	
		//document.getElementById('timphieuxuat').style.display = '' ;	
	}

	
}

function ajaxFileUpload(tenfile,loai)
{
	var  tt = id_user;

 	//$("#buttonUpload").val(loai);
	var  nn =   new Date().getTime(); ;
   		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});
		$.ajaxFileUpload
		(
			{
				url:'baohiemytefileuploaddata.php?us='+tenfile,
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				success: function (data, status)
				{
					
					
					
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
							{							
								alert(data.error);	
								return false ;
							}else
							{					
								 kq =data.msg ;
								 mkq = kq.split('*') ;
								
								 hienthidulieu();
								 
							}
						
					}
				},
				error: function (data, status, e)
				{		
					if ( data.e == 'vuotdungluong' )
					{
						alert("Vượt dung lượng cho phép 8M !!!");				 
					}
				}
			}
		)
		
		return false;

	}



function laydulieuexel(){
	var poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('resupdate', "baohiemytecheckdata", poststr, "xuly2");

}

function xuly2(){
var tam=document.getElementByID("resupdate").innerHTML;

	if(tam){
	
		alert(tam);
	}
}

function hienthidulieu()
{ 	
	
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel','baohiemytetailendatahienthi', poststr,"") ;		
 
}
function xuatbaoloi(str){
	alert(str);
}
</script>
