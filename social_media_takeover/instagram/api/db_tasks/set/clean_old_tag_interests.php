<?php 


require getcwd().'/../../lib/h.php';

// update task done date
$sql = "UPDATE `ig_db_tasks` SET `task_done`='";
$sql .= date('Y-m-d');
$sql .= "' WHERE `task_name` = 'clean_old_tag_interests';";
sql_set_query( $sql );

$clean_date =  date('Y-m-d',strtotime("-3 months"));
	
$sql = "DELETE FROM `ig_user_tag_interest` WHERE `freshness` < '".$clean_date."';";

jr( sql_set_query( $sql ) );

?>