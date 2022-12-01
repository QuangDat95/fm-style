      <script>
    function renderTime() {
        var currentTime = new Date();
        var diem = "AM";
        var h = currentTime.getHours();
        var m = currentTime.getMinutes();
        var s = currentTime.getSeconds();
        setTimeout('renderTime()',1000);
        if (h == 0) {
            h = 12;
        } else if (h > 12) { 
            h = h - 12;
            diem="PM";
        }
        if (h < 10) {
            h = "0" + h;
        }
        if (m < 10) {
            m = "0" + m;
        }
        if (s < 10) {
            s = "0" + s;
        }
        var myClock = document.getElementById('clockDisplay');
        myClock.textContent = h + ":" + m + ":" + s + " " + diem;
        myClock.innerText = h + ":" + m + ":" + s + " " + diem;
    }
    renderTime();
</script>
 <div class="col-md-4">
                  <div id="clockDisplay" style="font-size: 20px; color:#000;font-family: 'Times New Roman', Times, serif;"></div>
                      <span style="color:#000;font-size:25px;" >{homnay}</span>
 </div>
<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card" style="margin-top:100px; padding:20px; border:1px solid #ddd;">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						 <img src="img/logo-fm.png" alt="logo" width="100" height="100" class="img-fluid">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="" placeholder="Tên đăng nhập" required />
							
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="Mật khẩu" required />
							
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Ghi nhớ mật khẩu</label>
							</div>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" class="btn btn-primary">ĐĂNG NHẬP 
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
				   </div>
					</form>
				</div>
		
				<!--<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div>
				</div> -->
			</div>
		</div>
	</div>
