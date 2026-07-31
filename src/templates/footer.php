<?php

/*
	swCV header.php file
	Hppsrc 2026
	Based on version 0.1.0-alpha
	? loads footer and finish UNFINISHED html tags
*/

?>

<footer>
	<p>
		swCV <b> <?php echo constant("VERSION"); ?> </b>
	</p>
	<p>
		<?php general_print_lang('LANGUAGE'); ?>: <b> <?php general_print_lang('LANG_NAME'); ?> </b>
	</p>
	<p>
		<?php general_print_lang('MY_IP'); ?>: <b> <?php echo $_SERVER['REMOTE_ADDR']; ?> </b>
	</p>
</footer>

</html>