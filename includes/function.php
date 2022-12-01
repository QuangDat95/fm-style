<?php  
 // include_once("mangip.php");
  //echo $db["ip"] . $mangip[$db["ip"]] ;
 // if ($mangip[$db["ip"]]>=1 ){}
 // else
 // {   
 //	  if ($_SESSION["ipdn"]!=$db["ip"])
	//  { $_SESSION["ipdn"]=$db["ip"] ;  
	//   $headers = "Content-type: text/html; charset=utf-8\r\nFrom: fm.vn <info@fmstyle.vn>";
	//   $message = date('d/m/y H:i')."**$td**".$db["ip"]."**" .$UserName. '==='.($password)."**" .$_SERVER['HTTP_USER_AGENT'] ."  \n" ;
	//   mail("anhtuanas@gmail.com,admin@fmstyle.com.vn ", "dang nhap trai phep fmketoan", $message, $headers) ;
	 
 //	  }   
	//  echo "gui ip dang hien thi cho Anh de vao phan mem nhe:". $db["ip"];
  	//  exit ;
	 
	//   }
	   
function getmang($sqldt)
{  global $data ;
     $result= $data->query($sqldt) ;
      while($re = $data->fetch_array($result))
			{   
 				$mangp[$re["ID"]]= $re ;
 			}
			 
      return $mangp;	
}
//===========================================
function kiemtrangay($date,$vao='Y-m-d H:m', $format = 'Y-m-d H:m')
{   
	$d=str_replace("/","-",trim($date));
	$vao=str_replace("/","-",trim($vao));
	
	return DateTime::createFromFormat($vao,$d)->format($format);
	
	
	//$d = DateTime::createFromFormat($vao,$d);
	
	// return $d->format($format);
	 
	//$d = DateTime::createFromFormat($vao,$d);
	// echo $d; return ;
   //  return $d->format($format);
//return  $d && $d->format($format) == $date;

   // $d = DateTime::createFromFormat($vao, $date);
  //  return $d && $d->format($format) == $date;
}

//===========================================
function saveimage($url,$path,$kieu = 1)
{   
     if ($url =="") return "default.gif" ;

	$ch = curl_init($url);
	
     $c=strrpos($url,"/",1)+1;
	 $ten = substr($url,$c,strlen($url)-$c );
     $ten = str_replace(" ","-",$ten);	
     $name = time()."_".rand()."^".$ten ;

	 $fp = fopen( $path.$name, 'wb');
	//echo   $path.$name."12332" ;
	//return ;
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
	return $name ;
}
//===========================================

function kiemtradienthoai($desktopredirect=false){
  global   $status;
  $iphone=true;$ipad=true;$android=true;$opera=true;$blackberry=true;$palm=true;$windows=true;$mobileredirect=true; 
  $mobile_browser   = false;  
  $user_agent       = $_SERVER['HTTP_USER_AGENT']; // get the user agent value - this should be cleaned to ensure no nefarious input gets executed
  $accept           = $_SERVER['HTTP_ACCEPT']; // get the content accept value - this should be cleaned to ensure no nefarious input gets executed

  switch(true){  

    case (preg_match('/ipad/i',$user_agent)); // we find the word ipad in the user agent
      $mobile_browser = $ipad; // mobile browser is either true or false depending on the setting of ipad when calling the function
      $status = 'Apple iPad';
      if(substr($ipad,0,4)=='http'){ // does the value of ipad resemble a url
        $mobileredirect = $ipad; // set the mobile redirect url to the url value stored in the ipad value
      } // ends the if for ipad being a url
    break; // break out and skip the rest if we've had a match on the ipad // this goes before the iphone to catch it else it would return on the iphone instead

    case (preg_match('/ipod/i',$user_agent)||preg_match('/iphone/i',$user_agent)); // we find the words iphone or ipod in the user agent
      $mobile_browser = $iphone; // mobile browser is either true or false depending on the setting of iphone when calling the function
      $status = 'Apple';
      if(substr($iphone,0,4)=='http'){ // does the value of iphone resemble a url
        $mobileredirect = $iphone; // set the mobile redirect url to the url value stored in the iphone value
      } // ends the if for iphone being a url
    break; // break out and skip the rest if we've had a match on the iphone or ipod

    case (preg_match('/android/i',$user_agent));  // we find android in the user agent
      $mobile_browser = $android; // mobile browser is either true or false depending on the setting of android when calling the function
      $status = 'Android';
      if(substr($android,0,4)=='http'){ // does the value of android resemble a url
        $mobileredirect = $android; // set the mobile redirect url to the url value stored in the android value
      } // ends the if for android being a url
    break; // break out and skip the rest if we've had a match on android

    case (preg_match('/opera mini/i',$user_agent)); // we find opera mini in the user agent
      $mobile_browser = $opera; // mobile browser is either true or false depending on the setting of opera when calling the function
      $status = 'Opera';
      if(substr($opera,0,4)=='http'){ // does the value of opera resemble a rul
        $mobileredirect = $opera; // set the mobile redirect url to the url value stored in the opera value
      } // ends the if for opera being a url 
    break; // break out and skip the rest if we've had a match on opera

    case (preg_match('/blackberry/i',$user_agent)); // we find blackberry in the user agent
      $mobile_browser = $blackberry; // mobile browser is either true or false depending on the setting of blackberry when calling the function
      $status = 'Blackberry';
      if(substr($blackberry,0,4)=='http'){ // does the value of blackberry resemble a rul
        $mobileredirect = $blackberry; // set the mobile redirect url to the url value stored in the blackberry value
      } // ends the if for blackberry being a url 
    break; // break out and skip the rest if we've had a match on blackberry

    case (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine)/i',$user_agent)); // we find palm os in the user agent - the i at the end makes it case insensitive
      $mobile_browser = $palm; // mobile browser is either true or false depending on the setting of palm when calling the function
      $status = 'Palm';
      if(substr($palm,0,4)=='http'){ // does the value of palm resemble a rul
        $mobileredirect = $palm; // set the mobile redirect url to the url value stored in the palm value
      } // ends the if for palm being a url 
    break; // break out and skip the rest if we've had a match on palm os

    case (preg_match('/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile)/i',$user_agent)); // we find windows mobile in the user agent - the i at the end makes it case insensitive
      $mobile_browser = $windows; // mobile browser is either true or false depending on the setting of windows when calling the function
      $status = 'Windows Smartphone';
      if(substr($windows,0,4)=='http'){ // does the value of windows resemble a rul
        $mobileredirect = $windows; // set the mobile redirect url to the url value stored in the windows value
      } // ends the if for windows being a url 
    break; // break out and skip the rest if we've had a match on windows

    case (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320|vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo)/i',$user_agent)); // check if any of the values listed create a match on the user agent - these are some of the most common terms used in agents to identify them as being mobile devices - the i at the end makes it case insensitive
      $mobile_browser = true; // set mobile browser to true
      $status = 'Mobile matched on piped preg_match';
    break; // break out and skip the rest if we've preg_match on the user agent returned true 

    case ((strpos($accept,'text/vnd.wap.wml')>0)||(strpos($accept,'application/vnd.wap.xhtml+xml')>0)); // is the device showing signs of support for text/vnd.wap.wml or application/vnd.wap.xhtml+xml
      $mobile_browser = true; // set mobile browser to true
      $status = 'Mobile matched on content accept header';
    break; // break out and skip the rest if we've had a match on the content accept headers

    case (isset($_SERVER['HTTP_X_WAP_PROFILE'])||isset($_SERVER['HTTP_PROFILE'])); // is the device giving us a HTTP_X_WAP_PROFILE or HTTP_PROFILE header - only mobile devices would do this
      $mobile_browser = true; // set mobile browser to true
      $status = 'Mobile matched on profile headers being set'; 
    break; // break out and skip the final step if we've had a return true on the mobile specfic headers

    case (in_array(strtolower(substr($user_agent,0,4)),array('1207'=>'1207','3gso'=>'3gso','4thp'=>'4thp','501i'=>'501i','502i'=>'502i','503i'=>'503i','504i'=>'504i','505i'=>'505i','506i'=>'506i','6310'=>'6310','6590'=>'6590','770s'=>'770s','802s'=>'802s','a wa'=>'a wa','acer'=>'acer','acs-'=>'acs-','airn'=>'airn','alav'=>'alav','asus'=>'asus','attw'=>'attw','au-m'=>'au-m','aur '=>'aur ','aus '=>'aus ','abac'=>'abac','acoo'=>'acoo','aiko'=>'aiko','alco'=>'alco','alca'=>'alca','amoi'=>'amoi','anex'=>'anex','anny'=>'anny','anyw'=>'anyw','aptu'=>'aptu','arch'=>'arch','argo'=>'argo','bell'=>'bell','bird'=>'bird','bw-n'=>'bw-n','bw-u'=>'bw-u','beck'=>'beck','benq'=>'benq','bilb'=>'bilb','blac'=>'blac','c55/'=>'c55/','cdm-'=>'cdm-','chtm'=>'chtm','capi'=>'capi','cond'=>'cond','craw'=>'craw','dall'=>'dall','dbte'=>'dbte','dc-s'=>'dc-s','dica'=>'dica','ds-d'=>'ds-d','ds12'=>'ds12','dait'=>'dait','devi'=>'devi','dmob'=>'dmob','doco'=>'doco','dopo'=>'dopo','el49'=>'el49','erk0'=>'erk0','esl8'=>'esl8','ez40'=>'ez40','ez60'=>'ez60','ez70'=>'ez70','ezos'=>'ezos','ezze'=>'ezze','elai'=>'elai','emul'=>'emul','eric'=>'eric','ezwa'=>'ezwa','fake'=>'fake','fly-'=>'fly-','fly_'=>'fly_','g-mo'=>'g-mo','g1 u'=>'g1 u','g560'=>'g560','gf-5'=>'gf-5','grun'=>'grun','gene'=>'gene','go.w'=>'go.w','good'=>'good','grad'=>'grad','hcit'=>'hcit','hd-m'=>'hd-m','hd-p'=>'hd-p','hd-t'=>'hd-t','hei-'=>'hei-','hp i'=>'hp i','hpip'=>'hpip','hs-c'=>'hs-c','htc '=>'htc ','htc-'=>'htc-','htca'=>'htca','htcg'=>'htcg','htcp'=>'htcp','htcs'=>'htcs','htct'=>'htct','htc_'=>'htc_','haie'=>'haie','hita'=>'hita','huaw'=>'huaw','hutc'=>'hutc','i-20'=>'i-20','i-go'=>'i-go','i-ma'=>'i-ma','i230'=>'i230','iac'=>'iac','iac-'=>'iac-','iac/'=>'iac/','ig01'=>'ig01','im1k'=>'im1k','inno'=>'inno','iris'=>'iris','jata'=>'jata','java'=>'java','kddi'=>'kddi','kgt'=>'kgt','kgt/'=>'kgt/','kpt '=>'kpt ','kwc-'=>'kwc-','klon'=>'klon','lexi'=>'lexi','lg g'=>'lg g','lg-a'=>'lg-a','lg-b'=>'lg-b','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-f'=>'lg-f','lg-g'=>'lg-g','lg-k'=>'lg-k','lg-l'=>'lg-l','lg-m'=>'lg-m','lg-o'=>'lg-o','lg-p'=>'lg-p','lg-s'=>'lg-s','lg-t'=>'lg-t','lg-u'=>'lg-u','lg-w'=>'lg-w','lg/k'=>'lg/k','lg/l'=>'lg/l','lg/u'=>'lg/u','lg50'=>'lg50','lg54'=>'lg54','lge-'=>'lge-','lge/'=>'lge/','lynx'=>'lynx','leno'=>'leno','m1-w'=>'m1-w','m3ga'=>'m3ga','m50/'=>'m50/','maui'=>'maui','mc01'=>'mc01','mc21'=>'mc21','mcca'=>'mcca','medi'=>'medi','meri'=>'meri','mio8'=>'mio8','mioa'=>'mioa','mo01'=>'mo01','mo02'=>'mo02','mode'=>'mode','modo'=>'modo','mot '=>'mot ','mot-'=>'mot-','mt50'=>'mt50','mtp1'=>'mtp1','mtv '=>'mtv ','mate'=>'mate','maxo'=>'maxo','merc'=>'merc','mits'=>'mits','mobi'=>'mobi','motv'=>'motv','mozz'=>'mozz','n100'=>'n100','n101'=>'n101','n102'=>'n102','n202'=>'n202','n203'=>'n203','n300'=>'n300','n302'=>'n302','n500'=>'n500','n502'=>'n502','n505'=>'n505','n700'=>'n700','n701'=>'n701','n710'=>'n710','nec-'=>'nec-','nem-'=>'nem-','newg'=>'newg','neon'=>'neon','netf'=>'netf','noki'=>'noki','nzph'=>'nzph','o2 x'=>'o2 x','o2-x'=>'o2-x','opwv'=>'opwv','owg1'=>'owg1','opti'=>'opti','oran'=>'oran','p800'=>'p800','pand'=>'pand','pg-1'=>'pg-1','pg-2'=>'pg-2','pg-3'=>'pg-3','pg-6'=>'pg-6','pg-8'=>'pg-8','pg-c'=>'pg-c','pg13'=>'pg13','phil'=>'phil','pn-2'=>'pn-2','pt-g'=>'pt-g','palm'=>'palm','pana'=>'pana','pire'=>'pire','pock'=>'pock','pose'=>'pose','psio'=>'psio','qa-a'=>'qa-a','qc-2'=>'qc-2','qc-3'=>'qc-3','qc-5'=>'qc-5','qc-7'=>'qc-7','qc07'=>'qc07','qc12'=>'qc12','qc21'=>'qc21','qc32'=>'qc32','qc60'=>'qc60','qci-'=>'qci-','qwap'=>'qwap','qtek'=>'qtek','r380'=>'r380','r600'=>'r600','raks'=>'raks','rim9'=>'rim9','rove'=>'rove','s55/'=>'s55/','sage'=>'sage','sams'=>'sams','sc01'=>'sc01','sch-'=>'sch-','scp-'=>'scp-','sdk/'=>'sdk/','se47'=>'se47','sec-'=>'sec-','sec0'=>'sec0','sec1'=>'sec1','semc'=>'semc','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','sk-0'=>'sk-0','sl45'=>'sl45','slid'=>'slid','smb3'=>'smb3','smt5'=>'smt5','sp01'=>'sp01','sph-'=>'sph-','spv '=>'spv ','spv-'=>'spv-','sy01'=>'sy01','samm'=>'samm','sany'=>'sany','sava'=>'sava','scoo'=>'scoo','send'=>'send','siem'=>'siem','smar'=>'smar','smit'=>'smit','soft'=>'soft','sony'=>'sony','t-mo'=>'t-mo','t218'=>'t218','t250'=>'t250','t600'=>'t600','t610'=>'t610','t618'=>'t618','tcl-'=>'tcl-','tdg-'=>'tdg-','telm'=>'telm','tim-'=>'tim-','ts70'=>'ts70','tsm-'=>'tsm-','tsm3'=>'tsm3','tsm5'=>'tsm5','tx-9'=>'tx-9','tagt'=>'tagt','talk'=>'talk','teli'=>'teli','topl'=>'topl','hiba'=>'hiba','up.b'=>'up.b','upg1'=>'upg1','utst'=>'utst','v400'=>'v400','v750'=>'v750','veri'=>'veri','vk-v'=>'vk-v','vk40'=>'vk40','vk50'=>'vk50','vk52'=>'vk52','vk53'=>'vk53','vm40'=>'vm40','vx98'=>'vx98','virg'=>'virg','vite'=>'vite','voda'=>'voda','vulc'=>'vulc','w3c '=>'w3c ','w3c-'=>'w3c-','wapj'=>'wapj','wapp'=>'wapp','wapu'=>'wapu','wapm'=>'wapm','wig '=>'wig ','wapi'=>'wapi','wapr'=>'wapr','wapv'=>'wapv','wapy'=>'wapy','wapa'=>'wapa','waps'=>'waps','wapt'=>'wapt','winc'=>'winc','winw'=>'winw','wonu'=>'wonu','x700'=>'x700','xda2'=>'xda2','xdag'=>'xdag','yas-'=>'yas-','your'=>'your','zte-'=>'zte-','zeto'=>'zeto','acs-'=>'acs-','alav'=>'alav','alca'=>'alca','amoi'=>'amoi','aste'=>'aste','audi'=>'audi','avan'=>'avan','benq'=>'benq','bird'=>'bird','blac'=>'blac','blaz'=>'blaz','brew'=>'brew','brvw'=>'brvw','bumb'=>'bumb','ccwa'=>'ccwa','cell'=>'cell','cldc'=>'cldc','cmd-'=>'cmd-','dang'=>'dang','doco'=>'doco','eml2'=>'eml2','eric'=>'eric','fetc'=>'fetc','hipt'=>'hipt','http'=>'http','ibro'=>'ibro','idea'=>'idea','ikom'=>'ikom','inno'=>'inno','ipaq'=>'ipaq','jbro'=>'jbro','jemu'=>'jemu','java'=>'java','jigs'=>'jigs','kddi'=>'kddi','keji'=>'keji','kyoc'=>'kyoc','kyok'=>'kyok','leno'=>'leno','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-g'=>'lg-g','lge-'=>'lge-','libw'=>'libw','m-cr'=>'m-cr','maui'=>'maui','maxo'=>'maxo','midp'=>'midp','mits'=>'mits','mmef'=>'mmef','mobi'=>'mobi','mot-'=>'mot-','moto'=>'moto','mwbp'=>'mwbp','mywa'=>'mywa','nec-'=>'nec-','newt'=>'newt','nok6'=>'nok6','noki'=>'noki','o2im'=>'o2im','opwv'=>'opwv','palm'=>'palm','pana'=>'pana','pant'=>'pant','pdxg'=>'pdxg','phil'=>'phil','play'=>'play','pluc'=>'pluc','port'=>'port','prox'=>'prox','qtek'=>'qtek','qwap'=>'qwap','rozo'=>'rozo','sage'=>'sage','sama'=>'sama','sams'=>'sams','sany'=>'sany','sch-'=>'sch-','sec-'=>'sec-','send'=>'send','seri'=>'seri','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','siem'=>'siem','smal'=>'smal','smar'=>'smar','sony'=>'sony','sph-'=>'sph-','symb'=>'symb','t-mo'=>'t-mo','teli'=>'teli','tim-'=>'tim-','tosh'=>'tosh','treo'=>'treo','tsm-'=>'tsm-','upg1'=>'upg1','upsi'=>'upsi','vk-v'=>'vk-v','voda'=>'voda','vx52'=>'vx52','vx53'=>'vx53','vx60'=>'vx60','vx61'=>'vx61','vx70'=>'vx70','vx80'=>'vx80','vx81'=>'vx81','vx83'=>'vx83','vx85'=>'vx85','wap-'=>'wap-','wapa'=>'wapa','wapi'=>'wapi','wapp'=>'wapp','wapr'=>'wapr','webc'=>'webc','whit'=>'whit','winw'=>'winw','wmlb'=>'wmlb','xda-'=>'xda-',))); // check against a list of trimmed user agents to see if we find a match
      $mobile_browser = true; // set mobile browser to true
      $status = 'Mobile matched on in_array';
    break; // break even though it's the last statement in the switch so there's nothing to break away from but it seems better to include it than exclude it

    default;
      $mobile_browser = false; // set mobile browser to false
      $status = 'Desktop / full capability browser';
    break; // break even though it's the last statement in the switch so there's nothing to break away from but it seems better to include it than exclude it

  } // ends the switch 

 
  
  if($redirect = ($mobile_browser==true) ? $mobileredirect : $desktopredirect){
      if ($desktopredirect != false) { header('Location: '.$redirect);  exit; } // redirect to the right url for this device
       else  { return 1;   }
  
   }else{   
		// a couple of folkas have asked about the status - that's there to help you debug and understand what the script is doing
		if($mobile_browser==''){
			{   return $mobile_browser;  }// will return either true or false 
		}else{  
			 return array($mobile_browser,$status); // is a mobile so we are returning an array ['0'] is true ['1'] is the $status value
		}
	}

}

 
 //==================================================
 
 function docfile($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
  }
  
 //==================================================
 function getdong($sqldt)
{  global $data ;

   $result= $data->query($sqldt) ;
   $row = $data->fetch_array($result) ;
  // $row = $data->fetch_rows($result) ;
 
   return $row ;	
}
 //==================================================   
function set_cookie($name, $value = "", $remember = 1){
 	if ($remember == 1)
	{
	$expires = time() + 60*60*24*365;
	}
 	setcookie($name, $value, $expires, "/", "");
}
//==================================================

function thaythe($chars){
    $chars = str_replace('&gt;', '>', $chars);
    $chars = str_replace('&lt;', '<', $chars);
    $chars = str_replace('&quot;', '"', $chars);
    $chars = str_replace('&amp;', '&', $chars);

 	$chars = str_replace(chr(13), '\n', $chars);
	$chars = str_replace(chr(10), '\f', $chars);
 
 return $chars;
}
//===========================================
function compocay($table,$nameht,$tencotidchild,$id_root, $level,$select_i,$idcall)
 	{	
	echo $id_root."<br>";
 		global $data, $compocaydata;  
		$space="&nbsp;&nbsp;&nbsp;";	$name1="";	 	
		for($i=0; $i<$level; $i++)	{$name1.=$space;}
		$sql="SELECT $nameht,ID,$tencotidchild  FROM  $table WHERE $tencotidchild  ='$id_root' and ID != 0";
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
			{  
				$id = $result_news["ID"] ;
				if ($result_news["$tencotidchild"] == "0") { $name1 = "" ; }
				$name=$name1."".$result_news["$nameht"];
				$compocaydata.= "<option  title=\"$name\" value='$id' >$name</option>" ;
				compocay($table,$nameht,$tencotidchild,$id, $level+1,$select_i,$idcall);
			}
		}
}
 //============================================
function goidulieu($dl,$url)
   {
		foreach($dl as $key=>$value) { $fields_string .= $key.'='.urlencode($value).'&'; }
		rtrim($fields_string,'&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
		ob_start();
		$tv = curl_exec($ch);
		curl_close($ch);
		ob_end_clean();  
		return $tv ;
   }	
//==================================================================
function taocay($table,$Namesl,$IDsl,$IDGroup,$id_root, $level,$select_i,$idcall,$action)
	{			
		global $data, $taocaydata ;  
		$space="&nbsp;&nbsp;&nbsp;&nbsp;";	$name1="";	  
 		for($i=0; $i<$level; $i++){	$name1 .=$space; }
 		$sql="SELECT $Namesl , $IDsl, $IDGroup  FROM  $table WHERE $IDGroup ='$id_root' and $IDsl <> 0 order by Rank desc";
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
			{
				$idr = $result_news["$IDsl"] ;
 				if ($result_news["$IDGroup"] == "0") { $name1 = "" ; }
 				$named=$name1."".$result_news[$Namesl];
 				$select = "" ;
 				if ( trim($select_i) == trim($idr) ){	$select = "selected";	}				 
				if (trim($idcall)!= trim($idr) &&   $action ==false )
				   { $taocaydata .="<option value='$idr' $select>$named</option> ";}			
				   else   {	 $taocaydata .= "<optgroup label='$named'></optgroup>" ; $action = true ;  }
				   taocay($table,$Namesl,$IDsl,$IDGroup,$idr, $level+1,$select_i,$idcall,$action);		 $action = false ;	 
			 }
		 }
	}
	//==============================================
function timnhom($table,$cotcha,$idtim,$cotlay="ID",$sqlwhere=""){
  global $data ;
  $tam ="";
  $sql = " select $cotlay,$cotcha from $table where $cotcha = '$idtim'  $sqlwhere "; 
  if($result=$data->query($sql))
  {			
	 while($result_news = $data->fetch_array($result))
	 {	
		  $tam .=  ",".$result_news[$cotlay] ;
  		  $tam .= timnhom($table,$cotcha,$result_news[$cotlay]);
 	 }
  }	
    return $tam ;
 }


function tinhtong($table,$cottinh,$where){
global $data ;
$sql = "select count($cottinh) as tong from $table $where  "   ;
$result= $data->query($sql) ;
$n = $data->fetch_array($result);
return $n["tong"] ;
} 

//===========================================
function taomangs($table,$truong1,$truong2,$where=""){
global $data ;
	$sql = "select $truong1,$truong2 from $table $where  "   ;

  	$result= $data->query($sql) ;
	$mangt =  array() ;
  	while($n = $data->fetch_array($result))
	{
		foreach($n as $x=>$x_value)
		{
			
			if ($id=='') $id = $x  ;else $va =$x ;
 		}	 
	   $mangt[$n[$id]] = $n[$va] ;
	  // echo $n[$id] . '---'. $n[$va]."<br>" ;
 	}
 	return  $mangt ;
}

//===========================================
function taomang($table,$truong1,$truong2,$where=""){
global $data ;
	$sql = "select $truong1,$truong2 from $table $where  "   ;
	
 	$result= $data->query($sql) ;
	$mang =  array() ;
 	while($n = $data->fetch_array($result))
	{
	   $idm = $n[$truong1] ;
	   $ten = $n[$truong2] ;
	   $mang[$idm] =  $ten ;
	   
	}
		 
	return  $mang ;
}
//==========================================

function taomangj($table,$truong1,$truong2,$where="",$tenmang="mangj"){
global $data ;
	$sql = "select * from $table $where  "   ;
 	$result= $data->query($sql) ;
	$mangj = " var $tenmang = Array() ; " ;
 	while($n = $data->fetch_array($result))
	{
	   
	   $idm = $n[$truong1] ;
	   $ten = addslashes(trim($n[$truong2])) ;
	   $mangj .= $tenmang."['$idm'] = '$ten' ;" ;
 	}
	return  $mangj ;
}
//==========================================

function taomangsql($sql){
global $data ;
	 
 	$result= $data->query($sql) ;
	$mang =  array() ;
 	while($n = $data->fetch_array($result))
	{
	   $idm = $n["ID"] ;
	   $ten = $n["value"] ;
	   $mang[$idm] =  $n ;
	   
	}
		 
	return  $mang ;
 
	 
}
//==========================================

function compo1($table,$Name,$idsosanh){
	 global $data;
	$sql = "select $Name,ID from $table " ;
 	$result= $data->query($sql) ;
	while($n = $data->fetch_array($result))
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
 //====================================

function composx($table,$Name,$idsosanh,$cotsapxep= "",$where= ""){
    global $data;
	$f_sx = "" ;
 	
	if ($cotsapxep != "") 
	{ 
		if (strpos($cotsapxep,"order by") || strpos($cotsapxep,"where")  )
		{	
			$f_sx = $cotsapxep ;
		} else
		{
			$f_sx = " order by  $cotsapxep   desc " ;
		}
	}	
	$sql = "select $Name,ID from $table $where  $f_sx " ;

 	$result = $data->query($sql) ;	
 	while($n = $data->fetch_array($result))
	{
		$ft = addslashes($n[$Name]) ; 
		if($n["ID"] == $idsosanh)
		{
			
			$output .= "<option value='".$n["ID"]."' selected>".$n[$Name]."</option>\n";
		}
		else
		{
			$output .= "<option title=\"$ft\"    value='".$n["ID"]."'>".$ft."</option>\n";
		}
	}
	return $output;

}
//===========================================
function compoloai($table,$ma,$Name,$idsosanh,$where){
global $data ;
	$sql = "select $ma,$Name,ID from $table $where  "   ;
 	$result= $data->query($sql) ;
 	while($n = $data->fetch_array($result))
	{
	   $ma1 = trim($n[$ma]) ;
	   if (strlen($ma1)<11)
	   {
 	   	 	for ($i = strlen($ma1);$i<8;$i++)
			{
				$ma1 .= "&nbsp;&nbsp;" ;  
			}
			$ma1 .= "  " ;  
	   }
 		if($n["ID"] == $idsosanh)
		{
			$output .= "<option value='".$n["ID"]."' selected>".$ma1." - ".$n[$Name]."</option>\n";
		}
		else
		{
			$output .= "<option value='".$n["ID"]."'>".$ma1." - ".$n[$Name]."</option>\n";
		}
	}
	return $output;
 } 
//===========================================


function compochung($sq,$idss)   // vao chui sql co it nhat 2 truong truong 1 l� id truong 2 la ten
{   
	global $data;
//	echo $sq ;
   	$result = $data->query($sq) ;
 	// $fields = mysql_num_fields($result); lay so phan tu
 	$id = mysql_field_name($result,0);
	$valu = mysql_field_name($result,1);
	 
 	while($n = $data->fetch_array($result))
	{ 
	   if ($n[$id] !="")
	   {
			if($n[$id] == $idss)
			{
				$output .= "<option value='".$n[$id]."' selected>".$n[$valu]."</option>\n";
			}
			else
			{
				$output .= "<option value='".$n[$id]."'>".$n[$valu]."</option>\n";
			}
		}
	}
	return $output;

}

//======================================================================

 
//=============Get cookie=====================================
function get_cookie($name)
{
if (isset($_COOKIE[$name]))
{
return urldecode($_COOKIE[$name]);
}
else
{
return FALSE;
}
}

//==================================================

function kttrung($table,$cot,$truongss,$idloaitru) {
global $data ;
$sql="SELECT $cot,ID FROM $table WHERE ID != '$idloaitru' and  $cot ='$truongss'  ";

 $result= $data->query($sql) ;
 
 $row = $data->num_rows($result);

  return $row ;
}
function HTDSPhong1($id_root, $level,$select_i,$idcall)
 	{	
 		global $data, $dsphong;  
		$space="&nbsp;&nbsp;";
		$name1="";	 	
		for($i=0; $i<$level; $i++)
		{
			$name1.=$space;
		}
		$sql="SELECT Name,ID,ChildID  FROM  rooms WHERE ChildID='$id_root' and ID != 0";
		
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
			{
				$id = $result_news["ID"] ;
				if ($result_news["ChildID"] == "0") { $name1 = "" ; }
				$name=$name1."".$result_news["Name"];
				$dsphong.= "<option  title=\"$name\" value='$id' >$name</option>" ;
				HTDSPhong($id, $level+1,$select_i,$idcall);
			 
			}
		}
}	
//===========================================

function xemquyen($FunctionID)	
{
	 global $mquyen;
    $re =  $mquyen[$FunctionID];
 	return strrev($re);
}  
function phanquyenthu($quyenthu,$chucnang)	
  {
     global $data;
     if (trim($data->getdangnhap()) == "1" ) return 1 ;
 
	$tam =  strrev($quyenthu); // dao chuoi 
 	if ($tam == 0 || trim($tam) == "" ) return 0;
	
	
//	echo $quyenthu ;
	switch($chucnang)
	{   //  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
		case "xem":   //  1 000 000
			return $tam[6];
			break;
		case "them":  //  0 100 000
			return $tam[5];
			break;  //  0 010 000
		case "capnhap":
			return $tam[4];
			break;
		case "tim":  //  0 001 000
			return $tam[3];
			break;
		case "xoa":  //  0 000 100
			return $tam[2];
			break;
		case "khoa":  //  0 000 010
			return $tam[1];
			break;
		case "in":  //  0 000 001
			return $tam[0];
			break;
			
	}
	
	return 0;
  
  }

function kiemtraxoa($table,$truongsele,$dieukien)	
{
 global $data ;
  $sql = " select $truongsele from $table  $dieukien   " ;
   //echo $sql ;
  return  $data->sodong($sql) ;
}  

function kiemtraquyenthumuc($FunctionID,$chucnang)	
  { return 1 ;
    global $mquyen,$data;
	if ($data->getdangnhap() == "1" ) return 1 ;
    $re =  $mquyen[$FunctionID];
	$tam =  strrev($re); // dao chuoi 
 	if ($tam == 0 || trim($tam) == "" ) return false;
	switch($chucnang)
	{   //  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
		case "xem":   //  1 000 000
			return $tam[6];
			break;
		case "them":  //  0 100 000
			return $tam[5];
			break;  //  0 010 000
		case "capnhap":
			return $tam[4];
			break;
		case "tim":  //  0 001 000
			return $tam[3];
			break;
		case "xoa":  //  0 000 100
			return $tam[2];
			break;
		case "khoa":  //  0 000 010
			return $tam[1];
			break;
		case "in":  //  0 000 001
			return $tam[0];
			break;
			
	}
	
	return false;
 }	
function Layphanquyen($dl,$quyen)
{
 	$dl= $dl."";
	if (trim($dl) == "")
	{
		 return 0;
	} 	
	$tam = explode("!@!",$dl);
	if($quyen<0&&$quyen>count($tam)-1)
		return 0;
	return $tam[$quyen-1];
}
function kiemtrasoluongus($sl)
{
   global $data ;
     
	$sql = "select count(ID) as sl from userac " ;
	
  	$result = $data->query($sql) ;
	$row =  $data->fetch_array($result) ;	
	if ( ($row["sl"] *1) > ($sl*1 + 2 )  )
	 { return($row["sl"]-2) ;} else 
	 { return("ok") ;} 	
}

 function kiemtraquyen($mangquyen,$quyen,$loai)
 {	
	if ( $_SESSION["dangnhap"] == "admin" ) 
	{
		return true;
	}			
	if (trim($mangquyen) == "")   
	{
		return false;
	}
	
	$tam = explode("!@!",$mangquyen);
	
	for($j=0;$j<28;$j++)
	{
		if ($j==($quyen-1)) 
		{ 	
		    if ($tam[$j] == 7) return true;			
 			if ($tam[$j] == $loai) return true;
			if (($loai == 2) and ($tam[$j] >= 2)) return true;
			if (($loai == 4) and ($tam[$j] == 6))  return true;
			if (($loai == 5) and ($tam[$j] == 6))  return true;
			if (($loai == 6) and ($tam[$j] == 4))  return true;
			if (($loai == 6) and ($tam[$j] == 5))  return true;
			if (($loai == 6) and ($tam[$j] == 6))  return true;	
		}
	}
 	return false;
}

function gettruong($table,$tencotlay,$dieukien)
{
   global $data ;
 	$sql = "select $tencotlay from $table where  $dieukien " ;
//	echo $sql ;
     $result = $data->query($sql) ;
 	$row = $data->fetch_array($result);	
	//s	echo   $row[$cot] ;			
		return $row[$tencotlay] ;		
}

function getngay($kieu = '')
{
	if ($kieu == "dmy")	{	$ngay =  gmdate('d/m/Y', time() + 7*3600) ;return $ngay;}
	if ($kieu == "ymd")	{	$ngay =  gmdate('Y/m/d', time() + 7*3600) ;return $ngay;}
	$ngay =  gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	return $ngay;			
}

function bokytu($st,$kt,$ktthay='')
{
 	return str_replace($kt,$ktthay,$st);			
}

function trima($st)
{
 	return str_replace(' ','',$st);			
}
function formatngay($ngayvao,$kieura)
{
 
	if ($kieu == "dmy")	{	$ngay =  gmdate('d/m/Y', time() + 7*3600) ;return $ngay;}
	if ($kieu == "ymd")	{	$ngay =  gmdate('Y/m/d', time() + 7*3600) ;return $ngay;}
	$ngay =  gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	return $ngay;			
}
function getten($table,$ID,$cot)
{
   global $data ;
 	$sql = "select ID,$cot from $table where  ID='0$ID' " ;
     $result = $data->query($sql) ;
 	$row = $data->fetch_array($result);	
	 //	echo  $sql ;			
		return $row[$cot] ;		
}

function chonghack($ch)
{
	
	$ch = htmlspecialchars( $ch );
	$ch = str_replace( ">" , "&gt;" , $ch );
	$ch = str_replace( "$" , "&#36;" , $ch );
	$ch = str_replace( "<" , "&lt;" , $ch );
	$ch = str_replace( "'" , "&rsquo;" , $ch );
	$ch = str_replace( '"' , "&quot;" , $ch );
	$ch = str_replace( '&amp;' , "&" , $ch );	
	return $ch ;
}
function chonghackso($chuoi)
{
	return $chuoi ;	
}
function chonghackchu($chuoi)
{
	return $chuoi ;	
}
//===============================================
function getmuc($table,$ID)
{
   global $data ;
 
	$sql = " select ID from functions where  NameTable='$table' and  TableID= '$ID'";
	$result =$data->query($sql) ;
	$row = $data->fetch_array($result);	
	return $row["ID"] ;	
}

//===========================================
function getid($table)
{
   global $data ;
 	$sql = " select ID from ".$table." order by ID Desc limit 1 ";
	$result = $data->query($sql) ;
	$row =  $data->fetch_array($result) ;
	return $row["ID"] ;	
}
//=========================================
function getitem($UserID,$functionID)
{
   global $data ;
	$sql = " select Item from userright where UserID ='$UserID' and  FunctionID = '$functionID' ";
	$result = $data->query($sql) ;
	$row =  $data->fetch_array($result);
 	return $row["Item"] ;	
}

//=========================================


function tenmuc($table,$ID,$tenmuc)
{
   global $data ;
	$sql = " select $tenmuc from ".$table." where  ID = '$ID'";
	$result = $data->query($sql);
	$row =  $data->fetch_array($result);
 	$tam = $row["Name"] ;	
	return $tam;
}

//=========================================
function update_function($ID,$tableID,$nametable)
{
   global $data ;
	$sql = " update  functions set (tableID ,TableID) values  ";
	$sql = $sql."('$nametable',";
	$sql = $sql."'$ID')";	
    $update = $data->query($sql);
 }
//=========================================
function insert_function($NameTable,$TableID)
{
   global $data ;
	$sql = " insert into functions (NameTable,TableID) values  ";
	$sql = $sql."('$NameTable',";
	$sql = $sql."'$TableID')";	
    $update = $data->query($sql);
	

 }

//=======================================
function delete_function($NameTable,$TableID)
{
   global $data ;
	$sql = " select ID from functions where NameTable = '$NameTable' and TableID = '$TableID'";
	$result = $data->query($sql);
	$row =  $data->fetch_array($result) ;
 	$sql = " delete from userright where FunctionID  = '".$row["ID"]."' ";
	$update = $data->query($sql);
  	$sql = " delete from functions where NameTable = '$NameTable' and TableID = '$TableID'";
	$update = $data->query($sql);
 
}



//=========================================
function insert_userright($UserID,$FunctionID,$Item)
{
   global $data ;
	$sql = " insert into userright (UserID,FunctionID,Item) values  ";
	$sql = $sql."('$UserID',";
	$sql = $sql."'$FunctionID',";
	$sql = $sql."'$Item')";	
    $update = $data->query($sql);

 }

//===========================================
function delete_userright($UserID)
{
    global $data ;
	$sql = " delete  from  userright where UserID = '$UserID'";
	 $update = $data->query($sql);}
//===========================================
function kiemtranhomcon($table,$ID,$kiemtra)
{
   global $data ;
   $sql = " select ID from  $table where $kiemtra = '$ID'";	
//   echo $sql ;
   $result = $data->query($sql) ;
   $row =  $data->num_rows($result);
  	if ($row > 0) 
	{
		return("1");
	}
	else
	{
		return("0");
	}		
 	
}

//===========================================


function name_savefile($str)
{
// chuoi file goi cac file: "abc.gif*def.dat"
	$tam = "";
	while ($str != "")
	{
		if (strpos($str,"*",0) != 0 ) 
		{
		$ten = substr($str,0,strpos($str,"*",0));
		$ten ="<a target='_blank' href='file/".$ten."' style='text-decoration:none'>&nbsp;&nbsp;<img src='images/nut.gif'  border='0'; />&nbsp;".get_name($ten)."</a><br>";  
		$tam = $tam.$ten;
		}
		if (strpos($str,"*",0)!=0)
		{
			$str = substr($str,strpos($str,"*",0)+1);
			
		}
		else
		{
			$ten = $str;
		$ten ="<a  target='_blank' href='file/".$ten."' style='text-decoration:none'>&nbsp;&nbsp;<img src='images/nut.gif'  border='0' />&nbsp;".get_name($ten)."</a><br>";  
			$tam = $tam.$ten;
			$str=""; 	
		}

	}
	return($tam);
}
//=========================================
function get_name($name)
{
	$tam = stristr($name, '^');	
	$tam = substr($tam,1);
	return($tam);
}

//=========================================
function delete_P($name)
{
	
	$tam = str_replace("<P>","",$name);	
	$tam = str_replace("</P>","",$tam);	
	return($tam);
}
//=================================
function laso($str)
{
	
	$tam = str_replace(",","",trim($str));	
	if ( is_numeric($tam))	
	{ 
		return($tam);
	} else
	{
		return 0 ;
	}
}


//=================================
function formatso($str)
{	 
	$tam = number_format($str) ;
	return $tam ;
}


//=================================

function thu($so)
{
	switch($so)
	{
		case "0": 
			return "Ch&#7911; nh&#7853;t" ;			
			break;
		case "1": 
			return "Th&#7913; hai" ;			
			break;
		case "2": 
			return "Th&#7913; ba" ;			
			break;
		case "3": 
			return "Th&#7913; t&#432;" ;			
			break;
		case "4": 
			return "Th&#7913; n&#259;m" ;			
			break;
		case "5": 
			return "Th&#7913; s&#225;u" ;			
			break;
		case "6": 
			return "Th&#7913; b&#7843;y" ;			
			break;


	}
	return "";			
}
function kiemtrauser($user)
{
   global $data ;
	$sql = "select *  from account_user  where username ='".$user."'";
	$result = $data->query($sql);
	$row =  $data->num_rows($result);
 
	return $row;
	
}

 
 
 

//=========================================================================================================
function kiemtraphanquyen($UserID,$FunctionID,$chucnang)
{
   global $data ;
	$sql = "select Item from userright where FunctionID ='$FunctionID' and  UserID  ='$UserID'";
	$result = $data->query($sql);

 	if (!$result)
	{return -2;}
	else
	{
	$row = $data->fetch_array($result) ;
	$re =  stripslashes ($row["Item"]);
	$tam = strrev("$re"); 
	if ($tam == 0  ) return -2;
	switch($chucnang)
	{
		case "xem":
			return $tam[4];
			break;
		case "them":
			return $tam[3];
			break;
		case "capnhap":
			return $tam[2];
			break;
		case "hienthi":
			return $tam[1];
			break;
		case "xoa":
			return $tam[0];
			break;
	}
	
	return -1;
   }
}
//=========================================================================================================

function so_ngau_nhien()
{
$ngay = date('d');
$thang = date('m');
$nam = date('Y');
$gio = date('h');
$phut =date('i');
$giay = date('s');
$so = $ngay.$thang.$nam ;
$so =  $so . ( $gio * 3600  + $phut * 60 + $giay ) ;
//$so =  31   + 12 * 31 + 2100 * 372 + 24 * 3600  + 60 * 60 + 60 ;

  return $so;
}

function check_filetype($file_type){
	if ($file_type == "image/pjpeg") {
		return ".jpg";
	} elseif ($file_type == "image/bmp") {
		return ".bmp";
	}elseif($file_type == "image/x-png"){
		return ".png";
	} elseif ($file_type == "image/gif") {
		return ".gif";
	} else {
		return 0;
	}
}

function image_thumbnail($pic){
	$colours = split(",","255,255,255");
	require "class.dropshadow.php";
	require "class.originaldropshadow.php";
	$ds = new originalDropShadow();
	$ds->setDebugging(TRUE);
	$ds->setImageSize("100");
	$ds->setImageType("jpg");
	$ds->setShadowPath("../../../images/shadows");
	$ds->createDropShadow("../../../uploads/news/fulls/$pic", "../../../uploads/news/thumbnails/$pic", $colours);
}

function cut_string($str,$len,$more){
   	if ($str=="" || $str==NULL){ 
		return $str;
	}
   	if (is_array($str)){
   		return $str;
   	}
   	$str = trim($str);
   	if (strlen($str) <= $len){
   		return $str;
   	}
   	$str = substr($str,0,$len);
   	if ($str != ""){
        if (!substr_count($str," ")) {
        	if ($more){
        		$str .= " ...";
        	}
            return $str;
        }
        while(strlen($str) && ($str[strlen($str)-1] != " ")) {
        	$str = substr($str,0,-1);
        }
        $str = substr($str,0,-1);
        if ($more){
        	$str .= " ...";
        }
	}
    return $str;
}

function valid_email($email) {
	if (!eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$",$email) && $email != "") {
		return false;
	} else {
		return true;
	}
}

function check_number($str) {   
    if (ereg('^[[:digit:]]+$', $str)) 
           return 1; 
    else 
           return 0; 
}

function randomstring($length){
	$haystack = '0123456789ABCDEFGHKLMNOPRSTUVXYZabcdefghijklmnopqrstuvwxyz';
	$needle ="";
	while(strlen($needle) < $length) {
		$needle .= substr($haystack,rand(0,strlen($haystack)),1);
	}
	return($needle);
}

function gmdates($input_date,$value){
	$zone=3600*7;
	$out_date=gmdate($value, $input_date + $zone); // Ex: $value = "d:m:Y h:i:s a";
	return $out_date;
}

function date_make(){
	$date_make = time();
	return $date_make;
}

function sql_injection($str){
	if(!ereg('[\\\'\"!=:;,=&]', $str)){
		return $str;
	}
}

function option_cat($query, $idsosanh, $id, $name){
	global $data;
	while($n = $data->fetch_array($query)){
		if($n[$id] == $idsosanh){
			$output .= "<option value='".$n[$id]."' selected>".$n[$name]."</option>\n";
		}else{
			$output .= "<option value='".$n[$id]."'>".$n[$name]."</option>\n";
		}
	}
	return $output;
}


function rand_array($input_array,$input_number){
	srand((float) microtime() * 10000000);
	$rand_two = array_rand($input_array, $input_number); 
	$output = array();
	for($i=0;$i<$input_number;$i++){
		$output[] = $input_array[$rand_two[$i]];
	}
	return $output;
}

function alpha(){
	$alpha = array('A','B','C','D','E');
	return $alpha;
}

function gd2_image($file_gd_image, $alt){
	$show = "<img src='./includes/".$file_gd_image."' alt='$alt'>";
	return $show;
}
function regular_expression($str_one){
	$regular_expression = "@\[MEDIA\]([^']+)\[/MEDIA\]@";    
	$str_two = "<P align=center><OBJECT ID='Media' classid='CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95' codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701' standby='Loading Microsoft Windows Media Player components...' type='application/x-oleobject'>
        			<param name='Filename' value='\\1'>
        			<param name='ShowControls' VALUE='-1'>
        			<param name='ShowStatusBar' VALUE='-1'>
        			<param name='AutoSize' VALUE='0'>
        			<param name='AudioStream' value='-1'>
        			<param name='AutoStart' value='0'>
        			<param name='Volume' value='-180'>
        			<param name='EnableContextMenu' value='false'>
        			<embed type='application/x-mplayer2' pluginspage='http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/' file='\\1' src='\\1' ShowControls='1' ShowDisplay='0' ShowStatusBar='1' width='350' height='300'></embed>
      			</OBJECT></p>";   
	$str_one = preg_replace($regular_expression, $str_two, $str_one);
	return $str_one;
}

function config(){
	global $data;
	$config = $data->query("SELECT * FROM $data->table_config ORDER BY id ASC");
	$rows_config=$data->num_rows($config);
	while($n = $data->fetch_array($config)){
		$output[] = $n["value"];
	}
	return $output;
}

function senttime($format = 0, $timestamp){
	global $timezoneoffset, $timeoffset, $dateformat, $hourdiff;

	if($format == 0){
	$format = $dateformat;
	}

	return @date($format, $timestamp - $hourdiff);
}


function pms_die($reason) {
}

function dl_file($filestring, $filename, $filetype){
// send file to browser

if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') OR strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') ) {
        $filetype = 'application/octetstream';
    } else {
        $filetype = 'application/octet-stream';
    }

    header('Content-Type: ' . $filetype);
    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . strlen($filestring));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');

    echo $filestring;
    exit;
}


function xml_escape_cdata($xhtml){
// prevents nested CDATA tags in XML files
    $xhtml = str_replace('<![CDATA[', '![CDATA[', $xhtml);
    $xhtml = str_replace(']]>', ']]', $xhtml);
    return $xhtml;
}

function kiemtradinhdangngay($ngayvao,$dinhdang="dd-mm-yyyy")
{  
	$ngayvao =  explode('/',$ngayvao);
	 
 	$ngayvao[0] = laso($ngayvao[0]) ;
	$ngayvao[1] = laso($ngayvao[1]) ;
	$ngayvao[2] = laso($ngayvao[2]) ;
	
	if ($dinhdang=="dd-mm-yyyy")
	{    if (strlen($ngayvao[2])== 2) {  $ngayvao[2] = "20".$ngayvao[2] ;  }
		 if ( $ngayvao[0] < 1 || $ngayvao[0]>31 ) { return 0 ;}
		 if ( $ngayvao[1] < 1 || $ngayvao[1]>12 ) { return 0 ;}
		 if ( $ngayvao[2] < 1900 || $ngayvao[2]>2100 ) { return 0 ;}
	}
	if ($dinhdang=="mm-dd-yyyy")
	{ 
		if (strlen($ngayvao[2])== 2) {  $ngayvao[2] = "20".$ngayvao[2] ;  } 
	// echo $ngayvao[2]."====". $ngayvao[1]."====". $ngayvao[0]."====";
		 if ( $ngayvao[1] < 1 || $ngayvao[1]>31 ) {  return 0 ;}
		 if ( $ngayvao[0] < 1 || $ngayvao[0]>12 ) {  return 0 ;}
		 if ( $ngayvao[2] < 1900 || $ngayvao[2]>2100 ) { return 0 ;}
			
		 
	}
	if ($dinhdang=="yyyy-mm-dd")
	{   if (strlen($ngayvao[0])== 2) {  $ngayvao[2] = "20".$ngayvao[2] ;  }
		 if ( $ngayvao[2] < 1 || $ngayvao[2]>31 ) { return 0 ;}
		 if ( $ngayvao[1] < 1 || $ngayvao[1]>12 ) { return 0 ;}
		 if ( $ngayvao[0] < 1900 || $ngayvao[0]>2100 ) { return 0 ;}
	}	 
  return  1;
}
	
 
	
function chuyenngay($ngayvao,$dinhdangvao="yyyy-mm-dd",$dinhdangra="yyyy-mm-dd")
{
//echo "<br>vvv" .$ngayvao."<br>.kkv"; 	 
if ($ngayvao=='') return "";
$ngay=$ngayvao;
$ngayvao = str_replace("/","-",$ngayvao);$ngayvao = str_replace("  "," ",$ngayvao); $ngayvao = str_replace(" -","-",$ngayvao);
$dinhdangvao = str_replace("/","-",$dinhdangvao); $dinhdangvao = str_replace("  "," ",$dinhdangvao);
$dinhdangra = str_replace("/","-",$dinhdangra); $dinhdangra = str_replace("  "," ",$dinhdangra);

 
$ngayvao=  explode(' ',$ngayvao." ");
$gio =  $ngayvao[1] ; 
$ngayvao =$ngayvao[0];
 if (trim($gio) !='' ) $gio = " " . $gio ; 
 if(strlen($ngay)<12) $gio=""; 
 if ($dinhdangvao=="dd-mm-yyyy")
 {
	
	$ngayvao=  explode('-',$ngayvao);
	if(laso($ngayvao[1])>12 || laso($ngayvao[0])>31 )  return  "";
	
	if (strlen($ngayvao[2])== 2) {  $ngayvao[2] = "20".$ngayvao[2] ;  }   
	if (strlen($ngayvao[1])== 1) {  $ngayvao[1] = "0".$ngayvao[1] ;  }
	if (strlen($ngayvao[0])== 1) {  $ngayvao[0] = "0".$ngayvao[0] ;  }   
	if($ngayvao[0]>31) {  return '';} 
	$ngayvao = "$ngayvao[2]-$ngayvao[1]-$ngayvao[0]" ;
	//  echo $ngayvao."<br>...";
 }
  if ($dinhdangvao=="mm-dd-yyyy")
 {
	$ngayvao=  explode('-',$ngayvao);
	if (strlen($ngayvao[2])== 2) {  $ngayvao[2] = "20".$ngayvao[2] ;  }   
	if (strlen($ngayvao[1])== 1) {  $ngayvao[1] = "0".$ngayvao[1] ;  }
	if (strlen($ngayvao[0])== 1) {  $ngayvao[0] = "0".$ngayvao[0] ;  }   
	if($ngayvao[1]>31) {  return '';} 
	$ngayvao = "$ngayvao[2]-$ngayvao[0]-$ngayvao[1]" ;
 }
  if ($dinhdangvao=="yyyy-mm-dd")
 {
	$ngayvao=  explode('-',$ngayvao);
	if (strlen($ngayvao[0])== 2) {  $ngayvao[2] = "20".$ngayvao[2] ;  }   
	if (strlen($ngayvao[1])== 1) {  $ngayvao[1] = "0".$ngayvao[1] ;  }
	if (strlen($ngayvao[2])== 1) {  $ngayvao[0] = "0".$ngayvao[0] ;  }  
	if($ngayvao[2]>31) {  return '';} 
	$ngayvao = "$ngayvao[0]-$ngayvao[1]-$ngayvao[2]" ;	
 }	
 
   
 
  $tam = explode('-',$ngayvao);
  if ($dinhdangra=="mm-dd-yyyy") $ngayvao="$tam[1]-$tam[2]-$tam[0]"  ;	
  if ($dinhdangra=="dd-mm-yyyy") $ngayvao="$tam[2]-$tam[1]-$tam[0]" ;
  if ($dinhdangra=="yyyy-mm-dd") $ngayvao="$tam[0]-$tam[1]-$tam[2]"  ;
 
 
 
return  $ngayvao .$gio;
}

 
 
function unhtmlspecialchars($chars){
    $chars = str_replace('&gt;', '>', $chars);
    $chars = str_replace('&lt;', '<', $chars);
    $chars = str_replace('&quot;', '"', $chars);
    $chars = str_replace('&amp;', '&', $chars);
	$chars = str_replace('\'\'', '\'', $chars);
    return $chars;
}

 
function doiso($so) 
{
//var  $Chu , $solop , $so1 , $tg ;
if ($so == 0 || $so == "") 
{ return "-" ; }

if ($so < 0) 
{
	$Chu = "(&#194;m) " ;
	$so = 0 - $so ;
}
//ReDim term(10) , lop(6) , tlop(6) 

$term["1"] = " m&#7897;t" ;
$term["2"] = " hai";
$term["3"] = " ba";
$term["4"] = " b&#7889;n";
$term["5"] = " n&#259;m";
$term["6"] = " s&#225;u";
$term["7"] = " b&#7843;y";
$term["8"] = " t&#225;m";
$term["9"] = " ch&#237;n";

$tlop["1"] = "" ;
$tlop["2"] = " ng&#224;n";
$tlop["3"] = " tri&#7879;u";
$tlop["4"] = " t&#7927;";
$tlop["5"] = " ng&#224;n t&#7927;";
$tlop["6"] = " tri&#7879;u t&#7927;";

$so1 = $so ;
$solop = 1;
while ($so1 > 0)
{
	$tg = $so1 ;
	$so1 =  intval($so1 / 1000); // int coi lai
	 
	$lop[$solop] = $tg - $so1 * 1000;
	$solop = $solop + 1 ;
}
$i = $solop - 1 ;
// $Chu = ""
while ($i > 0 )
{
	$so1 = $lop[$i] ;
if ($so1 > 0 )
{
	$hangtram = intval($so1 / 100 ) ;
	$hangchuc =  intval(($so1 - $hangtram * 100)/ 10 );
	$hangdonvi = $so1 - $hangtram * 100 - $hangchuc * 10 ;
	if ($hangtram > 0 )
	{	//Chu $so hang tram c ngha $so1>=100
		$Chu = $Chu . $term[$hangtram] . " tr&#259;m" ;
	}	
//Xet chu $so hang chuc
if ( $hangchuc > 1 )
{
 	$Chu = $Chu . $term[$hangchuc] . " m&#432;&#417;i" ;
	 
}elseif ($hangchuc == 1 )
{
	$Chu = $Chu . " m&#432;&#7901;i" ;
}elseif ($hangchuc == 0 && $so1 > 100 && $hangdonvi != 0 )
{
	$Chu = $Chu . " l&#7867;" ;
}
// Xet ch s- hng n v"
	if ($hangdonvi != 5 && $hangdonvi != 0 && $hangdonvi != 1 )
	{
		$Chu = $Chu . $term[$hangdonvi] ;
	}
	elseif ($hangdonvi == 5 && $hangchuc != 0 )
	{ 
		$Chu = $Chu . " l&#259;m " ;
	}
	elseif ($hangdonvi == 5 && $hangchuc == 0 )
	{ $Chu = $Chu . " n&#259;m " ;}
	elseif ($hangdonvi == 1 && $hangchuc > 1 )
	{
		$Chu = $Chu . " m&#7889;t" ; 
	}
	else
	{ $Chu = $Chu . $term[$hangdonvi] ;
	}
 
$Chu = $Chu . $tlop[$i] ;
}
// Xet lop ke tiep
$i = $i - 1 ;
} // Loop
	$Chu = trim($Chu);
	 
	if ($Chu != "" )
	{
	 $Chu = strtoupper(substr($Chu,0,1)) . substr($Chu,1,strlen($Chu) - 1) . " &#273;&#7891;ng ch&#7861;n" ;
	}
	return $Chu ;

}?>