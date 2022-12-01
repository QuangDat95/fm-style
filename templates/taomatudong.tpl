<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">

</style>
<div class="top_space"></div>
<div class="nenbao">
	<div style="padding:1px">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Tạo mã sản phẩm</label>
				</a></legend>
			<div>
				<!-- BEGIN: block_cus -->
				<form name="frmProduct2" id="frmProduct2" method="post">

					<fieldset class="nencon" id="khachhang">
						<legend>
							<h3>{t-c}</h3>
						</legend>
						<script language="javascript">
							var t = 1;
							mTimer = setTimeout('doititle()', 1000);
							function doititle() {
								t = t + 1;

								if (t < 18) {
									if (document.title != '***') {
										document.title = "***";
									} else {
										document.title = "Tạo mã tự động";
									}
									setTimeout('doititle()', 500);
								}
							}
						</script>


						<table width="100%" border="0">
							
							<tr class="" id="loaicapnhat5">
								<td width="15%" id="capnhatphieu" style="padding-top:1em">NCC: </td>
								<td width="25%" style="padding-top:1em">
								<input type="hidden"  name="id" id="id" />
							
									<select id="ncc" name="ncc" onchange=""  style="width:200px" class="js-nhacungcap"><option value=""></option>
										{nhacungcap}
									</select>							  </td>
							  
							  <style>
							  
							  .show_size_mau{
							  	display:flex;
								justify-content: space-evenly;
							  }
							  .show-mau{
							  	    width: 40%;
								display: flex;
								flex-direction: column;
								height: 300px;
								overflow-y: scroll;
							  }
							  .show-mau > div{
							      display: flex;
    font-size: 14px;
    padding-top: 0.3em;
							  }
							  </style>
								<td width="60%"  rowspan="8">	
								
									<div class="show_size_mau">
									
										<div class="show-mau">
											{chuoimau}										</div>
										<div class="show-mau">
											{chuoisize}										</div>
									</div>
								<div style="    width: 100%;
    display: flex;
    padding: 1em;
    justify-content: flex-end;"></div>							  </td>
							</tr>
<tr class="m-r-2">
								<td width="15%">
									Năm:</td>
							  <td colspan=""><select id="nam"   style="width:200px" name="nam" onchange=""  class="js-nam">
										<option value=""></option>
										{chuoinam}
									</select>	</td>
							  <td width="0%"  >		
							  
									<div class="show_size_mau">									</div>		  </td>
						  </tr>
							<tr class="m-r-2">
								<td width="15%">
								Tháng:									</td>
							  <td colspan=""><select id="thang" name="thang"   style="width:200px" onchange=""  class="js-thang">
                                <option value=""></option>
							    
										{chuoithang}
									
						      </select></td>
								<td width="0%" >								</td>
							</tr>
					<tr class="m-r-2">
								<td width="15%">
									Ngành Hàng: </td>
							  <td colspan="">	<select id="nganhhang"   style="width:200px" name="nganhhang" onchange=""  class="js-nganhhang"><option value=""></option>
										{nganhhang}
									</select>	</td>
							  <td width="0%" >								</td>
						  </tr>
							<tr class="m-r-2">
								<td width="15%">
									Nhóm Hàng: </td>
							  <td colspan="">	<select id="nhomhang"   style="width:200px" name="nhomhang" onchange="" class="js-nhomhang"><option value=""></option>
										{nhomhang}
									</select>	</td>
							  <td width="0%" >								</td>
							</tr>
							
<tr class="m-r-2">
								<td width="15%">
									Ngày nhập:</td>
							  <td colspan=""><input id="ngaynhap" name="ngaynhap"   style="width:200px" type="datetime-local">		  </td>
							  <td width="0%" >								</td>
						  </tr>
							</tr>
							
<tr class="m-r-2">
								<td width="15%">
									Tên Sản phẩm:</td>
							  <td colspan=""><input type="text"   style="width:200px" id="tensp" name="tensp" />		  </td>
							  <td width="0%" ></td>
						  </tr>
<tr class="m-r-2">
								<td width="15%">
									Giá:</td>
							  <td colspan=""><input type="text"   style="width:200px" id="giamt" name="giamt" onchange="changegia(this.value),formatso(event)"  onkeyup ="formatchuan(this)"  onblur="txtFormat(this)" value="111" />		  </td>
							  <td width="60%" ></td>
						  </tr>
							
								<!--<tr class="m-r-2">
								<td width="15%">
									Size:</td>
							  <td colspan=""><select id="size"   style="width:200px" name="size" class="js-size" onchange="createSp(event)" multiple="multiple">
							  <option value=""></option>
										{size}
									</select>	</td>
							  <td width="1%" >								</td>
							</tr>
							</tr>
								<tr class="m-r-2">
								<td width="15%">
									màu:</td>
							  <td colspan=""><select id="mau"   style="width:200px" name="mau"  class="js-mau" onchange="createSp(event)"  multiple="multiple" >
							    <option value=""></option>
										{mau}
									</select>	</td>
							  <td width="67%" >								</td>
							</tr>-->
							<tr class="m-r-2">
							
							  <td colspan="4" >
							  <style>
							  #showsp{
							  		    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
							  }	
							  
							   #showsp >div{
							   		    display: flex;
									width: 50%;
									padding: 0 0.5em;
									/* margin-top: 1em; */
									justify-content: space-between;
							   }
							  </style>
							  <div id="showsp">							  </div>							</td>
							</tr>
						</table>
						<br />


					<div style="padding-left:105px;padding-bottom:8px">
					<button type="button" onclick="createSp(event)">họp màu X size</button>
							<input type="button" onfocus="setrong()" onclick="taomaxemtruoc()" class="text"
								id="btnUpdate" name="btnUpdate" value="Tạo mã xem trước" />
								
								<input type="button" onfocus="" onclick="lammoi()" class="text"
								id="btnUpdate" name="btnUpdate" value="làm mới" />
								<input type="button" onfocus="" onclick="toggleShow(true,'upanhsanphamnhieu')"class="text"
								id="btnUpdate" name="btnUpdate" value="Upload ảnh" />
							<!--<input type="button" onclick="quaylai()" name="cancel2" style="width:200px" 
									  value="Quay lại danh sách mã vận đơn" style="display:none" />-->

							<div id="loading" style="display:none"><img src="images/loading.gif" /></div>
							
					</div>
					</fieldset>

				</form>
				
				<style>
					#httim{
						display:none;
						position:fixed;
					    background-color: #00000024;
						top:0;
						left:0;
						width:100%;
						height:100vh;
						    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
	    justify-content: center;
    align-content: center;
    align-items: center;
					}
					#show_ma{
						    min-width: 70%;
    
    max-width: 60%;
    max-height: 500px;
    background-color: #FFFFFF;
    overflow-y: scroll;
	border: 1px solid #000000;
	
	    position: relative;
					}
					
					#show_ma_{
						    width: 100%;
					/* height: 100%; */
					
					}
				
					#show_ma_ table{
					padding: 1em;
					padding:1em;
					}
					#luu_ma{
							  position: sticky;
							bottom: 0;
							backdrop-filter: blur(2px);
							-webkit-backdrop-filter: blur(2px);
							width: 100%;
							background-color: #0000001c;
							padding: 1em;
					}
					.giaspct{
						width:35%;
					}
					.soluongspct{
						width:35%;
					}
					.wr_sl{
						width:60%;
					}
					.wr_lab{
						width:50%;
					}
					.block_sp_s{
						display:flex;
						    flex-direction: column;
							    padding: 1em !important;
    border: 1px solid green;
	margin-top:1em;
	width:47% !important;
	  position: relative;
					}
					
					.block_sp_s .wr_sl_item
					{
					display:flex;
					}
					.title_mau{
						    color: #484848;
    position: absolute;
    top: -10px;
    background-color: #ffffffff;
    font-weight: 600;
					}
				</style>
	<div id="httim" >
	
		<div id="show_ma"></div>
	
	</div>	
	<script>
var folder='';
var linkkiemtraanh='taomatudonghienthi';
</script>
{FILE "templates/upanhsanphamnhieu.tpl"}

	<form name="xuatexel" id="xuatexel"  action="taomatudongexel.php" method="post" target="_blank">
		<input type="hidden" name="XUATEXEL" id="XUATEXEL" value="1"/>
	</form>		
		 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
		
<script type="text/javascript" src="templates/ajaxfileupload.js"></script>		
				<script>
		

$(document).ready(function() {
		
	   
		 $('.js-size').select2({
		 		 multiple: true,
				  placeholder: "Chọn size",
				  
			});
			
		 $('.js-mau').select2({
		 		 multiple: true,
				  placeholder: "Chọn màu",
				  
			});
			
		 $('.js-nhomhang').select2({
		 		// multiple: true,
				  placeholder: "Chọn nhóm hàng",
				  
			});
			 $('.js-nganhhang').select2({
		 		// multiple: true,
				  placeholder: "Chọn ngành hàng",
				  
			});
			 $('.js-thang').select2({
		 		// multiple: true,
				  placeholder: "Chọn tháng",
				  
			});
			 $('.js-nam').select2({
		 		// multiple: true,
				  placeholder: "Chọn năm",
				  
			});
			$('.js-nhacungcap').select2({
		 		// multiple: true,
				  placeholder: "Chọn nhà cung cấp",
				  
			});
		});
		
		function changegia(value){
			$(".giaspct").each((index,item)=>{
				if($(item).val()==''){
				
					$(item).val(value);
				}
				
			})
		}	
		
		function createSp(e){
		
		var sizestong=$(".jssize");
			var maustong=$(".jsmau");
			var sizes=[];
			var maus=[];
			sizestong.each((index,item)=>{
			
				if(item.checked==true){
				
					sizes=[ ...sizes,{ "id":item.value,"text":item.getAttribute("data-name") }]
				}
			
			})
			maustong.each((index,item)=>{
			
				if(item.checked==true){
				//console.log(item);
					maus=[ ...maus,{ "id":item.value,"text":item.getAttribute("data-name") }]
				}
			
			})
			
			//var sizes=$(".js-size").select2('data');
			//var maus=$(".js-mau").select2('data');	
			var gia=$("#giamt").val();
			
			if(!sizes || sizes.length==0  || !maus || maus.length==0 ){
				return;
			
			}
			var sp="";
			var idtang='';
			for(var i=0;i<maus.length;i++){
				var mau=maus[i];
				
				if(!mau.id || mau.id==''){
					continue;
				}
				sp+='<div class="block_sp_s"><span class="title_mau" style="">'+mau.text+'</span>';
				for(var j=0;j<sizes.length;j++){
						var size=sizes[j];
						if(!size.id || size.id==''){
							continue;
						}
					sp+='<div id="" class="wr_sl_item"><div class="wr_lab" style="    font-weight: 700"><span style="color:red">'+mau.text+'</span> X <span style="color:green">'+size.text+'</span></div><div  class="wr_sl"><span style="    font-weight: 700; margin-right: 0.3em;">Số lượng</span><input type="number" name="" id="" class="soluongspct" placeholder="Số lượng" value="1" data-s="'+size.id+'"  data-m="'+mau.id+'" data-tm="'+mau.text+'"  data-ts="'+size.text+'"/><input type="text" class="giaspct" name="" id="" placeholder="Giá" value="'+gia+'" onkeyup ="formatchuan(this)" onchange="formatso(event)" onblur="txtFormat(this)" data-s="'+size.id+'"  data-m="'+mau.id+'"/></div><button onclick="xoactsp(event)">X</button></div>';
				}
				sp+='</div>';
			}
			//console.log(sp);
			$("#showsp").html(sp);
		}
		function lammoi(){
				$(".js-nhacungcap").val('');
				$(".js-nhacungcap").trigger("change");
			$(".js-nganhhang").val('');
			$(".js-nganhhang").trigger("change");
			$(".js-nhomhang").val('');
			$(".js-nhomhang").trigger("change");
			document.getElementById("ngaynhap").value='';
			document.getElementById("tensp").value='';
			document.getElementById("giamt").value='';
			$(".jssize").each((index,item)=>{
					item.checked=false
			
				});
					$(".jsmau").each((index,item)=>{
						item.checked=false
			
				});
				//$(".js-mau").trigger("change");
					//$(".js-size").trigger("change");
			$("#showsp").html("");
		}
		function kiemtra(){
			if(document.getElementById("ncc").value==''){
				alert("vui lòng chọn nhà cung cấp");
				return;
			}
			if(document.getElementById("nam").value==''){
				alert("vui lòng chọn năm");
				return;
			}
			if(document.getElementById("thang").value==''){
				alert("vui lòng chọn tháng");
				return;
			}
			if(document.getElementById("nganhhang").value==''){
				alert("vui lòng chọn ngành hàng");
				return;
			}
			if(document.getElementById("nhomhang").value==''){
				alert("vui lòng chọn nhóm hàng");
				return;
			}
			if(document.getElementById("ngaynhap").value==''){
				alert("vui lòng chọn ngày nhập");
				return;
			}
			if(document.getElementById("giamt").value==''){
				alert("vui lòng nhập giá");
				return;
			}
			//var size =$(".js-size").select2('data');
			//var mau =$(".js-mau").select2('data');
			//if(!size || size[0].id=='' ){
//				alert("vui lòng chọn size");
//				return;
//			}
//			if(!mau || mau[0].id=='' ){
//				alert("vui lòng chọn màu");
//				return;
//			}
			if(document.getElementById("tensp").value==''){
				alert("vui lòng nhập tên sản phẩm");
				return;
			}
			return true;
		}
		var tammamota='';
		function taomaxemtruoc(){
			if(!kiemtra()){
				return;
			}
			isloading1(true);
			var  ncc=$(".js-nhacungcap").select2("data");
			var  nam=document.getElementById("nam").value;
			var  thang=document.getElementById("thang").value;
			var  nganhhang=$(".js-nganhhang").select2("data");
			var  nhomhang=$(".js-nhomhang").select2("data");
			var  ngaynhap=document.getElementById("ngaynhap").value;
			var  tensp=document.getElementById("tensp").value;
			var  giamt=document.getElementById("giamt").value;
			var  sizetong=0;
			var  mautong=0;
			$(".jssize").each((index,item)=>{
					if(item.checked==true){
						sizetong++;
					}
			
				});
					$(".jsmau").each((index,item)=>{
						if(item.checked==true){
						mautong++;
					}
			
				});
			
			var soluongchitiet=document.getElementsByClassName("soluongspct");
			
			var giachitiet=document.getElementsByClassName("giaspct");
			var slmauchitiet=[];
			for(var i=0;i<soluongchitiet.length;i++){
				var soluong=soluongchitiet[i];
				
				var dataziseS=soluong.getAttribute("data-s");
				var tenziseS=soluong.getAttribute("data-ts");
				var datamauS=soluong.getAttribute("data-m");
				var tenamauS=soluong.getAttribute("data-tm");
				var tamSM='';
				for(var j=0;j<giachitiet.length;j++){
						var gia=giachitiet[j];
						var dataziseM=gia.getAttribute("data-s");
							var datamauM=gia.getAttribute("data-m");
							if(dataziseS==dataziseM && datamauS==datamauM){
								tamSM={
									"size":dataziseS,
									"tensize":tenziseS,
									"mau":datamauS,
									"tenmau":tenamauS,
									"gia":gia.value,
									"soluong":soluong.value
								};
								
							}
				}
				slmauchitiet.push(tamSM);
			}
			slmauchitiet={ ...slmauchitiet };
		
			var tam={ 
			'ncc':ncc,
			'nam':nam,
			'thang':thang,
			'nganhhang':nganhhang,
			'nhomhang':nhomhang,
			'ngaynhap':ngaynhap,
			'tensp':tensp,
			'gia':giamt,
			'sizetong':sizetong,
			'mautong':mautong,
			'chitietsizemau':slmauchitiet
			};
			 poststr="DATA="+ encodeURIComponent(JSON.stringify(tam))+"*@!";
		
    		 loadtrang('show_ma', "taomatudonghienthi", poststr,"xuly4") ;
	 
	
			//console.log(tam);
		}
		function xuly4(){
			var tam=document.getElementById("httim").innerHTML;
			if(tam){
				tammamota=document.getElementById("mamota").value;
				showpop(true);
				isloading1(false);
			}
		}
		
		function xoactsp(e){
			var target=e.target;
			target.parentElement.remove();
		}
		
		function luuma(){
			var mamotamoi=document.getElementById("mamota").value;
			 poststr="LUUMA="+ encodeURIComponent(mamotamoi)+"*@!";
			  loadtrang('resluuma', "taomatudonghienthi", poststr,"xuly8") ;
		}
		function xuly8(){
			var tam=document.getElementById("resluuma").innerHTML;
			if(tam){
				tam=tam.split("###");
				alert(tam[2]);
				//showpop(false);
				isloading1(false);
				document.getElementById("btn_in").disabled=false;
			}
		}
		
		function showpop(type){
			document.getElementById("httim").style.display=type?"flex":"none";
		}
		function isloading1(type){
			document.getElementById("loading").style.display=type?"inline-block":"none";
		}
		
		
		function checkmota(value){
			if(tammamota!=value){
					poststr="CHECKMOTA="+ encodeURIComponent(value)+"*@!";
			  loadtrang('rescheckmota', "taomatudonghienthi", poststr,"xuly9") ;
			  tammamota=value
			}
			else{
				return;
			}
			 
		
		}
		
		function xuly9(){
		
			var tam =document.getElementById("rescheckmota").innerHTML;
			if(tam){
			document.getElementById("btn_luu").focus();
				tam=tam.split("###");
				if(tam[1]==1){
					document.getElementById("btn_luu").disabled=false;
					document.getElementById("mamota").style.color="green";
					document.getElementById("mamota").style.borderColor="green";
				
				}else{
				document.getElementById("mamota").style.color="red";
				document.getElementById("mamota").style.borderColor="red";
					document.getElementById("btn_luu").disabled=true;
				}
			}
		}
		
		
function goiinma3()
{ 	

	//isloading1(true);
st = "taomatudonginmatems.php?type=1"    ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=720,height=600,titlebar=no') ;
return;
  poststr="DATA="+ encodeURIComponent(1) ;
  loadtrang('show_ma', "taomatudonginmatems", poststr,"xuly7") ;	
  	
}

function xuly7(){

	showpop(true);
				isloading1(false);
}
 
function xuatexelm(){
	document.getElementById("xuatexel").submit();
}
 	
 	//function inhd4()
//  {
//     w=window.open();
//		w.document.write($('.page_in').html());
//		w.print();
//		w.close();
//  }	

				</script>

			
			</div>
		</fieldset>
	</div>