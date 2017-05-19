<?php 
// This file filters the bad words for input fields.
function badWordFilter($data){
	$badWords = array("fuck", "fucker", "motherfucker", "muthafucker", "motherphucker", "phuck", "slut", "pussy", "bitch", "hoe", "whore", "dog", "nigger", "nigga", "niggas", "niggers", "spade", "jiggaboo", "spear chucker", "porch monkey", "cum", "ass", "damn", "shit", "shitting", "dick", "clit", "asshole", "cunt", "suck", "lick", "sperm", "tramp");
	$goodWords = array("love", "lover", "mommy-loves", "mommy-loves", "mommy-loves", "love", "slug", "feline", "female", "hopeful", "friendly-girl", "mutt", "boy", "friend", "homies", "black-people", "black-people", "black-people", "blackpeople", "come", "apple", "dart", "shoe", "shoeing", "cob", "clap", "tunnel", "captain", "drain", "wipe", "joy", "traveler");
	$data = str_ireplace($badWords, $goodWords, $data);
	return $data;
}
?>