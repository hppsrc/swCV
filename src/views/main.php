<?php

/*
	swCV main.php file
	Hppsrc 2026
	Based on version 0.1.0-alpha
	? main view
*/

// is user NOT set up yet?
if (!user_is_setup()) {
	general_redir("?v=setup");
}

// show app welcome?
if (app_show_welcome()) {
	general_redir("?v=welcome");
}

?>