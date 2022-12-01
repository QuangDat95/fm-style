

   var mangtv,bientam ;
   function xuly1()
   {
     //alert(ketqua);	
	   mangtv= ketqua.split('#*#');
	   if (mangtv['0']==0)  {document.getElementById("tenkhach").focus();  document.getElementById("idkhach").value=0 ;}
	   else
	   {
	   document.getElementById("idkhach").value=mangtv['1'] ;
	   document.getElementById("tenkhach").value=mangtv['2'] ;
	    document.getElementById("diachi").value=mangtv['3'] ;
		 document.getElementById("facebook").value=mangtv['4'] ;
		 {document.getElementById("tenkhach").focus(); }
		 
		 if(mangtv['6']>0) 
		 { var n = confirm('Người này đã có đơn trong vòng 3 ngày mã vận đơn:'+ mangtv['5']  + ' chọn hủy nếu vẫn muốn tạo phiếu !' );
				if(n == false)
				{
					return false;
 				}
			 document.getElementById("tel").focus();}	
		 }
		
	   }
     
function   chatcuahang(id)
   {
	   
   }
function ask()
{
	var n = confirm("Bạn có muốn xóa không");
	if(n == false)
	{
		return false;
			
	}
}  
   function setrong()
   {
      document.getElementById("ma").value = "" ;
	  document.getElementById("code").value = "" ;
	  document.getElementById("ten").value = "" ;
	  document.getElementById("nhom").value = "0" ;	  	  
   }   
  
 function kiemtra()
 {
	 if(document.getElementById("ship").value==''){alert("Vui lòng nhập số tiền ship"); document.getElementById("ship").focus();return false;}
	 if(document.getElementById("dachuyenkhoan").value=='') { alert("Vui lòng nhập số tiền đã chuyển khoản");document.getElementById("dachuyenkhoan").focus() ; return false;}
 }
 function kiemtrakhach(t)
 {
     
	 
 	 poststr="DATA="+  encodeURIComponent(t) +  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ; 
	 poststr += "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)  ; 
     loadtrang('khonghienthi', "onlinekiemtrakhach", poststr,"xuly1") ;
 }
   
 function setthongtin(t1,t2,t3)
 {
   
	  document.getElementById("masanpham").value = t2 ;
	   document.getElementById("giasanpham").value = t3 ; bientam="name_"+t1 ;
	    document.getElementById("tensanpham").value =   document.getElementById(bientam).innerHTML ;
		 document.getElementById("ghichusanpham").value ='';
 }
 
  function xemsanphamdangco(t)
 {
     
	 
 	 poststr="DATA="+  encodeURIComponent(t) +  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ; 
	 poststr += "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)  ; 
     loadtrang('divsanphamcon', "onlinekiemtraconhang", poststr,"xuly2") ;
 }

 function themvaodon (a,b,c,d) {
  if(c==''){alert("Vui lòng nhập ghi chú"); document.getElementById("ghichusanpham").focus() ;return false;}

   var src = document.getElementById('dathang') ;
   var src2 = document.getElementById('dathang2') ;
    var src3 = document.getElementById('dathang3') ;
  bientam=1 ;
   if(b=='') return;
  
 
  
	for(var i in src.options)
	{
	
		 if(src.options[i].value>0)
		{
		  	if(src.options[i].value==b) 
			{
				bientam=0 ;
			}
		}
	}
	
	 if(bientam==1)
	 { 
	 	src.options.add(new Option(b +' '+ c + ' '  + d,b));
	    src2.options.add(new Option(d,b));
		src3.options.add(new Option(a,b));
	    document.getElementById("masanpham").value = '' ;
	    document.getElementById("giasanpham").value = '' ; 
	    document.getElementById("tensanpham").value =  '' ;
		document.getElementById("ghichusanpham").value ='';
		document.getElementById("soluong").value ='1';
	 }
      tinhtien(src2,src3)
	
    selectAll('dathang','masp') ;
	 
}
 function tinhtien(t1,t2)
 {     var tt=0,c=0;;
	   for (var i = 0; i < t1.options.length; i++) { 
             t1.options[i].selected = true; 
			 c=t2.options[i].text;	c =c.replace(',','');	c =c.replace(',','');
			 tt= tt+1*(t1.options[i].text*c);
			 
        } 
		
		document.getElementById("tongbill").value=formatso(tt);
		  var s=document.getElementById("ship").value  ;
		  var c=document.getElementById("dachuyenkhoan").value ;
		
		s =s.replace(',','');s =s.replace(',','');c =c.replace(',','');	c =c.replace(',','');
	    document.getElementById("tongtien").value=tt*1+s*1+c*1;
  }
 
function chaymasp()
{ 
 
var k=0,b='' ;
	  var mangchay= document.getElementById("masp").value.split('&*!');
	  var src = document.getElementById('dathang');
	  var src2 = document.getElementById('dathang2');
	  var src3 = document.getElementById('dathang3');
	 for(var i in mangchay)
	 {   
		  if(mangchay[i]!='')
		  {  
			 if(k==1){
				src.options.add(new Option(mangchay[i],b));	 
				k=2 ;
			 } else  if(k==2){
				src2.options.add(new Option(mangchay[i],b));	 
				k=3 ;
			 }  else  if(k==3){
				src3.options.add(new Option(formatso(mangchay[i]),b));	 
				k=0 ;
			 } 
			 else
			 
			 {
				b=mangchay[i]; k=1;
			 }
			 
		  }
	}
	
}
function tongtienhang(s,t,c)
{
	s =s.replace(',','');s =s.replace(',','');	t =t.replace(',','');	t =t.replace(',','');c =c.replace(',','');	c =c.replace(',','');
	 document.getElementById("tongtien").value=formatso(s*1+t*1-c*1);
}

 


function selectAll(selectBox,oluu) { 
 var ch ='';
  var src2 = document.getElementById('dathang2');
   var src3 = document.getElementById('dathang3');
    // have we been passed an ID 
    if (typeof selectBox == "string") { 
        selectBox = document.getElementById(selectBox);
    } 
    // is the select box a multiple select box? 
    if (selectBox.type == "select-multiple") { 
        for (var i = 0; i < selectBox.options.length; i++) { 
             selectBox.options[i].selected = true; 
			 ch =ch+"&*!" + selectBox.options[i].value+"&*!"+selectBox.options[i].text+"&*!" +src2.options[i].text+"&*!" +src3.options[i].text;
        } 
    }
//	document.getElementById('luusl').value =sl ; 
	document.getElementById(oluu).value =ch ;
}
function tongtiensp(s,t)
{  
 var r;
  //  r=  document.getElementById("tongluu").value;

	s =s.replace(',','');s =s.replace(',','');	t =t.replace(',','');	t =t.replace(',',''); 
	r=(s*t ) ;
	 document.getElementById("tongbill").innerHTML=formatso(r);
}
function motrang(f)
{  
  window.open(f,'_blank');
}

function xoaspall() 
{
var trg = document.getElementById("dathang");
 	for(var i in trg.options)
	{
		 
		   trg.options.remove(i); 
		 
		
	}
//	coban= 0;
} 

 function xoasanpham(id) {
 
  var trg = document.getElementById("dathang");
   var trg2 = document.getElementById("dathang2");
    var trg3 = document.getElementById("dathang3"); 
 	for(var i in trg.options)
	{ 
		if(trg.options[i].value!='')
		{  
		  if (id==trg.options[i].value)  {trg.options.remove(i);trg2.options.remove(i);trg3.options.remove(i); tinhtien(trg2,trg3);return ;}
		}
		
	}
	  
} 