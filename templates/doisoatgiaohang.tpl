<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div class="top_space"></div>
<div class="nenbao">
<div style="padding:1px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Đối soát giao hàng</label>
	</a></legend>
   <div > 
 
 

 <div id="khonghienthi" style="display:none"></div>
  <table cellpadding="4" cellspacing="4" >
    <tr><td>File Excel GHTK 1</td><td> 
      <input id="GHTK1" type="file" accept=".xlsx"   size="35" name="GHTK1" class="input" style="height:22px" />
    </td> <td><button class="button" id="buttonUpload1" onclick="return ajaxFileUpload('GHTK1');" style="height:22px">Tải lên</button></td>
	<td>&nbsp; &nbsp; &nbsp; &nbsp;   </td>
	<td>File Excel Viettel 1 </td>
	<td> 
      <input id="Viettel1" type="file" accept=".xlsx"   size="35" name="Viettel1" class="input" style="height:22px" />
    </td> <td><button class="button" id="buttonUpload2" onclick="return ajaxFileUpload('Viettel1');" style="height:22px">Tải lên</button></td>
    </tr>
	
	   <tr>
	     <td>File Excel GHTK 2 </td>
	     <td> 
      <input id="GHTK2" type="file" accept=".xlsx"   size="35" name="GHTK2" class="input" style="height:22px" />
    </td> <td><button class="button" id="buttonUpload3" onclick="return ajaxFileUpload('GHTK2');" style="height:22px">Tải lên</button></td>
	<td>&nbsp; &nbsp; &nbsp; &nbsp;   </td>
	<td>File Excel Viettel 2</td>
	<td> 
      <input id="Viettel2" type="file" accept=".xlsx"   size="35" name="Viettel2" class="input" style="height:22px" />
    </td> <td><button class="button" id="buttonUpload4" onclick="return ajaxFileUpload('Viettel2');" style="height:22px">Tải lên</button></td>
    </tr>
  </table>
  </div>
  <form name="frmProduct2" id="frmProduct2" method="post" >
 
 
 			 
		  <div style="padding:5px">&nbsp; 
<input type="text" name="ten" id="ten" ondblclick="this.value=''"  placeholder="Tên KH"  class="inpl"  style="width:65px" onkeypress="return chuyentiep(event,'diachitim')"   value="" /> 
Tel
<input type="text" name="dt" ondblclick="this.value=''" id="dt" class="inpl"  style="width:66px" onkeypress="return chuyentieps(event,'cmnd')"   value="" />
  
<input type="text" name="trendiem" title="Khách có điểm tích lũy từ ..."  placeholder="Điểm"  ondblclick="this.value=''" id="trendiem" class="inpl"  style="width:30px" onkeypress="return chuyentieps(event,'cmnd')"   value="" />
<input type="hidden" name="mc" ondblclick="this.value=''" id="cm" class="inpl"  style="width:80px" onkeypress="return chuyentieps(event,'kv')"   value="" />

  Ngày  
  <input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="tungay"   id="tungay" class="text" style="width:65px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmProduct2.tungay,'dd/mm/yyyy',this)" />đến<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="denngay"   id="denngay" class="text" style="width:65px"  value="{denngay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmProduct2.denngay,'dd/mm/yyyy',this)" />&nbsp;<span style="padding-top:10px;padding-bottom:5px">
  
 </span>
 
   
<input type="button" style="  width: 40px;" id="xuat" value="Excel" name="xuat" onclick="xuatkq()" /></div>
		</div></div> 
  <div id="hienthinhacc"> </div>
 </form>
 
  
<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="thongtinkhachhang.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>
 
 
<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>
 
 <div   id="timexxcel" style="padding:10px">
 
 

&nbsp;
<button class="button" id="buttonUpload1" onclick="return hienthidulieu();" style="height:22px">Hiển thị dữ liệu Excel trước</button>&nbsp;  
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
  
<div id="khonghienthiapp"></div>
<script type="text/javascript" src="templates/ajaxfileupload.js"></script>
 <script language="JavaScript">
 
  function xulychung()
  {
  }
 function timkiemkh(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) +  "*@!"+ encodeURIComponent(t11) ;
    loadtrang('hienthinhacc', "khachhangtim", poststr,"") ;
	//alert('Luu xong !!!');
} 
function timthongke(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) +  "*@!"+ encodeURIComponent(t11) ;
    loadtrang('hienthinhacc', "khachhangthongke", poststr,"") ;
	//alert('Luu xong !!!');
} 
function timthongketuoi(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) +  "*@!"+ encodeURIComponent(t11) ;
    loadtrang('hienthinhacc', "khachhangthongketuoi", poststr,"") ;
	//alert('Luu xong !!!');
} 
function timthongkediem(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) +  "*@!"+ encodeURIComponent(t11) ;
    loadtrang('hienthinhacc', "khachhangthongkediem", poststr,"") ;
	//alert('Luu xong !!!');
} 
function khachmua(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10)+  "*@!"+ encodeURIComponent(t11) ;
    loadtrang('hienthinhacc', "khachhangthongkemua", poststr,"") ;
	//alert('Luu xong !!!');
} 
function nguonkhach(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11,t12)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10)+  "*@!"+ encodeURIComponent(t11) +  "*@!"+ encodeURIComponent(t12) ;
	if(t12==3)  { loadtrang('hienthinhacc', "khachhangbaocaooltim", poststr,"") ; }
	else  if(t12==4)  { loadtrang('hienthinhacc', "khachhangbaocaotailen", poststr,"") ; }
	else
	{
	    loadtrang('hienthinhacc', "khachhangbaocaotim", poststr,"") ;
	}
	//alert('Luu xong !!!');
} 
function xephang(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8) +  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) ;
    loadtrang('hienthinhacc', "khachhangxephang", poststr,"") ;
	//alert('Luu xong !!!');
} 

  	 
 
 function goidongthe()
{
 document.getElementById("hiethithongbao").style.display = 'none' ;
} 

 	
function nhapexcel1()
{
    if (document.getElementById('hiennhapexcel').style.display =="")
	{
		document.getElementById('hiennhapexcel').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '' ;	
		document.getElementById('timphieuxuat').style.display = 'none' ;	
 	} 
	else
	{
		document.getElementById('hiennhapexcel').style.display = "";
		document.getElementById('timkhachhanght').style.display = 'none' ;	
		document.getElementById('timphieuxuat').style.display = '' ;	
	}

	
} 
function ajaxFileUpload(inp)
{
	var  tt = id_user;
	 var aa= 'fileToUpload1' ;
 
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
				url:'fileuploadketoan.php?us=' +inp ,
				secureuri:false,
				fileElementId:inp,
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

						    hienthidulieu(inp);
							 
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
function laydulieue()
{ 
  	  poststr ="DATA="+encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
 	  loadtrang('hienthiexcel', "doisoatgiaohangexcel", poststr,"") ;	 
 }	

function hienthidulieu(t1)
{   
 	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(1) ;
 	   loadtrang('hienthiexcel', "doisoatgiaohangexcel", poststr,"") ;		
}
	 
</script>
</div></fieldset></div></div>
 