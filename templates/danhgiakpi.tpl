<br />  <style > .tbchuan input { cursor:pointer;} 
			.luongtb input { cursor:auto;}
</style>

<!--popup sưa du lieu -->
<style>
	#poup_sua_du_lieu {
		position: fixed;
		/* background-color: #ffffff; */
		width: 100%;
		height: 100vh;
		display: none;
		left: 0;
		top: 0;
		justify-content: center;
		align-items: center;
		z-index: 1;
	}

	#poup_sua_du_lieu .select2-container {
		width: 50% !important;
	}

	#poup_sua_du_lieu .form {

		background-color: #ffffff;
		width: 39%;
		height: 300px;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		border: 1px solid;
	}

	#poup_sua_du_lieu .form #closepop {
		display: flex;
		justify-content: flex-end;
		width: 90%;

	}

	#poup_sua_du_lieu .form form {
		display: flex;
		width: 90%;
		height: 90%;
	}

	#poup_sua_du_lieu form>div {
		height: 100%;
		width: 100%;
		display: flex;
		justify-content: space-around;
		flex-direction: column;
	}

	#poup_sua_du_lieu .form label {
		width: 30%;
	}

	#poup_sua_du_lieu input {
		cursor: pointer;
	}

	#poup_sua_du_lieu .btn-quyenchon span {
		font-size: 16px;
		width: 20%;
		z-index: 0;

	}

	#poup_sua_du_lieu .btn-quyenchon span:hover {
		color: #FF0000;
	}

	#quyenchon {
		display: flex;
		flex-wrap: wrap;
	}

	#poup_sua_du_lieu .btn-quyenchon {
		background-color: cadetblue;
		color: #ffffff;
		border: none;
		padding: 0.5em;
		min-width: 80px;
		max-height: 40px;
		margin-right: 0.3em;
		display: flex;
		justify-content: space-between;
	}

	#poup_sua_du_lieu .form_quyen {
		display: flex;
	}

	#poup_sua_du_lieu .form_quyen>div {
		width: 50%;
	}

	#poup_sua_du_lieu .form_quyen .form_ {
		width: 100%;
	}

	#poup_sua_du_lieu .form_quyen .form_ label {
		width: 70%;
	}

	#poup_sua_du_lieu .form_quyen .form_>div {
		width: 100%;
		display: flex;
		justify-content: space-between;
		padding: 0.2em 0.5em;
	}

	#kpi_wr {
		display: flex;
	}

	#shownhansu {
		height: 500px;
		overflow-y: scroll;
		width: 30%;
		padding: 1em;
		border: 1px solid;
		margin-top: 2em;
		padding-top:0;
	}
#shownhansu .showedit{
    display: flex;
    justify-content: flex-end;
	padding-bottom: 0.5em;
	padding-top:0.5em;
}
#shownhansu .showedit button{
       background-color: #2ecc71;
    color: #ffffff;
    border: none;
}
	#shownhansu::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		background-color: #F5F5F5;

	}

	#shownhansu::-webkit-scrollbar {
		width: 5px;
		background-color: #F5F5F5;
	}

	#shownhansu::-webkit-scrollbar-thumb {
		background-color: #d2691e;
		border: 2px solid #d2691e;
	}


	#showkpi_wrap::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		background-color: #F5F5F5;

	}

	#showkpi_wrap::-webkit-scrollbar {
		width: 5px;
		background-color: #F5F5F5;
	}

	#showkpi_wrap::-webkit-scrollbar-thumb {
		background-color: #d2691e;
		border: 2px solid #d2691e;
	}

	#showkpi_wrap {
		width: 70%;
		height: 500px;
		border: 1px double;
		margin-top: 2em;
		overflow-y: scroll;
	}

	#showkpi_wrap table {
		width: 100%;
	}


	.active {
		color: #FF0000 !important;
	}


	.tbchuan {
		border-collapse: collapse;
		border-spacing: 0;
		border: 10px
	}

	.tbchuan th {
		background: none repeat scroll 0 0 #E4EBF2;
		color: #12537F;
		font-weight: bold;
	}

	.tbchuan th,
	.tbchuan td {
		border: 1px solid #333333;
		padding: 5px 3px 5px 5px;
	}

	.tbchuan .mautr {
		background: none repeat scroll 0 0 #E4EBF2;
		color: #12537F;
		font-weight: bold;
	}

	.tbchuan thead th {
		position: -webkit-sticky;
		position: sticky;
		top: -1px;
		border-bottom: 1px solid;
		color: #000000;
		background-color: #F8E4CB;

	}

	.tbchuan th:first-child {
		position: -webkit-sticky;
		position: sticky;
		left: 0;
		z-index: 2;
	}

	.fixed-bottom {
		position: -webkit-sticky;
		position: sticky;
		bottom: 0;
	}

	.fixed-left {
		position: -webkit-sticky;
		position: sticky;
		left: 0;
		z-index: 1;
	}

	.kpi-list {
		display: flex;
		justify-content: space-between;
		    overflow: unset;
    white-space: nowrap;
	}

	.kpi-list button {
		padding: 2px;
		border: none;
		font-size: 10px;
		box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
		background: #2ecc71;
		color: #fff;
		border-radius: 3px;
		display:none;
		margin-left: 0.5em;
	}

	.kpi-list button:hover {
		background: #259253;
		transition: 0.3s;
	}

	/* The Modal (background) */
	.modal {
		display: none;
		position: fixed;
		z-index: 1;
		padding-top: 150px;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgb(0, 0, 0);
		background-color: rgba(0, 0, 0, 0.4);
	}

	.modal-content {
		position: relative;
		background-color: #fefefe;
		margin: auto;
		padding: 0;
		border: 1px solid #888;
		width: 30%;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		-webkit-animation-name: animatetop;
		-webkit-animation-duration: 0.4s;
		animation-name: animatetop;
		animation-duration: 0.4s;
		z-index: 99999;
	}

	.staff-pop .select2-container{
		width: 100% !important;
	}
	#suacappb{
		width: 100%;
    padding: 0.4em;
	}
	#ressuacap{
	    display: inline-flex;
    flex-direction: row;
}
.showandedit {
		display: flex;
		align-items: center;
		justify-content: space-around;
	}

	.form-add{
		display: none;
	}

	.add-staff{
		margin-top: 3px;
	}

	.btn-add{
		margin-top: 3px;
		text-align: center;
		width: 100%;
	}
	.btn-edit.show{
	margin-bottom:0.5em;
	display:flex !important;
		}
	.btn-edit.show button{
			display:block  !important;
		}	
</style>
<div id="poup_sua_du_lieu" style="">
<div class="form">
<div id="closepop"><button  onclick="closepoup()">x</button></div>


</div>
</div>

<div class="nenbao">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >KPI</label>
	</a></legend>
  	<table width="90%" >
	<thead>
		<tr>
		  <th width="115">Phòng ban: </th>
		  <th width="157"><select name="phongban" id="phongban" class="js-phongban" onchange="getNhanSu(event)">
          <option value="">Chọn phòng ban..</option>
		    
					{phongban}
				
	      </select></th>
		 <th width="86" align="center" valign="middle" style="text-align:center">Tháng: </th>
			<th width="158" >
		  <input type="date" name="thangkpi" id="thangkpi"  style="line-height:20px;height:30px" />		  </th>
		 
			<th width="174" >
		  <button type="button" name="themtt" id="themtt" style="line-height:20px;height:30px" disabled="disabled" value="" onclick="capnhatthongtinluong(event)">Thêm thông tin</button>		  </th>
		   <th width="365" align="center" valign="middle" style="text-align:center">
		   <div id="resloading"></div>
	      </th>
		</tr>
	</thead>
  </table>
  
  	<div id="kpi_wr">
		<div id="shownhansu">
		
		</div>
		<!--<div id="myModal" class="modal">
				<div class="modal-content">
					<div class="modal-header">
						<span id="close-pop" class="close" onclick="hiddenModal()">&times;</span>
						<h2>Sửa cấp</h2>
						<span>Chọn cấp trên</span>
					</div>
					<div class="modal-body">
						<label>Nhân viên</label>
						<div class="staff-pop">
							<select name="phongban" id="" class="js-phongban" onchange="getNhanSu(event)">
								<option value="">Chọn phòng ban..</option>
								{phongban}
							</select>
						</div>
					</div>
				</div>
			</div>-->
		<div id="showkpi_wrap">
		<!--	<table class="tbchuan luongtb">
			<tr>
				<td colspan="4" align="center">
					<h4>Cập nhật thông tin lương nhân viên</h4>				</td>
			</tr>
				<tr>
					<td><strong>Lương cơ bản</strong></td>
					<td><input type="text" id="luongcb" name="luongcb"  /></td>
						<td><strong>Lương KPI</strong></td>
					<td><input type="text" id="luongcb" name="luongcb"  /></td>
				</tr>
				<tr>
					<td><strong>Số của hàng quản lý</strong></td>
					<td><input type="text" id="luongcb" name="luongcb"  /></td>
						<td><strong>Lương trách nhiệm</strong></td>
					<td><input type="text" id="luongcb" name="luongcb"  /></td>
				</tr>
				<tr>
					<td><strong>Lương KPI miền</strong></td>
					<td><input type="text" id="luongcb" name="luongcb"  /></td>
						<td><strong>lương KPI doanh thu</strong></td>
					<td><input type="text" id="luongcb" name="luongcb"  /></td>
				</tr>
				<tr align="right">
					
					<td colspan="4"><button type="button" id="themthongtin" name="themthongtin">Cập nhật</button></td>
				</tr>
		  </table>-->
		</div>
	</div>
 </fieldset>
 
</div>

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>

<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script>
var idnvtong='';
var idpbtong='';
	function block(idcha) {
		idnvtong=idcha;
		document.getElementById("myModal").style.display = "block";
	}

	function hiddenModal() {
	idnvtong='';
		resetSelectElement(document.getElementById("suacappb"));
		document.getElementById("myModal").style.display = "none";
	}
	function showthem() {
		document.getElementById("myAdd").classList.toggle("show");
	}
	//reset select 
	function resetSelectElement(selectElement) {
		var options = selectElement.options;
	
		// Look for a default selected option
		for (var i=0, iLen=options.length; i<iLen; i++) {
	
			if (options[i].defaultSelected) {
				selectElement.selectedIndex = i;
				return;
			}
		}
	
		// If no option is the default, select first or none as appropriate
		selectElement.selectedIndex = 0; // or -1 for no option selected
	}
var idnv='';
$(document).ready(function() {
 	 $('.js-phongban').select2();
  	 $('.js-nhansu').select2();
  })
  function showsuaxoa(){
    $('.btn-edit').toggleClass("show");
	 // $('.btn-edit').css("margin-bottom","0.5em");
  //	$('.btn-edit').css("display","flex");
  	//$('.btn-edit button').css("display","block");
  }
  function getNhanSu(e){
  		var id=e.target.value;
		if(id){
		idpbtong=id;
	 	poststr="GETNHANSU="+   encodeURIComponent(id)+  "*@!"+ encodeURIComponent("0");
     	loadtrang('shownhansu',"kpiajax", poststr,"xuly1") ;
		}
  
  }
  
  function xuly1(){
  	$('.js-nhanvienadd').select2({
					width:'100%'
				});
			$('.js-captrenadd').select2({
					width:'100%'
				});
  }
  function setactive(e){

  		
		var nv=document.getElementsByClassName("nhanvien");
		
		for(var i=0;i<nv.length;i++){
			var el=nv[i];
			
				el.classList.remove("active");
			
		}
		e.classList.add("active");
  }
  function getKpiDanhgia(e,idphong){
		e.preventDefault();
		var btnthemtt=document.getElementById("themtt");
		var target=e.target;
		setactive(target);
				var idcv=target.getAttribute("data-cv");
					idnv=target.getAttribute("data-id");
					btnthemtt.value=idnv;
					btnthemtt.disabled=false;
					 var thang=document.getElementById("thangkpi").value;
		if(checkThang()){
				//console.log(id);
				poststr="GETFORMKPI="+encodeURIComponent(idcv)+  "*@!"+ encodeURIComponent(thang)+  "*@!"+ encodeURIComponent(idnv)+"*@!"+ encodeURIComponent(idphong);
				loadtrang('showkpi_wrap',"kpiajax", poststr,"xuly2") ;
		}else{
				alert("Vui lòng chọn tháng đánh giá!");
		}
  		
  }
  function xuly2(){
  		
  }
  
  
  function capnhattt(){
  		var luongcb=document.getElementById("luongcb").value;
		var luongkpi=document.getElementById("luongkpi").value;
		var socuahang=document.getElementById("socuahang").value;
		var luongtrachnhiem=document.getElementById("luongtrachnhiem").value;
		var luongkpimien=document.getElementById("luongkpimien").value;
		var luongkpidoanhthu=document.getElementById("luongkpidoanhthu").value;
  				poststr="UPDATETT="+encodeURIComponent(luongcb)+  "*@!"+ encodeURIComponent(luongkpi)+  "*@!"+ encodeURIComponent(socuahang)+  "*@!"+ encodeURIComponent(luongtrachnhiem)+  "*@!"+ encodeURIComponent(luongkpimien)+  "*@!"+ encodeURIComponent(luongkpidoanhthu);
					loadtrang('showkpi_wrap',"kpiajax", poststr,"xuly4") ;
  }
  function xuly4(){
  
  }
  function capnhatthongtinluong(e){
		var target=e.target;
		var value=target.value;
		poststr="GETFORMTT="+encodeURIComponent(value)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
					loadtrang('showkpi_wrap',"kpiajax", poststr,"xuly2") ;
  }
  function checkThang(){
  		var thang=document.getElementById("thangkpi").value;
  		if(!thang){
			return false;
		}
		return true;
  }
 function checkphongban(){
 	var phongban=document.getElementById("phongban").value;
	if(!phongban){
	return false;
	}
	return true;
 }
  function updateKPI(e,type,id,idcha){
	var target=e.target;
	var value=target.value;
	if(!value){
		return;
	}
//	var idcha=target.getAttribute("data-id");
	var thang=document.getElementById("thangkpi").value;
	
	if(checkThang()){
		poststr="UPDATEKPI="+   encodeURIComponent(value)+  "*@!"+ encodeURIComponent(idcha)+  "*@!"+ encodeURIComponent(idnv)+  "*@!"+ encodeURIComponent(thang)+ "*@!"+ encodeURIComponent(type)+ "*@!"+ encodeURIComponent(id);
     	loadtrang('resloading',"kpiajax", poststr,"xuly3") ;
	}
	else{
		alert("Vui lòng chọn tháng đánh giá!");
	}
	//console.log(value);
  }
  
  function xuly3(){
  			var tam = document.getElementById("resloading").innerHTML;
			console.log(tam);
		if(tam){
			tam=tam.split("###");
			if(tam[2]){
			alert(tam[2]);
			}
		}
		
  }
  
  function suacapnv(idcha){
  			poststr="SUACAP="+   encodeURIComponent(idcha)+  "*@!"+ encodeURIComponent(idnvtong)+  "*@!"+ encodeURIComponent(idpbtong);
     	loadtrang('ressuacap',"kpiajax", poststr,"xuly5") ;
  }
  function xuly5(){
  	var tam= document.getElementById("ressuacap").innerHTML;
	//console.log(tam);
	if(tam){
		tam=tam.split("###");
		if(tam[1]==-1){
			alert(tam[2]);
		}
		else{
			document.getElementById("ressuacap").style.display="none";
		hiddenModal();
			document.getElementById("shownhansu").innerHTML=tam;
				$('.js-nhanvienadd').select2({
					width:'100%'
				});
				$('.js-captrenadd').select2({
					width:'100%'
				});
		}
	}
	
  }
  
   function xoacapnv(id){
   if(confirm("Bạn có chắc muốn xóa nhân viên khỏi phòng ban!")){
   
  			poststr="XOACAP="+   encodeURIComponent(id)+  "*@!"+ encodeURIComponent(idpbtong)+  "*@!"+ encodeURIComponent(0);
     	loadtrang('loadinxoacap',"kpiajax", poststr,"xuly6") ;
		}
  }
   function xuly6(){
  	var tam= document.getElementById("loadinxoacap").innerHTML;
	console.log(tam);
	if(tam){
		tam=tam.split("###");
		if(tam[1]==-1){
			alert(tam[2]);
		}else{
			document.getElementById("shownhansu").innerHTML=tam;
			document.getElementById("loadinxoacap").style.display="none";
				$('.js-nhanvienadd').select2({
					width:'100%'
				});
				$('.js-captrenadd').select2({
					width:'100%'
				});
		}
	}
  }
  
  var timeout='';
  function OnkeyUpSeacrh(e){
  var str=e.target.value;
  	if(timeout){
		clearTimeout(timeout);
	}
	if(e.keyCode==13){
		seactnvadd(str);
	}
	else{
	timeout=setTimeout(() => {
		  seactnvadd(str);
		}, 1000);
	}
  }
  
  function seactnvadd(str){
    document.getElementById("loadingtim").style.display='block';
  			poststr="SEARCHNV="+   encodeURIComponent(str)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
     	loadtrang('loadingtim',"kpiajax", poststr,"xuly7") ;
  }
  
  function xuly7(){
  
  	var tam= document.getElementById("loadingtim").innerHTML;
	
	if(tam){
		tam=tam.split("###");
		if(tam[1]!=-1){
			document.getElementById("loadingtim").style.display='none';
			document.getElementById("nhanvienadd").innerHTML=tam;
			$('.js-nhanvienadd').select2('open');
		}
		else{
			document.getElementById("loadingtim").style.display='block';
		}	
	}
  }
  
  function addNvPb(idnv,idcha){
	
	  document.getElementById("loadingtim").style.display='block';
  		poststr="ADDNVPB="+   encodeURIComponent(idnv)+  "*@!"+ encodeURIComponent(idpbtong)+  "*@!"+ encodeURIComponent(idcha);
     	loadtrang('loadingtim',"kpiajax", poststr,"xuly8");
  }
  
  function xuly8(){
  		var tam= document.getElementById("loadingtim").innerHTML;
	//console.log(tam);
	if(tam){
		tam=tam.split("###");
		if(tam[1]!=-1){
			document.getElementById("loadingtim").style.display='none';
			document.getElementById("shownhansu").innerHTML=tam;
			$('.js-nhanvienadd').select2({
					width:'100%'
				});
				$('.js-captrenadd').select2({
					width:'100%'
				});
		}
		else{
			document.getElementById("loadingtim").style.display='block';
		}	
	}
  }
</script>


 

 
