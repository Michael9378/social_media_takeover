<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["users"] ) ){

	$users = $_POST["users"];
	$users = json_decode($users);

	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_users` ";
	$sql .= "VALUES";

	foreach($users as $user){

		$user_id = $user->username;
		$user_idNum = $user->id;
		$user_num_posts = $user->media->count;
		$user_num_followers = $user->followed_by->count;
		$user_num_following = $user->follows->count;
		$user_profile_pic = $user->profile_pic_url_hd;
		$user_real_name = str_replace("'", "", $user->full_name);
		$user_bio = str_replace("'", "", $user->biography);
		$user_website = str_replace("'", "", $user->external_url);

		$sql .= "('".$user_id."', ".$user_idNum.", ".$user_num_posts.", ".$user_num_followers.", ".$user_num_following.", '".$user_profile_pic."', '".$user_real_name."', '".$user_bio."', '".$user_website."', '".$date."'), ";

	}
	// trim the space and comma
	$sql = substr($sql, 0, -2);

	$sql .= ";";
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing users obj.");

?>