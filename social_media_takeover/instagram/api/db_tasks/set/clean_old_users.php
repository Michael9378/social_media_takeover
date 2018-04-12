<?php 


require getcwd().'/../../lib/h.php';

// update task done date
$sql = "UPDATE `ig_db_tasks` SET `task_done`='";
$sql .= date('Y-m-d');
$sql .= "' WHERE `task_name` = 'clean_old_users';";
sql_set_query( $sql );

$clean_date =  date('Y-m-d',strtotime("-4 months"));

$sql = "DELETE FROM `ig_users` WHERE `freshness` < '".$clean_date."';";

jr( sql_set_query( $sql ) );

?>