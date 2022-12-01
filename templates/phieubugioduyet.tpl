 <style>
	#poupduyetbugioct{
		    display: none;
		width: 100%;
		height: 120vh;
		position: fixed;
		left: 0;
		top: 0;
		align-items: center;
		justify-content: center;
		z-index:100;
		  background-color: #00000045;
	}
	
	
</style>


<div id="poupduyetbugioct">
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
<form name="frmProduct1" id="frmProduct1" method="post">
<div class="nenbao">
<fieldset  class="nencon"  >
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >Phiếu bù giờ duyệt</label></a>
    </legend>
			<div style="padding:5px">&nbsp;	
              
                <input type="text" name="tuvan" placeholder="Mã NV"  id="tuvan" class="inpl" ondblclick="this.value=''" style="width:100px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />
	&nbsp;
                <input type="text" name="ten" id="ten"  placeholder="Tên NV"  class="inpl" ondblclick="this.value=''" style="width:110px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />Cửa hàng
	  <select onkeypress="return chuyentiep(event,'idnhan')" name="cuahang"  id="cuahang"  class="js-ch" style="width:190px" title="cửa hàng">
  {tatca} 
  	{kho}
  </select>
<select onkeypress="return chuyentiep(event,'idnhan')" name="tinhtrang"  id="tinhtrang"  style="width:115px" title="Tình trạng">
   <option value="" selected="selected">Tình trạng Duyệt</option>
   <option value="1">Giám sát duyệt</option>
   <option value="2">Chưa duyệt</option>
   <option value="3">Không duyệt</option>
   <option value="4">Đã duyệt</option>
</select> Ngày
<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="tungay"   id="tungay" class="text" style="width:65px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmProduct1.tungay,'dd/mm/yyyy',this)" />đến<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="denngay"   id="denngay" class="text" style="width:65px"  value="{denngay}" /><img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmProduct1.denngay,'dd/mm/yyyy',this)" />		
<input type="button"  onclick="return timphieu(tuvan.value ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,ten.value,0)"   name="search" style="width:65px" id="search" value="Tìm kiếm" />  
  
 
<input type="button"  onclick="return timphieu(tuvan.value ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,ten.value,1)"   name="search2" style="width:65px" id="search2" value="Gộp NV" />
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

 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">
 
	$(document).ready(function() {
	    $('.js-nv').select2();
	 
	});
	
		$(document).ready(function() {
	    $('.js-ch').select2();
	 
	});
 
 function xuatkq()
{
 	 document.getElementById("noidung").value = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><html><body>'+ document.getElementById("httim").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
}


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
 


function timphieu(t1,t2,t3,t4,t5,t6,t7)
{
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4); 
  poststr= poststr +"*@!"+ encodeURIComponent(t5)+"*@!"+ encodeURIComponent(t6)+"*@!"+ encodeURIComponent(t7)  ;
  
  if(t7==1)  loadtrang('httim', "phieubugioduyetgoptim", poststr,"") ;
  else       loadtrang('httim', "phieubugioduyettim", poststr,"") ;

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

function kiemtraphieu(t1)
{ 	
   if(t1=='') return;
   poststr="DATA="+ encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
  
   loadtrang('khonghienthi',"kiemtracobill", poststr,"xuly1") ;
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
     	loadtrang('khonghienthi',"phieubugioxulyduyet",poststr,"xuly1") ;	
	}	
}

var  capnhap= '' ;
 var elselect='';
 var loaicp='';
function xuly1()
{
	closeloading1();
	//console.log('ok');
	tam=document.getElementById('khonghienthi').innerHTML ;
	 //alert(tam);
   	var  n=tam.split("###"); 
	 console.log(n);
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
		 	document.getElementById('lydo'+loaicp+capnhap).innerHTML=n[4];
			document.getElementById(elselect).value= n[1]; 
		 }
 		//document.getElementById('duyetad'+capnhap).innerHTML= n[3];  
	    alert(n[2]);
		if (n[1]=="4" || n[1]=="3") 
		{ document.getElementById(elselect).value= n[1]; 
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
function goiduyet(id,idl,tennv,loai,vl) {
 capnhap=id;
		elselect='cp'+loai+id;
		loaicp=loai;
	 	if(vl==4)
		{
			var cf = "Bạn có chắc chắn muốn duyệt phiếu cho nhân viên "+tennv+" này hay không ? " ;
			if(thongbao(cf) == false) { return } 
			else
		    {	 
				poststr="DATAC="+encodeURIComponent(id)+"*@!"+encodeURIComponent(idl)+"*@!"+encodeURIComponent(loai)+"*@!"+encodeURIComponent(vl)+"*@!"+encodeURIComponent(0);
				loadtrang('khonghienthi',"phieubugioxulyduyet",poststr,"xuly1") ;	
			}	
		}
		else 
		{
		      var lydo = prompt("Nhập Lý do: ");
			  if( lydo==null)return ;
		 	 poststr="DATAC="+encodeURIComponent(id)+"*@!"+encodeURIComponent(idl)+"*@!"+encodeURIComponent(loai)+"*@!"+encodeURIComponent(vl)+"*@!"+encodeURIComponent(lydo);
			 loadtrang('khonghienthi',"phieubugioxulyduyet",poststr,"xuly1") ;	

		}
 
 
	
 	//duyet(idphieu,idlogin,tinhtrang,tennv,lydo);
	
}

function thongtinlydo(lydo){
	alert(lydo);
}
function closepop(id){
 	document.getElementById(id).style.display="none";
 }
 
 function showpop(id){
 	document.getElementById(id).style.display="flex";
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
function showchitiet(id,idpop){
 	showpop(idpop);
 	poststr="DATA="+    encodeURIComponent(id)+  "*@!"+ encodeURIComponent(0)
	  loadtrang('poupduyetbugioct', "phieubugioduyetform", poststr,"") ;
 }
 
 function xuly4(){
 	//showpop();
 }

</script>
