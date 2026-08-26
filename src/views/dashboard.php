<?php

/*
	swCV dashboard.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? User dashboard
*/

// is user NOT set up yet?
if (!user_is_setup()) {
	general_redir("?v=setup");
}

?>

<div class="frow title">
	<h1>
		<?php general_print_lang('DASHBOARD_TITLE'); ?>
	</h1>
	<small class="fcol">
		<a href="?v=main"><?php general_print_lang('GENERAL_GO_BACK'); ?></a>
		<a href="?v=dashboard&a=logout"><?php general_print_lang('GENERAL_LOG_OUT'); ?></a>
	</small>
</div>
<hr>

<?php if (!user_is_admin_logged()): // is user NOT logged in yet?  ?>

	<p>
		<?php general_print_lang('DASHBOARD_TEXT_LOGIN'); ?>
	</p>

	<form action="?v=dashboard&a=dashboard_login" method="post">

		<h4>
			<label for="user_access">
				<?php general_print_lang('GENERAL_ADMIN_CREDENTIALS'); ?>
			</label>
		</h4>
		<input name="user_access" id="user_access" type="text"
			placeholder="<?php general_print_lang('GENERAL_ADMIN_CREDENTIALS_PLACEHOLDER'); ?>" maxlength="50" minlength="1"
			required>

		<h4>
			<label for="user_password">
				<?php general_print_lang('GENERAL_PASSWORD_CREDENTIALS'); ?>
			</label>
		</h4>
		<input name="user_password" id="user_password" type="password"
			placeholder="<?php general_print_lang('GENERAL_PASSWORD_CREDENTIALS_PLACEHOLDER'); ?>" minlength="1"
			maxlength="500" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_\-]).{8,}"
			title="Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character (!@#$%^&*_-)"
			required>

		<input type="hidden" name="csrf_token" value="<?= general_csrf_token() ?>">

		<button type="submit"><?php general_print_lang('DASHBOARD_BUTTON_LOGIN'); ?></button>

	</form>

<?php else: // user is logged ?>
	<?php user_check_admin_login() // check for login consistency ?>
	<?php general_dashboard_tab_helper() // set tab for dashboard ?>

	<div id="dash_menu" class="frow">
		<a class="tabs" onclick="s(this)" href="#general"><?php general_print_lang('DASHBOARD_TAB_GENERAL'); ?></a>
		<a class="tabs" onclick="s(this)" href="#blog"><?php general_print_lang('DASHBOARD_TAB_BLOG'); ?></a>
		<a class="tabs" onclick="s(this)" href="#analytics"><?php general_print_lang('DASHBOARD_TAB_ANALYTICS'); ?></a>
		<a class="tabs" onclick="s(this)" href="#settings"><?php general_print_lang('DASHBOARD_TAB_SETTINGS'); ?></a>
		<a class="tabs" onclick="s(this)" href="#about"><?php general_print_lang('DASHBOARD_TAB_ABOUT'); ?></a>
	</div>

	<section id="dashboard_view"></section>

	<script defer>
		const dashboard_view = document.getElementById("dashboard_view");
		const tabs = document.querySelectorAll(".tabs");
		let currentTab = window.location.hash.substring(1) || "general";

		function s(tab) {
			setTimeout(() => {
				currentTab = window.location.hash.substring(1) || "general";

				tabs.forEach(tab => {
					if (tab.getAttribute("href") === "#" + currentTab) {
						tab.classList.add("active");
					} else {
						tab.classList.remove("active");
					}
				});

				dashboard_view.style.maxHeight = "0px";

				setTimeout(() => {
					fetch('?v=dashboard&tab=' + currentTab, {
						headers: {
							'X-Requested-With': 'XMLHttpRequest'
						}
					})
						.then(data => data.text())
						.then(html => {
							dashboard_view.innerHTML = html;
							dashboard_view.style.maxHeight = dashboard_view.scrollHeight + "px";
						});
				}, 300);
			}, 10);
		}

		s(currentTab)

	</script>

<?php endif ?>