<?php

/*
	swCV setup.php file
	Hppsrc 2026
	Based on version 0.1.0-alpha
	? User welcome
*/

// is user NOT set up yet?
if (!user_is_setup()) {
	general_redir("?v=setup");
}

// show app welcome?
if (!app_show_welcome()) {
	general_redir("?v=main");
}

?>

<h1>
	<?php general_print_lang('WELCOME_TITLE'); ?>
</h1>
<hr>
<p>
	<?php general_print_lang('WELCOME_TEXT'); ?>
</p>