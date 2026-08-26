<?php

/*
	swCV header.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? loads footer and finish UNFINISHED html tags
*/

?>

<footer>
	<p>
		swCV <b> <?php echo constant("VERSION"); ?> (<?php echo constant("BUILD"); ?>) </b>
	</p>
	<p>
		<?php general_print_lang('LANGUAGE'); ?>: <b> <?php general_print_lang('LANG_NAME'); ?> </b>
	</p>
	<p>
		<?php general_print_lang('SQUEMA_VERSION'); ?>: <b> <?php echo constant("SQUEMA_VERSION"); ?> </b>
	</p>
</footer>

</html>