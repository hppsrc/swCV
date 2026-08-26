<?php

/*
	swCV dashboard/general.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? Dashboard "general" tab view
*/

$settings = app_get_general_values();

?>


<h2>
	<?php general_print_lang('DASHBOARD_TAB_GENERAL'); ?>
</h2>


<p>
	<?php general_print_lang('DASHBOARD_TAB_GENERAL_TEXT'); ?>
</p>

<hr>

<div class="frow">
	<input type="checkbox" name="show_welcome" id="show_welcome" onclick="ajax(this)" <?php echo $settings["show_welcome"] ? "checked" : "unchecked disabled"; ?>>
	<p>
		<?php general_print_lang('DASHBOARD_TAB_GENERAL_SHOW_WELCOME'); ?>
	</p>
</div>

<div class="frow">
	<input type="checkbox" name="show_last_update" id="show_last_update" onclick="ajax(this)" <?php echo $settings["show_last_update"] ? "checked" : "unchecked"; ?>>
	<p>
		<?php general_print_lang('DASHBOARD_TAB_GENERAL_SHOW_LAST_UPDATE'); ?>
	</p>
</div>

<div class="frow">
	<input type="checkbox" name="public_view" id="public_view" onclick="ajax(this)" <?php echo $settings["public_view"] ? "checked" : "unchecked"; ?>>
	<p>
		<?php general_print_lang('DASHBOARD_TAB_GENERAL_PUBLIC_VIEW'); ?>
	</p>
</div>

<div class="frow">
	<input type="checkbox" name="blog_enabled" id="blog_enabled" onclick="ajax(this)" <?php echo $settings["blog_enabled"] ? "checked" : "unchecked"; ?>>
	<p>
		<?php general_print_lang('DASHBOARD_TAB_GENERAL_BLOG_ENABLED'); ?>
	</p>
</div>

<div class="frow">
	<input type="checkbox" name="blog_comments_enabled" id="blog_comments_enabled" onclick="ajax(this)" <?php echo $settings["blog_comments_enabled"] ? "checked" : "unchecked"; ?>>
	<p>
		<?php general_print_lang('DASHBOARD_TAB_GENERAL_BLOG_COMMENTS_ENABLED'); ?>
	</p>
</div>

<div class="frow">
	<input type="checkbox" name="blog_likes_enabled" id="blog_likes_enabled" onclick="ajax(this)" <?php echo $settings["blog_likes_enabled"] ? "checked" : "unchecked"; ?>>
	<p>
		<?php general_print_lang('DASHBOARD_TAB_GENERAL_BLOG_LIKES_ENABLED'); ?>
	</p>
</div>

<div class="frow">
	<small>
		<?php general_print_lang('DASHBOARD_TAB_GENERAL_BLOG_INFO'); ?>
	</small>
</div>

<div class="frow">
	<p>
		<?php general_print_lang('DASHBOARD_TAB_GENERAL_LANGUAGE'); ?>
	</p>
</div>

<select id="system_language" name="system_language" onchange="ajax_lang(this)">
	<?php foreach (app_get_languages() as $lang): ?>
		<option value="<?= e($lang['code']) ?>" <?= ($lang['code'] === general_get_lang('LANG_CODE') ? 'selected' : '') ?>>
			<?= e($lang['name']) ?> - <?= $lang['percent'] ?>%
		</option>
	<?php endforeach; ?>
</select>
<small> <?php general_print_lang('DASHBOARD_TAB_GENERAL_LANGUAGE_INFO'); ?> </small>