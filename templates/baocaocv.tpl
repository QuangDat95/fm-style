<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<STYLE>
 	.cao{
	
	  height:20px;
    }
	.cungdong{
	  width:100px;float:left;
    }
	.cungdong1{
	  float:left;width:190px;height:20px ;
    }	
	.inptr{
	Color:#FF0000;background-image: url(images/dot_black.gif);Border:0px;Text-Align:center;
    }
	.inpt{
	Color:#FF0000;background-image: url(images/dot_black.gif);Border:0px;Text-Align:center;
    }	
	.inpl{
	Color:#0000FF;background-image: url(images/dot_xanh.gif);Border:0px;Text-Align:left;
    }
	.chu{
		Color:#FF3300; font-style:inherit;font-size:12px
    }	

	.lb{
		Color:green;Font-Weight:Bold;
	}
</STYLE>
<form id="frmbaocaocv" name="frmbaocaocv" action="" method="get">
<input type="hidden" id ="ngaybaocao" name="ngaybaocao" />
<input type="hidden" id ="ngayso"  name="ngayso" />
<input type="hidden" id ="in_tuan" name="in_tuan" />
<input type="hidden" id ="ngayluu" name="ngayluu" value=""/>
<input type="hidden" id ="chucnang" name="chucnang" value=""/>
 
<div style="padding-top:2px"> 

<div  align="center" style="padding-bottom:5px">
   <div id="Ngaybccv" style="color:#000000;background-color:#eef2fb;width:30%;BORDER:#eef2fb 1px solid; float:left" align="left">  Ngày :  </div>
   <div id="muctieu1" style="float:left;width:24%; BORDER :#cccccc 1px solid;" ><a class="menutab" style="cursor:pointer" onclick="bcsetmuc('1')" ><strong>Kế Hoạch Hằng Ngày </strong></a></div>
   
   <div id="muctieu2" style="float:left;width:24%;BORDER:#cccccc 1px solid;" class="mauchucnang"><a style="cursor:pointer" onclick="bcsetmuc('2')" class="menutab"  ><strong>Báo Cáo Công Việc</strong></a></div>
   <div id="muctieu5" style="BORDER:#cccccc 1px solid;background-color:#eef2fb;"><a  class="menutab" style="cursor:pointer" onclick="bcsetmuc('5')"><strong>Kế Hoạch Tuần-Tháng-Năm </strong></a></div>
  
</div>

  <div style="float:left;width:174px;padding-right:4px">
<fieldset  >
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt;cursor:pointer">Thời gian báo cáo </label>
	</a></legend>
	<br />
	<!-- BEGIN: block_xuattt --> 
	<a style="cursor:pointer" class="kehoach" title="Kế hoặch năm" onclick="kehoachnam(frmbaocaocv.nam.value)">Năm</a><select id="nam" name="nam" style="width:50px;font-size:11px" onchange="settuan(nam.value,thang.value,'1')">
 		{nam}
    </select> 
	<a style="cursor:pointer" title="Kế hoặch tháng"  class="kehoach" onclick="kehoachthang(frmbaocaocv.thang.value)">Tháng</a><select name="thang" id="thang" style="width:37px;font-size:11px;" onchange="settuan(nam.value,thang.value,'1')">
   	  {thang}    
    </select>
	<input type="hidden" name="ngay" value="{ngay}"/>
	<!-- END: block_xuattt --> 

    <div style="height:5px;"></div>	
<div style="BORDER-TOP:#0000CC 1px solid;"></div>
<div style="padding-top:5px" id="dsnhanvien">	
<table border="0" cellpadding="0" cellspacing="0" width="99%">
	<tr bgcolor="#FFCC33">
	<td align="center" style='border:solid windowtext 1.0pt;mso-border-alt:solid windowtext .9pt;padding:0in 0.4pt 0in 0.4pt' height="23" width="49"><a style="cursor:pointer"  class="kehoach"  title="Kế hoặch tuần" onclick="kehoachtuan(frmbaocaocv.in_tuan.value)"> Tuần&nbsp;</a></td>	
	<td id="t1" align="center" style="cursor:pointer;border:solid windowtext 1.0pt;mso-border-alt:solid windowtext .9pt;padding:0in 0.4pt 0in 0.4pt" height="23" width="33" onclick="settuant(nam.value,thang.value,'1')" class="doimau">1</td>
	<td id="t2" align="center" style='cursor:pointer;border:solid windowtext 1.0pt;mso-border-alt:solid windowtext .9pt;padding:0in 0.4pt 0in 0.4pt' height="23" width="27" onclick="settuant(nam.value,thang.value,'2')" class="doimau">2</td>
	<td id="t3" align="center" style='cursor:pointer;border:solid windowtext 1.0pt;mso-border-alt:solid windowtext .9pt;padding:0in 0.4pt 0in 0.4pt' height="23" width="27" onclick="settuant(nam.value,thang.value,'3')" class="doimau">3</td>
	<td id="t4" align="center" style='cursor:pointer;border:solid windowtext 1.0pt;mso-border-alt:solid windowtext .9pt;padding:0in 0.4pt 0in 0.4pt' height="23" width="27" onclick="settuant(nam.value,thang.value,'4')" class="doimau">4</td>			
	<td id="t5" align="center" style="cursor:pointer;border:solid windowtext 1.0pt;mso-border-alt:solid windowtext .9pt;padding:0in 0.4pt 0in 0.4pt" height="23" width="31" onclick="settuant(nam.value,thang.value,'5')" class="doimau">5</td>	
	</tr>
	</table>

<div id="hienthilich" >
	<table border="1" cellpadding="0" cellspacing="0">
		<tr bgcolor="#FFFFFF"  onclick="setthongtin('ngay','thang','nam')" class="doimau">
		<td colspan="2"  align="left"  height="23" >&nbsp;Chủ Nhật </td>
		<td colspan="4" align="center"  >&nbsp;</td>	
		</tr>	
		<tr bgcolor="#FFFFFF">
		<td colspan="2"  align="left"  height="23"  >&nbsp;Thứ hai</td>
		<td width="86" colspan="4" align="center"   >&nbsp;</td>	
		</tr>
		<tr bgcolor="#FFFFFF" >
		<td colspan="2"  align="left"   height="23" >&nbsp;Thứ Ba</td>
		<td colspan="4" align="center"  >&nbsp;</td>	
		</tr>
		<tr bgcolor="#FFFFFF">
		<td colspan="2"  align="left"  height="23" >&nbsp;Thứ Tư</td>
		<td colspan="4" align="center"  >&nbsp;</td>	
		</tr>
		<tr bgcolor="#FFFFFF">
		<td colspan="2"  align="left"  height="23" >&nbsp;Thứ Năm </td>
		<td colspan="4" align="center"  >&nbsp;</td>	
		</tr>
		<tr bgcolor="#FFFFFF">
		<td colspan="2"  align="left"  height="23" >&nbsp;Thứ Sáu</td>
		<td colspan="4" align="center"  >&nbsp;</td>	
		</tr>
		<tr bgcolor="#FFFFFF">
		<td colspan="2"  align="left" height="23" >&nbsp;Thứ Bảy</td>
		<td colspan="4" align="center"  >&nbsp;</td>	
		</tr>

	
	
	</table>
 
	</div>
	<div>
	<fieldset style="padding:1;margin:0px" >
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt;cursor:pointer" onclick="anhienform('hthoctap')">Học Tập </label>
	</a></legend>	
	<div style="padding-top:5px" id="hthoctap">
	<!-- BEGIN: block_baihoc--> 
		 <div style="padding:2px"><a onclick="xembh('{idbh}')" style="cursor:pointer;color:#260FF7"  ><img src="images/Book_openHS.png" align="left" border="0" width="12" />&nbsp;{BaiHoc}</a></div><div style="clear:left"></div>
	<!-- END: block_baihoc --> 	
	</div>
	</fieldset>
	<fieldset style="padding:1;margin:0px" >
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt;cursor:pointer" onclick="anhienform('httintuc')">Tin Tức</label>
	</a></legend>	
	<div style="padding-top:5px" id="httintuc">
	<!-- BEGIN: block_tintuc--> 
		 <div style="padding:2px"><a onclick="xemtt('{idbh}')" style="cursor:pointer;color:#260FF7"  ><img src="images/Book_openHS.png" align="left" border="0" width="12" />&nbsp;{tintuc}</a></div><div style="clear:left"></div>
	<!-- END: block_tintuc --> 	
	</div>
	</fieldset>	
	</div>
</div>
</fieldset>


</div>

<div id="noidung" style="display:" >
 <fieldset >
	<legend>  
	<label class="maufiel" id="ngaybc" style="cursor:pointer" >Thông tin báo cáo ngày</label>
	 </legend>
	<div style="height:5px"></div>
	<div id="thongtincv" >
 	   <input type="hidden" name="luuok"  value="0"/>
    </div> 
 
	<div style="padding:10px"><div style="float:left">Tự đánh giá &nbsp;</div>
	  <div>
<textarea name="ghichu_bc"  id="ghichu_bc" class="inpl" style="width:560px;height:100px;overflow:auto;background-color:#eef2fb;"></textarea></div><div style="clear:left"></div>
    </div>
	
	<div > <br />
		    Điểm  đánh giá 
		      <input type="radio" name="danhgia" onclick="settypebc('1')" />
		      <img src="images/star_1.gif" width="66" height="13" />&nbsp;
<input type="radio" name="danhgia" onclick="settypebc('2')" />
<img src="images/star_2.gif" width="66" height="13" />&nbsp;
		 <input type="radio" name="danhgia" onclick="settypebc('3')" /><img src="images/star_3.gif" width="66" height="13" />&nbsp;
		 <input type="radio" name="danhgia" onclick="settypebc('4')"/><img src="images/star_4.gif" width="66" height="13" />&nbsp;
		 <input type="radio" name="danhgia" onclick="settypebc('5')" /><img src="images/star_5.gif" width="66" height="13" />&nbsp;
		 <input type="hidden" name="dachon" id="dachon" value=""/>
			  <br /><br />
              <input id="luubaocaocv" type="button" value="Lưu Đánh Giá" name="luu"     onclick="savebaocaocv(ngaybaocao.value,dachon.value,ghichu_bc.value)" style="width:100px" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			<input type="button" value="Đánh giá Kế Hoạch Hằng Ngày " name="luu"  onclick="bcsetmuc('3')" style="width:250px" />
    </div>
 	</fieldset>
 
 </div>
 
  <div id="ht_baihoc" style="display:none" > </div>
  
  <div id="ht_bctonghop" style="display:none" >	
       <div align="center" style="color:#FF00FF;padding:20px;font-size:16px"><br /><br /><br /><br /><strong> Chọn "Tuần" hoặc "Tháng" hay "Năm" để xem kế hoạch .</strong></div>
 </div>
 
 <div id="dgmuctieu" style="display:none" >	
    <fieldset >
	<legend> <a style="cursor:pointer"  > 
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt; " >Đánh Giá Kế Hoạch Hằng Ngày </label>
 	</a></legend>
 
	<div id="dgmuctieungay" style="padding-top:10px" >
		<div align="center"> Vui lòng chọn ngày đề tạo kế hoạch</div>
	  
	</div> 
	
	
	<br />
	
	
	<div id="ht_dgmts" >Kế Hoạch Hằng Ngày Lãnh Đạo</div>

    <div id="htmt"></div>
	
    </fieldset>
	 
 </div>
 
 <div id="muctieu" style="display:none" >	
    <fieldset >
	<legend> <a style="cursor:pointer"  > 
	<label class="maufiel" >Kế Hoạch Hằng Ngày  </label>
 	</a></legend>
	<div id="muctieungay" style="padding-top:10px">
 		<div align="center" style="color:#FF0000"> Vui  lòng chọn ngày !!! </div>
	  
	</div> <br />
	 
    <div id="htmt"></div>
	
<div id="HT_yeucau"  >
	<br />
	<div style="padding-top:5px">Các  Yêu Cầu Gởi Cho Ban Lãnh Đạo</div>		
 		 
	 
    </div> 	
	
	
    </fieldset>
 </div>
 
 <div style="clear:left"></div>
 
 
	<script type="text/javascript" src="templates/jquery.js"></script>
	<script type="text/javascript" src="templates/ajaxfileupload.js"></script>
  <script language=JavaScript src='templates/baocaocv.js'></script>

</div>
</form>
 
<div id="xong">
</div>
 
