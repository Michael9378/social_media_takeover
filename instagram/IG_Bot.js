// ==UserScript==
// @name         IG Bot
// @namespace    http://michaeljscott.net/
// @version      0.1
// @description  Makes you Instagram Famous
// @author       Michael Scott
// @match        https://*.instagram.com/*
// ==/UserScript==

/*

Data needs
--------------------

User Data  (Local)
	- Username
	- Follow me
	- I follow
	- Follow tracking

User Preferences (Local)
	- Blacklist
	- Predefined Unfollow List
	- Tags
	- Daily like limit
	- Daily follow limit
	- Likes per hour

App Needs
	Session Storage
		- Flag for have user preferences
		- Flag for daily init
		- Flag for start/stop bot
		- Flags for actions
			* Liking posts
			* Scraping users to add to predefined unfollow list
			* Follow or unfollow
	Local Storage
		- Flag for user authenticated
		- Queue of unfollow users
			* make queue (Daily follow limit)*7 to cycle through on weekly basis

*/

// Class constructors. JavaScript classes are garbage, so I do my own thing here.

// holds information about the user that is automatically filled.
function newUserData(){

	/*
	User Data  (Local)
	- Username
	- Follow me
	- I follow
	- Follow tracking
	*/

	// class variables
	userData = {};
	userData.username = false;
	userData.followMe = [];
	userData.iFollow = [];
	userData.followTrack = [];

	// class functions

	user.updateFollowTotals = function(){
		// TODO
		// navigate to user page
		// scrape followme and ifollow lists
		// update user info and save locally.
	}

	// gets usernames that the user follows but doesn't follow them back
	user.getNoFollowBackUsers = function(){
		noFollowBack = [];
		return noFollowBack;
	}

	// gets new total for follows, dates it, and stores in followTrack array
	user.followTrackUpdate = function(){
		user.updateFollowTotals();
		var obj = {};
		var d = new Date();
		var dateString = (d.getMonth() + 1) + ", " + d.getDate() + ", " + d.getFullYear();
		obj.date = dateString;
		obj.followers = this.followMe.length;
		followTrack.push( obj );
		return obj;
	}

	// returns follows per day stat for user
	user.getFollowsPerDay = function(){
		var daysRan = followTrack.length;
		if( daysRan > 1 ){
			var total = followTrack[daysRan - 1].followers;
			total -= followTrack[0].followers;
			total /= daysRan;
			return total;
		}
		else
			return false;
	}
	// give this empty object back
	return userData;
}

// holds information that user provides.
function newUserPreferences(){

	/*
	User Preferences (Local)
	- Blacklist
	- Predefined Unfollow List
	- Tags
	- Daily like limit
	- Daily follow limit
	- Likes per hour 
	*/

	// class variables
	userPref.blacklist = [];
	userPref.unfollow = [];
	userPref.tags = [];
	userPref.tagIndex = 0;
	userPref.likeLimit = 500;
	userPref.followLimit = 50;
	userPref.likesPerHour = 100;

	// get the tag to follow from
	userPref.getTag = function( increment ){
		// set increment to true to increment the tag before pulling current tag.
		if( increment )
			this.tagIndex++;
		// get the tag from tag array
		var tag = "";
		var index = this.tagIndex % this.tags.length;
		tag = this.tags[ index ];
		// return tag
		return tag;
	}

	// set daily like limit between 10 and 1000
	userPref.setLikeLimit = function( newLimit ) {
		if( newLimit > 1000 )
			newLimit = 1000;
		if( newLimit < 10 ) {
			newLimit = 10;
		}
		userPref.likeLimit = newLimit;
	}

	// set daily follow limit between 0 and 300
	userPref.setFollowLimit = function( newLimit ) {
		if( newLimit > 300 )
			newLimit = 300;
		if( newLimit < 0 ) {
			newLimit = 0;
		}
		userPref.followLimit = newLimit;
	}

	// set likes per hour to be between 1 and 200
	userPref.setLikesPerHour = function( newLimit ) {
		if( newLimit > 200 )
			newLimit = 200;
		if( newLimit < 1 ) {
			newLimit = 1;
		}
		userPref.likesPerHour = newLimit;
	}

	// check if a given user is on your blacklist
	userPref.onBlacklist = function( username ){
		for( var i = 0; i < this.blacklist.length; i++ ) {
			if( this.blacklist[i] == username )
				return true;
		}
		return false;
	}

	return userPref;
}

// holds information necessary for app functionality.
function newAppData(){

	/*
	App Needs
	Session Storage
		- Flag for have user preferences
		- Flag for daily init
		- Flag for start/stop bot
		- Flags for actions
			* Liking posts
			* Scraping users to add to predefined unfollow list
			* Follow or unfollow
	Local Storage
		- Flag for user authenticated
		- Queue of unfollow users
			* make queue (Daily follow limit)*7 to cycle through on weekly basis
	*/

	// class variables
	var appd = {};
	var session = {};
	var local = {};
	session.dailyInit = false;
	session.runBot = false;
	session.follow = true;
	session.action = 0;
	/*
	SESSION ACTIONS
	---------------
	0: Like posts
	1: Scrape users and store
	2: Follow/Unfollow
	*/
	local.authenticated = true;
	local.unfollowQueue = [];
	local.unfollowLength = 50/2*7; // default user pref say 50 follow actions, half are unfollows, times 7 days

	appd.session = session;
	appd.local = local;

	// functions

	// check that user preferences are filled correctly
	appd.validateUserPref = function( userPref ){
		// check that all required preferences are in the passed user pref obj
	}

	return appd;
}


// Utility functions.

// enqueue function for array
function enQ(arr, item){
	arr.splice(0, 0, item);
}

// dequeue function for array
function deQ(arr){
	if( !arr.length )
		return false;
	return arr.pop();
}

// TODO: Write functions to pass same obj in and return custom objects above.
// TODO: Write load function that loads data from storage and casts to custom objects.
// TODO: Write save function to save data to storage.

// TODO: everything below this needs to be rewritten

// Global variables
var username;
var tags;
var blacklist;
var likeLimit;
var likesPerHour;
var followLimit

// flags for proper operation
var initDone = ( sessionStorage.getItem("initDone") == null );
var runBot = false;
var dailyInit = false;

// if we haven't run init yet, run it.
if( !initDone ) {
	injectJquery();
	setTimeout(instagramInit, 2000);
	// all variables are stored in global but need to be saved in local/session storage
	localStorage.setItem("username", username);
	localStorage.setItem("tags", tags);
	localStorage.setItem("blacklist", blacklist);
	localStorage.setItem("likeLimit", likeLimit);
	localStorage.setItem("likesPerHour", likesPerHour);
	localStorage.setItem("followLimit", followLimit);
}
if( runBot ) {
	// if we haven't reset our daily limits and timers, do so now.
	if( !dailyInit )
		dailyInit();
	// start liking posts
	likePost();
}


// Initial startup takes in user parameters
function instagramInit(){
	// TODO: Check if setup in local storage first and prompt with that for blacklist and tags
	alert("You have the instagram bot enabled. Disable the plugin and reload page to stop it.\n\nPlease answer the following prompts to setup scripts. \n\nIf you find accounts you do not wish to like or follow, please enter them in the blacklist. \n\nFor tags, grab 2 or more tags to pull from. Make sure that 1 these tags post pictures relevant to your account that you would like and 2 that they have a good amount of pictures posted to them (more than 500,000 total posts. 2 tags with 1.5 mil posts worked for me.)");
	alert("Notice: Like and follow limit suggestions are known to be safe. Go beyond these at your own risk. Don't get you account banned, I can't help you and it WILL happen if you violate limits exceptionally.)");
	// get username
	username = $(".coreSpriteDesktopNavProfile").attr("href");
	username = username.substring(1, username.length-1);
	username = prompt("Is your username correct here?", username);
	// get list of tags
	tags = prompt("Please enter a comma seperated list of tags to pull posts from (no spaces).", "motocross,dirtbike,motolife,braap,2stroke");
	tags = tags.split(",");
	// get blacklist
	blacklist = prompt("Enter list of users not to like or follow (no spaces).", "dirtbikemedia,alphamxgraphics,jmx_shop,creditcascos,dirtkingdom,puncak_sablon,dirtfilmx,sisinblack_,adrenalinejunkieprod,crushedmx,dirtbikevideos,shineraysdeal,factorybacking,motoholics,waspcam,vintage_offroad,motouniverse,rottamg,bonnieclassentertainment");
	blacklist = blacklist.split(",");
	// get daily like limit
	likeLimit = prompt("Enter daily like limit.", "500");
	likeLimit = parseInt( likeLimit );
	// get likes per hour
	likesPerHour = prompt("Enter likes per hour.", "100");
	likesPerHour = parseInt( likesPerHour );
	// get follow/unfollows per hour
	followLimit = prompt("Enter follows/unfollows daily limit.", "100");
	followLimit = parseInt( followLimit );
	// set init done to true
	sessionStorage.setItem("initDone", "true");
}