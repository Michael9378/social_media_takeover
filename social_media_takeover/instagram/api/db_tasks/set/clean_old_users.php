<?php 


require getcwd().'/../../lib/h.php';

$clean_date =  date('Y-m-d',strtotime("-4 months"));

$sql = "DELETE FROM `ig_users` WHERE `freshness` < '".$clean_date."';";

jr( sql_set_query( $sql ) );

?>