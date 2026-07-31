<?php

/*
	swCV setup.php file
	Hppsrc 2026
	Based on version 0.1.0-alpha
	? User setup
*/

// is user already set up?
if (user_is_setup()) {
	general_redir("?v=main");
}

?>

<h1> <?php general_print_lang('SETUP_TITLE'); ?> </h1>

<hr>

<p> <?php general_print_lang('SETUP_TEXT'); ?> </p>

<form action="?v=setup&a=setup" method="post" enctype="multipart/form-data">

	<h4>
		<label for="name">
			<?php general_print_lang('SETUP_NAME'); ?>
		</label>
	</h4>
	<input name="name" id="name" type="text" placeholder="<?php general_print_lang('SETUP_NAME_PLACEHOLDER'); ?>"
		maxlength="50" minlength="1" required>

	<h4>
		<label for="description">
			<?php general_print_lang('SETUP_DESCRIPTION'); ?>
		</label>
	</h4>
	<textarea name="description" id="description"
		placeholder="<?php general_print_lang('SETUP_DESCRIPTION_PLACEHOLDER'); ?>" required></textarea>

	<h4>
		<label for="birthday">
			<?php general_print_lang('SETUP_AGE'); ?>
		</label>
	</h4>
	<input type="date" name="birthday" id="birthday" required>

	<div>
		<input type="checkbox" name="show_age" id="show_age">
		<label for="show_age">
			<?php general_print_lang('SETUP_SHOW_AGE'); ?>
		</label>
	</div>

	<h4>
		<label for="profile_picture">
			<?php general_print_lang('SETUP_PROFILE_PICTURE'); ?>
		</label>
	</h4>
	<input type="file" name="profile_picture" id="profile_picture" accept="image/png, image/jpeg" required>
	<small>
		<?php general_print_lang('SETUP_PROFILE_PICTURE_INFO'); ?>
	</small>

	<hr>

	<h4>
		<?php general_print_lang('SETUP_SOCIALS'); ?>
	</h4>

	<div class="frow setup_rows">

		<div>
			<input type="checkbox" name="show_social_facebook" id="show_social_facebook">
			<label for="social_facebook_input">
				<?php general_print_lang('SETUP_FACEBOOK'); ?>
			</label>
			<div style=" min-width: 20px; "></div>
		</div>

		<input name="social_facebook_input" id="social_facebook_input" type="text"
			placeholder="<?php general_print_lang('SETUP_FACEBOOK_PLACEHOLDER'); ?>">

	</div>

	<div class="frow setup_rows">

		<div>
			<input type="checkbox" name="show_social_twitter" id="show_social_twitter">
			<label for="social_twitter_input">
				<?php general_print_lang('SETUP_TWITTER'); ?>
			</label>
			<div style=" min-width: 20px; "></div>
		</div>

		<input name="social_twitter_input" id="social_twitter_input" type="text"
			placeholder="<?php general_print_lang('SETUP_TWITTER_PLACEHOLDER'); ?>">

	</div>

	<div class="frow setup_rows">

		<div>
			<input type="checkbox" name="show_social_linkedin" id="show_social_linkedin">
			<label for="social_linkedin_input">
				<?php general_print_lang('SETUP_LINKEDIN'); ?>
			</label>
			<div style=" min-width: 20px; "></div>
		</div>

		<input name="social_linkedin_input" id="social_linkedin_input" type="text"
			placeholder="<?php general_print_lang('SETUP_LINKEDIN_PLACEHOLDER'); ?>">

	</div>

	<div class="frow setup_rows">

		<div>
			<input type="checkbox" name="show_social_github" id="show_social_github">
			<label for="social_github_input">
				<?php general_print_lang('SETUP_GITHUB'); ?>
			</label>
			<div style=" min-width: 20px; "></div>
		</div>

		<input name="social_github_input" id="social_github_input" type="text"
			placeholder="<?php general_print_lang('SETUP_GITHUB_PLACEHOLDER'); ?>">

	</div>

	<div class="frow setup_rows">

		<div>
			<input type="checkbox" name="show_social_web" id="show_social_web">
			<label for="social_web_input">
				<?php general_print_lang('SETUP_WEB'); ?>
			</label>
			<div style=" min-width: 20px; "></div>
		</div>

		<input name="social_web_input" id="social_web_input" type="text"
			placeholder="<?php general_print_lang('SETUP_WEB_PLACEHOLDER'); ?>">

	</div>

	<div class="frow setup_rows">

		<div>
			<input type="checkbox" name="show_social_email" id="show_social_email">
			<label for="social_email_input">
				<?php general_print_lang('SETUP_EMAIL'); ?>
			</label>
			<div style=" min-width: 20px; "></div>
		</div>

		<input name="social_email_input" id="social_email_input" type="email"
			placeholder="<?php general_print_lang('SETUP_EMAIL_PLACEHOLDER'); ?>">

	</div>

	<div class="frow setup_rows">

		<div>
			<input type="checkbox" name="show_social_phone" id="show_social_phone">
			<label for="social_phone_input">
				<?php general_print_lang('SETUP_PHONE'); ?>
			</label>
			<div style=" min-width: 20px; "></div>
		</div>

		<div>
			<input type="checkbox" name="social_phone_whatsapp" id="social_phone_whatsapp">
			<label for="social_phone_whatsapp">
				<?php general_print_lang('SETUP_PHONE_WHATSAPP'); ?>
			</label>
		</div>

		<input name="social_phone_input" id="social_phone_input" type="tel"
			placeholder="<?php general_print_lang('SETUP_PHONE_PLACEHOLDER'); ?>">

	</div>

	<hr>

	<h4>
		<label for="user_access">
			<?php general_print_lang('SETUP_ADMIN_CREDENTIALS'); ?>
		</label>
	</h4>
	<input name="user_access" id="user_access" type="text"
		placeholder="<?php general_print_lang('SETUP_ADMIN_CREDENTIALS_PLACEHOLDER'); ?>" maxlength="50" minlength="1"
		required>

	<h4>
		<label for="user_password">
			<?php general_print_lang('SETUP_PASSWORD_CREDENTIALS'); ?>
		</label>
	</h4>
	<input name="user_password" id="user_password" type="password"
		placeholder="<?php general_print_lang('SETUP_PASSWORD_CREDENTIALS_PLACEHOLDER'); ?>" minlength="1" required>

	<input type="hidden" name="social_switches" value="00000000" disabled>

	<button type="submit"><?php general_print_lang('SETUP_SUBMIT'); ?></button>

</form>

<script defer>

	document.getElementById("profile_picture").addEventListener("change", function () {
		const file = this.files[0];
		const maxMB = 3;
		const maxSize = maxMB * 1024 * 1024;
		const maxPX = 500;

		if (file && file.size > maxSize) {
			alert("<?php general_print_lang('SETUP_PROFILE_PICTURE_ERROR_SIZE'); ?>");
			this.value = "";
			return;
		}

		var url = URL.createObjectURL(this.files[0]);
		var img = new Image;

		img.onload = () => {

			URL.revokeObjectURL(url);

			if (img.width > maxPX || img.height > maxPX) {
				alert("<?php general_print_lang('SETUP_PROFILE_PICTURE_ERROR_DIMENSIONS'); ?>");
				this.value = "";
				return;
			}

			if (Math.abs((img.width / img.height) - 1) > 0.05) {
				alert("<?php general_print_lang('SETUP_PROFILE_PICTURE_ERROR_RATIO'); ?>");
				this.value = "";
				return;
			}

		};

		img.src = url;

	});

</script>