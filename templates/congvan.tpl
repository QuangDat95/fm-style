<!DOCTYPE html>
  <html lang="vi">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <head>
  <meta charset="utf-8">
  <title>Tạo Tree menu bằng Bootstrap- hocwebgiare.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap.min.css">
  <link rel="stylesheet" href=" https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap.min.css">
  
  <style type="text/css">
  *, *::before, *::after {
    box-sizing: border-box
  }
  
  
  .avatar {
    width: 26px;
    height: 25px;
  
    background-image: url('https://cdn.iconscout.com/icon/free/png-256/download-folder-1404293-1188162.png');
    background-size: cover;
    background-position: center;
    position: relative;
  }
  
  .tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
  }
  .tree ul {
    margin-left:1em;
    position:relative
  }
  .tree ul ul {
    margin-left:.5em
  }
  .tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
  }
  .tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
  }
  
  .tree ul li:before {
    content:"";
    display:block;
    width:5px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
  }
  .tree ul li:last-child:before {
    background:#99CCFF;
    height:auto;
    top:1em;
    bottom:0
  }
  .indicator {
    margin-right:5px;
  }
  .tree li a {
    text-decoration: none;
    color:#369;
  }
  .tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
  }
  
  #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 59%;
  }
  
  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers tr:hover {background-color: #ddd;}
  
  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #04AA6D;
    color: white;
  }
  </style>
  <script src="js/jquery-1.11.1.min.js.download"></script>
  <script src="js/bootstrap.min.js.download"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    
  <div class="container">
    <div class="row"   style=" display: flex;
    justify-content: flex-start;" >
      <div class="col-md-4" >
        
        <ul >
        <li  id="tree1">
          {item}
        </li>
      </ul>
    </div>
    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
      <thead>
          <tr>
              <th style="color:red">Name</th>
              <th style="color:red">Loại</th>
              <th style="color:red">Người Tạo</th>
              <th style="color:red">Ngày Tạo</th>
              <th style="color:red">Ngày Nhận</th>
              <th style="color:red">Số</th>
          </tr>
      </thead>
      <tbody>
            <!-- BEGIN:block_congvan -->
            <tr>
              <td>
                <a href="default.php?act=test&id={bid}" width="690" height="800" style="margin-right: 1em;">
               <img src="https://cdn.iconscout.com/icon/free/png-256/download-folder-1404293-1188162.png" width="30px" height="30px">{Name}
                </a>
            </td>
              <td>
            {mota}</td>
            <td>
              {ma}</td>
              <td>
                {ngaytao}</td>
                <td>
                  {ngaytao}</td>
                  <td>
                    {files}</td>
            </tr>
            <!-- END:block_congvan -->
    
            </tr>
            <!-- BEGIN:block_chitietcongvan -->
            <tr>
              <td>
                <a href="data/{filechitiet}" width="690" height="800" style="margin-right: 1em;">
               <img src="https://cdn.iconscout.com/icon/free/png-256/download-folder-1404293-1188162.png" width="30px" height="30px">{filechitiet}
                </a>
            </td>
              <td>
            {filechitiet}</td>
            <td>
              {filechitiet}</td>
              <td>
                {filechitiet}</td>
                <td>
                  {filechitiet}</td>
                     <td>
                {filechitiet}</td>
            </tr>
            <!-- END:block_chitietcongvan -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
        </table>
  </div>
  
  </div>
  
  
     
  <script type="text/javascript">
  $.fn.extend({
      treed: function (o) {
        
        var openedClass = 'glyphicon-minus-sign';
        var closedClass = 'glyphicon-plus-sign';
        
        if (typeof o != 'undefined'){
          if (typeof o.openedClass != 'undefined'){
          openedClass = o.openedClass;
          }
          if (typeof o.closedClass != 'undefined'){
          closedClass = o.closedClass;
          }
        };
        
          //initialize each of the top levels
          var tree = $(this);
          tree.addClass("tree");
          tree.find('li').has("ul").each(function () {
              var branch = $(this); //li with children ul
              branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
              branch.addClass('branch');
              branch.on('click', function (e) {
                  if (this == e.target) {
                      var icon = $(this).children('i:first');
                      icon.toggleClass(openedClass + " " + closedClass);
                      $(this).children().children().toggle();
                  }
              })
              branch.children().children().toggle();
          });
          //fire event from the dynamically added icon
        tree.find('.branch .indicator').each(function(){
          $(this).on('click', function () {
              $(this).closest('li').click();
          });
        });
          //fire event to open branch if the li contains an anchor instead of text
          tree.find('.branch>a').each(function () {
              $(this).on('click', function (e) {
                  $(this).closest('li').click();
                  e.preventDefault();
              });
          });
          //fire event to open branch if the li contains a button instead of text
          tree.find('.branch>button').each(function () {
              $(this).on('click', function (e) {
                  $(this).closest('li').click();
                  e.preventDefault();
              });
          });
      }
  });
  
  $('#tree1').treed();
  </script>
  <script>
    jQuery(document).ready(function($) {
      $('#container a').on('click', function(e) {
          e.preventDefault();
          alert('Xử lý sự kiện click!');
      });
      $('#container').append('<a href="#">Click vào đây</a>');
  });</script>
  
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js  "></script>
  
  <script>
      $(document).ready(function() {
          var table = $('#example').DataTable( {
              responsive: true
          } );
      
          new $.fn.dataTable.FixedHeader( table );
      } );
  </script>
  <script>
    var indicator = document.querySelector('.nav-indicator');
    var items = document.querySelectorAll('.nav-item');
   function handleIndicator(el) {
        items.forEach(function (item) {
            item.classList.remove('is-active');
            item.removeAttribute('style');
        });
        indicator.style.width = "".concat(el.offsetWidth, "px");
        indicator.style.left = "".concat(el.offsetLeft, "px");
        indicator.style.backgroundColor = el.getAttribute('active-color');
        el.classList.add('is-active');
        el.style.color = el.getAttribute('active-color');
    }
   items.forEach(function (item, index) {
        item.addEventListener('click', function (e) {
            handleIndicator(e.target);
        });
        item.classList.contains('is-active') && handleIndicator(item);
    });
  </script>
  </body>
  </html>