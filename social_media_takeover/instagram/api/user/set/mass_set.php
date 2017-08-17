<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["users"] ) ){

	$users = $_POST["users"];
	$users = json_decode($users);

	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_users` ";
	$sql .= "VALUES";

	foreach($users as $user){

		$user_id = $user->userId;
		$user_num_posts = $user->numPosts;
		$user_num_followers = $user->numFollowers;
		$user_num_following = $user->numFollowing;
		$user_profile_pic = $user->profilePic;
		$user_real_name = str_replace("'", "", $user->realName);
		$user_bio = str_replace("'", "", $user->bio);
		$user_website = str_replace("'", "", $user->website);

		$sql .= "('".$user_id."', ".$user_num_posts.", ".$user_num_followers.", ".$user_num_following.", '".$user_profile_pic."', '".$user_real_name."', '".$user_bio."', '".$user_website."', '".$date."'), ";

	}
	// trim the space and comma
	$sql = substr($sql, 0, -2);

	$sql .= ";";
	echo $sql;
	// jr( sql_set_query( $sql ) );
}
else
	jr("Missing users obj.");

?>