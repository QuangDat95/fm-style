 <?php
  session_start();

  if ($_SESSION["LoginID"] == '') {
    return;
  }
  $quyen = $_SESSION["quyen"];
  $ql = $quyen[$_SESSION["mangquyenid"]["baocaodoanhthu"]];
  if (!($ql[0] || $_SESSION["LoginID"] == 1)) return;

  $root_path = getcwd() . "/";
  include($root_path . "biensession.php");
  include($root_path . "includes/config.php");
  include($root_path . "includes/removeUnicode.php");
  include($root_path . "includes/class.paging.php");
  include($root_path . "includes/class.mysql.php");
  include($root_path . "includes/function.php");
  include($root_path . "includes/gChart.php");

  $data = new class_mysql();
  $data->config();
  $data->access();
  //////////////////////////////////////////////////////////////
  //   update doanhthukhoan k left join (  SELECT n.vc,p.idkho,c.Name,c.macuahang, 
  // sum(ceil(p.DonGia*(1-1*p.chietkhau/100))*p.SoLuong) as tongtien , 
  // sum(CASE WHEN (p.lydo>45) THEN (ceil(p.DonGia*(1-1*p.chietkhau/100))*p.SoLuong) end) as tienonline  
  //  from phieubanhangluu p  left join cuahang c on p.IDKho=c.ID left join
  //   (select m.idkho,sum(m.tigia) as vc from phieunhapxuat m where m.Loai in (1,3,5) and m.dakhoa =1 and m.NgayNhap >= '2022-05-01' 
  //   and m.NgayNhap <= '2022-05-31' group by m.idkho ) n on p.idkho=n.idkho where p.Loai in (1,3,5) and p.dakhoa =1 
  //   and p.NgayNhap >= '2022-05-01' and p.NgayNhap <= '2022-06-31' group by c.ID ) v on  k.idcuahang=v.idkho  
  //    set k.datduoc=v.tongtien-v.vc
  //    
  //////////////////////////////////////////////////////////////
  //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In


  // $sql = "select Item,FunctionID from userright where  UserID  ='$id' and FunctionID = '10' " ;
  // $tam = $data->truyvan($sql);	



  $data1 = $_POST['DATA'];

  $tmp = explode('*@!', $data1);
  //   echo $data1 ;
  $loai  = trim($tmp[0]);

  $cuahang = (laso($tmp[0]));
  $thang = (chonghack($tmp[1]));
  $vung = (chonghack($tmp[2]));
  $tinhtrang =  chonghack($tmp[3]);
  $sapxep =  chonghack($tmp[4]);

  if ($thang == "") {
    echo "Vui lòng chọn ngày đầy đủ từ ngày tới ngày";
    return;
  }

  //  echo "<br>". $dt;


  if ($tinhtrang == '0') $sql_where .= " and a.sotien>= a.datduoc   ";
  if ($tinhtrang == '1') $sql_where .= " and a.sotien<= a.datduoc   ";


  if ($vung != '') $sql_where .= " and b.NameN= " . abs($vung);



  if ($cuahang != "") {
    $sql = " SELECT a.ID,a.sotien , a.datduoc , a.thangnam,b.Name as tencuahang , b.macuahang  as ma ,DATE_FORMAT(thangnam,'%d/%m/%Y') as ngay,  a.thangnam 
FROM doanhthukhoan a INNER JOIN cuahang b ON b.ID = a.idcuahang where a.macuahang = '$cuahang' and  a.thangnam = '$thang' " . $sql_where . " ORDER BY $sapxep";
  } else {
    $sql = " SELECT a.ID,a.sotien , a.datduoc , a.thangnam,b.Name as tencuahang , b.macuahang  as ma ,DATE_FORMAT(thangnam,'%d/%m/%Y') as ngay,  a.thangnam 
FROM doanhthukhoan a INNER JOIN cuahang b ON b.ID = a.idcuahang where a.thangnam = '$thang' " . $sql_where . " ORDER BY $sapxep";
  }
  echo $sql;

  if ($_SESSION["admintuan"])    echo $sql;
  //========================================================

  $result = $data->query($sql);
  //==============================================================	


  ?>

 <div style=" overflow:auto;width:99%;height:500px" class="col-md-6">
   <div style="color:#0000FF">Doanh thu đạt được đã trừ doanh thu online tại mỗi cửa hàng</div>
   <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">
     <tr bgcolor="#F8E4CB">
       <td align="center" height="23" width="41"><b>STT</b></td>
       <td width="201" align="center"><strong>Mã Cửa Hàng</strong></td>
       <td width="343" align="center"><strong>Tên Cửa hàng</strong></td>
       <td width="143" align="center"><strong>Ngày</strong></td>
       <td width="200" align="center"><strong>Số Tiền </strong></td>
       <td width="200" align="center"><strong>Đạt được</strong></td>
       <td width="200" align="center"><strong>Chỉ tiêu còn lại</strong></td>
       <td width="200" align="center"><strong>Chỉ tiêu 1 ngày</strong></td>
       <td width="200" align="center"><strong>Chỉ tiêu ngày còn lại</strong></td>
       <td width="200" align="center"><strong>Tỉ lệ</strong></td>
       <?php if ($ql[2]) { ?> <td width="143" align="center"><strong>Cập Nhập </strong></td>
         <td width="143" align="center"><strong>Xóa</strong></td> <?php } ?>
     </tr>

     <?php
      $IDCH = $_SESSION["se_kho"];
      if ($_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 2 || $_SESSION["LoginID"] == 983 || $_SESSION["LoginID"] == 604 || $IDCH == 1006 || $IDCH == 1013 || $tungay != "") $am = false;
      else $am = true;
      //echo   $am . "123" ;
      $r = 0;
      // if ($IDCH) $am = true ; else $am = false;
      while ($re = $data->fetch_array($result)) {
        $r++;
        if ($mau == "white") {
          $mau = "#EEEEEE";
          $hl = "Normal4";
          $hl2 = "Highlight4";
        } else {
          $mau = "white";
          $hl = "Normal5";
          $hl2 = "Highlight5";
        }

        //====== Tính số tiền cần đạt được / 1 ngày ======//
        $ngayhientai = date("Y-m-d");
        if (!empty($thang) && date("m") != date("m", strtotime($thang))) {
          $ngayhientai = date("Y-m-t", strtotime($thang));
        }
        $ngaycuoithang = date("Y-m-t", strtotime($ngayhientai));
        $songaycon = DateDiffInterval($ngayhientai, $ngaycuoithang, "D");
        $sotiencon = 0;
        $songay1thang = date("t", strtotime($ngayhientai));
        $tongsotien += $re['sotien'];
        $tongdat += $re['datduoc'];
        $chitieu = $re['sotien'];
        $dadat = $re['datduoc'];
        $sotiencon = ($chitieu - $dadat) / ($songaycon + 1);

        if (date("m") == date("m", strtotime($thang))) {
          $songaycon += 1;
        }

      ?>
       <tr title="<?php echo addslashes($re['note']) ?>" onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'" bgcolor="<?php echo $mau; ?>">
         <td align="right"><?php echo $r; ?> </td>
         <td><?php echo $re['ma']; ?></td>
         <td><?php echo $re['tencuahang']; ?></td>
         <td align="center"><?php echo $re['ngay']; ?></td>

         <td align="center"><?php echo formatso($re['sotien']); ?></td>
         <td align="center"><?php echo formatso($re['datduoc']); ?></td>
         <td align="center"><?php echo formatso($chitieu - $dadat); ?></td>
         <td align="center"><?php echo number_format($chitieu / $songay1thang) . " x " . $songay1thang . " ngày"; ?></td>
         <td align="center"><?php echo formatso($sotiencon) . " x " . ($songaycon) . " ngày"; ?></td>
         <td align="center"><?php echo round($re['datduoc'] * 100 / $re['sotien'], 2) . '%'; ?></td>
         <?php if ($ql[2]) { ?>
           <td align="center"><a href="default.php?act=doanhthukhoan&id=<?php echo $re['ID']; ?>"> <img src="images/book_addressHS.png" border="0"></a> </td>
           <td align="center"><a onclick='return ask()' href="default.php?act=doanhthukhoan&Del=<?php echo $re['ID']; ?>"><img src="images/delete.gif" border="0"></a></td>
         <?php } ?>
       </tr>
     <?php
      }

      ?>
     <tr title="<?php echo addslashes($re['note']) ?>" onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'" bgcolor="<?php echo $mau; ?>">
       <td align="right"> </td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td align="center">&nbsp;</td>

       <td align="center"><?php echo formatso($tongsotien); ?></td>
       <td align="center"><?php echo formatso($tongdat); ?></td>
       <td align="center">&nbsp;</td>
       <td align="center">&nbsp;</td>
       <td align="center">&nbsp;</td>
       <td align="center"><?php echo round($tongdat * 100 / $tongsotien, 2) . '%'; ?></td>
       <?php if ($ql[2]) { ?>
         <td align="center"><a href="default.php?act=doanhthukhoan&id=<?php echo $re['ID']; ?>"></a> </td>
         <td align="center"><a onclick='return ask()' href="default.php?act=doanhthukhoan&Del=<?php echo $re['ID']; ?>"></a></td>
       <?php } ?>
     </tr>
   </table>
 </div>
 <div style="padding:5px;">

   <?php
    //==============================================================	

    $data->closedata();

    function DateDiffInterval($sDate1, $sDate2, $sUnit = 'D')
    {
      //subtract $sDate2-$sDate1 and return the difference in $sUnit (Days,Hours,Minutes,Seconds)
      $nInterval = strtotime($sDate2) - strtotime($sDate1);
      if ($sUnit == 'D') { // days
        $nInterval = $nInterval / 60 / 60 / 24;
      } else if ($sUnit == 'H') { // hours
        $nInterval = $nInterval / 60 / 60;
      } else if ($sUnit == 'M') { // minutes
        $nInterval = $nInterval / 60;
      } else if ($sUnit == 'S') { // seconds
      }
      return $nInterval;
    }
    ?>