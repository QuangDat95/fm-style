<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!--<li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
		<i class="nav-icon far fa-plus-square"></i>
		Tạo nhanh
		</a>
		<div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">    
		      
          {menu_taonhanh}		  	
		</div>
      </li> -->
      
    </ul> 

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      
      <!-- Dropdown Menu -->
      <!--<li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
          <span class="badge badge-warning navbar-badge">6</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><B>MENU HRM</B></span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 
			Nhân sự            
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i>
			Tuyển dụng
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> Chấm công
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> Bảng lương
          </a>
		  <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> Đào tạo
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> KPI
          </a>
		  </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <!--<i class="fas fa-th-large"></i> -->
		  {hovaten}
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
	<div class="os-content" style="padding: 16px; height: 100%; width: 100%;">	
	<div class="mb-1"><span><a href="?act=user&uid={uid}&action=info" class="nav-link"><i class="nav-icon fas fa-edit"></i>&nbsp;&nbsp;Tài khoản</a></span></div>
	<hr class="mb-1"></hr>
	<div class="mb-1"><span><a href="?act=user&uid={uid}&action=password" class="nav-link"><i class="nav-icon fas fa-edit"></i>&nbsp;&nbsp;Mật khẩu</a></span></div>
	<hr class="mb-1"></hr>
	<div class="mb-1"><span><a href="?act=user&uid={uid}&action=logout" class="nav-link"><i class="fas fa-circle nav-icon"></i>&nbsp;&nbsp;Đăng xuất</a></span></div>
	<hr class="mb-1"></hr>
	</div>
  </aside>
  <!-- /.control-sidebar -->