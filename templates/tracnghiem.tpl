

<link rel="stylesheet" href="tracnghiem/style.css">

<form name="frmxuat" id="frmxuat"  method="get"   >

<div  class="nenbao">

<div align="center" style="padding:0px"> 

<fieldset   class="nencon" style="width: 99%">

	<legend align="center" style="Color: rgba(250, 250, 250, 0.94);background: rgba(8, 115, 191, 0.88);padding: 3px 7px 4px 7px; border-radius: 5px;"> 
		<a style="cursor:pointer"  >

			<label style="color:#ffffff; " class="fieldset_name" >Trắc nghiệm</label>
		</a> 
		<div id='error_chaomung' class="okidone" style='display:none'>
			<img src="images/load.gif" style="width: 35px;"><br><b>Trắc nghiệm</b>
			<!-- <i class="error-triangle"> </i> -->
		</div>
		<div id='error_luu' class="okidone" style='display:none'>
			<img src="images/checkdone.png" style="width: 35px;"><br><b>Hoàn thành</b> kiểm tra!
			<!-- <i class="error-triangle"> </i> -->
		</div>
		<div id='error_capnhat' class="okidone" style='display:none'>
			<img src="images/checkdone.png" style="width: 35px;"><br><b>Cập nhật</b> thành công!
			<!-- <i class="error-triangle"> </i> -->
		</div>
		<div id='error_phuchoi' class="okidone" style='display:none'>
			<img src="images/recycling-254259_640_vectorized.png" style="width: 35px;"><br><b>Phục hồi</b> thành công!
			<!-- <i class="error-triangle"> </i> -->
		</div>
		<div id='error_huyphieu' class="okidone" style='display:none'>
			<img src="images/trash-circle-red.png" style="width: 35px;"><br><b>Hủy phiếu (Xóa)</b> thành công!
			<!-- <i class="error-triangle"> </i> -->
		</div>
		<div id='error_khoaphieu' class="okidone" style='display:none'>
			<img src="images/Lock1.ico" style="width: 35px;"><br><b>Khóa Phiếu</b> thành công!
			<!-- <i class="error-triangle"> </i> -->
		</div>
	</legend>
	
	<div id="container" class="container">
        <div id="start" class="start">Bắt đầu >></div>
        <div id="quiz" style="display: none">
            <div id="question"></div>
            <div id="question_id" style="display:none "></div>
            <div id="qImg" style="display: none"></div>
            <div id="choices">
                <div class="choice" id="A" onclick="checkAnswer('A')"></div>
                <div class="choice" id="B" onclick="checkAnswer('B')"></div>
                <div class="choice" id="C" onclick="checkAnswer('C')"></div>
                <div class="choice" id="D" onclick="checkAnswer('D')"></div>
            </div>
            <div id="timer">
                <div id="counter"></div>
                <div id="btimeGauge"></div>
                <div id="timeGauge"></div>
            </div>
            <div id="progress"></div>
        </div>
        <div id="scoreContainer" style="display: none">Kết quả: </div>
    </div> 

</fieldset>
 
</div>

</div>

</form>
<div id="khonghienthi"></div>













<script language="JavaScript" onload="">
	//$('#error_chaomung').stop().fadeIn(100).delay(1500).fadeOut(100); //fade out after 2 seconds
	// create our questions
	//var danhsachcauhoi =  document.getElementById("danhsachcauhoi").innerHTML;
	let questions = [
	      {danhsachcauhoi}     
	];

</script>
<script src="templates/tracnghiem.js"></script>