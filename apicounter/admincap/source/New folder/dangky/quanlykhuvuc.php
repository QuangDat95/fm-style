<?php
function tree($id_root, $level)
	{
		global $con, $Caytme,$mau,$stt,$q_cn,$q_xoa,$idcv; 
		
		$space="------------|";
		$ten1="";	 
		for($i=1; $i<$level; $i++)
		{
			$ten1.=$space;
		}
		$sql="SELECT * FROM  khuvuc WHERE IDcha='$id_root' and ID != 0";
		$query= query($sql);
		if($query){			
			while($result_news = fetch_array($query))
 			{   
			   $ten = "&nbsp;".$result_news["ten"] ."&nbsp;";
			   $diachi="&nbsp;".$result_news["diachi"] ."&nbsp;";
				$id = $result_news["ID"] ;
 			    $mottin ="&nbsp;".$result_news["ten"] ;
				 $stt = $stt +1 ;
 				if ( $result_news["IDcha"] != "0" )				
				{  
  					$col="<td align='center'>$stt</td><td align='left'>$space.$ten</td><td align='left'>$diachi</td><td align='center'><button class='btn btn-success' style='padding:0.3em'><a href='?act=quanlykhuvuc&id=".$id."' style='color:white'>Sửa</a></button><button class='btn btn-danger' style='padding:0.3em'><a href='?act=quanlykhuvuc&del=".$id."' style='color:white'>Xóa</a></button></td>";
				}else
				{				
					$col="<td  align='center'>$stt</td><td align='left'>$ten</td><td align='left'>$diachi</td><td align='center'><button class='btn btn-success' style='padding:0.3em'><a href='?act=quanlykhuvuc&id=".$id."' style='color:white'>Sửa</a></button><button class='btn btn-danger' style='padding:0.3em'><a href='?act=quanlykhuvuc&del=".$id."' style='color:white'>Xóa</a></button></td>";
				}	
				  

				$Caytme.="<tr>$col</tr>";				
				tree($id, $level+1);
			 
			}
		}
	}
 
 if(isset($_POST["btnupdate"])){
 	$IDcha=laso($_POST["idcha"]);
	$ten=$_POST["ten"];
	$diachi=$_POST["diachi"];
	$phongban=laso($_POST["phongban"]);
	
	if($IDcha=='' && $phongban==''){
		$phongban=numUniqe();
		
	}
	if(!isset($_POST["idedit"]) || $_POST["idedit"]==''){
		$sql="insert into khuvuc (IDcha,ten,Diachi,idphong) values ($IDcha,'$ten','$diachi',$phongban)";
	}
	else{
		$idedit=$_POST["idedit"];
		$sql="update khuvuc set  IDcha='$IDcha',ten='$ten',Diachi='$diachi',idphong='$phongban' where ID='$idedit'";
	}
	
	$result= query($sql);
	if($result){
		$template->parse("main.block_addsucc");
	}
	else{
		$template->parse("main.block_addfail");
	}
	
 }
 
 //+++++++++++++++++++++++++++++++++++++++++++
if(isset($_REQUEST["del"])){
 
 		$sql='delete from khuvuc where ID='.$_REQUEST["del"];
		
		$result= query($sql);
	$template->parse("main.block_deletekv");
 }
 
 //======================================
 if(!isset($_REQUEST["id"])){
 	 tree(0, 1); 
	
 	$template->assign("caykhuvuc",$Caytme);
	$template->parse("main.block_caykv");
 }
 else if(isset($_REQUEST["id"])){
 	$id=laso($_REQUEST['id']);
	
 	if($id!=-1){
		
		$sql="select * from khuvuc where ID=$id";
		
		$query= query($sql);
		$result_news = fetch_array($query);
	
		$template->assign('ten',$result_news['ten']);
		$template->assign('ID',$result_news['ID']);
		$template->assign('diachi',$result_news['diachi']);
		//var_dump($result_news['idphong']);
		compocay11('khuvuc','ten','IDcha',0,0,$result_news['IDcha'],0);
		$template->assign('muccha',$compocaydata);
		
		$template->assign('phongban',compo11('rooms','Name',$result_news['idphong']));
		$template->parse("main.block_editkv");
	}
	else{
		
		compocay11('khuvuc','ten','IDcha',0,0,0,0);
		$template->assign('muccha',$compocaydata);
		$template->assign('phongban',compo11('rooms','Name',''));
		$template->parse("main.block_editkv");
	}
	
 }
 

 
 
 function compo11($table,$Name,$idsosanh){
	
	$sql = "select $Name,ID from $table " ;
 	$result= query($sql) ;
	while($n =fetch_array($result))
	{
		if($n["ID"] == $idsosanh)
		{
			$output .= "<option value='".$n["ID"]."' selected>".$n[$Name]."</option>\n";
		}
		else
		{
			$output .= "<option value='".$n["ID"]."'>".$n[$Name]."</option>\n";
		}
	}
	return $output;
 } 


function compocay11($table,$nameht,$tencotidchild,$id_root, $level,$select_i,$idcall)
 {	
 		global $data, $compocaydata;  
		$space="--------| &nbsp;";	$name1="";	 	
		for($i=0; $i<$level; $i++)	{$name1.=$space;}
		$sql="SELECT $nameht,ID,$tencotidchild  FROM  $table WHERE $tencotidchild  ='$id_root' and ID != 0";
		$result=query($sql);
		
		if($result){			
			while($result_news = fetch_array($result))
			{  
				$id = $result_news["ID"] ;
				if($select_i==$id){
					$selected="selected";
					
				}
				else{
					$selected="";
				}
				
				if ($result_news["$tencotidchild"] == "0") { $name1 = "" ; }
				$name=$name1."".$result_news["$nameht"];
				$compocaydata.= "<option  title=\"$name\" value='$id' $selected>$name</option>" ;
				compocay11($table,$nameht,$tencotidchild,$id, $level+1,$select_i,$idcall);
			}
		}
}


function numUniqe(){
	$mString = date('m'); //Generate a datestring.
	$dString = date('d');
	$hString = date('h');
	$pString = date('m');
	$sString = date('m'); //Generate a datestring.
	$branchNumber = 101; //Get the branch number somehow.
	$receiptNumber = 1;  //You will query the last receipt in your database 
	//and get the last $receiptNumber for that branch and add 1 to it.;
	
	if($receiptNumber < 99) {
	
	  $receiptNumber = $receiptNumber + 1;
	
	}else{
	 $receiptNumber = 1;
	} 
		return $mString.$dString.$hString.$pString.$sString.$branchNumber.$receiptNumber;
}
?>