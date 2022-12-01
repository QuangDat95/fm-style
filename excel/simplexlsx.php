<?php
require_once 'simplexlsx.class.php';
$xlsx = new SimpleXLSX("thu.xlsx");
echo '<pre>';
print_r( $xlsx->rows() );
echo '</pre>';
?>