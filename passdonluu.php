<?php  
session_start();
$idk = $_SESSION["LoginID"] ; if (  $idk == '') return ;
 $idkho = $_SESSION["se_kho"] ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
 
$data = new class_mysql();
$data->config();
$data->access();


  $mpt = array () ; 
  $mangud = array() ;
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
  $mang = explode('|@|',$tmp[1]);
  //echo $data1;
   $i =0 ;
  $data->setthaotac('xuatkholuu') ;  
   foreach($mang as $x)
   {
     	$mpt[$i] = explode('|*|',$x); 
        $i  = $i + 1 ;	
   }
   
   	
		$sochungtu=$tmp[2];$tigia=laso($tmp[4]);$lydoxuat=$tmp[5];$idban=$tmp[6];$idkhach=laso($tmp[7]);$ghichu=addslashes($tmp[8]);
		$vat=$tmp[9];$Loai=$tmp[10];$tenkhach=$tmp[11];$diachi=$tmp[12];  $tientra =str_replace(",","",$tmp[14]) ;	
		$qua =trim($tmp[15]);$diem =str_replace(",","",$tmp[16]);$diem = substr($diem,strrpos($diem,'-')+1,strlen($diem)) ; $makm =trim($tmp[17]) ;$idchol =laso($tmp[18]) ;
		$tenN =  ($tenkhach);$diachiN =  ($diachi) ;
		$phivcthukhach=$tmp[20];
		$phivcdvvc=$tmp[21];
		$thanhtoan=$tmp[22];
		$IDtknh=$tmp[23];
			$sotknh=$tmp[24];
				$chuyenkhoan=$tmp[25];
				
		//;$idkho =laso($tmp[19]) ;
	 	//$tenkho = getten("kho",$xuatkho,"Name") ;
		
         $idgoi = laso($tmp[0]) ;
		 $nguoitao =$_SESSION["TenUser"]."_".$idk; // dùng lưu sau này phòng trường hợp bị đổi tên user để dùng lại 
  		 
		 $khach = getdong("select Name,address,diemtichluy from customer where ID = '$idkhach' limit 1 "); 
 		 $tenlydo= getten("lydonhapxuat",$lydoxuat,"Name") ;
		 $mangc = $_SESSION["mangck"] ;
 	      function timchietkhau($diem)
		 {  
			 global $mangc  ;
			 $chietkhau = 0;
			 foreach ($mangc as $m)
			 {  
				 if($diem>=$m[0]) $chietkhau =$m[1] ;
			 }
			 return $chietkhau ;
		 }
		 $ck = timchietkhau($khach['diemtichluy']);
		 if(strlen($ck)==1) $ck="0".$ck;
		 
		 $ngaytao = gmdate('Y-m-d H:i:s', time() + 7*3600) ;
		 $ngay =  explode('/',$tmp[1]);
   		 if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
	 	 if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }
	//	 $ngayxuat = $ngay[2].'-'.$ngay[1].'-'.$ngay[0] ; // có the sau nay lay theo nguoi tao de có thẻ nhap lui
		  $ngayxuat =gmdate('Y-m-d', time() + 7*3600) ;
	//	 echo $idgoi ;
	
	
					
				$chuoitinhanchitiet='';	
 		if( $idgoi == 0 )
		{
	 
		// $idnha la id cap nhap lan thu n, idtao là id tạo ra phiéu này, idtao va idnhap thong thuong trung nhau
		 
   	    if (true  )
				 {
		
		//	 echo "Trùng số chứng từ !!! " ; return ; }   
		//=======================================================================================
		   $thang = gmdate('m', time() + 7*3600); 
		   $nam = gmdate('y', time() + 7*3600); 
		   $so = strlen($idkho) + 9;
		   $sql = "select   max(convert( mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from passdon  where loai ='1' and  IDKho='$idkho' and  mid(SoCT,4,2) = '$thang' " ;
 		   $kq = $data->truyvan($sql) ;		
		   $sp = laso($kq['sp']) + 1 ;
		   if (strlen($sp)== '1' ) $sp = "00". $sp ;
		   if (strlen($sp)== '2' ) $sp = "0". $sp ;
		   $sochungtu ="P".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".$sp ; 
		   $sochungtu2 ="P".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".($sp+1) ; 
		   
		}
	   $tam = getdong(" select ID from passdon where SoCT ='$sochungtu' limit 1 ") ;
	   
	
	   
   	   if ($tam["ID"]  != ""  ) $sochungtu= $sochungtu2  ;
				 if($ck!="00")	$ghichu= $ck."% ".$ghichu;
		
		$sql = "insert into passdon   set Loai='1' ,IDKho ='$idkho',IDNhaCC ='$idkhach' ,IDNhap ='$id' ,NgayNhap ='$ngayxuat' ,SoCT='$sochungtu' ,LyDo='$lydoxuat' ,SoNgayNo='0' ,IDTKNo='0' ,IDTKCo='0' ,TiGia ='$tigia' ,VAT='$vat' ,GhiChu='$ghichu' ,NgayTao='$ngaytao' ,IDTao='$idk' ,NguoiGiao='$makm' ,ten='$khach[Name]',diachi='$khach[address]', tenlydo='$tenlydo'   ,diachiN='$idban' ,nguoitao='$nguoitao',tientra='$tientra',idchol='$idchol',idgioithieu='$idgioithieu',phivcthukhach='$phivcthukhach',phivcdvvc='$phivcdvvc',thanhtoan='$thanhtoan',IDtknh='$IDtknh',tknh='$sotknh',chuyenkhoan='$chuyenkhoan'    "  ;
		
 		$data->query($sql);	
	 
		  
		$idphieu = getdong(" select ID from passdon where  SoCT = '$sochungtu'  ");
		$idphieu = $idphieu['ID'];
	 
		$chuoitinhanchitiet="Đơn pass: $sochungtu\n";
	//   echo  $tam["ID"]." select ID from passdon where SoCT ='$sochungtu' limit 1 " ;	
		
			
 			$sql = "INSERT INTO passdonchitiet (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idtao,idnv,mota) VALUES "; 
			$sqlu = "" ;$sqlt ="";	
			
 			
			$tien =0;		
			
 			foreach($mpt as $x)
			{ 
			  
				   if ($Loai=='0') {$dau = "+";$t3= laso($x[3]) ;}else{$dau="-";$t3= -(laso($x[3])) ;}
				   $t0= $x[0] ;$t1= $x[1] ;$t2= $x[2] ;$t4= laso($x[4]) ;$t5= $x[5] ;$t6= $x[6] ;$t7= $x[7] ;  ;
				   $tenpt = getdong("select a.Name,a.code,a.codepro,a.price,a.idgroup,a.giabinhquan,b.giagiam from products a left join giamgiacuahang b on (a.id=b.idsp and b.idcuahang=$idkho)   where a.ID=$t0 limit 1 ");
 	  			    $giagiam = laso($tenpt['giagiam']) ;				    
					$gia = $tenpt['giabinhquan'] ;
					$nhom = $tenpt['idgroup'] ;
					$tien=$tien + $t3 *($t4-($t5*$t4/100))  ;
					$codepro=$tenpt['codepro']  ;
					$giaban=$tenpt['price']  ;
					$mota=$tenpt['code']  ;
					$tenpt = addslashes($tenpt['Name']) ;
					
					$chuoitinhanchitiet.="Mã sản phẩm: $codepro\ntên sản phẩm: $tenpt\nSố lượng: $t3";
					
					if($sqlu == "")  
					{		     // IDPhieu   ,IDSP,mahang,tenpt,   SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon			
						 $sqlu =  "('$idphieu','$t0','$codepro','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom','$giaban','$giagiam','$mota')";		
					}else
					{
						 $sqlu .= ",('$idphieu','$t0','$codepro','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom','$giaban','$giagiam','$mota')";		
					}
				
 				   $sl = abs($t3);
					 
			//	  $data->query("update products set SoLuong = SoLuong - $sl  where ID ='$t0' ");
 			//	  $data->query("update hanghoacuahang set SoLuong = SoLuong - $sl  where IDSP ='$t0' and IDcuahang = '$idkho'  "); 
  				 
			}
			$sql .= $sqlu  ;  //  echo "$sql";
 		    $update = $data->query($sql);
			
			if($update){
				sendFB($chuoitinhanchitiet);
			}
			echo "**#$idphieu**#$sochungtu**#" ;
		 
		 
		    
            return ;		 
		}   // else của them mới
		else
		{   //  $idgoi <>0 cập nhập
		
		
		    $st = getdong(" select ID,dakhoa from passdon  where ID='$idgoi' and  SoCT ='$sochungtu'   ") ;
			if ( laso($st['dakhoa']) == 1) { echo "#*#*Phiếu đã khóa  !!! " ; return ; } 
			if ( laso($st['ID']) == 0) { echo "#*#*Phiếu không tồn tại !!! " ; return ; } 
			
		   $st = getdong(" select ID from passdon where ID <> '$idgoi' and  SoCT ='$sochungtu' ") ;
	       if (trim($st['ID'])!= "") { echo "#*#*Trùng số chứng từ khi lưu !!! " ; return ; } 
	 	    
			 
		   $sql = " update passdon   set  idkho ='$idkho' , IDNhaCC ='$idkhach' , IDNhap ='$id' ,LyDo='$lydoxuat'    ,VAT='$vat' ,GhiChu='$ghichu'  ,NguoiGiao='$nguoigiao' ,ten='$khach[Name]',diachi='$khach[address]' ,TiGia ='$tigia', tenlydo='$tenlydo' ,tenN='$khach[NameN]' ,diachiN='$idban',tientra='$tientra'    where ID = '$idgoi'"  ;
 		   $data->query($sql);	
		   
		   $data->query(" delete from passdonchitiet where IDPhieu='$idgoi'    ");
		     // $sql = "INSERT INTO xuatbhchuakhoa (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idnv) VALUES "; 
			  $sql = "INSERT INTO passdonchitiet (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idtao,idnv,mota) VALUES "; 
		   // $sql = "INSERT INTO xuatbhchuakhoa (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai) VALUES "; 
			$sqlu = "" ;$sqlt ="";	
 			foreach($mpt as $x)
			{  
 				   $t0= $x[0] ;$t1= $x[1] ;$t2= $x[2] ;$t3= laso($x[3]) ;$t4= laso($x[4]) ;$t5= $x[5] ;$t6= $x[6] ;$t7= $x[7] ; 
				//   $tenpt =   getdong(" select Name,price,idgroup,giabinhquan from products where ID= $t0 limit 1 ");
				
				  $sqlt = " select a.Name,a.price,a.codepro,a.code,a.idgroup,a.giabinhquan,b.giagiam from products a left join giamgiacuahang b on (a.id=b.idsp and b.idcuahang=$idkho) where a.ID=$t0 limit 1";   
				   $tenpt =   getdong($sqlt);
	 
	  			    $giagiam = laso($tenpt['giagiam']) ;
					$gia = $tenpt['giabinhquan'] ;  $mota = $tenpt['code'] ;
					$nhom = $tenpt['idgroup'] ;$tenpt = addslashes($tenpt['Name']) ;
			 
					if($sqlu == "")  
					{		     // IDPhieu   ,IDSP,mahang,tenpt,   SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon			
						 $sqlu =  "('$idgoi','$t0','$t1','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom','$giaban','$giagiam','$mota')";	
					}else
					{
						 $sqlu .= ",('$idgoi','$t0','$t1','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom','$giaban','$giagiam','$mota')";	
					}
  			}
				$sql .= $sqlu  ;
				// echo  $sql ;
 		    $update = $data->query($sql);
			
			
			echo "**#$idgoi**#" ;
	 }
 
       
// echo $sql ; 
	    $data->closedata() ;
  	return ;

   //=========bat dau kiem tra =================================  
   if ($idkhach >1)
   {
   foreach($mpt as $x)
			{  
 				   if ($x[1] =='ATCF182' )  
				   $kt =   getdong(" select a.ID from passdon a left join xuatbanhang b on a.ID = b.IDPhieu  where a.IDNhaCC= $idkhach and b.mahang='ATCF182' limit 1 ");
				   
					if($kt['ID'] !="")  
					{
 					  echo "**#8**#Mã ATCF182 đã được khách hàng này mua một lần rồi !" ;
					   // return ;		      
					}
					
			}
   }
   
  
  
			//=========het kiem tra =================================  
			
			
function sendFB($mess){
    global $data;
    $sql="select distinct a.IDfb from userac a left join nhanviendilam b on a.ID=b.IDnhanvien where day(b.ngaytao)=day(now()) and month(b.ngaytao)=month(now()) and year(b.ngaytao) = year(now()) and a.IDfb is not null";
    $query=$data->query($sql);
   // var_dump($mess);
    // $magresp=array("1962958627103807","4712811502139254");
//$mess="đây là tin nhắn tự động";
$mangbatch=[];
    while($re=$data->fetch_array($query)){
        $value=$re["IDfb"];
		 //var_dump($value);
            $texbody = [
                    'recipient'=> [
                        'id' => $value,
                    ],
                    'message'=>[
                        'text'=>$mess
                    ]
                ];
            $batch=[
            'method'=>'POST',
            'relative_url'=>'me/messages',
            'body'=>http_build_query($texbody, "", '&'),
            ];
        array_push($mangbatch,$batch);
    

    }
    $jsonurl=json_encode($mangbatch);
      //$jsonurl=urlencode($jsonurl);
        //var_dump($jsonurl);
   $res=guitinnhanhangloat($jsonurl);
  //
   $res=json_decode($res,true);
   echo "<pre>";
    var_dump($res);
	 echo "</pre>";
   if($res[0]["code"]==200){
       echo "Gửi tin nhắn thành công";
   }
   else{
       echo "Gửi tin nhắn thất bại";
   }
  
}

function guitinnhanhangloat($jsonurl){
    
 $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    $curl = curl_init();
    $url='https://graph.facebook.com/me';
    //$ACCESSTOKEN='EAAOFnsGIUHYBAMuys1ZCSnZBZApyZAwZCofJu9wosuIuz4TvFBlqkt8CZCZBL5ZAsKQNS5BIgpBAYsDZCM69bqiZAs6wziMtOuBUgprc8qZCSzpX33YN2aDwRt9hUUPTUbuQyFKkhgBx0nLrXQg3d1jt6dqaRQdYpZBJAs8ZC0MdL4rWSg2RRMZCsc7HdpZCz4uzH9DLCMoYz7FazsCTwZDZD';
	
	$ACCESSTOKEN='EAAOFnsGIUHYBACcJZC2erkZB8uxLEH3jOUvoaLTZCvvD8KfDrz5kcuIitfZBHZCi9bZBnuZBRWtPhzEjCFeceeSVV6bEpkGoMZAOJu2TJ8sFFsTrJe8bQUdGXYu8seZCSvzEyCGQQGUtZC6MO3mc7kZAZCMvKUSrq5VLZBL9XlYdoFhZCBKnCZBE4XAmode';
  
    //$endpoint="me&access_token=".$ACCESSTOKEN;
    //return  $url.$endpoint;
    curl_setopt_array($curl, array(
          CURLOPT_URL =>$url,
         CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
             CURLOPT_POSTFIELDS =>array("batch"=>$jsonurl,"access_token"=>$ACCESSTOKEN),
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
             CURLOPT_USERAGENT => $agent,
            CURLOPT_HTTPHEADER => array(
                'Cookie: sb=7yC7YPRdvUTACsPMzGr1Z0iH'
            ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}		
?>	