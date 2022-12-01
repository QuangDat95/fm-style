<script type="text/javascript" src="https://www.google.com/jsapi"></script>

 

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="top_space"></div>
<div class="nenbao">
<!-- BEGIN: block_admin -->
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >Báo cáo hằng ngày</label> 
	</a></legend>
 
<form name="frmttk" method="post">
 <div style="display:none" id="hthuongdan"> </div>
<div id="codechinh">



<div style="padding-bottom:10px"> 
<input  type="hidden" name="NameTK"  id="NameTK" ondblclick="this.value=''" size="10" value="{NameTK}" />
   
<input  type="hidden" name="codeprotk"  id="codeprotk" ondblclick="this.value=''" size="8" value="{codeprotk}" /> 
      
<input onkeypress="return chuyentiep(event,'IDGrouptk')" type="hidden" name="IDNV"  id="IDNV"  style="width:25px" value="{IDNV}" ondblclick="this.value=''"/> 
Nhóm   <select onkeypress="return chuyentieps(event,'kho')" name="IDGrouptk"  id="IDGrouptk" style="width:40px" >
			<option value="" ></option>
			{cay}
			</select>
&nbsp;CH 
<select onkeypress="return chuyentiep(event,'search')" name="kho"  id="kho" style="width:61px">
  
 	{tatca}
 	 	{kho}

	 
 
</select>
Từ
<input onkeypress="return chuyentiep(event,'denngay')" ondblclick="this.value=''" type="text" name="tungay"   id="tungay" class="text" style="width:67px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmttk.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
<input onkeypress="return chuyentiep(event,'htchitiet')" type="text" name="denngay"  id="denngay" class="text" style="width:67px" value="{denngay}" />
<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmttk.denngay,'dd/mm/yyyy',this)" />&nbsp;
<input type="button"    onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,1)"   name="search2" style=" " id="bcch" value="BC cửa hàng" />
<input type="button"    onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,2)"   name="search22" style=" " id="search22" value="Theo ngày" />
<input type="button"    onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0)"   name="search" style=" " id="search" value="1 ngày trước" />
<input type="button"    onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,3)"   name="search3" style=" " id="search3" value="3 ngày trước" />
<input type="button"    onclick ="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,4)"   name="search4" style=" " id="search4" value="BC Tuần" />
<input type="button"    onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,5)"   name="search42" style=" " id="search42" value="BC Tháng" />
 </div>
<div id="httim" >
  
</div>

 

 <script type="text/javascript">
  
 
  
      google.charts.load("current", {packages:['corechart']
											   });
       google.charts.setOnLoadCallback(drawChart);
       
	  
  </script>
 
    
  

 </div>
</form>
 

  

 
<script language="javascript"  type="text/javascript" >
 function xuly1()
   {
	   eval(document.getElementById("dulieu").innerHTML); 
	    google.charts.setOnLoadCallback(drawChart);
	 
	    eval(document.getElementById("bdt").innerHTML); 
          google.charts.setOnLoadCallback(drawChart3);
		// 
   }
   
 
document.getElementById('NameTK').focus();
function submittk(t1,t2,t3,t4,t5,t6,t7,t8)
{
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4); 
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8);
  loadtrang('httim', "matdinhtonghoptim", poststr,"xuly1") ;
 }

 
  document.getElementById("bcch").click();


</script>
 
 
 
</fieldset>

<!-- End: block_admin -->
</div>
