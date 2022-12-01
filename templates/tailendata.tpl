<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div class="top_space"></div>
<div class="nenbao">
<div style="padding:1px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;" >Tải lên data</label></a>
   </legend><div    > 
 

  
 
<form name="frmProduct2" id="frmProduct2" method="post" >

<fieldset  class="nencon" id="khachhang" >
	<legend>   <h3>
	  <input type="button" name="tm" style="width:100px;display:{q_themp}"    value="Nhập từ Excel" onclick="nhapexcel1()" />
	</h3>
</fieldset>
</form>
 
 

<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>
 
 <div   id="timexxcel" style="padding:10px">
 
 
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="" />
    <label>File khách hàng Excel *.xlsx</label>
<input id="fileToUpload" type="file" accept=".xlsx"   size="35" name="fileToUpload" class="input" style="height:22px" />
<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();" style="height:22px">Tải lên</button>&nbsp;  

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
  
 
  

function goidongthe()
{
 document.getElementById("hiethithongbao").style.display = 'none' ;
}

  

function timkiemkh(t1,t2,t3,t4,t5,t6,t7,t8,t9)
{ 	
     poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
     poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8)+ "*@!"+ encodeURIComponent(t9);
	 if(t6!=2)
	 {    
 		 loadtrang('hienthinhacc', "naptienapptim", poststr,"") ; 
	 } else
	 {
		 loadtrang('hienthinhacc', "naptienapptim", poststr,"") ; 
	 }
	//alert('Luu xong !!!');
} 


 function xuatkq()
{
	 
	 document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>'+ document.getElementById("hienthinhacc").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
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
function ajaxFileUpload()
{
	var  tt = id_user;
	
 
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
				url:'fileuploaddata.php?us=' + tt + '_'+ nn,
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
function laydulieue()
{ 
 	  document.getElementById("tbht").innerHTML=document.getElementById("tbex").innerHTML;
	   goidongid('hiennhapexcel') ;
	  return;
	 var table = document.getElementById("tbex"); 
	 var totalRows = document.getElementById("tbex").rows.length;
 	var totalCol = 5; // enter the number of columns in the table minus 1 (first column is 0 not 1)
	 
	for (var x = 1; x <= totalRows; x++)
	  {
 	 
		  addpro(table.rows[x].cells[1].innerHTML,table.rows[x].cells[3].innerHTML,
		        table.rows[x].cells[2].innerHTML ,table.rows[x].cells[5].innerHTML,
				 table.rows[x].cells[6].innerHTML,table.rows[x].cells[4].innerHTML,0,table.rows[x].cells[7].innerHTML) ;
				
	  }
//To display a single cell value enter in the row number and column number under rows and cells below:
    goidongid('hiennhapexcel') ;
}	
function hienthidulieu()
{ 
	   var t1 ;
	   alert("ok");
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel', "tailendatahienthi", poststr,"") ;		
 
}
	 
</script>
 
</div></fieldset></div>