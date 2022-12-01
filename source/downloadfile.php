<?php
$root_path = getcwd() . "/";
if(isset($_GET['files'])) {
    $file = $root_path."files/".$_GET['files']; 

    header("Content-Description: File Transfer"); 
    header("Content-Type: application/octet-stream"); 
    header("Content-Disposition: attachment; filename=\"". basename($file) ."\""); 

    readfile ($file);
    exit(); 
}
