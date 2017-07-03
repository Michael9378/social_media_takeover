var api_url = "http://socialmedia.michaeljscott.net/instagram/api";

function botActionFollowSet(user, follows, success, error){
  jQuery.post({
    url: api_url + "/botaction_follows/set/",
    data: {
      user_id: user,
      follows_user_id: follows
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success();
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function botActionFollowGet(user, success, error){
  jQuery.post({
    url: api_url + "/botaction_follows/get/",
    data: {
      user_id: user
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
    }
  });
}

function botActionLikeSet(user, post, success, error){
  jQuery.post({
    url: api_url + "/botaction_like/set/",
    data: {
      user_id: user,
      post_id: follows
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success();
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function botActionLikeGet(user, success, error){
  jQuery.post({
    url: api_url + "/botaction_like/get/",
    data: {
      user_id: user
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
    }
  });
}

function userSet(user, num_posts, num_followers, num_following, profile_pic, real_name, bio, website, success, error){
  jQuery.post({
    url: api_url + "/user/set/",
    data: {
      user_id: user,
      user_num_posts: num_posts,
      user_num_followers: num_followers,
      user_num_following: num_following,
      user_profile_pic: profile_pic,
      user_real_name: real_name,
      user_bio: bio,
      user_website: website
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success();
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function userGet(user, success, error){
  jQuery.post({
    url: api_url + "/user/get/",
    data: {
      user_id: user
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
    }
  });
}

function userGetMissing(limit, success, error){
  jQuery.post({
    url: api_url + "/user/get/missing.php",
    data: {
      scrape_limit: limit
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
    }
  });
}

function followSet(user, follows, success, error){
  jQuery.post({
    url: api_url + "/follows/set/",
    data: {
      user_id: user,
      follows_user_id: follows
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success();
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function followGetAutoFollow(user, limit, success, error){
  jQuery.post({
    url: api_url + "/follows/get/auto_follows.php",
    data: {
      user_id: user,
      num_follows: limit
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function followGetAutoUnfollow(user, limit, success, error){
  jQuery.post({
    url: api_url + "/follows/get/auto_unfollows.php",
    data: {
      user_id: user,
      num_unfollows: limit
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function postSet(user, post, time, likes, desc, loc, success, error){
  jQuery.post({
    url: api_url + "/post/set/",
    data: {
      user_id: user,
      post_id: post,
      post_time: time,
      num_likes: likes,
      description: desc,
      location: loc
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success();
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function postGet(post, success, error){
  jQuery.post({
    url: api_url + "/post/get/",
    data: {
      post_id: post
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
    }
  });
}

function tagSet(tag, num_posts, success, error){
  jQuery.post({
    url: api_url + "/tag/set/",
    data: {
      tag_name: tag,
      tag_num_posts: num_posts
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success();
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function tagGet(tag, success, error){
  jQuery.post({
    url: api_url + "/tag/get/",
    data: {
      tag_name: tag
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function interestSet(user, tag, success, error){
  jQuery.post({
    url: api_url + "/interest/set/",
    data: {
      user_id: user,
      tag_name: tag
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success();
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function interestGet(tag, success, error){
  jQuery.post({
    url: api_url + "/interest/get/",
    data: {
      tag_name: limit
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function likeSet(user, post, success, error){
  jQuery.post({
    url: api_url + "/like/set/",
    data: {
      user_id: user,
      post_id: post
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success();
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function likeGet(post, success, error){
  jQuery.post({
    url: api_url + "/like/get/",
    data: {
      post_id: post
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function commentSet(user, post, comment, success, error){
  jQuery.post({
    url: api_url + "/comment/set/",
    data: {
      user_id: user,
      post_id: post,
      comment_content: comment
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success();
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

function commentGet(post, success, error){
  jQuery.post({
    url: api_url + "/comment/get/",
    data: {
      post_id: post
    },
    success: function( result ){
      result = JSON.parse(result);
      if( result )
        success( result );
      else
        error();
    },
    error: function( jqXHR, textStatus, errorThrown ){
      alert( textStatus + " " + jqXHR.status + " " + errorThrown );
      error();
    }
  });
}

/*
Complete Sections:
  bot action follow
  bot action like
  post
  user
  tag
  interest
  like
  comment
  

Partial Sections:
  follows
*/

/*
// generic ajax call format.
$.ajax({
	url: api_url + "/path/to/call/",
  type: "POST",
  data: {
    // TODO
  },
	success: function( result ){
    result = JSON.parse(result);
    if( result )
      success();
    else
      error();
  },
  error: function( jqXHR, textStatus, errorThrown ){
  	alert( textStatus + " " + jqXHR.status + " " + errorThrown );
  	}
  }
});
*/