<?php	
 function paging($result_rows)
 {
 	global $page_start,$page_row,$page_col,$act;
	$list_page="";
	// phan trang===================================================================
	$col = isset ($_REQUEST["col"])  ? intval ($_REQUEST["col"]) : 1; 		

	$page = isset ($_REQUEST["page"])  ? intval ($_REQUEST["page"]) : 1; 		
 
	$page_start = ( $page - 1 ) * $page_row;
	$page_end   = $page * $page_row; 
	//$col_start  = ( $col - 1 ) * $page_col + 1; 
	$col_start  = $page; 
 	$col_kt  = ceil (ceil($result_rows /$page_row)/ $page_col);
	//$col_end    = $col_start + $col_kt ; 
	$col_end    = $page+$page_col;
	$number_of_page = ceil($result_rows /$page_row); 

	if($col_start+$page_col>$number_of_page)
		$col_start=$number_of_page-$page_col+1;
	if($col_start< 1)
		$col_start=1;
	//echo $col_end ;
	$j = 0 ;	
	if ( $number_of_page > 1 ) 
	{ 	
	 	$list_page="<font color='#CC0000'>Trang &nbsp;</font>";
		$colc = $col + 1 ;
		if($colc > $col_kt)
			$colc=$col_kt;
		$colt = $col - 1 ;
		if($colt<1 )
			$colt=1;
		if ($page > 1 ) 
		{ 
			$list_page .="<a title='Trang Đầu' style='text-decoration:none' href='default.php?act=".$act."&page=1&col=1'> |&lt;&nbsp; </a> ";
			$page_prev=$page-1;
			
			$list_page .="<a title='Trang Trước' style='text-decoration:none' href='default.php?act=".$act."&page=$page_prev&col=$colt'> &lt;&lt; </a> ";
		}	
		for ( $i = $col_start; $i <= $col_end and $i<($col_start+$page_col) and $i <= $number_of_page; $i++ ) 
		{ 
			if ( $i == $page ) 
			{ 
				$list_page .= " [ <b><font color='#FF0000'>{$i}</font></b> ]  "; 
			} 
			else 
			{   			   
			   $list_page .= "<a style='text-decoration:none' href='default.php?act=".$act."&page=$i&col=$col'> $i </a> "; 
			} 
		} 
		if ($page < $number_of_page ) 
		{
			$page_next=$page+1;
			$list_page .= "<a title='Trang Kế' style='text-decoration:none' href='default.php?act=".$act."&page=$page_next&col=$colc'> &gt;&gt;</a> ";
			$list_page .= "<a title='Trang Cuối' style='text-decoration:none' href='default.php?act=".$act."&page=$number_of_page&col=$col_kt'> &nbsp;|&gt;</a> ";
		}	
	} 
	//echo "<script>alert('".$list_page."');</script>";
	return $list_page;
}

?>