<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$IDK = $_SESSION["LoginID"];
$cuahang = $_SESSION["se_kho"];
$quyen = $_SESSION["quyen"];
$ql = $quyen[$_SESSION["mangquyenid"][$_SESSION["act"]]];
if (!($ql[0] == 1 || $IDK == 1))
{
    return;
}

$root_path = getcwd() . "/";
include ($root_path . "biensession.php");
include ($root_path . "includes/config.php");
include ($root_path . "includes/removeUnicode.php");
include ($root_path . "includes/class.paging.php");
include ($root_path . "includes/class.mysql.php");
include ($root_path . "includes/function.php");
include ($root_path . "includes/function_local.php");
include ($root_path . "ghtk.php");
include ($root_path . "viettel.php");
$data = new class_mysql();
$data->config();
$data->access();


if (isset($_POST["LOADVANCHUYEN"]))
{
	

    $data1 = chonghack($_POST['LOADVANCHUYEN']);
  
    $tmp = explode('*@!', $data1);
	
	  $mavd = chonghack($tmp[0]);
	  $loai = chonghack($tmp[1]);
	  $vc='';
	  switch($loai){
	  		case 'GHTK':
				$ghtk = new Ghtk("187c69cA1c3d49fE1B43573b335d67a7481e7181","https://services.giaohangtietkiem.vn/services/shipment/");
				$vc= $ghtk->GetStatusBill($mavd);
			
				if($vc["success"]){
						$tinh=tachdiachi($vc['address'])["tinh"];
						$quan=tachdiachi($vc['address'])["quan"];
							$idquan='';
							$idtinh='';
							$idphuong='';
							$quan='';
							$phuong='';
							if($tinh){
								$idtinh=checktinh($tinh)['ID'];
							}
							if($quan){
								$idquan=checkquan($quan)['ID'];
							}
							
											
						if($idtinh){
							$quan=composx("quan","CONCAT(loai,' ',Name)",$idquan," where idtinh=$idtinh" );
						}
						if($idtinh && $idquan){
							$phuong=composx("phuong","CONCAT(loai,' ',Name)",$idphuong," where idtinh=$idtinh and idquan=$idquan" );
						}
							$phiship=$vc['ship_money'];
							$giatridon=$vc['pick_money'];
							
						echo "###1###$idtinh###$quan###$phuong###$vc[address]###$phiship###".$giatridon."###$vc[partner_id]###";
					
				}else{
					echo "###-1###$vc[message]###";
				}
				return;
			break;
			case 'VT':
				
				$services = new ViettelPostServices;
				$respon = $services->Get_Status_Oder($mavd);
				$vc=$respon;
				if($vc["code"]==200){
					//var_dump(json_decode($vc["data"],true));
					$arr=json_decode($vc["data"],true);
					$arr=$arr[0];
					$giatridon=$arr["MONEY_TOTAL"];
					echo "###1###0###0###0###0###0###".$giatridon."###$madh###";
				}
				else{
					echo "###-1###$vc[message]###";
				}
				return;
			break;
				
			default:
				
				$ghtk = new Ghtk("187c69cA1c3d49fE1B43573b335d67a7481e7181","https://services.giaohangtietkiem.vn/services/shipment/");
				$vc= $ghtk->GetStatusBill($mavd);
			
				if(!$vc["success"]){
					$services = new ViettelPostServices;
					$respon = $services->Get_Status_Oder($mavd);
					if($respon || $respon["code"]==200){
						$arr=json_decode($vc["data"],true);
							$arr=$arr[0];
							$giatridon=$arr["MONEY_TOTAL"];
							$madh=$arr["ORDER_REFERENCE"];
							var_dump($arr);
							echo "###1###0###0###0###0###0###".$giatridon."###$madh###";
					}else{
						echo "###-1###<span style='color:red;font-weigth:bold'>Không thể kế nối nhà vận chuyển!</span>";
					}
					
				}
				else if($vc["success"]){
					if($vc["success"]){
						$tinh=tachdiachi($vc['address'])["tinh"];
						$quan=tachdiachi($vc['address'])["quan"];
							$idquan='';
							$idtinh='';
							$idphuong='';
							$quan='';
							$phuong='';
							if($tinh){
								$idtinh=checktinh($tinh)['ID'];
							}
							if($quan){
								$idquan=checkquan($quan)['ID'];
							}
							
											
						if($idtinh){
							$quan=composx("quan","CONCAT(loai,' ',Name)",$idquan," where idtinh=$idtinh" );
						}
						if($idtinh && $idquan){
							$phuong=composx("phuong","CONCAT(loai,' ',Name)",$idphuong," where idtinh=$idtinh and idquan=$idquan" );
						}
							$phiship=$vc['ship_money'];
							$giatridon=$vc['pick_money'];
							echo "###1###$idtinh###$quan###$phuong###$vc[address]###$phiship###".$giatridon."###$vc[partner_id]###";
						//echo thongtinvc($vc,$loai);
					}else{
						echo "###-1###$vc[message]###";
					}
					
				}else{
						echo "###-1###<span style='color:red;font-weigth:bold'>Không thể kế nối nhà vận chuyển!</span>";
					}
			
				return;
			break;
	  }
	return;
	
		
	
//	var_dump($vc);
    
}
if (isset($_POST["TINH"]))
{
    $data1 = chonghack($_POST['TINH']);
    // echo $data1."abcs";
    $tmp = explode('*@!', $data1);

    $idtinh = $tmp[0];
    $idssquan = $tmp[1];
    $sql = "select * from quan where idtinh=".$idtinh;
    $query_districts = $data->query($sql);
    $arrtmp = [];
    $chuoithanhpho = '<option value="0" >Chọn quận huyện</option>';
    while ($result_district = $data->fetch_array($query_districts))
    {
        $arrtmp = $result_district;

        if ($idssquan == $result_district['ID'])
        {
            $chuoithanhpho .= '<option value="' . $result_district['ID'] . '" selected="selected">' . $result_district['loai'] . ' ' . $result_district['Name'] . '</option>';
        }
        else
        {
            $chuoithanhpho .= '<option value="' . $result_district['ID'] . '">' . $result_district['loai'] . ' ' . $result_district['Name'] . '</option>';
        }

    }
    echo $chuoithanhpho;
    return;

}

if (isset($_POST["THANH"]))
{
    $data1 = chonghack($_POST['THANH']);
    $tmp = explode('*@!', $data1);

    $idtinh = $tmp[0];
    $idthanhpho = $tmp[1];
  
    $sql = "select * from phuong where idtinh=" . $idtinh . " and idquan=" . $idthanhpho;
  
    $query_districts = $data->query($sql);
    $arrtmp = [];
    $chuoiphuongxa = '<option value="0" >Chọn phường/xã </option>';
    while ($result_district = $data->fetch_array($query_districts))
    {

        if ($idssphuong == $result_district['ID'])
        {
            $chuoiphuongxa .= '<option value="' . $result_district['ID'] . '" selected="selected">' . $result_district['loai'] . ' ' . $result_district['Name'] . '</option>';
        }
        else
        {
            $chuoiphuongxa .= '<option value="' . $result_district['ID'] . '">' . $result_district['loai'] . ' ' . $result_district['Name'] . '</option>';
        }

    }
    echo $chuoiphuongxa;
    return;

}
if (isset($_POST["DATA"])){
		$data1 = $_POST['DATA'];
		$tmp = explode('*@!', $data1);
		$soct = trim($tmp[0]);
		$loai = trim($tmp[1]);
		//   echo "tets".$loai; return;
		//return;
		if ($soct == '')
		{
			echo "###-1###";
			return;
		}
		
		$tam = '';
		$idbill='';
		switch ($loai)
		{
		
			case 1:
				$dong = CheckSoCT($soct);
				$dong['SoCT'];
				$sobill=$dong['SoCT'];
				$idbill=$dong['ID'];
				
				if ($sobill){
					$tam = CheckVanChuyen($sobill);
					
				}
				else{
			 		echo "###-1###Không tìm thấy phiếu này! Hãy thử tra cứu bằng mã vận đơn###";
					return;
				}
			break;
		}
		
		
		//var_dump($tam['phuong']);
		//return;
		if ($tam){
			$idquan='';
			$idtinh='';
			$idphuong='';
			$quan='';
			$phuong='';
			if($tam['tinh']){
				$idtinh=checktinh($tam['tinh'])['ID'];
			}
			if($tam['quan']){
				$idquan=checkquan($tam['quan'])['ID'];
			}
			if($tam['phuong']){
				$idphuong=checkphuong($tam['phuong'])['ID'];
			}
			if($idtinh){
				$quan=composx("quan","CONCAT(loai,' ',Name)",$idquan," where idtinh=$idtinh" );
			}
			//echo $idtinh;
			//echo $tam['quan'];
			if($idtinh && $idquan){
				$phuong=composx("phuong","CONCAT(loai,' ',Name)",$idphuong," where idtinh=$idtinh and idquan=$idquan" );
			}
			
				echo "###1###$idbill###$tam[mavd]###$sobill###$tam[madh]###$tam[diachi]###".$idtinh."###".$quan."###".$phuong."###$tam[addressch]###$tam[ID]###$tam[phitravc]###$tam[trigiadon]";
			
		}else{
	//	var_dump($idbill);
			echo "###-1###Không tìm thấy Mã vận đơn  $soct này! Hãy thử tra cứu bằng mã vận đơn###$idbill###$sobill###";
			return;
		}


}
function CheckSoCT($soct)
{
	global  $data;
    $sql = "SELECT a.ID, a.SoCT,c.address as addressch from phieunhapxuat a LEFT JOIN cuahang c   ON a.IDKho = c.ID where a.SoCT='$soct'";
 //echo $sql;
    $tam = getdong($sql);

    return $tam;
    
}

//  get số chức từ để hiển thị value
function CheckVanChuyen($sobill)
{
global  $data;
    $sql = "SELECT ID,IDbill, mavd, sobill, madh, diachi, tinh, quan, phuong,trigiadon,phitravc from vanchuyenonline where sobill ='$sobill'";
  //   echo $sql;
    $tam = getdong($sql);
	//var_dump($tam);
    return $tam;

}

// check tỉnh
function checktinh($chuoi)
{

    global $data;
    $chuoi = addslashes($chuoi);
    $chuoi = strtolower(trim($chuoi));
    $sql = "select * from tinh where LOWER(TRIM(Name)) like '%$chuoi%'";

    $query = $data->query($sql);
    $num_row = $data->num_rows($query);
    if ($num_row == 0){
        return;
    }else{
        return getdong($sql);
    }
}

// check quận
function checkquan($chuoi)
{

    global $data;
    $chuoi = addslashes($chuoi);
    $sql = "select * from quan1 where CONCAT(loai,' ',Name) like '%$chuoi%'";

    $query = $data->query($sql);
    $num_row = $data->num_rows($query);
    if ($num_row == 0){
        return;

    }else{
        return getdong($sql);
    }
}

// check phường
function checkphuong($chuoi)
{

    global $data;
    $chuoi = addslashes($chuoi);
    $sql = "select * from phuong1 where CONCAT(loai,' ',Name) like '%$chuoi%'";

    // echo "test".$sql;
    $query = $data->query($sql);
    $num_row = $data->num_rows($query);
    if ($num_row == 0){
        return;

    }else{
        return getdong($sql);
    }
}

function thongtinvc($arr,$nvc){
if($nvc=="GHTK"){
	$ngaytaodon=strtotime($arr['order']["created"]);
	$ngaytaodon=date("d/m/Y",$ngaytaodon);
	$ngaymoi=strtotime($arr['order']["modified"]);
	$ngaymoi=date("d/m/Y",$ngaymoi);
	$ngayhenlay=strtotime($arr['order']["pick_date"]);
	$ngayhenlay=date("d/m/Y",$ngayhenlay);
	$ngaygiudon=strtotime($arr['order']["storage_day"]);
	$ngaygiudon=date("d/m/Y",$ngaygiudon);
	$ngaygiao=strtotime($arr['order']["deliver_date"]);
	$ngaygiao=date("d/m/Y",$ngaygiao);
	$freeship=$arr['order']["is_freeship"]==1?"true":"false";
	$chuoi= "<table>
				<tr>
					<td>Mã VD</td>
					<td>".$arr['order']['label_id']."</td>
				</tr>
				<tr>
					<td>Mã ĐH</td>
					<td>".$arr['order']['partner_id']."</td>
				</tr>
					<tr>
					<td>Ngày tạo</td>
					<td>".$ngaytaodon."</td>
				</tr>
				
				<tr>
					<td>Trạng thái</td>
					<td>".$ngaymoi." ".$arr['order']['status_text']."</td>
				</tr>
				
				<tr>
					<td>Ghi chú</td>
					<td>".$arr['order']['message']."</td>
				</tr>
				
				<tr>
					<td>Ngày Hẹn/lấy hàng</td>
					<td>".$ngayhenlay."</td>
				</tr>
				<tr>
					<td>Ngày Hẹn/giao hàng</td>
					<td>".$ngaygiao."</td>
				</tr>
				<tr>
					<td>Tên khách hàng</td>
					<td>".$arr['order']['customer_fullname']."</td>
				</tr>
				<tr>
					<td>ĐT khách hàng</td>
					<td>".$arr['order']['customer_tel']."</td>
				</tr>
				<tr>
					<td>Địa chỉ khách hàng</td>
					<td>".$arr['order']['address']."</td>
				</tr>
				<tr>
					<td>Số ngày giữ đơn</td>
					<td>".$ngaygiudon."</td>
				</tr>
				<tr>
					<td>Phí ship</td>
					<td>".$arr['order']['ship_money']."</td>
				</tr>
				<tr>
					<td>Giá trị đơn</td>
					<td>".$arr['order']['value']."</td>
				</tr>
				<tr>
					<td>Cân nặng</td>
					<td>".$arr['order']['weight']."</td>
				</tr>
				<tr>
					<td>Freeship</td>
					<td>".$freeship."</td>
				</tr>
				<tr>
					<td>Sản phẩm</td>
					<td></td>
				</tr>";
				
				foreach($arr['order']['products'] as $key =>$value){
				
				$chuoi.="<tr>
					<td>Tên sản phẩm</td>
					<td>$value[full_name]</td>
				</tr>
				<tr>
					<td>Mã sản phẩm</td>
					<td>$value[product_code]</td>
				</tr>";
				
				
				}
				
			$chuoi.="</table>";
	}
	else if($nvc=="VT"){
	//echo "ok";
			$ngaymoi=strtotime($arr['ORDER_STATUSDATE']);
	$ngaymoi=date("d/m/Y h:i:s",$ngaymoi);

	$chuoi= "<table>
				<tr>
					<td>Mã VD</td>
					<td>".$arr['ORDER_NUMBER']."</td>
				</tr>
				<tr>
					<td>Mã ĐH</td>
					<td>".$arr['ORDER_REFERENCE']."</td>
				
				<tr>
					<td>Trạng thái</td>
					<td>".$ngaymoi." ".$arr['trangthai']."</td>
				</tr>
				
				<tr>
					<td>Ghi chú</td>
					<td>".$arr['NOTE']."</td>
				</tr>
				
				<tr>
					<td>Ngày Hẹn/lấy hàng</td>
					<td>".$arr['EXPECTED_DELIVERY']."</td>
				</tr>
				
				<tr>
					<td>Tên khách hàng</td>
					<td>...</td>
				</tr>
				<tr>
					<td>ĐT khách hàng</td>
					<td>...</td>
				</tr>
				<tr>
					<td>Địa chỉ khách hàng</td>
					<td>...</td>
				</tr>
				<tr>
					<td>Số ngày giữ đơn</td>
					<td>...</td>
				</tr>
				<tr>
					<td>Phí thu hộ (không bao gồm tiền cước)</td>
					<td>".$arr['MONEY_COLLECTION']."</td>
				</tr>
			<tr>
					<td>Phí thu hộ (bao gồm tiền cước)</td>
					<td>".$arr['MONEY_FEECOD']."</td>
				</tr>
				<tr>
					<td>Giá trị đơn</td>
					<td>".$arr['MONEY_TOTAL']."</td>
				</tr>
				<tr>
					<td>Cân nặng</td>
					<td>".$arr['PRODUCT_WEIGHT']."</td>
				</tr>
				<tr>
					<td>Freeship</td>
					<td>...</td>
				</tr>
				<tr>
					<td>Sản phẩm</td>
					<td>...</td>
				</tr>";
				
				/*foreach($arr['order']['products'] as $key =>$value){
				
				$chuoi.="<tr>
					<td>Tên sản phẩm</td>
					<td>$value[full_name]</td>
				</tr>
				<tr>
					<td>Mã sản phẩm</td>
					<td>$value[product_code]</td>
				</tr>";
				
				
				}*/
				
			$chuoi.="</table>";
	}
	return $chuoi;
}


function tachdiachi($chuoidiachi,$kitu=','){
	
	$chuoidiachi=explode($kitu,$chuoidiachi);
	$len=count($chuoidiachi)-1;
	return array("tinh"=>$chuoidiachi[$len],"quan"=>$chuoidiachi[$len-1],"diachi"=>$chuoidiachi[$len-2]);

}
$data->closedata();
?>
