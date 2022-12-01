<?php
class paging
{

	function paging_one(){	
		if(empty($_GET['page'])){
    	    $paging_one = 1;
		}else{
    		$paging_one = $_GET['page'];	
		}
		return $paging_one;
	}
	
	function paging_two($paging_one, $pagesize){
		if(isset($_GET['page'])){
			$paging_two = ($paging_one - 1) * $pagesize;	
		}else{
			$paging_two = 0;
		}
		return $paging_two;
	}
	
	function page_three($paging_one, $paging_two, $recordcount, $pagesize, $url){
		if($paging_one % $pagesize == 0){
    		$counterstart = $paging_one - ($pagesize - 1);
		}else{
    		$counterstart = $paging_one - ($paging_one % $pagesize) + 1;
		}

		$counterend = $counterstart + ($pagesize - 1);
		
		$maxpage = $recordcount % $pagesize;

		if($recordcount % $pagesize == 0){
    		$maxpage = $recordcount / $pagesize;
		}else{
    		$maxpage = ceil($recordcount / $pagesize);
		}

		if($counterstart != 1){
			$PrevStart = $counterstart - 1;
				$output = "<a href=\"".$_SERVER['PHP_SELF'].$url."page=1\">««</a> ";
				$output .= "<a href=\"".$_SERVER['PHP_SELF'].$url."page=$PrevStart\"> « </a>";
		}
		$c = 0;
		for($c=$counterstart;$c<=$counterend;$c++){
			if($c < $maxpage){
				if($c == $paging_one){
					if($c % $pagesize == 0){
						$output .= "[$c] ";
        			}else{
            			$output .= "[$c] ";
        			}
        		}elseif($c % $pagesize == 0){
					$output .= "<a href=\"".$_SERVER['PHP_SELF'].$url."page=$c\">$c</a> ";
				}else{
					$output .= "<a href=\"".$_SERVER['PHP_SELF'].$url."page=$c\">$c</a> ";
				}
			}else{
				if($paging_one == $maxpage){
					$output .= "[$c] ";
					break;
				}else{
					$output .= "<a href=\"".$_SERVER['PHP_SELF'].$url."page=$c\">$c</a> ";
					break;
				}
			}
		}
		if($counterend < $maxpage){
			$NextPage = $counterend + 1;
			$output .= "<a href=\"".$_SERVER['PHP_SELF'].$url."page=$NextPage\"> » </a>";
		}
		if($counterend < $maxpage){
			$LastRec = $recordcount % $pagesize;
			if($LastRec == 0){
				$LastStartRecord = $recordcount - $pagesize;
			}else{
				$LastStartRecord = $recordcount - $LastRec;
			}
			$output .= "<a href=\"".$_SERVER['PHP_SELF'].$url."page=$maxpage\">»»</a>";
		}
		$output .= "($paging_one / $maxpage)"; 
		return $output;
	}
}

?>