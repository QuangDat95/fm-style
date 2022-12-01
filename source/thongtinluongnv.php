<?php
if(session_status()==PHP_SESSION_NONE) session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	

//=============================================	
if (isset($_POST['view'])) {
	header("Content-Type', application/pdf");
	readfile("templates/QUOC.pdf");
}


if ($_POST["cancel"])
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 
 
if ($_POST["btnUpdate"] )
{ 	
	     
	$ID           =		$_GET["id"]  ;
	$phongban         =  	$_POST["phongban"]  ;
	$chucvu      =  	$_POST["chucvu"]  ;
	$IDcuahang      =  	$_POST["idcuahang"]  ;
	$IDNV =  	$_POST["idnhanvien"]  ;
	$manv =  	$_POST["manv"]  ;
	$luongthang =  	$_POST["luongthang"]  ;
	$tenNV =  	$_POST["tennv"]  ;
	$luongcb =  	$_POST["luongcoban"]  ;
	$luongkpi =  	$_POST["luongkpi"]  ;
	$luongchitieu=$_POST["luongchitieu"]  ;
	$socuahang =  	$_POST["socuahang"]  ;
	$luongtrachnhiem =  	$_POST["luongtrachnhiem"]  ;
	$luongkpi =  	$_POST["luongkpi"]  ;
	$luongdoanhthu =  	$_POST["luongdoanhthu"];
	$chucdanh =  	$_POST["chucdanh"];
	$ngaychuan =  	$_POST["ngaychuan"];
	$giotrenngay =  	$_POST["giotrenngay"];
	$songaytrongthang =  	$_POST["songaytrongthang"];
	$giocong =  	$_POST["giocong"];
	$luongngaycong =  	$_POST["luongngaycong"];
	$songaymocua =  	$_POST["songaymocua"];
	$hanghoa =  	$_POST["hanghoa"];
	$nhansuvadaotao =  	$_POST["nhansuvadaotao"];
	$doanhthumoicuahang =  	$_POST["doanhthumoicuahang"];
	$dichvu =  	$_POST["dichvu"];
	$doanhthumuctieu =  	$_POST["doanhthumuctieu"];
	$doanhthuthuc =  	$_POST["doanhthuthuc"];
	$doanhthucanhan =  	$_POST["doanhthucanhan"];
	$doanhthumuctieu =  	$_POST["doanhthumuctieu"];
	$hesodoanhthu =  	$_POST["hesodoanhthu"];
	$luongdoanhso =  	$_POST["luongdoanhso"];
	$phucap =  	$_POST["phucap"];
	$phucapdich =  	$_POST["phucapdich"];
	$phucapkhac =  	$_POST["phucapkhac"];
	$phat =  	$_POST["phat"];
	$bhxh =  	$_POST["bhxh"];
	$thunhap =  	$_POST["thunhap"];
	$luongcu =  	$_POST["luongcu"];
	$congno =  	$_POST["congno"];
	$daung =  	$_POST["daung"];
	$giuluong =  	$_POST["giuluong"];
	$thucnhan =  	$_POST["thucnhan"];
	$xacnhan =  	$_POST["xacnhan"];
	$xacnhanluongthuviec =  	$_POST["xacnhanluongthuviec"];
	$giocongtinhsp =  	$_POST["giocongtinhsp"];
	$trugiocongtinhsp =  	$_POST["trugiocongtinhsp"];
	$thuongcs =  	$_POST["thuongcs"];
	$thuongtop =  	$_POST["thuongtop"];
	$hesoluong =  	$_POST["hesoluong"];
	$machaythuong =  	$_POST["machaythuong"];
	$machayluong =  	$_POST["machayluong"];
	$phantramdoanhthu =  	$_POST["phantramdoanhthu"];
	$luongdtcpct =  	$_POST["luongdtcpct"];
	$Luongdtbhtnbv =  	$_POST["Luongdtbhtnbv"];
	$hoahong =  	$_POST["hoahong"];
	$luongkpi =  	$_POST["luongkpi"];
	$socuahang =  	$_POST["socuahang"];
	$luongtrachnhiem =  	$_POST["luongtrachnhiem"];
	$luongkpimien =  	$_POST["luongkpimien"];
	$luongdoanhthu =  	$_POST["luongdoanhthu"];
	$ngayvaolam=$_POST["ngayvaolam"];
	$luongDTCNTB="";
	$luongCPtrenDT="";
	$thuongdsolt='';
		if  ($_GET["id"] == "-1")
		{
		  $sql ="insert into ns_luongthang  (luongthang,IDcuahang,IDNV,tenNV,manv,ngayvaolam,chucdanh,ngaychuan,sogiotrenngay,giocong,luongngaycong,luongds,phucap,phucapdich,phucapkhac,phat,bhxh,thunhap,luongcu,congno,daung,giuluong,thucnhan,cuahang,xacnhan,xacnhanluongnghiviec,giocongtinhsp,trugiocongtinhsp,thuongdskho,thuongdsolt,hesoluong,hesovung,socuahang,machaythuong,machayluong,phantramdoanhthu,luongdtcpct,luongdtbhtnbv,hoahong,thuongcs,thuongtop,songaytrongthang,songaymocua,hanghoa,nhansuvadaotao,doanhthumoicuahang,dichvu,doanhthumuctieu,doanhthuthuc,doanhthucanhan,doanhthudat,hesodoanhthu,luongchitieu,luongDTCNTB,luongdoanhthu,luongCPtrenDT,luongcoban,luongkpi,luongtrachnhiem,chucvu,phongban) values ('$luongthang','$IDcuahang','$IDNV','$tenNV','$manv','$ngayvaolam','$chucdanh','$ngaychuan','$sogiotrenngay','$giocong','$luongngaycong','$luongds','$phucap','$phucapdich','$phucapkhac','$phat','$bhxh','$thunhap','$luongcu','$congno','$daung','$giuluong','$thucnhan','$cuahang','$xacnhan','$xacnhanluongnghiviec','$giocongtinhsp','$trugiocongtinhsp','$thuongdskho','$thuongdsolt','$hesoluong','$hesovung','$socuahang','$machaythuong','$machayluong','$phantramdoanhthu','$luongdtcpct','$luongdtbhtnbv','$hoahong','$thuongcs','$thuongtop','$songaytrongthang','$songaymocua','$hanghoa','$nhansuvadaotao','$doanhthumoicuahang','$dichvu','$doanhthumuctieu','$doanhthuthuc','$doanhthucanhan','$doanhthudat','$hesodoanhthu','$luongchitieu','$luongDTCNTB','$luongdoanhthu','$luongCPtrenDT','$luongcb','$luongkpi','$luongtrachnhiem','$chucvu','$phongban')";
		
		} 
		
		else
		{
		  $sql = "UPDATE  ns_luongthang  SET  luongthang='$luongthang',IDcuahang='$IDcuahang',IDNV='$IDNV',tenNV='$tenNV',manv='$manv',ngayvaolam='$ngayvaolam',chucdanh='$chucdanh',ngaychuan='$ngaychuan',sogiotrenngay='$sogiotrenngay',giocong='$giocong',luongngaycong='$luongngaycong',luongds='$luongds',phucap='$phucap',phucapdich='$phucapdich',phucapkhac='$phucapkhac',phat='$phat',bhxh='$bhxh',thunhap='$thunhap',luongcu='$luongcu',congno='$congno',daung='$daung',giuluong='$giuluong',thucnhan='$thucnhan',cuahang='$cuahang',xacnhan='$xacnhan',xacnhanluongnghiviec='$xacnhanluongnghiviec',giocongtinhsp='$giocongtinhsp',trugiocongtinhsp='$trugiocongtinhsp',thuongdskho='$thuongdskho',thuongdsolt='$thuongdsolt',hesoluong='$hesoluong',hesovung='$hesovung',socuahang='$socuahang',machaythuong='$machaythuong',machayluong='$machayluong',phantramdoanhthu='$phantramdoanhthu',luongdtcpct='$luongdtcpct',luongdtbhtnbv='$luongdtbhtnbv',hoahong='$hoahong',thuongcs='$thuongcs',thuongtop='$thuongtop',songaytrongthang='$songaytrongthang',songaymocua='$songaymocua',hanghoa='$hanghoa',nhansuvadaotao='$nhansuvadaotao',doanhthumoicuahang='$doanhthumoicuahang',dichvu='$dichvu',doanhthumuctieu='$doanhthumuctieu',doanhthuthuc='$doanhthuthuc',doanhthucanhan='$doanhthucanhan',doanhthudat='$doanhthudat',hesodoanhthu='$hesodoanhthu',luongchitieu='$luongchitieu',luongDTCNTB='$luongDTCNTB',luongdoanhthu='$luongdoanhthu',luongCPtrenDT='$luongCPtrenDT',luongcoban='$luongcb',luongkpi='$luongkpi',luongtrachnhiem='$luongtrachnhiem',chucvu='$chucvu',phongban='$phongban' where ID='0$ID'" ;
		  		
		}  
		$update = $data->query($sql);
		$them = true;
 
 		
	 
}	

if ($_GET["Del"])
{ 
		$IDD = $_GET["Del"] ;
		$sql = "delete from  ns_luongthang  where ID = '0".$IDD."'" ;
		$update = $data->query($sql);
		$xoa = true ;
}	

{
 	$tam = "" ;
	$kt = 0 ;	
	error_reporting(E_ALL ^ E_NOTICE);
	if ($_REQUEST["id"] == "" || $them  || $xoa )
	
	{
	
			$mangcv = taomang ("kh_chucvu","ID","LCASE(Name)");
			$mangch = taomang ("cuahang","ID","LCASE(Name)");
			$mangpb = taomang ("rooms","ID","LCASE(Name)");
		error_reporting(E_ALL ^ E_NOTICE);
		$maS = chonghack($_POST["maS"]) ;
		$chucvuS = chonghack($_POST["chucvuS"]) ;
		$phongbanS = chonghack($_POST["phongbanS"]) ;
		$thangS = chonghack($_POST["thangS"]) ;
		$thangS=explode('-',$thangS);
		$namS=$thangS[0];
		$thangS=$thangS[1];
		$tongngaythang=30;
		if($_POST["thangS"]){
		$tongngaythang=cal_days_in_month(CAL_GREGORIAN,$thangS,$namS);
		}
		$ngaybd=$namS.'-'.$thangS.'-01';
		$ngayketthuc=$namS.'-'.$thangS.'-'.$tongngaythang.' 23:59:00';
		
		$template->assign("kh_chucvu",composx("kh_chucvu","Name",$chucvuS,""));
		$template->assign("phongban",composx("rooms","Name",$phongbanS,""));
		$template->assign("maS",strtoupper($maS));
		$template->assign("thangS",$_POST["thangS"]);
  	    $template->parse("main.block_khht1"); 
		$sql = "SELECT ID FROM thongtinluongnv ";

		$sql_where=" where 1=1 ";
		if($maS!=""){
			$sql_where.=" and manv = '".$maS."'";
			$pagenation="limit 0,20";	
		}
			if($chucvuS!=""){
			$pagenation="limit 0,20";
			$sql_where.=" and chucvu = '".$chucvuS."'";
			}
			if($phongbanS!=""){
				$pagenation="limit 0,20";
				$sql_where.=" and phongban = '".$phongbanS."'";
			}
			if($thangS!=""){
				$pagenation="limit 0,20";
			$sql_where.=" and luongthang >= '".$ngaybd."' and luongthang <='".$ngayketthuc."'";
			}
		$sql.=$sql_where;
		error_reporting(E_ALL ^ E_NOTICE);
	 
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
	     $sql = "SELECT ID,DATE_FORMAT(luongthang,'%d/%m/%Y') as thangluong,luongcoban,manv,luongkpi,socuahang,luongtrachnhiem,luongkpimien,luongds,chucvu,phongban FROM  ns_luongthang $sql_where order by ID ";
 		$query_rows = $data->query($sql);
		$num=$data->num_rows($query_rows);	
	
	    $page_start=0;
		$page_row = 20 ;
		
		$pagenation="limit $page_start,$page_row ";
		include("paging.php");
		$list_page=paging($num);	
	//var_dump($sql);
		$sql ="SELECT ID,DATE_FORMAT(luongthang,'%d/%m/%Y') as thangluong,tennv,luongcoban,manv,luongkpi,sogiotrenngay,luongchitieu,luongngaycong,giocong,chucvu,phongban FROM  ns_luongthang  ".$sql_where." ORDER BY ID desc, ID $pagenation";
		//echo $sql;
		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i = $page_start; 
//=========================================================
$SOST = $page_start; 
while($result_news = $data->fetch_array($result))		
{  
	if($mau == "white")
		$mau = "#EEEEEE";
	else
	$mau = "white";
	$SOST = $SOST + 1 ;	
	$giotinhluong= (int) $result_news["giocong"];
	 $sogio =  floor($giotinhluong/60)  ;   $sophut=$giotinhluong%60;		
	$template->assign("color", $mau);
	$template->assign("ID",$result_news["ID"]);
	$template->assign("stt", $SOST);
	$template->assign("tennv", $result_news["tennv"]);
	$template->assign("luongthang", $result_news["thangluong"]);
	$template->assign("manv",$result_news["manv"]);			
	$template->assign("luongcoban",$result_news["luongcoban"]);	
	$template->assign("luongkpi", $result_news["luongkpi"]);
	$template->assign("giotrenngay", $result_news["giotrenngay"]);
	$template->assign("luongngaycong", $result_news["luongngaycong"]);
	$template->assign("giocong", $sogio."h". $sophut);
		$template->assign("luongchitieu", $result_news["luongchitieu"]);
	$template->assign("chucvu", $mangcv[$result_news["chucvu"]]);
		$template->assign("phongban", $mangpb[$result_news["phongban"]]);
	
  $template->parse("main.block_khht"); 
	$template->parse("main.block_khht2"); 
		 $i++; 
 } 

	$template->assign("list_page",$list_page);  // phan trang
	
	 $template->parse("main.block_proht2"); 	 
  
}
else	
{ 

if ($_REQUEST["id"] == "-1")
{ 
   $template->assign("t-c","Cập nhật thông tin lương nhân viên " );
   $template->assign("idgoi",$_POST["id"]);
	$template->assign("kh_chucvu",composx("kh_chucvu","Name",'',""));
	$template->assign("phongban",composx("rooms","Name",'',""));
	$template->assign("cuahang",composx("cuahang","Name",'',""));
	$template->assign("nhanvien",compoloai("userac","MaNV",'Ten',"",""));
	//$template->assign("quan",composx("quan","Name",$result["ID"],""));
	//$template->assign("thongtinluongnv",composx("thongtinluongnv","Name",$result["ID"],""));
}
else		
{
			$sql ="SELECT *, luongcoban,manv,luongkpi,socuahang,luongtrachnhiem,luongkpimien,luongds,chucvu,IDcuahang,phongban FROM  ns_luongthang  WHERE ID='".$_REQUEST["id"]."'";

			$query = $data->query($sql);
			$result = $data->fetch_array($query);
			
				$template->assign("t-c","Cập nhập" );
				$template->assign("IDnhanvien", $result["IDnhanvien"]);
					$template->assign("manv",$result["manv"]);			
					$template->assign("luongcoban",$result["luongcoban"]);	
					$template->assign("luongkpi", $result["luongkpi"]);
					$template->assign("socuahang", $result["socuahang"]);
					$template->assign("luongtrachnhiem", $result["luongtrachnhiem"]);
					$template->assign("luongkpimien", $result["luongkpimien"]);
					$template->assign("luongds", $result["luongds"]);
					$template->assign("chucvu", $result["chucvu"]);
					$template->assign("phongban", $result["phongban"]);	
					$template->assign("luongthang", $result["luongthang"]);
					
					
						$template->assign("tennv", $result["tennv"]);
					$template->assign("ngayvaolam",$result["ngayvaolam"]);			
					$template->assign("chucdanh",$result["chucdanh"]);	
					$template->assign("ngaychuan", $result["ngaychuan"]);
					$template->assign("giotrenngay", $result["sogiotrenngay"]);
					$template->assign("giocong", $result["giocong"]);
					$template->assign("luongngaycong", $result["luongngaycong"]);
					$template->assign("phucapdich", $result["phucapdich"]);
					$template->assign("phucapkhac", $result["phucapkhac"]);
					$template->assign("phat", $result["phat"]);	
					$template->assign("bhxh", $result["bhxh"]);
					$template->assign("ngayvaolam",$result["ngayvaolam"]);			
					$template->assign("chucdanh",$result["chucdanh"]);	
					$template->assign("ngaychuan", $result["ngaychuan"]);
					$template->assign("giotrenngay", $result["sogiotrenngay"]);
					$template->assign("giocong", $result["giocong"]);
					$template->assign("luongngaycong", $result["luongngaycong"]);
					$template->assign("phucapdich", $result["phucapdich"]);
					$template->assign("phucapkhac", $result["phucapkhac"]);
					$template->assign("phat", $result["phat"]);	
					$template->assign("bhxh", $result["bhxh"]);
					
					$template->assign("thunhap", $result["thunhap"]);
					$template->assign("luongcu",$result["luongcu"]);			
					$template->assign("congno",$result["congno"]);	
					$template->assign("daung", $result["daung"]);
					$template->assign("giuluong", $result["giuluong"]);
					$template->assign("thucnhan", $result["thucnhan"]);
					$template->assign("cuahang", $result["cuahang"]);
					$template->assign("xacnhan", $result["xacnhan"]);
					$template->assign("xacnhanluongnghiviec", $result["xacnhanluongnghiviec"]);
					$template->assign("giocongtinhsp", $result["giocongtinhsp"]);	
					$template->assign("thuongdskho", $result["thuongdskho"]);
					$template->assign("thuongdslt", $result["thuongdslt"]);
					$template->assign("hesoluong", $result["hesoluong"]);
					$template->assign("hesovung", $result["hesovung"]);
					$template->assign("socuahang", $result["socuahang"]);
					$template->assign("machaythuong", $result["machaythuong"]);
					$template->assign("machayluong", $result["machayluong"]);
					$template->assign("phantramdoanhthu", $result["phantramdoanhthu"]);
					$template->assign("luongdtcpct", $result["luongdtcpct"]);
					$template->assign("luongdtbhtnbv", $result["luongdtbhtnbv"]);
					$template->assign("hoahong", $result["hoahong"]);
					$template->assign("thuongcs", $result["thuongcs"]);
					$template->assign("thuongtop", $result["thuongtop"]);
					$template->assign("phucap", $result["phucap"]);
					$template->assign("luongtrachnhiem", $result["luongtrachnhiem"]);
					$template->assign("phongban", $result["phongban"]);
					$template->assign("luongkpimien", $result["luongkpimien"]);
					$template->assign("songaytrongthang", $result["songaytrongthang"]);
					$template->assign("songaymocua", $result["songaymocua"]);
					$template->assign("hanghoa", $result["hanghoa"]);
					$template->assign("nhansuvadaotao", $result["nhansuvadaotao"]);
					$template->assign("doanhthumoicuahang", $result["doanhthumoicuahang"]);
					$template->assign("dichvu", $result["dichvu"]);
					$template->assign("doanhthumuctieu", $result["doanhthumuctieu"]);
					$template->assign("doanhthuthuc", $result["doanhthuthuc"]);
					$template->assign("doanhthucanhan", $result["doanhthucanhan"]);
					$template->assign("doanhthudat", $result["doanhthudat"]);
					$template->assign("giatricotloi", $result["giatricotloi"]);
					$template->assign("hesodoanhthu", $result["hesodoanhthu"]);
					$template->assign("luongchitieu", $result["luongchitieu"]);
					$template->assign("luongdtcntb", $result["luongDTCNTB"]);
					$template->assign("luongdoanhthu", $result["luongdoanhthu"]);
					
					$template->assign("luongcptrendt", $result["luongCPtrenDT"]);
				$template->assign("kh_chucvu",composx("kh_chucvu","Name", $result["chucvu"],""));
				$template->assign("phongban",composx("rooms","Name",$result["phongban"],""));
				$template->assign("cuahang",composx("cuahang","Name",$result["IDcuahang"],""));
				$template->assign("nhanvien",compoloai("userac","MaNV","Ten",$result["IDnhanvien"],''," where ID =".$result["IDnhanvien"]));	
  		}
		
 	    $template->parse("main.block_kh");
	}
}
 $template->parse("main.block_ajack"); 
  $data->closedata() ;
?>
