<?php

include("./includes/api.php");





	$siteimg="https://data.fmstyle.com.vn/";
	$site="https://fmstyle.com.vn/";
	

$now = time();
$min='16:00:00';
$max='16:59:00';

if ($now>=strtotime($min) && $now <= strtotime($max)) {
	echo "product: <pre>";
 	var_dump(backupimages($siteimg,$site,'images/products'));
	echo "</pre><br/>";
	echo "banner: <pre>";
	var_dump(backupimages($siteimg,$site,'images/banner'));
	echo "</pre><br/>";
	echo "color: <pre>";
	var_dump(backupimages($siteimg,$site,'images/products/color'));
	echo "</pre><br/>";
	echo "categories: <pre>";
	var_dump(backupimages($siteimg,$site,'images/categories'));
	echo "</pre>ok";
  return;
}
echo $now;
return;

function listdir_by_date($path){

	$dir = $path;
	$i = 0;
	$tam=array();
	//here list of files of your directory with extension (jpg, jpeg, png) case insenstive
	if(is_dir($dir)) {
		$files = glob($dir . '/*.{jpg,JPG,jpeg,JPEG,png,PNG}', GLOB_BRACE);
		$currentDate = date("F d Y");
		if (!empty($files) && is_array($files)) {
			foreach ($files as $f) {
				if (date("F d Y", filemtime($f)) == $currentDate) {
					array_push($tam,$f);
				}
			}
		}
	}
	return $tam;

}


function backupimages($sitenhan,$sitegoi,$path){
	$countor = glob($path.'/*.*', GLOB_BRACE);
	echo "TotalOr: ";
	var_dump(count($countor));
	$original=listdir_by_date($path);
	
	$datatruyen  =  array(
				"link" => $sitegoi, 
				"mangfile" => $original,
				"path"=>$path,
			  ); 
	
				 $url =$sitenhan."nhanall.php";		
				
				 $make_call=callAPInoibo('POST',$url, json_encode($datatruyen));	 
				
	
	return $make_call;
}

?>