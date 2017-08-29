
DROP TABLE IF EXISTS ig_users;
DROP TABLE IF EXISTS ig_follows;
DROP TABLE IF EXISTS ig_posts;
DROP TABLE IF EXISTS ig_likes;
DROP TABLE IF EXISTS ig_comments;
DROP TABLE IF EXISTS ig_tags;
DROP TABLE IF EXISTS ig_user_tag_interest;
DROP TABLE IF EXISTS ig_tagged_in_post;
DROP TABLE IF EXISTS ig_botaction_follow;
DROP TABLE IF EXISTS ig_botaction_like;
DROP TABLE IF EXISTS ig_log;
DROP TABLE IF EXISTS ig_private_users;

CREATE TABLE ig_users
(
	user_id VARCHAR(35),
	user_idNum INT,
	user_num_posts INT,
	user_num_followers INT,
	user_num_following INT,
	user_profile_pic VARCHAR(200),
	user_real_name VARCHAR(50),
	user_bio VARCHAR(500),
	user_website VARCHAR(100),
	freshness DATE,
	PRIMARY KEY (user_id)
);

CREATE TABLE ig_follows
(
	user_id VARCHAR(35),
	follows_user_id VARCHAR(35),
	follows_unfollow_date DATE,
	freshness DATE,
	PRIMARY KEY (user_id, follows_user_id)
);

CREATE TABLE ig_posts
(
	post_id VARCHAR(100),
	user_id VARCHAR(35),
	post_time INT,
	post_num_likes INT,
	post_description VARCHAR(500),
	post_is_video INT,
	freshness DATE,
	PRIMARY KEY(post_id),
	FOREIGN KEY(user_id) references ig_users(user_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ig_tagged_in_post
(
	user_id VARCHAR(35),
	post_id VARCHAR(100),
	freshness DATE,
	PRIMARY KEY(post_id, user_id),
	FOREIGN KEY(post_id) references ig_posts(post_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(user_id) references ig_users(user_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ig_likes
(
	post_id VARCHAR(100),
	user_id VARCHAR(35),
	freshness DATE,
	PRIMARY KEY(post_id, user_id),
	FOREIGN KEY(post_id) references ig_posts(post_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(user_id) references ig_users(user_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ig_comments
(
	post_id VARCHAR(100),
	user_id VARCHAR(35),
	comment_content VARCHAR(500),
	comment_time INT,
	freshness DATE,
	PRIMARY KEY(post_id, user_id, comment_content),
	FOREIGN KEY(post_id) references ig_posts(post_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(user_id) references ig_users(user_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ig_tags
(
	tag_name VARCHAR(35),
	tag_num_posts INT,
	freshness DATE,
	PRIMARY KEY(tag_name)
);

CREATE TABLE ig_user_tag_interest
(
	user_id VARCHAR(35),
	tag_name VARCHAR(35),
	freshness DATE,
	PRIMARY KEY(user_id, tag_name)
);

CREATE TABLE ig_botaction_follow
(
	user_id VARCHAR(35),
	follows_user_id VARCHAR(35),
	action_date DATE,
	PRIMARY KEY (user_id, follows_user_id)
);

CREATE TABLE ig_botaction_like
(
	post_id VARCHAR(100),
	user_id VARCHAR(35),
	action_date DATE,
	PRIMARY KEY(post_id, user_id)
);

CREATE TABLE ig_log
(
	log_time DATETIME,
	log_type VARCHAR(10),
	log_msg VARCHAR(200),
	PRIMARY KEY(log_time, log_msg)
);

CREATE TABLE ig_private_users
(
	user_id VARCHAR(35),
	PRIMARY KEY (user_id)
);

/*

CREATE OR REPLACE VIEW ig_user_avgs AS
	SELECT u2.user_id, ROUND(AVG(u1.user_num_posts)) AS posts, ROUND(AVG(u1.user_num_followers)) AS followers, ROUND(AVG(u1.user_num_following)) AS following
	FROM ig_users as u1, ig_users as u2
	WHERE u1.user_id IN 
		(SELECT ig_follows.user_id 
		FROM ig_follows 
		WHERE ig_follows.follows_user_id = u2.user_id
		AND 10 < 
			(SELECT COUNT(*) 
			FROM ig_follows
			WHERE ig_follows.follows_user_id = u2.user_id))
	GROUP BY u2.user_id;

CREATE OR REPLACE VIEW ig_user_stats AS
	SELECT owner_user.user_id AS owner_user_id,
	follower_user.user_id AS follower_user_id, 
	follower_user.user_num_posts, 
	follower_user.user_num_followers, 
	follower_user.user_num_following,
	ROUND ( 
		( ABS(follower_user.user_num_followers - ig_user_avgs.followers) + ABS(follower_user.user_num_following - ig_user_avgs.following) ) *
		( (follower_user.user_num_followers + follower_user.user_num_following)/(ig_user_avgs.followers + ig_user_avgs.following) ) *
		( follower_user.user_num_followers/follower_user.user_num_following ) *
		( follower_user.user_num_posts/ig_user_avgs.posts )
	) AS follow_rating
	FROM ig_users AS follower_user, ig_users AS owner_user, ig_user_avgs 
	WHERE follower_user.user_id IN (
		SELECT user_id 
		FROM ig_follows 
		WHERE follows_user_id = owner_user.user_id
		AND 10 < (
			SELECT COUNT(*) 
			FROM ig_follows
			WHERE ig_follows.follows_user_id = owner_user.user_id
		)
	) 
	AND ig_user_avgs.user_id = owner_user.user_id
	AND follower_user.user_num_followers < follower_user.user_num_following
	AND follower_user.user_num_following < 2000
	AND follower_user.user_num_followers < 2000
	AND follower_user.user_num_following > 75
	AND follower_user.user_num_followers > 50
	AND follower_user.user_num_posts > 0;
*/