<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
  <script src="cssm/jquery-1.11.1.min.js"></script>
     <script src="cssm/bootstrap.min.js"></script>
     
     

</head>

<body>
<div id="loading">loading</div>
<button onclick="testajax()">Gửi Ajax</button>
<button onclick="stopRequest()">Stop Ajax</button>
<button onclick="chuyentrang()">Chuyển hướng</button>
<script type="text/javascript" src="js/function.js"></script>
<script language=JavaScript src="js/load.js"></script>
<script>
function testajax(){
	 poststr="test="+ encodeURIComponent(0); 
	 loadtrang('loading', "testajaxserver", poststr,"xuly1") ;
}
function xuly1(){

}	

function chuyentrang(){
	stopRequest();
	window.location="https://fmstyle.com.vn/products/0-5683-khoac-nam-titke.html";
}

function stopRequest(){

 	requests.forEach(function(request) {
 	 	request.abort()
			
	})
	document.getElementById("loading").innerHTML="ok";
}
</script>
</body>
</html>
