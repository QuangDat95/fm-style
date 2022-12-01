<?php

function checkditre($giobatdau,$giodi,$gioketthuc){
		if(($giobatdau>0 && $giodi>$giobatdau) && $giodi<$gioketthuc){ 
			return true;
		}
	return false;
}
function checkvesom($giora,$gioketthuc,$giobatdau){
	if($giora>$giobatdau && $giora<$gioketthuc){ 
		return true;
	}
	return false;
}


function tachthongtin($chuoi){
	
	$result=[];
	$mangtam=explode('-',$chuoi);
	foreach($mangtam as $key => $value){
		$arr=explode(':',$value);
		$result[$arr[0]]=$arr[1];
	}
return $result;

}
//hàm này đang xài
// chuyển đổi giờ phút
function convertHtoM($h){
	$g=floor($h);
	
	$p=$h-$g;
	if($p<0.6 && $p>0)
	{$p=$p*100;}
	$h=$g*60+$p;
	return array('h'=>$g,'p'=>$p,'totalp'=>$h);
}
//hàm này đang xài
function convertMtoH($m){
	$h=floor($m);
	$p=$m-$h;
	$p=$p*60;
	$total=$h*60+$p;
	return array('h'=>$h,'p'=>$p,"totalp"=>$total);
}


// kiểm tra quét thẻ 4lan
function kiemtraquetthe4lantam($giobatdau1,$giobatdau2='',$gioketthuc1='',$gioketthuc2,$gioquet,$lanthu,$lanthugiuagio){
	$result=array();
	$checkvao=true;
	//$checkra=false;
	$checktre=false;
	$checksom=false;
	
	if($gioquet<=$giobatdau1){
		$checkvao=true;//vào 1
		
	}
	else if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
		if($lanthu==1){
			$checkvao=true; // vào 1: trễ 1
			$checktre=true;
			$result['tre1']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		if($lanthu==2){
			$checkvao=false; //ra 1 : sớm 1
			$checksom=true;
			$result['som1']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		
		
	}
	else if($gioquet>=$gioketthuc1 && $gioquet<=$giobatdau2){
		if($lanthu==1){
			//vào 2: nghỉ sáng
					$checkvao=true; //  vào 2
		}
		 if($lanthu==2){
		 	$checkvao=false; //  ra 1
		}
		if($lanthu==3){
		 	$checkvao=true; //  vao 2
		}
		
	}
	else if($gioquet>$giobatdau2 && $gioquet<$gioketthuc2){
			if($lanthu==1){
				$checkvao=true;// vào 2: trễ 2 : nghỉ sáng
				$checktre=true;
				$result['tre2']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
			}
			if($lanthu==2){
				
					$checkvao=false; //  ra 2: sớm 2 : nghỉ sáng
					$checksom=true;
					$result['som2']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
			}
			if($lanthu==3){
					$checkvao=true; //vào 2: trễ 2
					$checktre=true;
					$result['tre2']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
			}
			if($lanthu==4){
					$checkvao=false; //ra2: sớm 2
					$checksom=true;
					$result['som2']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
			}
	
	}
	else if($gioquet>=$gioketthuc2){
			$checkvao=false; //ra2
	}
	if($checkvao){
		$result['loai']=1;
	}
	else{
		$result['loai']=2;
	}
	return $result;
}


// kiểm tra quét thẻ 4lan
function kiemtraquetthe4lantam2($giobatdau1,$giobatdau2='',$gioketthuc1='',$gioketthuc2,$gioquet,$lanthu,$loaigio){
	$result=array();
	$checkvao=true;
	$checktre=false;
	$checksom=false;
	$hetsang=false;
	$gio=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
	if($loaigio==1){
		if($gioquet<=$giobatdau1){
			$checkvao=true;//vào 
		}
		if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
			
			if($lanthu==1){
				$checktre=true;
				$checkvao=true;//vào
			}
			else if($lanthu%2==0){
				$checksom=true;
				$checkvao=false;//ra 
			}
			else if($lanthu%2!=0){
				$checkvao=true;//vào
			}
			
		}
		if($gioquet>=$gioketthuc1 && $gioquet<=$giobatdau2){
			if(($lanthu-1)%2==0){
				$hetsang=true;//vào 
			}
			else if(($lanthu-1)%2!=0){
				
			}
		}
	}
	
	if($checkvao){
		$result['loai']=1;
	}
	else{
		$result['loai']=2;
	}
	return $result;
}
// kiểm tra quét thẻ 4lan
function kiemtraquetthe4lan($giobatdau1,$giobatdau2='',$gioketthuc1='',$gioketthuc2,$gioquet,$lanthu,$loaigio){
	$result=array();
	$checkvao=true;
	$checktre=false;
	$checksom=false;
	$gio=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
	if($loaigio==1){
		if($lanthu==1){
			$checkvao=true;//vào 
			if($gioquet<=$giobatdau1){
				
				$checktre=true;
				
			}
			else if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
				$result['tre1']=$gio;
				$checktre=false;//vào 1: trễ
			}
		}
		else if($lanthu%2==0){
			/*if($gioquet>$giobatdau2){
				if($lanthu>2){
					$checkvao=true;//vao 
					$checktre=true;
					$result['tre2']=$gio;
				
				}
				else if($lanthu==2){
					$checkvao=true;//vao 
				}
				
			}
			*/
			
			if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
				$checkvao=false;//ra 
				$checksom=true;
				$result['som1']=$gio;
				
			}
			else if($gioquet>$giobatdau2 && $gioquet<$gioketthuc2){
				$checkvao=false;//ra 
				$checksom=true;
				$result['som2']=$gio;
			
			}
		}
		else if($lanthu%2!=0){
			$checkvao=true;//ra 
			if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
				$checktre=true;
				$result['tre1']=$gio;
				
			}
			else if($gioquet>$giobatdau2 && $gioquet<$gioketthuc2){
				$checktre=true;
				$result['tre2']=$gio;
			}
		}
	}
	else if($loaigio==2){
	
		if($lanthu==1){
			$checkvao=true;//vào 
			if($gioquet<=$giobatdau1){
				
				$checktre=true;
				
			}
			else if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
				$result['tre1']=$gio;
				$checktre=false;//vào 1: trễ
			}
		}
		else if($lanthu%2==0){
			$checkvao=false;//ra 
			
			if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
				$checksom=true;
				$result['som1']=$gio;
				
			}
			else if($gioquet>$giobatdau2 && $gioquet<$gioketthuc2){
				
				$checksom=true;
				$result['som2']=$gio;
			
			}
		}
		else if($lanthu%2!=0){
			$checkvao=true;//ra 
			if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
				$checktre=true;
				$result['tre1']=$gio;
				
			}
			else if($gioquet>$giobatdau2 && $gioquet<$gioketthuc2){
				$checktre=true;
				$result['tre2']=$gio;
			}
		}
	}
	else if($loaigio==0){
		if($lanthu%2!=0){
			$checkvao=true;//ra
		}
		else{
			$checkvao=false;//vao
		}
	}
		
	if($checkvao){
		$result['loai']=1;
	}
	else{
		$result['loai']=2;
	}
	return $result;
}
// kiểm tra quét thẻ 2lan
function kiemtraquetthe2lantam($giobatdau1,$giobatdau2='',$gioketthuc1='',$gioketthuc2,$gioquet,$lanthu,$lanthugiuagio){
	$result=array();
	$checkvao=true;
	//$checkra=false;
	$checktre=false;
	$checksom=false;
			
	if($gioquet<=$giobatdau1){
		$checkvao=true;//vào 
		
	}
	else if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
		if($lanthu==1){
			$checkvao=true; // vào : trễ 
			$checktre=true;
			$result['tre']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		if($lanthu==2){
			$checkvao=false; //ra  : sớm : nghỉ chiều
			$checksom=true;
			$result['som']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		
		
	}
	else if($gioquet>=$gioketthuc1 && $gioquet<=$giobatdau2){
		if($lanthu==1){
			$checkvao=true; //  vào  : nghỉ sáng
			$checktre=true;
			$result['tre']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		if($lanthu==2){
		 	$checkvao=false; //  ra : sớm 
			$result['som']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		
	}
	else if($gioquet>$giobatdau2 && $gioquet<$gioketthuc2){
			if($lanthu==1){
				$checkvao=true;// vào : trễ  : nghỉ sáng
				$checktre=true;
				$result['tre']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
			}
			if($lanthu==2){
				
					$checkvao=false; //  ra : sớm  : nghỉ sáng
					$checksom=true;
					$result['som']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
			}
	
	}
	else if($gioquet>=$gioketthuc2){
			$checkvao=false; //ra
	}
	if($checkvao){
		$result['loai']=1;
	}
	else{
		$result['loai']=2;
	}
	return $result;
}
// kiểm tra quét thẻ 2lan
function kiemtraquetthe2lan($giobatdau1,$giobatdau2='',$gioketthuc1='',$gioketthuc2,$gioquet,$lanthu,$lanthugiuagio){
	$result=array();
	$checkvao=true;
	//$checkra=false;
	$checktre=false;
	$checksom=false;
	
	if($gioquet<=$giobatdau1){
		$checkvao=true;//vào 
		
	}
	else if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
		if($lanthu==1){
			$checkvao=true; // vào : trễ 
			$checktre=true;
			$result['tre']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		if($lanthu>=2){
			$checkvao=false; //ra  : sớm : nghỉ chiều
			$checksom=true;
			$result['som']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		
		
	}
	else if($gioquet>=$gioketthuc1 && $gioquet<=$giobatdau2){
		if($lanthu==1){
			$checkvao=true; //  vào  : nghỉ sáng
			$checktre=true;
			$result['tre']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		if($lanthu>=2){
		 	$checkvao=false; //  ra : sớm 
			$result['som']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
		}
		
	}
	else if($gioquet>$giobatdau2 && $gioquet<$gioketthuc2){
			if($lanthu==1){
				$checkvao=true;// vào : trễ  : nghỉ sáng
				$checktre=true;
				$result['tre']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
			}
			if($lanthu>=2){
				
					$checkvao=false; //  ra : sớm  : nghỉ sáng
					$checksom=true;
					$result['som']=convertMtoH($gioquet)['h'].':'.convertMtoH($gioquet)['p'];
			}
	
	}
	else if($gioquet>=$gioketthuc2){
			$checkvao=false; //ra
	}
	if($checkvao){
		$result['loai']=1;
	}
	else{
		$result['loai']=2;
	}
	return $result;
}
// kiểm tra quét thẻ n lan
function kiemtraquetthenlan($gioquet,$lanthu){
	$result=array();
	
	if($lanthu%2==0){
		$result['loai']=2;
	}
	else{
		$result['loai']=1;
	}
	return $result;
}
function travegiophut($sogiolam,$giolamd,$sophut,$loaigio){
 	
	if($loaigio==2){
		if(($giolamd*60+$sophut)>=$sogiolam){
		
		 $sophutlam=($sogiolam%60);
		 $giolam = floor($sogiolam/60)."h$sophutlam";
		
	
		}
		else{
			$maugiolam="";
			$giolam = $giolamd  ."h$sophut  "; 
			 $sophutlam='';
		}
	}
 	
	if($loaigio==1){
			if (($giolamd*60+$sophut)>=$sogiolam){
				  $sophutlam =$sogiolam%60 ;
					$giolam =  floor($sogiolam/60) ."h$sophutlam ";
					
			}
			else{
				$maugiolam="red";
				$giolam = $giolamd  ."h$sophut <br>Thiếu giờ" ;
			}
	}
	 
	 return array('sophutlam'=>$sophutlam,'giolam'=>$giolam,'maugiolam'=>$maugiolam);

}



function kiemtrasolanquettam($giobatdau1,$giobatdau2='',$gioketthuc1='',$gioketthuc2,$gioquet,&$quetsang,&$quettrua,&$quetchieu){
			if($gioquet<=$gioketthuc1){
				$quetsang++;
				return 1;
			}
			else if($gioquet>$gioketthuc1 && $gioquet<$giobatdau2){
				$quettrua++;
				return 2;
			}
			else if($gioquet>=$giobatdau2){
				$quetchieu++;
				return 3;
			}


}
			
function kiemtrasolanquettam1($giobatdau1,$giobatdau2='',$gioketthuc1='',$gioketthuc2,$gioquet,&$quettruocsang,&$quetsang,&$quettrua,&$quetchieu,&$quetsauchieu){
			
			if($gioquet<=$giobatdau1){
				$quettruocsang++;
				return 1;
			}
			else if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
				$quetsang++;
				return 2;
			}
			else if($gioquet >=$gioketthuc1 && $gioquet<=$giobatdau2){
				$quettrua++;
				return 3;
			}
			else if($gioquet>$giobatdau2 && $gioquet<$gioketthuc2){
				$quetchieu++;
				return 4;
			}
			else if($gioquet>=$gioketthuc2){
				$quetsauchieu++;
				return 5;
			}

}
//hàm này đang xài		
function kiemtrasolanquet($giobatdau1,$giobatdau2='',$gioketthuc1='',$gioketthuc2,$gioquet,$giovao,$gioquetkt){
			$giotrua12=720;
			$giochieu5=1020;
		if($gioketthuc1==$giobatdau2){
			 	if($gioquet >$gioketthuc1){
				
					return 6;
				}
				else if($gioquet <$gioketthuc1){
					return 7;
				}
				else if($gioquet ==$gioketthuc1){
					return 20;
				}
				else if($gioquet >=$gioketthuc2){
					return 21;
				}
				else if($gioquet <$gioketthuc2){
					return 22;
				}
		}
		else if($gioketthuc1<$giobatdau2){
				if($gioquet<=$giobatdau1){
					
					return 1;
				}
				else if($gioquet>$giobatdau1 && $gioquet<$gioketthuc1){
					
					return 2;
				}
			
				else if($gioquet >=$gioketthuc1 && $gioquet<=$giobatdau2){
					
						return 3;
					
				}
				else if($gioquet>$giobatdau2 && $gioquet<$gioketthuc2){
					
					return 4;
				}
				else if($gioquet>=$gioketthuc2){
					
					return 5;
				}
			}
		else if($gioketthuc1>$giobatdau2){
		
				if($gioquet <=$giobatdau1){
					return 8;//vào đúng 1
					//check vao
				}
				//chỉ được phép quét vào trước 12 h trưa ca 1
				else if($gioquet >$giobatdau1 && $gioquet <$giotrua12 && !$giovao){
			
					return 9;// vào trễ  1 
					//check vao
				}
				else if($gioquet >$giobatdau1 && $gioquet <$giotrua12 && $giovao){
					//check ra
					return 10;// sớm 1 
				}
				else if($gioquet >$giotrua12 && $gioquet <$gioketthuc1 && $giovao){
					//kiểm tra giờ quét trước đó
					
					if(convertHtoM($gioquetkt)['totalp']<$giotrua12){
						return 10;// sớm 1 
						//check ra
					}
					else if(convertHtoM($gioquetkt)['totalp']>=$giotrua12){
						return 12;// vào đúng 2 
						//check vao
					}
					
				}
				//chỉ dc phép quét vào từ 12h đến 5h ca 2
				else if($gioquet >=$gioketthuc1 && $gioquet<$giochieu5 && $giovao){
					
					if(convertHtoM($gioquetkt)['totalp']<$giotrua12){
						//check ra
						return 11;// về đúng 1 
					}
					else if(convertHtoM($gioquetkt)['totalp']>=$giotrua12){
						return 15;//về sớm  2
						//check ra
					}
					
				}
				// chỉ được phép quét vào từ 12h trưa trở đi ca 2
				else if($gioquet >=$giotrua12 && $gioquet <=$giobatdau2 && !$giovao){
					//check vao
					return 12;// vào đúng 2 
				}
				//khoảng từ 12h đến giờ bắt đầu 2 có thể là quét vào 2 hoặc ra 1
				else if($gioquet >=$giotrua12 && $gioquet <=$giobatdau2 && $giovao){
					
					//kiểm tra giờ quét trước đó
					if(convertHtoM($gioquetkt)['totalp']<$giotrua12){
						return 13;// sớm 1
						//check ra
					}
					return 12;// vào đúng 2
						//check vao
					
				}
				//khoảng lớn hớn bắt đầu 2 và nhỏ hơn kết thúc 2 có thể là vào trễ 2 hoặc ra đúng 1
				else if($gioquet >$giobatdau2 && $gioquet <$gioketthuc2 && $giovao){
					
					//kiểm tra giờ quét trước đó
					if(convertHtoM($gioquetkt)['totalp']<$giotrua12){
						return 14;//về đúng  1
						//check ra
					}
					else if(convertHtoM($gioquetkt)['totalp']>=$giotrua12){
						return 15;//về sớm  2
						//check ra
					}
					
				}
				else if($gioquet >$giobatdau2 && $gioquet <$gioketthuc2 && !$giovao){
							//check vao
							
					return 16; // trễ 2
				}
				//khoảng lớn hớn kết thúc 2 có thể là ra đúng 1 hoặc ra đúng 1
				else if($gioquet >=$gioketthuc2){
					//kiểm tra giờ quét trước đó
					if(convertHtoM($gioquetkt)['totalp']<$giotrua12){
						return 17;//về đúng  1
						//check ra
					}
					else if(convertHtoM($gioquetkt)['totalp']>=$giotrua12){
						return 18;//về đúng  2
						//check ra
					}
				}
		}
		

}	

function ConvertTimeWork($sogiolam){
	$giolam = floor($sogiolam/60);
	$sophutlam=($sogiolam%60);
	
	return array("giolam"=>$giolam,"phutlam"=>$sophutlam);
}
function ConvertTimeNotE($sogiolam,$giolamd,$sophut){
	$giothieu=floor(($sogiolam-($giolamd*60+$sophut))/60);
	$phutthieu=($sogiolam-($giolamd*60+$sophut))%60;
	return array("giothieu"=>$giothieu,"phutthieu"=>$phutthieu);
}

function isThisDayAWeekend($date) {

   $dayofweek = date('w', strtotime($date));
   //echo  $dayofweek."<br>";
    if ($dayofweek =="Sunday") { return true; } 
    else {return false; }

}

function chuyenngaychuan($ngaytao,$giobd){
	$tvao= explode(" ",$ngaytao);
	$tvao=$tvao[0]." ";
	$gio=floor($giobd/60);
	$phut=$giobd%60;
	
	return $tvao.' '.$gio.":".$phut.":00";
	
	

}
?>