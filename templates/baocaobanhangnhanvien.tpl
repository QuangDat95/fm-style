<style> .wrapper{ 	width:100%; 	height:140vh; } .header { width:100%; }</style>
<div class="top_space"></div>
<div class="nenbao">
  <div class="nencon">
    <legend> <a style="cursor:pointer">
        <label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;">Báo cáo bán hàng nhân viên</label>
      </a></legend>

    <form name="frmttk" method="post">
      <div style="display:none" id="hthuongdan"> </div>
      <div id="codechinh">
        <!-- BEGIN: block_proht1 -->


        <div style="padding-bottom:10px">
		
          <input type="checkbox" id='nangcao' name='nangcao' title="Tìm nâng cao từ trái sang phải" checked="checked"
            value="1" />
  <input onkeypress="return chuyentieps(event,'IDNV')" placeholder="Số bill" type="text" name="sobill"
            id="sobill" ondblclick="this.value=''"  value="{sobill}" />
          <input onkeypress="return chuyentieps(event,'IDNV')" placeholder="Mã SP" type="text" name="codeprotk"
            id="codeprotk" ondblclick="this.value=''" size="5" value="{codeprotk}" />

          <input onkeypress="return chuyentieps(event,'IDNV')" type="text" placeholder="mô tả SP" name="mota" id="mota"
            ondblclick="this.value=''" size="9" value="{mota}" />
          &nbsp; <input onkeypress="return chuyentiep(event,'codeprotk')" type="text" placeholder="Tên SP" name="NameTK"
            id="NameTK" ondblclick="this.value=''" size="9" value="{NameTK}" />
          <input onkeypress="return chuyentiep(event,'codeprotk')" type="text" placeholder="Ghi chú" name="ghichu"
            id="ghichu" ondblclick="this.value=''" size="15" value="{ghichu}" />
          <select class="js-nv" onkeypress="return chuyentiep(event,'search')" name="IDNV" id="IDNV"
            style="width:120px">
            {nhanvien}
          </select>
          &nbsp;

          <select onkeypress="return chuyentieps(event,'kho')" name="IDGrouptk" id="IDGrouptk"
            style="width:79px;display:none">
            <option value="">Nhóm SP</option>

            {cay}

          </select>
          &nbsp;
          <select onkeypress="return chuyentiep(event,'search')" name="tinhtrangdon" id="tinhtrangdon"
            style="width:120px">
            <option value="">Tình trạng đơn</option>
            <option value="8">Đơn hoàn</option>
            <option value="1">Đơn thành công </option>
            <option value="0">Đơn đang xử lý</option>
            <option value="2">Đơn không có mã vận đơn </option>
            <option value="3">Đơn không có tình trạng cuối </option>
            <option value="4">Đơn tự động lấy từ thu chi kế toán qua chưa xử lý </option>
			 <option value="5">Đơn gối đầu </option>
          </select>
          <select onkeypress="return chuyentieps(event,'kho')" name="nganh" id="nganh" style="width:85px;display:none">
          </select>
          <input type="hidden" placeholder="kho" name="kho" id="kho" value="0" />
          <select onkeypress="return chuyentieps(event,'kho')" name="nganh" style="width:85px;display:none">
            <option value="">Ngành hàng</option>

            {nganhhang}



          </select>


          <select onkeypress="return chuyentiep(event,'search')" name="luachon" id="luachon" style="width:130px">
		   <option value="-9">Tất cả bill online hệ thống</option>
            <option value="">Tất cả</option>
            <option value="-11">Chỉ bill online Miền trung</option>
            <option value="-12">Chỉ bill online Miền Nam</option>
            <option value="-13">Bill từ Các kho online</option>
           
            <option value="1">Có giảm giá</option>
            <option value="2">không giảm giá</option>
            <option value="3">Voucher</option>
            <option value="4">Thành Viên</option>
            <option value="-5">Khách lẻ</option>
            <option value="-6">Thương mại điện tử</option>
			
            {lydo}
          </select>
          Từ
          <input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay" placeholder="Tạo đơn"
            id="tungay" class="text" style="width:65px" value="{tungay}" />
          <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
            title="Date selector" onclick="displayCalendar(frmttk.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
          <input onkeypress="return chuyentiep(event,'htchitiet')" type="text" name="denngay" id="denngay" class="text"
            style="width:65px" value="{denngay}" />
          <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
            title="Date selector" onclick="displayCalendar(frmttk.denngay,'dd/mm/yyyy',this)" />&nbsp;
          TT cuối Từ
          <input onkeypress="return chuyentiep(event,'denngay')" type="text" placeholder="Ngày cuối" name="tucuoi"
            id="tucuoi" class="text" style="width:65px" value="{tungay}" />
          <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
            title="Date selector" onclick="displayCalendar(frmttk.tucuoi,'dd/mm/yyyy',this)" />&nbsp;đến
          <input onkeypress="return chuyentiep(event,'htchitiet')" type="text" placeholder="Ngày cuối" name="dencuoi"
            id="dencuoi" class="text" style="width:65px" value="{denngay}" />
          <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
            title="Date selector" onclick="displayCalendar(frmttk.dencuoi,'dd/mm/yyyy',this)" />&nbsp;

          <input type="button"
            onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'0',nganh.value,0,ghichu.value,tinhtrangdon.value,tucuoi.value,dencuoi.value,sobill.value)"
            name="search" style="width:55px" id="search" value="Chi tiết" />

          <input type="button"
            onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'1',nganh.value,0,ghichu.value,tinhtrangdon.value,tucuoi.value,dencuoi.value,sobill.value)"
            title="Khi gộp số tiền có thể không chính xác do cùng 1 sản phẩm có thể giá bán khác nhau !" name="search2"
            style="width:40px" id="search2" value="Gộp" />

          <input type="button"
            onclick="return submitdoanhthusale(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'0',nganh.value,0,ghichu.value,tinhtrangdon.value,tucuoi.value,dencuoi.value,1)"
            title="Báo cáo doanh thu Sale" name="search3" style="width:75px" id="search3" value="BCDT Sale" />
 
 
 <input type="button"
            onclick="return submitdoanhthusale(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'1',nganh.value,0,ghichu.value,tinhtrangdon.value,tucuoi.value,dencuoi.value,2)"
            title="Báo cáo doanh thu CH" name="search3" style="width:75px" id="search3" value="BCDT CH" />
 <input type="button"
            onclick="return submitluongonline(tungay.value,denngay.value,tucuoi.value,dencuoi.value,IDNV.value,3)"
            title="Báo cáo lương Online" name="search32" style="width:auto" id="search32" value="BC Lương OL" />
 <!-- BEGIN: block_capnhap -->
          <input type="button"
            onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'9',nganh.value,0,ghichu.value,tinhtrangdon.value,tucuoi.value,dencuoi.value)"
            name="search22" style="width:40px" id="search22" title="Cập nhập mã vận đơn trống " value="Xử lý " />

          <input type="button"
            onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'8',nganh.value,0,ghichu.value,tinhtrangdon.value,tucuoi.value,dencuoi.value)"
            name="search22" style="width:180px" id="search22" title="Đơn đã tiếp nhận  quá 10 ngày"
            value="Đã tiếp nhận  quá 10 ngày" />
          <!-- END: block_capnhap -->
        </div>
        <div id="httim" >

        </div>
        <div style="padding:10px">
          <input type="button" name="timnhap3" id="timnhap3" style="width:90px" onclick="matdinh()" value="Đóng lại" />
          <span style="padding-bottom:10px">
            <input type="button" style="font-size: 12px; width: 40px;" id="xuat" value="Excel" name="xuat"
              onclick="xuatkq()" />
          </span>
        </div>
      </div>
    </form>

    <form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank">
      <input name="noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
      <input name="tenfile" id="tenfile" type="hidden" value="baocaocuahang.xls">
      <input name="loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
    </form>




    <script language="javascript">
      document.getElementById('NameTK').focus();
    </script>
    <!-- End: block_proht1 -->


    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/select2.min.js"></script>
    <link rel="stylesheet" media="screen" href="js/select2.min.css">

    <script language="javascript">

      $(document).ready(function () {
        $('.js-ch').select2();
        $('.js-nv').select2();
      });
      function xuatkq() {

        document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><html><body>' + document.getElementById("httim").innerHTML + "</body></html>";
        // alert( document.getElementById("ketqua").value);
        document.getElementById("xuatketqua").submit();
      }
		 function submitluongonline(t1, t2, t3, t4,t5) {
		
					poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!"+ encodeURIComponent(t5) + "*@!";
					loadtrang('httim', "thuchiktbaocaoluongonl", poststr, "");
		 }
      function submitdoanhthusale(t1, t2, t3, t4, t5, t6, t7, tr, t9, t10, t11, t12, t13, t14, t15, t16, t17, t18,loai='') {

        poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
        poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(tr) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12) + "*@!" + encodeURIComponent(t13) + "*@!" + encodeURIComponent(t14) + "*@!" + encodeURIComponent(t15) + "*@!" + encodeURIComponent(t16) + "*@!" + encodeURIComponent(t17) + "*@!" + encodeURIComponent(t18);
		if(loai==1){
		
       	loadtrang('httim', "baocaodoanhthusale", poststr, "");
		}
		else{
			loadtrang('httim', "baocaodoanhthuch", poststr, "");
		}

      }
 function submittk(t1, t2, t3, t4, t5, t6, t7, tr, t9, t10, t11, t12, t13, t14, t15, t16, t17, t18,t19) {

        poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
        poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(tr) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12) + "*@!" + encodeURIComponent(t13) + "*@!" + encodeURIComponent(t14) + "*@!" + encodeURIComponent(t15) + "*@!" + encodeURIComponent(t16) + "*@!" + encodeURIComponent(t17) + "*@!" + encodeURIComponent(t18)+ "*@!" + encodeURIComponent(t19);
        if (t12 == 2) loadtrang('httim', "baocaonhanvienonline", poststr, "");
        else if (t12 == 3) loadtrang('httim', "baocaodoanhthusale", poststr, "");
        else loadtrang('httim', "baocaobanhangnhanvientim", poststr, "");

      }

      function xemchitiet(id, tu, den, k) {
        var st;
        st = "thontinkhochitiet.php?id=" + id + '&tu=' + tu + '&den=' + den + '&k=' + k;
        window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=840,titlebar=no');

      }
      loadhuongdan('thongtinkho');
    </script>

  </div>
</div>