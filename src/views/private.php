<?php

/*
	swCV private.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? Private view
*/

// is app public?
if (app_is_public()) {
	general_redir("?v=main");
}

?>

<h1>
	<?php general_print_lang('PRIVATE_TITLE'); ?>
</h1>
<hr>
<p>
	<?php general_print_lang('PRIVATE_TEXT'); ?>
</p>