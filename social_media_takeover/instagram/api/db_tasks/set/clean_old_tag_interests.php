<?php 


require getcwd().'/../../lib/h.php';

$clean_date =  date('Y-m-d',strtotime("-3 months"));
	
$sql = "DELETE FROM `ig_user_tag_interest` WHERE `freshness` < '".$clean_date."';";

jr( sql_set_query( $sql ) );

?>