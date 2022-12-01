
					<style>
							#qrcoderes{
									align-items: center;
							justify-content: center;
							width: 100%;
							
							
							height: 100vh;
							top: 0;
							
							left: 0;
							display:flex;
							}
							#qr{
								background-color:#FFFFFF;
								padding:0.5em;
							}
						</style>
						<div id="qrcoderes" style="" onclick="hideQRcode()">
							<div id="qr">
								
							</div>
						</div>
						
<script>
 
 var url_qr='{url_qr}';
jQuery(function (){
	$('#qr').qrcode({
		render: "canvas",
		text: url_qr, 
		width: 400, 
		height: 400,
		background: "#ffffff", 
		foreground: "#000000", 
		//src: 'jquery.qrcode-master/examples/qrcord.png',
		src: 'images/logoqr.png',
		imgWidth: 50,
		imgHeight: 50
	});
	
	
});
 
function showQRcode(){
	$('#qrcoderes').css("display","flex");
}
   
function hideQRcode()
{
	$('#qrcoderes').css("display","none");
}

</script>


