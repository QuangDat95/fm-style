<style>
  .wrapper {
    width: 100%;
    height: 140vh;
  }

  .header {
    width: 100%;
  }
</style>
<div class="top_space"></div>
<div class="top_space"></div>
<div class="nenbao">
  <fieldset class="nencon">
    <legend> <a style="cursor:pointer">
        <label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;">Báo cáo doanh thu</label>
      </a></legend>

    <form name="frmttk" method="post">
      <div style="display:none" id="hthuongdan"> </div>
      <div id="codechinh">
        <!-- BEGIN: block_proht1 -->

        <div style="padding-bottom:10px">
          <input onkeypress="return chuyentiep(event,'codeprotk')" placeholder="Tên SP" type="text" name="NameTK"
            id="NameTK" ondblclick="this.value=''" size="7" value="{NameTK}" />
          &nbsp; <input onkeypress="return chuyentieps(event,'IDNV')" placeholder="Mã SP" type="text" name="codeprotk"
            id="codeprotk" ondblclick="this.value=''" size="7" value="{codeprotk}" /> <input
            onkeypress="return chuyentieps(event,'IDNV')" placeholder="Mô tả SP" type="text" name="mota" id="mota"
            ondblclick="this.value=''" size="7" value="{mota}" />
          <input onkeypress="return chuyentiep(event,'codeprotk')" placeholder="Ghi chú" type="hidden" name="ghichu"
            id="ghichu" ondblclick="this.value=''" size="7" value="{ghichu}" />
          <input placeholder="IDNV" onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="IDNV" id="IDNV"
            style="width:35px" value="{IDNV}" ondblclick="this.value=''" />&nbsp;
          <select onkeypress="return chuyentieps(event,'kho')" name="IDGrouptk" id="IDGrouptk" style="width:95px"
            class="js-nhom">
            <option value="">Nhóm SP</option>
            {cay}
          </select>
          <select onkeypress="return chuyentieps(event,'kho')" name="nganhhang" id="nganhhang" style="width:68px">
            <option value="">Ngành</option>

            {nganhhang}

          </select>
          &nbsp;CH
          <select onkeypress="return chuyentiep(event,'search')" name="kho" id="kho" style="width:130px" class="js-ch">
            {tatca}
            {kho}

          </select>

          <select onkeypress="return chuyentiep(event,'search')" name="khuvuc"
            style="display:{hienthikhuvuc};width:90px" id="khuvuc">
            <option value=''>Mọi khu vực</option>
            {tatcakv}
            {khuvuc}
            {mien}
          </select>

          <select onkeypress="return chuyentiep(event,'search')" name="luachon" id="luachon" style="width:60px">
            <option value="">Tất cả</option>
            <option value="1">Có giảm giá</option>
            <option value="2">không giảm giá</option>

            <option value="3">Voucher</option>
            <option value="4">Thành Viên</option>
            <option value="-1">Không tư vấn ca 1</option>
            <option value="-2">Không tư vấn ca 2</option>
            <option value="-5">Khách lẻ</option>
            <option value="-6">Thương mại điện tử</option>
            <option value="-7">Tổng 1,2,3,7,kids,SPO</option>
            <option value="-8">Tất cả bill online</option>

            {lydo}
          </select>
          <span style="padding-bottom:10px;line-height:30px;text-align:center">
            <select name="ncc" id="ncc" class="js-nhacc" style="width:110px;height:20px;display:{quyenncc}"
              onkeypress="return chuyentiep(event,'IDGrouptk')">
              <option value="0">NCC</option>
              {nhacc}
            </select>
          </span>
          Từ
          <input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay" id="tungay" class="text"
            style="width:67px" value="{tungay}" />
          <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
            title="Date selector" onclick="displayCalendar(frmttk.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
          <input onkeypress="return chuyentiep(event,'htchitiet')" type="text" name="denngay" id="denngay" class="text"
            style="width:67px" value="{denngay}" />
          <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
            title="Date selector" onclick="displayCalendar(frmttk.denngay,'dd/mm/yyyy',this)" />
          &nbsp; &nbsp; <input type="button" style="font-size: 12px;  " id="xuat" value="Excel" name="xuat"
            onclick="xuatkq()" />

          <div style="padding-top:5px"><input type="button" title="Tổng Quát"
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,-1,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search2" style=" " id="search2" value="Tổng Quát" />
            <input type="button" title="Báo cáo cửa hàng "
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,1,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search2" style=" " id="search2" value="BC của hàng" /> &nbsp;
            <input type="button" title="Báo cáo cửa hàng theo ngày "
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,2,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search22" style=" " id="search22" value="BCCH-ngày" />
            <input type="button" title="Báo cáo doanh thu theo nhân viên thu ngân "
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search" style=" " id="search" value="BCDT Thu Ngân" />
            <input type="button" title="Báo cáo doanh thu theo nhân viên bán hàng "
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,8,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search7" style=" " id="search7" value="BCNV Bán Hàng" />
            <input type="button" title="Báo cáo doanh thu theo nhân viên thu ngân "
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,14,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search5" style=" " id="search5" value="BCDT Nhóm" />
            <input type="button" title="Báo cáo doanh thu theo nhân viên thu ngân "
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,15,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search52" style=" " id="search52" value="BCDT Ngành" />
            <input type="button" title="Báo cáo doanh thu theo nhân viên bán hàng "
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,12,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search73" style=" " id="search73" value="BC Taget" />
            <input type="button"
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,9,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search72" style=" " id="search72" value="Tổng hợp giảm giá"
              title="Nhân viên bán được bao nhiêu % giảm > số và < số và không giảm giá" />
            <input type="button"
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,10,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search7222" style=" " id="search7222" value="BC tháng"
              title="Báo cáo doanh thu từng tháng của 1 cửa hàng" />
            <input type="button"
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,11,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search722" style=" " id="search722" value="BC Team" title="Báo cáo Team" />
            <input type="button"
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,6,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search3" style=" " id="search3" value="Ca 1" />
            <input type="button"
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,7,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search4" style=" " id="search4" value="Ca 2" />
            <input type="button" title="Tổng Quát"
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,-2,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search23" style=" " id="search23" value="TB Bill" />
            <input type="button" title="Tổng Quát"
              onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,-3,nganhhang.value,mota.value,luachon.value,khuvuc.value,ghichu.value,ncc.value)"
              name="search232" style=" " id="search232" value="Tỉ lệ hoàn" />
          </div>
          <div id="httim">

          </div>
          <div style="padding:10px;display:none" align="right">
            <input type="button" name="timnhap32" id="timnhap32" style="width:90px" onclick="huongdan()"
              value="Hướng Dẫn" />
            <input type="button" name="timnhap3" id="timnhap3" style="width:90px" onclick="matdinh()"
              value="Đóng lại" />
          </div>
        </div>
    </form>
    <form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank">
      <input name="noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
      <input name="tenfile" id="tenfile" type="hidden" value="baocaodoanhthu.xls">
      <input name="loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
    </form>


    <!-- End: block_proht1 -->


    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/select2.min.js"></script>
    <link rel="stylesheet" media="screen" href="js/select2.min.css">

    <script language="javascript">

      $(document).ready(function () {
        $('.js-ch').select2();
        $('.js-nhom').select2();
        $('.js-nhacc').select2();


      });

      function xuatkq() {
        document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><html><body>' + document.getElementById("httim").innerHTML + "</body></html>";
        // alert( document.getElementById("ketqua").value);
        document.getElementById("xuatketqua").submit();
      }

      document.getElementById('NameTK').focus();

      function submittk(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t13, t14) {


        poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
        poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12) + "*@!" + encodeURIComponent(t13) + "*@!" + encodeURIComponent(t14);
        if (t8 == 10 && t4 == '') { alert('Vui lòng chọn cửa hàng'); return; }
        if (t8 == 9) loadtrang('httim', "baocaodoanhthutimth", poststr, "");
        else if (t8 == 11) loadtrang('httim', "baocaodoanhthuteamtim", poststr, "");
        else if (t8 == -1) loadtrang('httim', "baocaodoanhthutongquat", poststr, "");
        else if (t8 == -2) loadtrang('httim', "baocaodoanhthutbbill", poststr, "");
        else if (t8 == -3) loadtrang('httim', "baocaodoanhthutilehoan", poststr, "");
        else if (t8 == 14 || t8 == 15) loadtrang('httim', "baocaodoanhthunhomtim", poststr, "");
        else loadtrang('httim', "baocaodoanhthutim", poststr, "");

      }



      loadhuongdan('baocaodoanhthu');
    </script>

  </fieldset>
</div>