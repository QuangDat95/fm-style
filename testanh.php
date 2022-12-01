<?php
	// *** Include the class
    include("resizeimg.php");
    // *** 1) Initialize / load image
    $resizeObj = new resize('upload/anhgoc.jpg');
 	//$newH= $resizeObj->getSizeByFixedWidth(500);
    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
  	$resizeObj -> resizeImage(480, 480, 'portrait');
    // *** 3) Save image
    $resizeObj -> saveImage('upload/anhgoc1.jpg', 100);
?>