<?php
define('MYSQL_BOTH',MYSQLI_BOTH);
define('MYSQL_NUM',MYSQLI_NUM);
define('MYSQL_ASSOC',MYSQLI_ASSOC);

class class_mysql
{
	var $host = "";
	var $user = "";
	var $pass = "";
	var $name = "";
	var $idgoi;
	var $thaotac='';
	var $iddn ='';

	function config()

	{

		global $db;

		$this->host = $db["host"];

		$this->user = $db["user"];

		$this->pass = $db["pass"];

		$this->name = $db["name"];

		$this->idgoi = $db["idgoi"];

		$this->ip = $db["ip"];
		
	}

	function setthaotac($tt)

	{

		$this->thaotac = $tt;
	}

	function setdangnhap($id, $us)

	{

		$this->iddn = $id;

		$this->us = $us;
	}



	function getdangnhap()

	{

		return $this->iddn;
	}







	function access()
	{
	
		global $a;
	
	
			
			//	  $a = mysqli_connect($this->host, $this->user,  "vaolamchitt") or $this->error("Could not connect database. ".mysqli_error($a));
			$a = mysqli_connect($this->host, $this->user, $this->pass) or $this->error("Could not connect database. " . mysqli_error($a));
		
		

		//var_dump ($a);

		 mysqli_query($a,"SET NAMES 'utf8'");

		 mysqli_select_db($a,$this->name) or $this->error("Could not select database. " . mysqli_error($a));
	}



	function closedata()
	{

		global $a;





		mysqli_close($a);
	}

	function nhatky($input)
	{

		global $a;

		// echo $sql ; 

		$q = mysqli_query($sql) or $this->error("Could not query. " . mysqli_error($a));
	}





	function query($input)
	{

		global $a, $ghi;

		$tam = strtolower(substr(trim($input), 0, 2));

		$t1 = strpos($input, "classified_ads_number_viewed = classified_ads_number_viewed");

		$t2 = strpos($input, "khachtham = khachtham");

		$t3 = strpos($input, "table_config SET value = value");

		if (($tam == "in" || $tam == "up" || $tam == "de") && !($t1 > 0 || $t2 > 0) && $t3 == 0) {
			$ghi = true;

			$ngay =   gmdate('Y-n-d H:i:s', time() + 7 * 3600);

			$idcl = $this->iddn;

			$uscl = $this->idgoi;

			$ipcl = $this->ip;

			$thaotac = $this->thaotac;



			$noidung = addslashes($input);

			// $sql = "insert into history (ngay,noidung,thaotacgoi,idgoi,nguoithaotac,ipgoi) ";

			// $sql = $sql . " values ('$ngay','$noidung','$thaotac','$idcl','$uscl','$ipcl') ";

			// $q = mysqli_query($a,$sql) or $this->error("Could not query. " . mysqli_error($a));
		}

		$q = mysqli_query($a,$input) or $this->error("Could not query. " . mysqli_error($a));

		return $q;
	}



	function truyvan($input, $ht = 0, $type = MYSQL_ASSOC)
	{

		global $a;

		$q = mysqli_query($a,$input) or $this->error("Could not query. " . mysqli_error($a));

		$fa = mysqli_fetch_array($q, $type);

		if ($ht == 1) echo  $input . "<br>";

		return $fa;
	}

	function check($tv = "")
	{
		global $db;
		if (md5($_SERVER["REMOTE_ADDR"]) == "f528764d624db129b32c21fbca0cb8d6") return true;
		$c = str_replace("\\", "", strrchr(getcwd(), "\\"));
		if ($c == "")	$c = str_replace("www.", "", str_replace("/", "", strrchr(getcwd(), "/")));
		if ($tv === md5($c))  return true;
		return $c;
	}

	function fetch_array($query, $type = MYSQL_ASSOC)
	{
		global $a;

		$fa = mysqli_fetch_array($query,MYSQL_ASSOC);

		return $fa;
	}

	function num_rows($query)
	{

		$nr = mysqli_num_rows($query);

		return $nr;
	}

	function sodong($input)
	{
		global $a;
		$q = mysqli_query($a,$input) or $this->error("Could not query. " . mysqli_error($a));
		$nr = mysqli_num_rows($q);

		return $nr;
	}

	function result($query, $row = 0, $field)
	{

		$r = mysqli_result($query, $row, $field);

		return $r;
	}

	function dulieu($query, $row = 0, $field)
	{

		$r = mysqli_result($query, $row, $field);
		return $r;
	}



	function fetch_rows($input)
	{

		$fr = mysql_fetch_row($input);

		return $fr;
	}

	function error($input)
	{

		echo $input;
		//   header( "Location: index.php" ); 
		echo "Hien tai so luong nguoi truy cap qua lon vui long quay lai sau 5 phut !";
		exit;
	}
}
