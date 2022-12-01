 
 window.onload=function(){
 document.body.onkeydown = function(e){
	 // alert(e.keyCode);	 
	  if (e.keyCode==27    )    {document.getElementById('themmoi').click();    return;    }
  
  };
}


var mangsp = new Array() ;
var mangph = new Array() ;
var mangsp1 = new Array() ;
var mangtam = new Array() ;
var dakhoa =false ;
var kiemtra50 =false ;

var x,khachduatien,tongsl,km ;
 km=0;
 //=======================================================
  function doinhac(n)
 {
	document.getElementById('nhac').src="images/tb"+n +".wav" ;
	document.getElementById('nhac').play();
	 }
function setlailuu(v)
{ 	
	
    document.getElementById('luu').disabled= "";
	document.getElementById('khoa').disabled= "";
	 
 } 
  
 function xuly1()
{
 document.getElementById("hiethithongbao").style.display = '' ;
}
 function goikhach()
{ 
  var t1 ;
   
   t1 = document.getElementById('idkh').value   ;
   if (t1==''||t1==1) return ;
    document.getElementById("hiethithongbao").style.display = '' ;
     poststr="DATA="+ encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
   loadtrang('hienthihoso',"thongtinkhachhangmua", poststr,"xuly1") ;

}
var phantramgiamgia=[];
var solancheck=0;
function kiemtrama(t1)
{ 
 
   if (t1=='') {km=0;document.getElementById('bot').value =0; return ;}
   poststr="DATA="+ encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
   loadtrang('ketqualuu',"xuatkhokhuyenmaitim", poststr,"xuly3") ;

}

function xuly3()
{
 	 tam=document.getElementById('ketqualuu').innerHTML
	
	  km =0;
	  var  n=tam.split("**#"); 
	  phantramgiamgia=n;
	
	  
	 
 	 if (n[1]=='-1') {alert('Không tìm thấy mã khuyến mãi này trong hệ thống !') ; document.getElementById('bot').value =0;}
	 else if (n[1]=='-2') {alert('Mã khuyến mãi này đã sử dụng vào ngày ' + n[2] ) ; document.getElementById('bot').value =0;}
	 else if (n[1]=='-3') {alert('Mã Số không hợp lệ. Mã số này chỉ được áp dụng tại ' + n[2] ) ; document.getElementById('bot').value =0;}
	 else 
	 {
		 if (n[1]>100) document.getElementById('bot').value =n[1] ;
		 else 
		 {  
			 if (n[2]>1)    alert(n[3]) ; else alert('mã thẻ này được giảm giá ' + n[1] + '% trên tổng hóa đơn !') ;
 		     document.getElementById('bot').value =0; 
		     km =n[1] ;  kiemtra50=false ;
 			 if(n[2]==1) {kiemtragiamgia50(2); km =0;  kiemtra50=false ; }
			 if(n[2]==2) { km =0;  kiemtra50=false ; } 
		 }
	 }
	 
}

function kiemtragiamgia50(loai=0){

	if (kiemtra50==false) return ; 
	//phantramgiamgia[1]=50;
	//phantramgiamgia[2]=1;
	var checkgiamgia=false;
	if(phantramgiamgia[1]){
		
		checkgiamgia=true;
	}else{
			
			return;	
	}
	if(phantramgiamgia[2]>0){
		 checkgiamgia= true;
	}
	else{
		return;	
	}
	
	if(checkgiamgia){
		
		tinhgiamgia(phantramgiamgia[1],phantramgiamgia[2]);
		if(loai=2){
				solancheck=1;
			xuatsp() ;
		
		}
	}
	else{
		return;	
	}
	
}
var macutam='';
function tinhgiamgia(tiengiamgia,dieukien)
{
 	//console.log(mangsp);
  	var a = new Array();
	var tam = mangsp ;
    var k=0;
 	for (x in tam)
	{  
 	    for (i=1;i<= tam[x][2];i++) 
		{   so=1*tam[x][3] ;
 		    
  		   		a.push([x,so]) ;  
				k++;
  			
 		}
	}
  //============ sap xep ====================================================	
   a.sort(sortFunction);
   function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}	 
	console.log(a);
  //=============tim vi tri set giam =======================================
  i=0; var j=0;    var macu=''; var mang = new Array(); var tongtiengiam =0; var tongtiengoc=0; k=0; var soluong=0; var giasp =0; 
  for (t in a)
  {
	   
		if(i==0){
			mang[j]= [a[t][0],km];
			if(macutam!='' && macutam!=mangsp[a[t][0]][0] && mangsp[macutam]){
				 if(mangsp[macutam][4]){
					mangsp[macutam][4]=0;
				 }
			}
			macutam=a[t][0];
			macu=mangsp[a[t][0]][0];
	   }
	   else{
		   if(macu!=mangsp[a[t][0]][0]){
			    mang[j]=[a[t][0],0]; 
		   }
		   	
		
	   }
	   j++;
	    i++ ;
 		
			   
  }
  
  //console.log(macutam);
 
  //==========================================================================
	  for (t in mang)
	  {
			// alert( mangsp[mang[t][0]][3]) 
			// (k-tongtiengiam)/k*100 
		   //  mangsp[mang[t][0]][4] =  mang[t][1] /   mangsp[mang[t][0]][2] ;
			 mangsp[mang[t][0]][4] =  mang[t][1] /   mangsp[mang[t][0]][2] ;
	  }
	//console.log(mangsp);
	//xuatsp() ;
}

function setchietkhau(ck)
{ 
	document.getElementById('chietkhau').value = ck ;
}

function setchietkhauchung(ck)
{
 
  var mt = new Array() ;
	if 	(ck!='')
	{
 		for (x in mangsp)
		{
		 		mt[x] =	mangsp[x] ;		
				mt[x][4] =	ck ;
 		}
	//	alert('112')
		mangsp = mt ;	
        xuatsp() ;
    }
} 


function xulychung()
{
 	 tam=document.getElementById('ketqualuu').innerHTML;
	 
	 //  alert(tam) ;
	 //return ;
	 var  n=tam.split("**#"); 
	 
     if (n[1]=="")  { alert('cố lỗi xảy ra hoặc đường truyền bị gián đoạn cần đăng nhập lại !'); return; }
	
	 if (n[1]=="8") { alert( n[2] );document.getElementById('luu').disabled= false;  return; }
	// document.getElementById('ketqualuu').innerHTML=""; 
	 document.getElementById('idgoi').value= n[1] ;	 
 	 if (n[2]!='')  document.getElementById('sochungtu').value =n[2];

	 var timet
	
	 document.getElementById('luu').value= "Cập Nhập";
     clearTimeout(timet);
	// document.getElementById('khoa').click() ;
	 dakhoa =true ;
//	 ;
	// timet=setTimeout( function daluuxong() { setlailuu('1') },900);
	
}

function xuly8()
{  tam =document.getElementById('ketqualuu').innerHTML ;
	var  n=tam.split("*tb#"); 
 	 alert(n[1]) ; 
	document.getElementById('ketqualuu').innerHTML= "" ;
}

function xuly5()
{
	 tam=document.getElementById('ketqualuu').innerHTML ;
	 var  n=tam.split("*loi#"); 
	 
      if (n[1]!="" && n.length>1 ) {alert(n[1]); return; }
	  
	document.getElementById('luu').disabled= false; 
	document.getElementById('khoa').disabled= false; 	
	document.getElementById('huyphieu').disabled= false; 	
	document.getElementById('inan').disabled= ""; 	
	document.getElementById('timk').click() ; 
}

function goiphuchoi(p,n)
{ 	
 sp = document.getElementById('idgoi').value  ;	
 if ( n.length <30 ){alert('Bạn chưa ghi chú cụ thể vui lòng ghi rỏ lý do phục hồi vào phần ghi chú ! ');return;}
 if (sp!=p) return ;
 var tt=0 ;
 var cf = " Bạn có chắc chắn muốn phục hồi phiếu này hay không ? " ;
 if(thongbao(cf) == true)
 {	 
 
  poststr="DATA="+   encodeURIComponent(sp)+  "*@!"+ encodeURIComponent("nx")+  "*@!"+ encodeURIComponent(tt)+  "*@!"+ encodeURIComponent(n);
  loadtrang('ketqualuu',"xuatkhophuchoi", poststr,"xuly5") ;		
  
 }
	 
 } 

function chuyenchuoithanhmang(chuoi){
	var result=[];
	var tam=chuoi.split("|@|");
	for(var i=0;i<tam.length;i++){
		var el=tam[i];
		var tam2=el.split("|*|");
		result.push(tam2.splice(1, tam2.length));
	}
  return result;
	
}
function phuchoibandau()
{  
   
  	mangsp=chuyenchuoithanhmang(localStorage.getItem("mangbd"));
    xuatsp() ;
}

function setmua3tang1()
{
	var tt= kiemtra50;  
    
	kiemtra50=false;
 
  // 	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp))); 
  	var a = new Array();
	var tam = mangsp ;
    var k=0;
	 
	for (x in tam)
	{  
 	    for (i=1;i<= tam[x][2];i++) 
		{   so=1*tam[x][3] ;
		    
		    if(tam[x][4]*1== 0 && so>=70000 )
			{
  		   		a.push([x,so]) ;  
				k++;
  			}
 		}
	}
  //============ sap xep ====================================================	
   a.sort(sortFunction);
   function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}	 
  //=============tim vi tri set giam =======================================
  i=0; var j=0;  var mang = new Array();
  for (t in a)
  {
	  i++ ;
	 
	   if(i==4) {mang[j]  =[a[t][0],100];i=0; j++;}
   }
  //==========================================================================
   for (t in mang)
   {
	    // alert( mangsp[mang[t][0]][2] + '  ' + mang[t][1] );
		 mangsp[mang[t][0]][4] =  mang[t][1] /   mangsp[mang[t][0]][2] ;
   }
  	  xuatsp() ;
  kiemtra50=tt;
}

//=================================================================================
function set12k()
{
   // 	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp))); 
  	var a = new Array();
	var tam = mangsp ;
    var k=0;
 	for (x in tam)
	{  
 	    for (i=1;i<= tam[x][2];i++) 
		{   so=1*tam[x][3] ;
 		    if(tam[x][9] == '12k')
			{
  		   		a.push([x,so]) ;  
				k++;
  			}
 		}
	}
  //============ sap xep ====================================================	
   a.sort(sortFunction);
   function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}	 
  //=============tim vi tri set giam =======================================
  i=0; var j=0;    var macu=''; var mang = new Array(); var tongtiengiam =0; var tongtiengoc=0; k=0; var soluong=0; var giasp =0; 
  for (t in a)
  {
	    i++ ; //k=Math.floor(mangsp[a[t][0]][2]/2) ; alert(k) ; 
 	  	if(macu!=mangsp[a[t][0]][0])  
		{ 	   soluong=1;  //alert('111')
			   macu= mangsp[a[t][0]][0];  
			   if(i==2) 
			   {   //    mang[j]=[a[t][0],((mangsp[a[t][0]][3]-12000)/mangsp[a[t][0]][3])*100];i=0; j++;   
	  				i=0; j++;  
				    tongtiengiam = 12000;   tongtiengoc= 0; 	
					 k =  (tongtiengoc-tongtiengiam)/tongtiengoc*100 ;	
					  mang[j]=[a[t][0],k];  
    			   } 
			   else
			   {    tongtiengiam =  0 ;    
			        tongtiengoc= mangsp[a[t][0]][3]*1; 	 ;   //k =  (tongtiengoc-tongtiengiam)/tongtiengoc*100 ; // alert(tongtiengiam +'='+ k) ;
			        	// alert(1*mangsp[a[t][0]][3])
  			   }
 		}
		else   
		{    soluong ++ ;
			   if(i==2) {   //    mang[j]=[a[t][0],((mangsp[a[t][0]][3]-12000)/mangsp[a[t][0]][3])*100];i=0; j++;   
	  				i=0;   
				   	tongtiengiam +=  12000 ;   // tongtiengoc += 1*mangsp[a[t][0]][3]  ;   
					  k =  (tongtiengoc-tongtiengiam)/tongtiengoc*100 ;	
					  mang[j]=[a[t][0],k];  
    			   } 
			   else
			   {
 				//	tongtiengiam +=  0 ;   
				
				 tongtiengoc += 1*mangsp[a[t][0]][3]  ;   
 				//	k =  (tongtiengoc-tongtiengiam)/tongtiengoc*100 ;
 			   }
  		}
 		 giasp =(1*tongtiengoc+1*tongtiengiam)/soluong  ;
 		 k= (1*mangsp[a[t][0]][3]-giasp)/ mangsp[a[t][0]][3] *100 ;
		 
		
		 // alert(tongtiengoc + "=" +tongtiengiam )
		 mang[j]= [a[t][0],k]
 		// alert(mang[j]);
		//  alert(tongtiengoc + "=" + tongtiengiam) ;   
				
	  
 	
			   
  }
    
       
  //==========================================================================
  for (t in mang)
  {
	    // alert( mangsp[mang[t][0]][3]) 
 		// (k-tongtiengiam)/k*100 
 	   //  mangsp[mang[t][0]][4] =  mang[t][1] /   mangsp[mang[t][0]][2] ;
	      mangsp[mang[t][0]][4] =  mang[t][1]  ; 
  }
  	  xuatsp() ;
  
}

//==========================================================================

 
function setmua2tang1()
{
  	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp))); 
  	var a = new Array();
	var tam = mangsp ;
    var k=0;
	for (x in tam)
	{  
 	    for (i=1;i<= tam[x][2];i++) 
		{   so=1*tam[x][3] ;
		    if(tam[x][4]*1== 0 && so>=70000 )
			{
  		   		a.push([x,so]) ;  
				k++;
  			}
 		}
	}
  //============ sap xep ====================================================	
   a.sort(sortFunction);
   function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}	 
  //=============tim vi tri set giam =======================================
  i=0; var j=0;  var mang = new Array();
  for (t in a)
  {
	  i++ ;
	 
	   if(i==3) {mang[j]  =[a[t][0],100];i=0; j++;}
   }
  //==========================================================================
   for (t in mang)
  {
	    // alert( mangsp[mang[t][0]][2] + '  ' + mang[t][1] );
		 mangsp[mang[t][0]][4] =  mang[t][1] /   mangsp[mang[t][0]][2] ;
   }
  	  xuatsp() ;
}
 
 
 function setmua2giam70()
{
  	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp))); 
  	var a = new Array();
	var tam = mangsp ;var macu=''; var tongck=0 ;
    var k=0;
	for (x in tam)
	{  
 	    for (i=1;i<= tam[x][2];i++) 
		{   so=1*tam[x][3] ;
		    
		    if(tam[x][4]*1== 0 && so>=70000 )
			{
  		   		a.push([x,so]) ;  
				k++;
  			}
 		}
	}
  //============ sap xep ====================================================	
   a.sort(sortFunction);
   function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}	 
  //=============tim vi tri set giam =======================================
  i=0; var j=0;  var mang = new Array();
  for (t in a)
  {
	  i++ ;
	 
	   if(i==3) {mang[j]  =[a[t][0],70];i=0; j++;}
   }
  //==========================================================================
   for (t in mang)
  {
	    if(  mangsp[mang[t][0]][0]==macu) {  tongck += mang[t][1] ; } else { tongck = mang[t][1] ;macu =  mangsp[mang[t][0]][0] ;  }
		 mangsp[mang[t][0]][4] =  mang[t][1] /   mangsp[mang[t][0]][2] ;
   }
  	  xuatsp() ;
}
function setkhuyenmai()
{ 
    
	//localStorage.setItem("mang1", JSON.stringify(mangsp)); // mang san pham dang hiển thị lưu lại
	//mangbd=mangthanhchuoi(mangsp);
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp))); 
	
 	var a = new Array();
	var tam = mangsp  ;var macu=''; var tongck=0 ;
    var k=0;
	for (x in tam)
	{  
 	    for (i=1;i<= tam[x][2];i++) 
		{   so=1*tam[x][3] ;
		    if(tam[x][4]*1== 0 && so>70000 )
			{
  		   		a.push([x,so]) ;  
				k++;
  			}
 		}
	}
  //============ sap xep ====================================================	
   a.sort(sortFunction);
   function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}	 
  //=============tim vi tri set giam =======================================
  i=0; var j=0;  var mang = new Array();
  for (t in a)
  {
	  i++ ;
	  if(i==2) mang[j]  =[a[t][0],30];
	  else if(i==3) mang[j]  =[a[t][0],50];
	  else if(i==4) {mang[j]  =[a[t][0],80];i=0; j++;}
   }
  //==========================================================================
   for (t in mang)
   { 
   	//  alert(  mangsp[mang[t][0]][0]  + '===' + macu ); 
	  if(  mangsp[mang[t][0]][0]==macu) {  tongck += mang[t][1] ; } else { tongck = mang[t][1] ;macu =  mangsp[mang[t][0]][0] ;  }
 		 mangsp[mang[t][0]][4] =  tongck /   mangsp[mang[t][0]][2] ;
   }
  
    
	  xuatsp() ;
}


function xoaphieux(sophieu)
{ 		
    var cf = " Bạn có chắc chắn muốn xóa phiếu "+sophieu+" này hay không ? " ;
 var n = confirm(cf);
 if(n == true)
	{
      poststr="DATA="+    encodeURIComponent(sophieu)+  "*@!"+ encodeURIComponent(sophieu)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
     loadtrang('ketqualuu',"xuatkhoxoa", poststr,"xuly8") ;
	}
}
function luuphieuxuat()
{ 
  if (document.getElementById('luu').disabled) return ;
  	
	if(document.getElementById('online').value=="0")
	{
		alert("Bạn chưa chọn nhân viên tư vấn"); 
		document.getElementById('online').focus() ;
		return ;
	}

    
	
   var cf = " Bạn có chắc chắn muốn tạo phiếu này hay không ? " ;
 if(thongbao(cf) == true)
 {	 
   var idluu,ngayxuatkho,sochungtu,xuatkho,tigia,lydo,khachhang,ghichu,tenkhachhang,tenlydo,idgoi,khachdua,qua,diem,ido,idch,phivcthukhach,phivcdvvc,IDtknh,tknh,chuyenkhoan,thanhtoan;
   sochungtu= document.getElementById('sochungtu').value ;
   tigia= document.getElementById('TiGia').value ;
   lydo= document.getElementById('lydo').value ;
    khachhang= document.getElementById('idkh').value ;
    ghichu = document.getElementById('note').value ; 
   vat = document.getElementById('VAT').value ; 
   ghichu = document.getElementById('note').value ; 
   khachdua = document.getElementById('khachdua').value ; 
   tienbot = document.getElementById('bot').value ; 
   qua = document.getElementById('chonnhanqua').checked ;
   diem = document.getElementById('diem').value ;
   makm = document.getElementById('makm').value ;
    ido= document.getElementById('online').value ;
   //  alert(idgoi)
   idgoi= document.getElementById('idgoi').value ; 
   idch= document.getElementById('cuahang').value ; 
   
   
   //them mới
    phivcthukhach= document.getElementById('phivcthukhach').value ; 
	phivcthukhach=phivcthukhach.replace(",","").replace(",","").replace(",","");
	  phivcdvvc= document.getElementById('phivcdvvc').value ; 
	  	phivcdvvc=phivcdvvc.replace(",","").replace(",","").replace(",","");
	    thanhtoan= document.getElementById('pttt').value ; 
		  IDtknh= document.getElementById('tknh').value ; 
		   sotknh= document.getElementById('tknh').options[document.getElementById('tknh').selectedIndex].text; 
		   sotknh=sotknh.split("-");
		   sotknh=sotknh[0];
		  chuyenkhoan= document.getElementById('sotienchuyen').value ; 
		  chuyenkhoan=chuyenkhoan.replace(",","").replace(",","").replace(",","");
   //console.log(chuyenkhoan);
  // return;
  	if(kiemtraphieu()==true)
 	{
		   if(lydo!=5) idch=0;

		 document.getElementById('luu').disabled= true;
	 	 poststr= "DATA="+idgoi+"*@!"+ encodeURIComponent(mangthanhchuoi(mangsp))+"*@!"  + encodeURIComponent(sochungtu) ; 
		 poststr += "*@!"+ encodeURIComponent(xuatkho)+  "*@!"+ encodeURIComponent(tienbot)+  "*@!"+ encodeURIComponent(lydo) ; 
		 poststr += "*@!"+ encodeURIComponent(ido)+  "*@!"+ encodeURIComponent(khachhang)+  "*@!"+ encodeURIComponent(ghichu) ; 
		 poststr += "*@!"+ encodeURIComponent(vat)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(tenkhachhang) ; 
		 poststr += "*@!"+ encodeURIComponent('diachi')+  "*@!"+ encodeURIComponent(0) +  "*@!"+ encodeURIComponent(khachdua); 
		 poststr += "*@!"+ encodeURIComponent(qua) +  "*@!"+ encodeURIComponent(diem)+"*@!"+ encodeURIComponent(makm)+"*@!"+ encodeURIComponent(idch)+"*@!"+ encodeURIComponent(0); 
		
		poststr += "*@!"+ encodeURIComponent(phivcthukhach) +  "*@!"+ encodeURIComponent(phivcdvvc)+"*@!"+ encodeURIComponent(thanhtoan)+"*@!"+ encodeURIComponent(IDtknh)+"*@!"+ encodeURIComponent(sotknh)+"*@!"+ encodeURIComponent(chuyenkhoan); 
   		 loadtrang('ketqualuu', "passdonluu", poststr,"xuly") ;
 	}
	return false;
 }
}
//=======================================================
  

 
function setsanpham(id,ten,ma,gia,dvt,giagia,baohanh,sl,mt,giagiam,giamgop) // baohanh => giachan
{   if (giagia<km) giagia =km;
 
  	document.getElementById('idsp').value= id; 
	document.getElementById('tensp').value= ten; 
	document.getElementById('masp').value= ma; 

	document.getElementById('dongia').value = gia;
  	document.getElementById('giachan').value = baohanh ;
 	document.getElementById('sl').value = sl; 	
	document.getElementById('soluong').value = 1;
	document.getElementById('sanpham').innerHTML = "" ; 
	document.getElementById('soluong').select() ; 
	document.getElementById('chietkhau').value = giagia;
	
     document.getElementById('mt').value= mt; 
	document.getElementById('giagiam').value = giagiam;
	document.getElementById('ghichu').value = giamgop;
	
	document.getElementById('chietkhauc').value = giagia;
	document.getElementById('giamgop').value = giamgop;
	document.getElementById('codeprotk').select() ;
}  
 
function timtheomacode(v)
{ 	
	v= document.getElementById('codeprotk').value ;
    poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
    loadtrang('khonghienthi', "xuattimtheoma", poststr,"xuly9") ;
} 

function layvesoluong(macode)
{ 
 	for (x in mangsp)
	{  
	  if ( mangsp[x][0]==macode ) return  mangsp[x][2] ;
 	}
	return  0 ;
}


function thaydoisoluong(macode,soluong)
{ 
 	for (x in mangsp)
	{  
	    if ( mangsp[x][0]==macode )    mangsp[x][2] =soluong  ;
 	}
	xuatsp() ;
	 
}



function xuly9()
{ 

  var tam =  document.getElementById('khonghienthi').innerHTML ;  
  //alert(tam)
  var  n=tam.split("##"); 
 
  
   if (n[1]=="") return;
   n[8] = 1+ parseFloat(layvesoluong(n[3])) ;
   thaydoisoluong( n[3],n[8]) ;
   //  document.getElementById("sound_element").innerHTML= "<embed src='images/ding.wav' hidden=true autostart=true loop=false>"; 
	 document.getElementById('nhac').play();
   //alert(n[6])
   var dg =n[4] ;
   dg =dg.replace(',',''); 	dg =dg.replace(',','');
   var giagiam=Math.round(parseFloat(dg) -   parseFloat(dg) * n[6]/100);
    setsanpham(n[1],n[2],n[3],n[4],n[5],n[6],n[9],n[8],n[11],giagiam,n[13]);
    document.getElementById('soluong').value = n[8];
    document.getElementById('codeprotk').value ='';
   
   if (n[8]==1)   document.getElementById('add').click();
   
    
 }
var timer;
  function  goisp(v)
  {
     clearTimeout(timer);
   timer=setTimeout( function validate() { timtheomacode(v) },500);
  }
 
 
function xuly2()
{
 	 document.getElementById('search2').click();	 
	 
}

 function khachhangtimtheomacode(v)
{ 	
	  document.getElementById('search2').click();	 
  //  poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
  //  loadtrang('khonghienthi', "khachhangtimtheoma", poststr,"xuly2") ;
} 
  
  function  goikh(v)
  {
	 if(v.length!=10 ) return ;
     clearTimeout(timer);
     timer=setTimeout( function validate() { khachhangtimtheomacode(v) },500);
  }


 function  timdiachicc(id)
 {
    poststr="DATA="+    encodeURIComponent(id)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
   loadtrang('diachicc', "timdiachicc", poststr,"") ;
 }
 


function timbaogiachuyen(t1)
{
	baogiachuyen(t1) ;
	timphieu() ;
}
 
 
function xuly6()
{
	//alert(ketqua)
 	 tam=document.getElementById('ketqualuu').innerHTML ;
	 var  n=tam.split("*loi#"); 
     if (n[1]!="" && n.length>1 ) {alert(n[1]); return; }
	document.getElementById('luu').disabled= true; 
	document.getElementById('khoa').disabled= true; 	
	document.getElementById('huyphieu').disabled= true; 	
	document.getElementById('inan').disabled= ""; 	
	document.getElementById('timk').click() ; 
	goiin() ;
}

function khoaphieu()
{var tt=0 ;
  
 var cf = " Bạn có chắc chắn muốn khóa phiếu này hay không ? " ;
 if (dakhoa==true)
 {
	 sp = document.getElementById('idgoi').value  ;
	 poststr="DATA="+   encodeURIComponent(sp)+  "*@!"+ encodeURIComponent("nx")+  "*@!"+ encodeURIComponent(tt)+  "*@!"+ encodeURIComponent(document.getElementById('chonnhanqua').checked);
     loadtrang('ketqualuu',"xuatkhokhoaphieu", poststr,"xuly6") ;	 
	 dakhoa =false ;
 }else
 
 if(thongbao(cf) == true)
 {	 
   sp = document.getElementById('idgoi').value  ;
   poststr="DATA="+   encodeURIComponent(sp)+  "*@!"+ encodeURIComponent("nx")+  "*@!"+ encodeURIComponent(tt)+  "*@!"+ encodeURIComponent(0);
   loadtrang('ketqualuu',"xuatkhokhoaphieu", poststr,"xuly6") ;		
   dakhoa =false ;
  }
}


function timkiemncc(t1,t2,t3,t4,t5)
{ 
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
  loadtrang('hienthinhacc', "xuattimkh", poststr,"") ;
  
}
 
 function kiemtraid(tenselec,id)
 { var t =0 ;
   var a ;
	for (x in tenselec.options)
	{
	  a= tenselec.options[x].value ;
	//  alert(x);
   	  if ( laso(a) == laso(id)) return id ;
  	  
	}
	return "" ;
 }


function  xuly7()
{
 document.getElementById('themmoi').click();		
}
function  goihuyphieu(t1,t2)
{
 var cf = " Bạn có chắc chắn muốn hủy phiếu này hay không ? " ;
 var n = confirm(cf);
 if(n == true)
	{
      poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
     loadtrang('ketqualuu',"banhanghuyphieu", poststr,"xuly7") ;
	}
	
 }


 

function xuattimsanpham(t1,t2,t3,t4,t5,t6){
	
  poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr = poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6);
  loadtrang('sanpham', "xuatkhotimsp", poststr,"") ;
  
 } 
 
function setkh(t1,t2,t3,t4,t5,t6)
{
		document.getElementById('tenkh').innerHTML = t2
		document.getElementById('dckh').innerHTML = t3
		document.getElementById('idkh').value = t1
		km=t6;
		document.getElementById('tt').innerHTML = t4 + " CK: " + t6 + "%"
		if (t5!='')
		{
			document.getElementById('nhanqua').style.display = '' ;
			t6=t4.lastIndexOf('-');
			document.getElementById('diem').value =t4.substring(t6+1) ;
		}
		else
		{
		//	document.getElementById('nhanqua').style.display = 'none' ;
		 	document.getElementById('diem').value = 0 ;
		}
		
		document.getElementById('hienthongbao').style.display = "none";
		
	    goidong()
}
  var tinh='';
		var thanhpho='';
		
function xulygoi()
{ 
 	if (document.getElementById('taomoikhach').value=='1')
	{
 	     $(document).ready(function() {
	      $('.js-tinh').select2();  	
		  $('.js-quan').select2();
			$('.js-phuong').select2();
		  $('.js-tinh').on('select2:selecting', function(e) {
				 document.getElementById('henthiloading').style.display="inline-block";						 
				   //console.log('Selecting: ' , e.params.args.data);
				   tinh=e.params.args.data.id;
					var poststr = "TINH=" + encodeURIComponent(e.params.args.data.id) + "*@!";
					
					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xulyquan");
			});
					
			$('.js-quan').on('select2:selecting', function(e) {
			document.getElementById('henthiloading').style.display="inline-block";
  					var poststr = "THANH=" + encodeURIComponent(tinh) + "*@!"+ encodeURIComponent(e.params.args.data.id);		
					
					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xulyphuong");
			});
		});
		  
	   
	}
}
 			
	function xulyquan() {
			  
			var tam = document.getElementById('khonghienthi').innerHTML;
			var quan=document.getElementById("quan");
			
			if(tam!="")
			{
			
			quan.innerHTML=tam;
			quan.disabled=false;
				document.getElementById('henthiloading').style.display="none";
			}
			
		
		}
		
 function xulyphuong() 
 {
			 
			var tam = document.getElementById('khonghienthi').innerHTML;
			var phuong=document.getElementById("phuong");
			
			if(tam!="")
			{
			
			phuong.innerHTML=tam;
			phuong.disabled=false;
			document.getElementById('henthiloading').style.display="none";
				
			}
			
		
 }	  

//mới
function checkchangevalue(){
	document.getElementById("btnUpdate").style.display="inline-block";
	
}

//thong tin set
var t7tam,t8tam,t9tam,t10tam,t11tam,t12tam;
function updatethongtinkhach(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11,t12){
	t7tam=t7;t8tam=t8;t9tam=t9;t10tam=t10;t11tam=t11;t12tam=t12;
	 poststr="UPDATEKH="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4)+"*@!"+ encodeURIComponent(t5)+"*@!"+ encodeURIComponent(t6);
	  loadtrang('henthiupdate', "passdontimkhachhang", poststr,"xuly10") ;
}

function xuly10(){
	var tam =document.getElementById("henthiupdate").innerHTML;
	if(tam){
		console.log(tam);
		tam=tam.split("###");
		if(tam[1]==1){
			setkh(t7tam,t8tam,t9tam,t10tam,t11tam,t12tam);
		}
		else{
			alert("có lỗi xảy ra vui lòng thử lại!");
		}
	}else{
			alert("có lỗi xảy ra vui lòng thử lại!");
		}
	
}
function timkiemkh(t1,t2,t3,t4,t5,t6,t7,t8)
{ 	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8);
    loadtrang('hienthikh', "passdontimkhachhang", poststr,"xulygoi") ;
	//alert('Luu xong !!!');
} 


function timsanpham(t1,t2,t3,t4,t5,t6,t7){
	
  poststr="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7);
  loadtrang('sanpham', "xuatkhotimsp", poststr,"") ;
  
 } 
 

//=======================================================
function xuatsetkhachhang(id)
 {
  poststr="DATA="+    encodeURIComponent(id)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
  loadtrang('tenkhachhang', "xuattimkhachhang", poststr,"") ;
 }
function setkhachhang(id)
 {
  poststr="DATA="+    encodeURIComponent(id)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
  loadtrang('tenkhachhang', "timkhachhang", poststr,"") ;
 }
 

function setnhacungcap(loai,id,diachi)
 {
	 
	document.getElementById('khachhang').value= id;
	 
 	document.getElementById('timkhachhang').style.display = "none";
	document.getElementById('codechinh').style.display = "";
	document.getElementById('note').focus() ;

 }
var idxe= '' ;

 

 
//=======================================================
 
function clearchon() 
 {
 
	document.getElementById('NameTK').value= '' ;		
	document.getElementById('codeprotk').value= '' ;		
	document.getElementById('code').value= '' ;		
	document.getElementById('IDGrouptk').value = '0' ;		
 	document.getElementById('sanpham').innerHTML = document.getElementById('luutimsp').innerHTML ;
 }
function kiemtraphieu()
{ 
    if(document.getElementById('makm').value!='' && document.getElementById('idkh').value==1) {alert('Bạn phải chọn khách hàng khi dùng mã khuyến mãi !');timkhachhang(); return false ;}
 	if(document.getElementById('lydo').value==0)
	{
		alert('Xin vui lòng chọn ly lo!');
		document.getElementById('lydo').focus();
		return false;
	}
   if(document.getElementById('lydo').value==5 && document.getElementById('cuahang').value==0) { alert('Bạn chưa chọn cửa hàng') ;return false ;}
      
	
	if(document.getElementById('idkh').value==0)
	{
		alert('Xin vui lòng chọn khách hàng!');
		document.getElementById('khachhang').focus();
		return false;
	}
  	if(mangsp.length==0)
	{
		alert('Xin vui lòng chọn sản phẩm đã bán!');
		document.getElementById('codeprotk').focus();
		return false;
	} 	
	return true;
}


function timkhachhang()
{
	if (document.getElementById('hienthongbao').style.display =="")
	{
	document.getElementById('hienthongbao').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '' ;	
	document.getElementById('timphieuxuat').style.display = 'none' ;
	
	 
	}else
	{
	document.getElementById('hienthongbao').style.display = "";
	 	document.getElementById('timkhachhanght').style.display = '' ;	
	document.getElementById('timphieuxuat').style.display = 'none' ;
	document.getElementById('ma').focus() ; 
	}
	
	
}

function timkiemnhacc()
{
	if (document.getElementById('timkhachhang').style.display =="")
	{
	document.getElementById('timkhachhang').style.display = "none";
	document.getElementById('codechinh').style.display = "";
	}else
	{
	document.getElementById('timkhachhang').style.display = "";
	document.getElementById('codechinh').style.display = "none";	}
 	
}
 
//=======================================================

//===============================================
 

function timtrongbaogia(t0,t1,t2,t3,t4,t5,t6)
{
 
  poststr="DATA="+encodeURIComponent(t0)+"*@!"+encodeURIComponent(t1)+"*@!"+ encodeURIComponent(t2)+"*@!"+ encodeURIComponent(t3)+"*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(0);
  loadtrang('httimxuatb', "xuattimbaogia", poststr,"") ;	
  
	
} 
 
function timdsphieuxuat(t0,t1,t2,t3,t4,t5,t6,t7,t8)
{
  poststr="DATA="+encodeURIComponent(t0)+"*@!"+encodeURIComponent(t1)+"*@!"+ encodeURIComponent(t2)+"*@!"+ encodeURIComponent(t3)+"*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+"*@!"+ encodeURIComponent(t6)+"*@!"+ encodeURIComponent(t7)+"*@!"+ encodeURIComponent(t8);
  loadtrang('httimxuat', "passdontim", poststr,"") ;	
}

 

function xuly4()
{
	// alert( ketqua)
   var ma = ketqua.split('&$&');
   var m = ma[0].split('@$@');
  // alert( m[29])
  //0     1   2       3       4     5    6    7         8      9    10    11   12    13       14     15      16   17   18     19     20      21   22      23   24
 console.log(m);//ID,IDKho,IDNhaCC,IDNhap,NgayNh,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,soxe

 //alert(m[5] )
   document.getElementById('sochungtu').value = m[5];  
   document.getElementById('kho').value = m[8];
    document.getElementById('bot').value = m[10];
   document.getElementById('lydo').value = m[6];
 
   document.getElementById('idkh').value = m[2];
   document.getElementById('dckh').innerHTML = m[18];
   document.getElementById('tenkh').innerHTML = m[17];
   document.getElementById('idgoi').value = m[0] ;
    document.getElementById('note').value = m[12]; 
	document.getElementById('khachdua').value = m[29]; 
	 document.getElementById('ngaynhap').value = m[31]; 
	  document.getElementById('textarea').value = m[19]; 
	  document.getElementById('makm').value = m[15]; 
	   document.getElementById('online').value = m[22]; 
	   document.getElementById('cuahang').value = m[30]; 
	    document.getElementById('phivcthukhach').value = m[32]; 
		 document.getElementById('pttt').value = m[33]; 
		  document.getElementById('sotienchuyen').value = m[34]; 
		   document.getElementById('tknh').value = m[35]; 
		   if(m[33]){
			   	checkpttt(m[33]);
		   }
	 //   document.getElementById('idcuahang').value = m[32]; 
	   if(m[6]==5)    document.getElementById('cuahangdiv').style.display =''; 
	   $('.js-nv').select2();
	    $('.js-ch').select2();
		   $('.js-nvht').select2();
	 
  // document.getElementById('VAT').value = m[11]; 
    var msp =  ma[1].split('@$&');
   var mang = new Array() ;
   var mgt =  new Array() ;
   	mangsp = mang ;
	for (x in msp) 
	{ // alert(msp[x]);
	    mgt = msp[x].split('@$@') ;
		                      //  (code, ten,    soluong,d ongia, thue,loaitien,ghichu,  mt,    giagiam);     9  
		mangsp[mgt[2]] = new Array(mgt[3],mgt[7],(mgt[4]),mgt[5],mgt[12],mgt[6],mgt[10],mgt[13],mgt[14]);	
	//	mangsp[mgt[2]] = new Array(mgt[3],mgt[7],Math.abs(mgt[4]),mgt[5],mgt[12],mgt[6],mgt[10]);	
		
		//                   Array(code  ,ten   ,soluong, dongia , chietkhau ,loaitien,ghichu);	  
	}
	xuatsp() ;
	timphieu() ;
 }
 
function setlaiphieuxuat(t1,t2)
{
	  poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	  loadtrang('khonghienthi', "passdongoi", poststr,"xuly4") ;		
	
 	  poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	 
 //	  loadtrang('httimlai', "xuatkhoht", poststr,"") ;		
 	 if (t2 == "0")
		{	
		document.getElementById('luu').disabled= false;	
		document.getElementById('khoa').disabled= false;	
		document.getElementById('copy').disabled= false;
			document.getElementById('huyphieu').disabled= false; 	
		}
		else
		{	
		document.getElementById('luu').disabled= true; 
		document.getElementById('khoa').disabled= true; 
		document.getElementById('copy').disabled= false; 
		document.getElementById('huyphieu').disabled= true; 	
		}	
	 document.getElementById('inan').disabled= ""; 
}

function themnhacc(t1,t2,t3,t4)
{
 	var st ;
	st = "default.php?act=nhacungcap&id=-1&t1=" + t1 + '&t2=' + t2 + '&t3=' +t3 + '&t4=' +t4  ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no') ;

}

function themkhachhang(t1,t2,t3,t4,t5)
{
 	var st ;
	st = "default.php?act=customer&id=-1&t1=" + t1 + '&t2=' + t2 + '&t3=' +t3 + '&t4=' +t4  + '&t5=' + t5 ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no') ;
}

  function xemthe(id,xuatxuat,kho,tu,den)
   {
 	var st ;
	st = "thekhoxem.php?t1=" +id + "&t2=" + xuatxuat + '&t3=' + kho + '&t4=' +tu + '&t5=' +den  ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no') ;
     }
 

function timphieu()
{
 
	
    if (document.getElementById('hienthongbao').style.display =="")
	{
		document.getElementById('hienthongbao').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '' ;	
		document.getElementById('timphieuxuat').style.display = 'none' ;	
 	}else
	{
		document.getElementById('hienthongbao').style.display = "";
		document.getElementById('timkhachhanght').style.display = 'none' ;	
		document.getElementById('timphieuxuat').style.display = '' ;	
	}
	
}
function thempt(t1,t2,t3,t4)
{ 		
	var sobaogia = document.getElementById('sochungtu').value ;
	var st ;
	st = "default.php?act=product&id=-1&t1=" + t1 + '&t2=' + t2 + '&t3=' + t3+ '&t4=' + t4 ;
	window.open(st, 'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;
}

function taomoi()
{
	document.forms['frmxuat'].reset() ; 
	document.getElementById('sanphamxuat').innerHTML = document.getElementById('luubd').innerHTML ; 
	document.getElementById('luu').disabled= '';	
	document.getElementById('khoa').disabled= true ;	
}

 
 function xulyluukhachmoi() {
	 var mang = ketqua.split('###');
	    document.getElementById('idkh').value = mang[2] ;
     	document.getElementById('tenkh').innerHTML = mang[3] ;
		document.getElementById('dckh').innerHTML =mang[4] ;
		
		km=0;
		document.getElementById('tt').innerHTML = '';
 		document.getElementById('diem').value = 0 ;
 		document.getElementById('hienthongbao').style.display = "none";
 	    goidong()
 	
}


function luuthongtinkhach(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10)
{ 	 // ngaysinh.value,xungho.value,address.value,tinhthanh.value,quan.value,phuong.value,notem.value
t2=trim(t2);
  if(t1=='') { alert('Bạn chưa chọn nhóm khách hàng'); document.getElementById('khonghienthi').focus();return; }
  if(t2.length<10||t2.length>10) { alert('kiểm tra lại số điện thoại khách hàng'); document.getElementById('telm').focus();return; }
  if(t3=='') { alert('Bạn chưa nhập tên khách hàng'); document.getElementById('Namem').focus(); return; }
  if(t4=='') { alert('Bạn chưa nhập ngày sinh khách hàng'); document.getElementById('ngaysinh').focus();return; }
  if(t5=='') { alert('Bạn chưa chọn xưng hô khách hàng'); document.getElementById('xungho').focus();return; }
  if(t6=='') { alert('Bạn chưa nhập địa chỉ khách hàng'); document.getElementById('address').focus();return; }
  if(t7=='0') { alert('Bạn chưa chọn tỉnh khách hàng'); document.getElementById('tinhthanh').focus();return; }
  if(t8=='0') { alert('Bạn chưa chọn quận khách hàng'); document.getElementById('quan').focus();return; }
  if(t9=='0') { alert('Bạn chưa chọn phường khách hàng'); document.getElementById('phuong').focus();return; }
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4)+  "*@!"+ encodeURIComponent(t5);
    poststr= poststr +"*@!"+ encodeURIComponent(t6)+"*@!"+ encodeURIComponent(t7)+"*@!"+ encodeURIComponent(t8)+"*@!"+ encodeURIComponent(t9)+"*@!"+ encodeURIComponent(t10);
    loadtrang('hienthikh', "khachhangtaomoi", poststr,"xulyluukhachmoi") ;
	//alert('Luu xong !!!');
} 

 
  

function setnguoc(id,ten,ma,sl,gia,lt,chietkhau,note)
{ 
	document.getElementById('idsp').value= id; 
	document.getElementById('ten').value= ten; 
	document.getElementById('ma').value= ma; 
	
	document.getElementById('tensp').value= ten; 
	document.getElementById('masp').value= ma; 
	
	document.getElementById('soluong').value= txtFormatj(sl); 
	document.getElementById('dongia').value= txtFormatj(gia); 
//	document.getElementById('giamgia').value= '0'; 
	document.getElementById('loaitien').value= lt; 
 	document.getElementById('chietkhau').value= chietkhau; 
 	document.getElementById('ghichu').value= note;  
	
	document.getElementById('dongia').focus(); 
}

 //===================================================================================== 
function kiemtrachuyen(idsp)
{ 
	if (idsp == '')
	{
		alert('Bạn chưa chọn sản phẩm !!!')
		document.getElementById('ten').focus() ; 
		return false;
	}
	if (document.getElementById('dongia').value == '')
	{
		alert('Bạn chưa nhập đơn giá!!!');	
		document.getElementById('dongia').focus() ; 
		return false;
	}
	return true;
}

function copymang(mangvao,mangra)
{
	for (x in mangvao)
	{
		mangra[x] =	mangvao[x] ;
	}
}

 
 


function sapnguoc()
{  
    var x,t,tam = new Array() ;
    var tam2 = new Array() ;    	
	 
	copymang(mangsp,tam) ;

	 
	var index = tam.indexOf(element) ;
	while (index != -1)
	{
	  tam1.push(index);
	  index = array.indexOf(element, ++index);
	  alert(index);
	}	

//for (x in mangsp)
//	{
//		t =tam.length-1 ;
//		alert(t)
//		tam2 = tam.pop() ;
//		t =tam.length-1 ;
//		alert(t)
		
		//alert(tam2[0]+'---'+tam2[1]+'---'+tam2[2]);
//	}
	//mangsp = tam ;
 }
 
 
function goidongthe()
{
    document.getElementById("hiethithongbao").style.display = 'none' ;
}

function capxuatgia(idsp,dongia)
{
  poststr="DATA="+encodeURIComponent(idsp)+"*@!"+encodeURIComponent(dongia)+"*@!"+ encodeURIComponent(0)+"*@!"+ encodeURIComponent(0)+"*@!"+ encodeURIComponent(0);
   loadtrang('ketqualuu', "capxuatgia", poststr,"") ;			
}
 
function addpro(idsp,ten,code,dongia,loaitien,soluong,chietkhau,ghichu,giachan,mt,giagiam,giamgop){ 

 var dg =dongia ;
	dg =dg.replace(',','');
	dg =dg.replace(',','');
	dongia=dg ;
    var dongia2= document.getElementById('dongia2').value ;
	dongia2 =dongia2.replace(',','');
	dongia2 =dongia2.replace(',','');
	if(dongia2*1>dg*1) dongia=dongia2 ;
	 
 if(chietkhau>0  && (dongia*1<70000)) { alert('Mã này giá nhỏ hơn 70.000 không được chiết khấu !!!');}
 
 
if(chietkhau>0  && (code[code.length-1] =='Z'||code[code.length-1] =='z')) { alert('Mã Z này khuyến cáo không được chiết khấu !!!');}
	if 	(idsp == '')
	{
      alert('Bạn Chưa chọn hàng hóa!!!');document.getElementById('NameTK').focus(); return;	
	}

	// if (chietkhau<km) chietkhau =km ;
	 
	if (laso(giachan)>  ( parseFloat(dg) -   parseFloat(dg) * chietkhau/100 )  )
	{	
  	//  alert('Giảm giá không được vượt '+ txtFormatj(giachan)+' !!!');document.getElementById('chietkhau').focus(); return false;	
	}
	if (laso(dongia) == 0 && code!='giamgia')
	{
		 var cf = "Bạn chưa nhập đơn giá!!! \n\nBạn có muốn nhập hay không ?" ;
		var n = confirm(cf);
		if(n == true)
 		{
			document.getElementById('dongia').focus() ; 
			return false;	
	    }	
	}
	
	if( document.getElementById('ol').value==0) 
	{
	
		if(code=='giamgia' && dongia==0) 
		{  
			document.getElementById('dongia').readOnly= false ;  soluong="1" ;
			document.getElementById('dongia').focus() ; 
			return ;
		} else   { document.getElementById('dongia').readOnly= true ; }
		
	}
	  
	if 	(trim(soluong) == '' || laso(soluong) == 0)
	{
      alert('Bạn chưa nhập số lượng!!!');document.getElementById('soluong').focus(); return;	
	}
	
	if 	(  laso(soluong) < 0)
	{
      alert('Bạn không được nhập số Âm !!!');document.getElementById('soluong').focus(); return;	
	}
	//alert(document.getElementById('sl').value > soluong);
	var sl = laso(document.getElementById('sl').value) ;
	 
	//alert(sl < soluong) ;
//	if(document.getElementById('tenform').innerHTML== "xuatkho" && parseFloat(sl) < parseFloat(soluong) )
//	{
//		alert('Trong kho chỉ còn "' + sl + '" sản phẩm, vui lòng nhập thêm vào kho hoặc xuất ít hơn ' + sl +  ' !!!');
//		document.getElementById('soluong').focus() ;
//		document.getElementById('soluong').select() ;
//		return ;
//	}
 
	
 	  var giagiam=Math.round(parseFloat(dg) -   parseFloat(dg) * chietkhau/100);
	  
	  if(code=='giamgia' && 1*dg>0) 	{    dongia =-1*( (dg)); }
	  
	  
       mangsp[idsp] = new Array(code,ten,soluong,dongia,chietkhau,loaitien,ghichu,mt,giagiam,giamgop);	   
	   document.getElementById('codeprotk').value='' ;
  	 	
	 xuatsp() ;
	   document.getElementById('nhac').play();
//	if(document.getElementById('tenform').innerHTML== "xuatkho" )	{ capxuatgia(idsp,dongia) ;}  
	document.getElementById('codeprotk').select() ;
	//tinhgiamgia(50,1)
} 


function xoapt(id)
{ 
   
  var mt = new Array() ;
	if 	(id!= '')
	{
		for (x in mangsp)
		{
			if (x != id)
			{				
				mt[x] =	mangsp[x] ;
			}
		}
		mangsp = mt ;	
        xuatsp() ;
    }
	document.getElementById('idsp').value=''; 
	document.getElementById('masp').value=''; 
	document.getElementById('tensp').value=''; 	
	document.getElementById('soluong').value=''; 
	document.getElementById('dongia').value=''; 
 	document.getElementById('chietkhau').value=''; 
	document.getElementById('loaitien').value='';  
  	document.getElementById('ghichu').value='';
	document.getElementById('mt').value='';  
	document.getElementById('giagiam').value='';  
	document.getElementById('giamgop').value='';  
} 

function setthongtin(id)
{
	 
 	document.getElementById('idsp').value= id; 
	document.getElementById('masp').value= mangsp[id][0]; 
	document.getElementById('tensp').value= mangsp[id][1];  	
	document.getElementById('soluong').value= mangsp[id][2]; 
	document.getElementById('dongia').value= mangsp[id][3]; 
 	document.getElementById('chietkhau').value= mangsp[id][4];
	document.getElementById('loaitien').value= mangsp[id][5]; 
  	document.getElementById('ghichu').value= mangsp[id][6]; 
	document.getElementById('mt').value= mangsp[id][7]; 
	document.getElementById('giagiam').value= mangsp[id][8]; 
	document.getElementById('giamgop').value= mangsp[id][9]; 
	if( document.getElementById('ol').value==0) 
	{
		if(mangsp[id][0]=="giamgia")  document.getElementById('dongia').readOnly=false; else document.getElementById('dongia').readOnly=true;
	}
  	document.getElementById('dongia').focus(); 
	

}
 
function xuatsp()
{   
	if(solancheck==0){
		kiemtragiamgia50();
	}else{
		solancheck=0;	
	}
	var x,stt,tam,lon1,lon2,lon3,dagiam,solangiam,str ="" ,manho='';	stt= 0 ; lon1=0,lon2=0;lon3=0; chuagiam=true;
	var thanhtien,tong ,dem=0 ;gianho=10000000 ;
	  tienbot= document.getElementById('bot').value ;
	  tienbot =tienbot.replace(',','');tienbot =tienbot.replace(',','');tienbot =tienbot.replace(',','');
     var mt = new Array() ;
	//=============================kiem tra mua 3 giam 92== va tim sp nho nhat====================== (code,ten,soluong,dongia,chietkhau,loaitien,ghichu,mt,giagiam);
	if(tienbot==0&&document.getElementById('ol').value=='0'&& 1==2 )
	{
		 
		for (x in mangsp)
		{  
			  if(mangsp[x][3]==txtFormatj(mangsp[x][8])) 
			  { 	
			  		dem=dem+1*mangsp[x][2];    
					//if( gianho>1*mangsp[x][8]) {gianho =1*mangsp[x][8] ;   } 
					
					if(lon3<1*mangsp[x][8]) lon3 =1*mangsp[x][8] ;
					if(lon2<lon3){ tam=lon2 ; lon2 =lon3 ; lon3=tam ;}
 					if(lon1<lon2){ tam=lon1 ; lon1 =lon2 ; lon2=tam ;}
				 
					 
			  } 
			  
  		}
		
		
		
		
		for (x in mangsp)
		{  
			  if(mangsp[x][3]==txtFormatj(mangsp[x][8])) 
			  { 	
			  		dem=dem+1*mangsp[x][2];    
					//if( gianho>1*mangsp[x][8]) {gianho =1*mangsp[x][8] ;   } 
					
					if(lon3<1*mangsp[x][8]) lon3 =1*mangsp[x][8] ;
					if(lon2<lon3){ tam=lon2 ; lon2 =lon3 ; lon3=tam ;}
 					if(lon1<lon2){ tam=lon1 ; lon1 =lon2 ; lon2=tam ;}
				 
					 
			  } 
			  
  		}
		solangiam= Math.floor(dem/3);
		if(dem>=3)
		{ 
		if(lon2==0) lon2 = lon1; if(lon3==0) lon3 = lon2;
		
			for (x in mangsp)
			{  
			//   alert(lon3+ '='+ lon2 +'='+ lon1)
			   if(1*mangsp[x][8]==lon3&&chuagiam) 
			   { 
 				     mangsp[x][4]=Math.round(1000*92/ mangsp[x][2])/1000;
 				 	chuagiam=false;
				} else if(mangsp[x][3]==txtFormatj(mangsp[x][8]) && mangsp[x][4]!=0  ) 
			    { 
				     mangsp[x][4]= 0;
			    }
				
  				mt[x] =	mangsp[x] ;
			   
			}
			mangsp=mt ;
			
		}
		
	   
	}
	//================so sanh chuong trinh khuyen mai ===============================================================
//	thanhtien=0;
 //   for (x in mangsp)
//	{  
 //		thanhtien =  doiso(mangsp[x][3]) *  doiso(mangsp[x][2])    ;	
//		thanhtien  = thanhtien - thanhtien *  mangsp[x][4]/100   ;
//		thanhtien  =   Math.round(thanhtien,0) ; 
//		tong = tong + thanhtien ;		
//	}
//	tong = tong -1*tienbot ;
//	alert(tong) ;
 	//=============================kiem tra mua 3 giam 92========================
	
	
	thanhtien = 0 ; tong = 0 ;
	   str = ' <table width="100%" border="0" cellpadding="0" cellspacing="0">' ;
	   str += '    <tr bgcolor="#F8E4CB" > ';
	   str += ' <td width="29"  align="center" class="cothienthi" height="23"><b>STT</b></td> ';
	   str += ' <td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td> ';
	   str += ' <td width="350" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td> ';
	   str += ' <td width="45"  align="center" class="cothienthi"><strong>SL</strong></td> ';
	   str += ' <td width="105" align="center" class="cothienthi"><strong>Đơn Giá </strong></td> ';
	   str += ' <td width="51"  align="center" class="cothienthi"><strong>CK</strong></td> ';
	   str += ' <td width="100" align="center" class="cothienthi"><strong>Thành Tiền </strong></td> ';
	   str += ' <td width="300" align="center" class="cothienthi"><strong>Ghi Chú </strong></td> ';
 	   str += ' <td width="30"  align="center" class="cothienthi"><strong>X&#243;a</strong></td> ';
	   str += ' </tr>';
	var mau,h1,h12 ;
	tongsl = 0 ;
	for (x in mangsp)
	{  
 		if(mau == "white")
		{	{
			 mau = "#EEEEEE";
			 hl = "Normal4" ;
			 hl2 = "Highlight4";
			}
			 hl = "Normal4" ;
			 hl2 = "Highlight4"; 
		}else { 
		mau = "white";
		hl = "Normal5" ;
		hl2 = "Highlight5";
		} 
	thanhtien =  doiso(mangsp[x][3]) *  doiso(mangsp[x][2])    ;	
	thanhtien  = thanhtien - thanhtien *  mangsp[x][4]/100   ;
	thanhtien  =   Math.round(thanhtien,0) ; 
	tong = tong + thanhtien ;		
		tongsl = 1*tongsl + 1*mangsp[x][2] ;
    stt = stt + 1;
 	str +='<TR onMouseOver="this.className=\''+ hl2+'\'"   onMouseOut="this.className=\''+h1+'\'" bgcolor="'+mau+'" style="cursor:pointer" onclick="setthongtin(\''+ x + '\')">';
	str += ' <td class="cothienthi"  align="Right" height="23">'+ stt +'</td>';	
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][0] + ' ' +mangsp[x][7]+'</td>';
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][1] +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + mangsp[x][2] +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(mangsp[x][3]) +'</td>';
	str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][4] +'%</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(thanhtien) +'&nbsp;</td>';
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][6] +'</td>';
 	str += ' <td class="cothienthi"  align="center"  ><img onclick="xoapt(\''+ x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>';
 	str += ' </Tr>';		
		
	}
str += ' <Tr class="cothienthi"><td colspan="3" align="right" ><b>Tổng cộng &nbsp; </b></td><td align="right"  class="chulon" ><b>'+ txtFormatj(tongsl) +'&nbsp;</b></td><td></td><td></td><td  align="right"   class="chulon" ><b>'+ txtFormatj(tong) +'</b>&nbsp;</td><td></td>';		
	str += ' </Tr>';		
  str +='</table>';
	document.getElementById('sanphamxuat').innerHTML = str ;
    document.getElementById('tongtien').innerHTML =   txtFormatj(tong);
	 khachduatien = document.getElementById('khachdua').value ;
	 
	 khachduatien =khachduatien.replace(',','');
	 khachduatien =khachduatien.replace(',','');
	  khachduatien =khachduatien.replace(',','')
	  if(khachduatien=='')khachduatien =0;
	  
	 document.getElementById('tralai').innerHTML =   txtFormatj(parseFloat(khachduatien)-parseFloat(tong)+parseFloat(tienbot) );
	//  document.getElementById('tralai').innerHTML =  document.getElementById('tralai').innerHTML.replace('-,','-');
}
//===================================================================================== 
var tongtienhang,tienbot,khachdua ;

function tinhtien(giatri)
{ 	 
    giatri =  giatri.replace(',','');
	giatri =  giatri.replace(',','');
	giatri =  giatri.replace(',','');
    tongtienhang = document.getElementById('tongtien').innerHTML  ;
	tongtienhang =  tongtienhang.replace(',','');
	tongtienhang =  tongtienhang.replace(',','');
	tongtienhang =  tongtienhang.replace(',','');
	tienbot = document.getElementById('bot').value  ;
	tienbot =  tienbot.replace(',','');	 tienbot =  tienbot.replace(',','');	tienbot =  tienbot.replace(',','');	
	tongtienhang = tongtienhang*1 -tienbot ;
	 
    document.getElementById('tralai').innerHTML =   txtFormatj(parseFloat(giatri)-parseFloat(tongtienhang) );	
    document.getElementById('tralai').innerHTML =  document.getElementById('tralai').innerHTML.replace('-,','-');
}

function kiemtradongthoi(bot)
{
	 var ckx=''; 
   bot =  bot.replace(',','');bot =  bot.replace(',','');bot =  bot.replace(',','');
  var mt = new Array() ;
	if(bot*1>0)
	{
  	  for (x in mangsp)
		{
		 	mt[x] =	mangsp[x] ;			 
			if( mt[x][4]>0)  
			{
				if(ckx=='')
				{
					var cf = "Bạn chỉ được chọn 1 loại khuyến mãi nhập voucher hoặc giảm giá!!! \n\nBạn có muốn xóa chiết khấu các sản phẩm đang có hay không ?" ;
					var n = confirm(cf);
					if(n == true) { setchietkhauchung('0'); return ; }	
					else { return ; }
			    }
 			}
 		}
	}
}

function tinhtienbot(bot)
{ 

	khachdua = document.getElementById('khachdua').value  ;
    khachdua =  khachdua.replace(',','');
	khachdua =  khachdua.replace(',','');
	khachdua =  khachdua.replace(',','');
    tongtienhang = document.getElementById('tongtien').innerHTML  ;
	tongtienhang =  tongtienhang.replace(',','');
	tongtienhang =  tongtienhang.replace(',','');
	tongtienhang =  tongtienhang.replace(',','');
	
	 
	tongtienhang = tongtienhang*1-bot ;
    document.getElementById('tralai').innerHTML =   txtFormatj(parseFloat(khachdua)-parseFloat(tongtienhang) );	
    document.getElementById('tralai').innerHTML =  document.getElementById('tralai').innerHTML.replace('-,','-');
}

function xulyod()
{ 
   innoidung(ketqua)	;
   innoidung(ketqua)	;
}
function goiin()
{ 		
	var so = document.getElementById('sochungtu').value ;
	var st ;
//	st = "xuatkhoin.php?id=" + so  ;
	//window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,height=300px,titlebar=no') ;

  
   poststr= "DATA="+ encodeURIComponent(so)+"*@!"  + encodeURIComponent(0) ; 
   
   loadtrang('khonghienthi',"xuatkhoinmoi", poststr,"xulyod") ;		
 
}
function goiinxuat()
{ 		
	var so = document.getElementById('sochungtu').value ;
	var st ;
	st = "xuatkhoin.php?id=" + so  ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;
}
function lamlai()
{
	document.forms['xuatsp'].btnUpdate.disabled = '' ;
}
 
function tinhgiamgia1(tongcong,giatri,loaitien)
{
}
function tinhgiamgia2(tongcong,giatri,loaitien)
{
		var tienchuagiam ;
 	    document.getElementById('thanhtien').innerHTML = parseFloat(tienchuagiam) - parseFloat(document.getElementById('giamphamtram').innerHTML) - parseFloat(tongcong) ; 		
}
function kiemtrach(t)
{
  	localStorage.setItem("bien_team", t); 
  // alert(localStorage.getItem("bien_team"))
}
	// document.getElementById('online').value =  document.getElementById('idban').value ;
	   document.getElementById('lydo').value =  localStorage.getItem("bien_team");
	  
	 $('.js-nv').select2();
 