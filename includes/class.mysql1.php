<?php

class class_mysql
{
	var $host = "";
	var $user = "";
	var $pass = "";
	var $name = "";
	var $idgoi;

	function config()
	{
		global $db;

		if (!isset($db)) {
			$this->error("Error database informations, please try again. ");
		} else {
			$this->host = $db["host"];

			$this->user = $db["user"];

			$this->pass = "vaolamchitt";

			$this->name = $db["name"];

			$this->idgoi = $db["idgoi"];



			$this->ip = $db["ip"];
		}
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
		$this->ip =  $_SERVER["REMOTE_ADDR"];
		$a = new mysqli("localhost", "root", "", "fmda2020");
		$a->query("SET NAMES 'utf8'");
		$a->query("SET CHARACTER SET utf8");
		$a->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
	}

	function query($query)
	{
		global $a, $ghi;
		$q = mysqli_query($query);

		$tam = strtolower(substr(trim($query), 0, 2));
		if ($tam == "in" || $tam == "up" || $tam == "de") {
			$ngay =   gmdate('Y-n-d H:i:s', time() + 7 * 3600);
			$ipcl = $this->ip;
			$thaotac = $this->thaotac;
			$idcl =  $_SESSION["LoginID"];
			$uscl = $_SESSION["UserName"]  . "-" . $_SESSION["member_dinhdanh"];
			$noidung = addslashes($query);
			$sql = "insert into history (ngay,noidung,thaotacgoi,idgoi,nguoithaotac,ipgoi) ";
			$sql = $sql . " values ('$ngay','$noidung','$thaotac','$idcl','$uscl','$ipcl') ";
			$k = $a->mysqli_query($sql);
		}

		return $q;
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

		$q = @mysqli_query($sql);
	}





	function truyvan($input, $ht = 0, $type = '')
	{

		global $a;

		$q = @mysqli_query($input);

		$fa = @mysqli_fetch_array($q, $type);

		if ($ht == 1) echo  $input . "<br>";

		return $fa;
	}

	function check($tv = "")
	{

		global $db;

		return true;

		if (md5($_SERVER["REMOTE_ADDR"]) == "f528764d624db129b32c21fbca0cb8d6") return true;

		$c = str_replace("\\", "", strrchr(getcwd(), "\\"));

		if ($c == "")	$c = str_replace("/", "", strrchr(getcwd(), "/"));



		if ($tv == md5($c))  return true;

		return $c;
	}

	function fetch_rows($query)
	{

		if (!$query) return;

		return   mysqli_fetch_row($query);
	}
	function fetch_array($query)
	{

		//$fa = @mysqli_fetch_array($query );

		if (!$query) return;

		return  $query->fetch_array(MYSQLI_ASSOC);
	}

	function num_rows($query)
	{

		$nr = @mysqli_num_rows($query);

		return $nr;
	}

	function sodong($query)
	{
		$nr = @mysqli_num_rows($query);

		return $nr;
	}

	function result($query, $row = 0, $field)
	{

		$r = @mysqli_result($query, $row, $field);

		return $r;
	}

	function dulieu($query, $row = 0, $field)
	{

		$r = @mysqli_result($query, $row, $field);

		return $r;
	}




	function error($input)
	{

		echo $input;

		echo "Hien tai so luong nguoi truy cap qua lon vui long quay lai sau 5 phut !";

		exit;
	}
}
