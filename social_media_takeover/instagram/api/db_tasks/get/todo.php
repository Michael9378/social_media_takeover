<?php 

require getcwd().'/../../lib/h.php';

// gets the tasks that need to be ran in the db.

$month_ago =  date('Y-m-d',strtotime("-30 days"));
$sql = "SELECT task_name FROM ig_db_tasks WHERE `task_done` < '" . $month_ago . "';";

jr( sql_get_query( $sql ) );

?>