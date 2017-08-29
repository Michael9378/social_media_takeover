
SELECT follower_user_id as user_id
FROM (
	SELECT follower_user.user_id AS follower_user_id,
	follower_user.user_num_posts,
	follower_user.user_num_followers,
	follower_user.user_num_following,
	ROUND ( 
		( ABS(follower_user.user_num_followers - ig_dirtkingdom_avgs.followers) + ABS(follower_user.user_num_following - ig_dirtkingdom_avgs.following) ) *
		( (follower_user.user_num_followers + follower_user.user_num_following)/(ig_dirtkingdom_avgs.followers + ig_dirtkingdom_avgs.following) ) *
		( follower_user.user_num_followers/follower_user.user_num_following ) *
		( follower_user.user_num_posts/ig_dirtkingdom_avgs.posts )
	) AS follow_rating
	FROM ig_users AS follower_user, (
		SELECT ROUND(AVG(user_num_posts)) AS posts, ROUND(AVG(user_num_followers)) AS followers, ROUND(AVG(user_num_following)) AS following
			FROM ig_users
			WHERE user_id IN 
				(SELECT ig_follows.user_id 
				FROM ig_follows 
				WHERE ig_follows.follows_user_id = "dirtkingdom")
	) AS ig_dirtkingdom_avgs 
	WHERE follower_user.user_id NOT IN (
		SELECT user_id 
		FROM ig_follows 
		WHERE follows_user_id = "dirtkingdom"
		UNION
		SELECT user_id FROM ig_botaction_follow
		UNION
		SELECT user_id FROM ig_deleted_users
	) 
	AND follower_user.user_num_followers < follower_user.user_num_following
	AND follower_user.user_num_following < 2000
	AND follower_user.user_num_followers < 2000
	AND follower_user.user_num_following > 150
	AND follower_user.user_num_followers > 100
	AND follower_user.user_num_posts > 0
	ORDER BY follow_rating
) as t1;