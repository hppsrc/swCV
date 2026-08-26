<?php

/*
	swCV app.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? General app server checks, mostly single checks or loads on running
*/

// check for critial envs
function app_check_env(): void
{
	if (
		!isset($_ENV['host']) ||
		!isset($_ENV['name']) ||
		!isset($_ENV['user']) ||
		!isset($_ENV['pass']) ||
		!isset($_ENV['sql_generic_error']) ||
		!isset($_ENV['sql_generic_error_msg']) ||
		!isset($_ENV['lang'])
	) {
		throw new Exception("CATASTROPHIC ERROR: Critical variables from .env are missing. Please check you .env file.");
	}
}

// load app language
// * AI assisted by Gemini 3.5 Low
function app_load_lang(): void
{
	$code = null;

	// skip database query if debug flag is enabled
	if (($_ENV['FLAG_IGNORE_DB_LANG'] ?? false) !== true) {

		try {

			// Attempt to read language from database
			$res = client_select("SELECT system_language FROM general LIMIT 1");
			if ($res && sizeof($res) > 0) {
				$code = $res[0]['system_language'];
			}

		} catch (Throwable $th) {
			// Fallback to null
			$code = null;
		}

	}

	// Fallback to env file if database lang is not set
	if (empty($code)) {
		$code = get_env("lang");
	}

	// Default to english if everything else is empty
	if (empty($code)) {
		$code = "en";
	}

	$file = "lang/" . $code . ".php";

	if (!file_exists($file)) {
		$file = "lang/en.php";
	}

	if (!file_exists($file)) {
		throw new Exception("CATASTROPHIC ERROR: No language file found. Your installation might be broken. Please reinstall swCV from GitHub.", 1);
	}

	$GLOBALS['lang'] = include $file;

}

// check if display welcome screen or not
function app_show_welcome(): bool
{

	$res = client_select("SELECT `show_welcome` from general");

	if (sizeof($res) == 0) {
		throw new Exception("CATASTROPHIC ERROR: No data found in the 'show_welcome' column. Your installation might be broken. Please reinstall swCV from GitHub.", 1);
	}

	return $res[0]['show_welcome'];

}

// check if display private screen or not
function app_is_public(): bool
{

	$res = client_select("SELECT `public_view` from general");

	if (sizeof($res) == 0) {
		throw new Exception("CATASTROPHIC ERROR: No data found in the 'public_view' column. Your installation might be broken. Please reinstall swCV from GitHub.", 1);
	}

	return (bool) $res[0]['public_view'];

}

// check if show last update
function app_show_last_update(): bool
{

	$res = client_select("SELECT `show_last_update` from general");

	if (sizeof($res) == 0) {
		throw new Exception("CATASTROPHIC ERROR: No data found in the 'show_last_update' column. Your installation might be broken. Please reinstall swCV from GitHub.", 1);
	}

	return (bool) $res[0]['show_last_update'];

}

function app_check_db_version(): void
{

	$res = client_select(
		"SELECT `squema_version` FROM general LIMIT 1",
	);

	if (sizeof($res) == 0) {
		throw new Exception("CATASTROPHIC ERROR: No data found in the 'squema_version' column. Your installation might be broken. Please reinstall swCV from GitHub.", 1);
	}

	if ($res[0]["squema_version"] !== constant("SQUEMA_VERSION")) {
		throw new Exception("WARNING: Your database squema version isn't the expected to run this swCV version.<br><br>Please update your swCV database.<br><br>Your swCV " . constant("VERSION") . " expected squema version " . constant("SQUEMA_VERSION") . ", squema version on server is: " . $res[0]["squema_version"], 1);
	}
}

// app setup
function app_setup(): void
{

	if (!general_csrf_check()) {
		general_set_alert(general_get_lang('GENERAL_CSRF_ERROR'));
		general_redir("?v=dashboard");
		exit();
	}

	function _internal_return_value($v)
	{
		if ($v === null) {
			return 0;
		}
		if ($v === "on") {
			return 1;
		}
		return $v;
	}

	$expected = [
		'name',
		'description',
		'birthday',
		'show_age',
		'show_social_facebook',
		'social_facebook_input',
		'show_social_twitter',
		'social_twitter_input',
		'show_social_linkedin',
		'social_linkedin_input',
		'show_social_github',
		'social_github_input',
		'show_social_web',
		'social_web_input',
		'show_social_email',
		'social_email_input',
		'show_social_phone',
		'social_phone_input',
		'social_phone_whatsapp',
		'user_access',
		'user_password'
	];

	foreach ($expected as $k) {
		$_POST[$k] = $_POST[$k] ?? null;
	}

	$name = _internal_return_value($_POST['name']);
	$description = _internal_return_value($_POST['description']);
	$birthday = _internal_return_value($_POST['birthday']);
	$show_age = _internal_return_value($_POST['show_age']);

	if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
		general_set_alert(general_get_lang('SETUP_PROFILE_PICTURE_ERROR_UPLOAD'));
		general_redir("?v=setup");
		exit();
	}

	$tmp_file = $_FILES['profile_picture']['tmp_name'];

	$maxBytes = 3 * 1024 * 1024;
	if ($_FILES['profile_picture']['size'] > $maxBytes) {
		general_set_alert(general_get_lang('SETUP_PROFILE_PICTURE_ERROR_SIZE'));
		general_redir("?v=setup");
		exit();
	}

	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$mime_type = $finfo->file($tmp_file);
	$allowed_mimes = ['image/png', 'image/jpeg', 'image/jpg'];
	if (!in_array($mime_type, $allowed_mimes)) {
		general_set_alert(general_get_lang('SETUP_PROFILE_PICTURE_ERROR_UPLOAD'));
		general_redir("?v=setup");
		exit();
	}

	$dimensions = getimagesize($tmp_file);
	if ($dimensions === false) {
		general_set_alert(general_get_lang('SETUP_PROFILE_PICTURE_ERROR_DIMENSIONS'));
		general_redir("?v=setup");
		exit();
	}

	$width = $dimensions[0];
	$height = $dimensions[1];
	$maxPX = 500;

	if ($width > $maxPX || $height > $maxPX) {
		general_set_alert(general_get_lang('SETUP_PROFILE_PICTURE_ERROR_DIMENSIONS'));
		general_redir("?v=setup");
		exit();
	}

	if (abs(($width / $height) - 1) > 0.05) {
		general_set_alert(general_get_lang('SETUP_PROFILE_PICTURE_ERROR_RATIO'));
		general_redir("?v=setup");
		exit();
	}

	$profile_picture = 'data:' . $mime_type . ';base64,' . base64_encode(file_get_contents($tmp_file));

	$show_social_facebook = _internal_return_value($_POST['show_social_facebook']);
	$social_facebook_input = _internal_return_value($_POST['social_facebook_input']);
	$social_facebook = $show_social_facebook ? $social_facebook_input : "";

	$show_social_twitter = _internal_return_value($_POST['show_social_twitter']);
	$social_twitter_input = _internal_return_value($_POST['social_twitter_input']);
	$social_twitter = $show_social_twitter ? $social_twitter_input : "";

	$show_social_linkedin = _internal_return_value($_POST['show_social_linkedin']);
	$social_linkedin_input = _internal_return_value($_POST['social_linkedin_input']);
	$social_linkedin = $show_social_linkedin ? $social_linkedin_input : "";

	$show_social_github = _internal_return_value($_POST['show_social_github']);
	$social_github_input = _internal_return_value($_POST['social_github_input']);
	$social_github = $show_social_github ? $social_github_input : "";

	$show_social_web = _internal_return_value($_POST['show_social_web']);
	$social_web_input = _internal_return_value($_POST['social_web_input']);
	$social_web = $show_social_web ? $social_web_input : "";

	$show_social_email = _internal_return_value($_POST['show_social_email']);
	$social_email_input = _internal_return_value($_POST['social_email_input']);
	$social_email = $show_social_email ? $social_email_input : "";

	$show_social_phone = _internal_return_value($_POST['show_social_phone']);
	$social_phone_input = _internal_return_value($_POST['social_phone_input']);
	$social_phone = $show_social_phone ? $social_phone_input : "";
	$social_phone_whatsapp = _internal_return_value($_POST['social_phone_whatsapp']);

	$user_access = _internal_return_value($_POST['user_access']);
	$user_password = _internal_return_value($_POST['user_password']);

	$social_switches =
		$show_social_facebook
		. $show_social_twitter
		. $show_social_linkedin
		. $show_social_github
		. $show_social_web
		. $show_social_email
		. $show_social_phone
		. $social_phone_whatsapp;

	try {

		client_start_transaction();

		$res = client_select(
			"SELECT `user_access`, `user_password` FROM general WHERE `user_access` = ? LIMIT 1",
			[$user_access],
			"s"
		);

		if (empty($res) || sizeof($res) == 0) {
			general_set_alert(general_get_lang('GENERAL_ADMIN_ERROR'));
			general_redir("?v=setup");
			exit();
		}

		if (!password_verify($user_password, $res[0]["user_password"])) {
			general_set_alert(general_get_lang('GENERAL_ADMIN_ERROR'));
			general_redir("?v=setup");
			exit();
		}

		$res = client_sql(
			"INSERT INTO `userinfo` (
				`name`,
				`description`,
				`profile_picture`,
				`social_facebook`,
				`social_twitter`,
				`social_linkedin`,
				`social_github`,
				`social_web`,
				`social_email`,
				`social_phone`,
				`social_switches`,
				`birthday`,
				`show_age`
			) VALUES (
				?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
			)",
			[
				$name,
				$description,
				$profile_picture,
				$social_facebook,
				$social_twitter,
				$social_linkedin,
				$social_github,
				$social_web,
				$social_email,
				$social_phone,
				$social_switches,
				$birthday,
				$show_age,
			],
			"ssssssssssssi"
		);

		if (!$res) {
			throw new Exception;
		}

		client_commit();

		// ? not working
		general_set_alert(general_get_lang('SETUP_SUCCESS'));
		general_redir("?v=main");
		exit();

	} catch (Throwable $th) {
		client_rollback();
		throw new Exception(client_get_error(), 1);
	}

}

function app_get_general_values(): array
{
	try {

		$res = client_select(
			"SELECT
			`show_last_update`, `last_update`, `system_language`,
			`show_welcome`, `public_view`,
			`blog_enabled`, `blog_comments_enabled`, `blog_likes_enabled`
			FROM general LIMIT 1",
		);

		return $res[0];

	} catch (Throwable $th) {
		throw new Exception(client_get_error(), 1);
	}
}

// IA assited by DeepSeek-v4-Pro
function app_get_languages(): array
{
	$files = glob("lang/*.php");
	$langs = [];
	$base_total = 0;

	foreach ($files as $f) {
		$code = basename($f, ".php");
		$data = include $f;
		if (!is_array($data)) {
			continue;
		}
		$langs[$code] = [
			'code' => $data['LANG_CODE'] ?? $code,
			'name' => $data['LANG_NAME'] ?? $code,
			'total' => count($data),
		];
		if ($code === 'en') {
			$base_total = count($data);
		}
	}

	if ($base_total <= 0) {
		$base_total = 1;
	}

	$result = [];
	foreach ($langs as $lang) {
		$lang['percent'] = (int) round(($lang['total'] / $base_total) * 100);
		$result[] = $lang;
	}

	return $result;
}

function app_ajax_handler(string $request, bool $data): string
{
	switch ($request) {

		case 'show_welcome':

			if (!$data) {

				try {

					client_start_transaction();

					$res = client_sql(
						"UPDATE `general` SET `show_welcome` = 0"
					);

					if (!$res) {
						throw new Exception;
					}

					client_commit();

					return json_encode(
						array(
							"ok" => true,
							"response" => general_get_lang('DASHBOARD_SUCCESS'),
							"update" => "set_disabled",
						)
					);

				} catch (Throwable $th) {

					client_rollback();

					return json_encode(
						array(
							"error" => general_get_lang('DASHBOARD_ERROR'),
							"details" => client_get_error(),
							"update" => "set_checked",
						)
					);

				}

			}

			return json_encode(
				array(
					"ok" => true,
					"response" => general_get_lang('DASHBOARD_DISABLED'),
					"update" => "set_disabled",
				)
			);

		case 'public_view':
		case 'show_last_update':
		case 'blog_enabled':
		case 'blog_comments_enabled':
		case 'blog_likes_enabled':

			try {

				client_start_transaction();

				$res = client_sql(
					"UPDATE `general` SET `$request` = ?",
					[$data ? 1 : 0],
					"i"
				);

				if (!$res) {
					throw new Exception;
				}

				client_commit();

				return json_encode(
					array(
						"ok" => true,
						"response" => general_get_lang('DASHBOARD_SUCCESS'),
						"update" => $data ? "set_checked" : "set_unchecked",
					)
				);

			} catch (Throwable $th) {

				client_rollback();

				return json_encode(
					array(
						"error" => general_get_lang('DASHBOARD_ERROR'),
						"details" => client_get_error(),
						"update" => "set_checked",
					)
				);

			}

		case 'system_language':

			$lang = $_GET['d'] ?? '';

			$valid = array_column(app_get_languages(), 'code');
			if (!in_array($lang, $valid, true)) {
				return json_encode(
					array(
						"error" => general_get_lang('DASHBOARD_AJAX_ERROR'),
						"details" => general_get_lang('DASHBOARD_AJAX_ERROR'),
						"update" => "set_checked",
					)
				);
			}

			try {

				client_start_transaction();

				$res = client_sql(
					"UPDATE `general` SET `system_language` = ?",
					[$lang],
					"s"
				);

				if (!$res) {
					throw new Exception;
				}

				client_commit();

				return json_encode(
					array(
						"ok" => true,
						"response" => general_get_lang('DASHBOARD_SUCCESS'),
						"update" => "set_checked",
					)
				);

			} catch (Throwable $th) {

				client_rollback();

				return json_encode(
					array(
						"error" => general_get_lang('DASHBOARD_ERROR'),
						"details" => client_get_error(),
						"update" => "set_checked",
					)
				);

			}

		default:
			http_response_code(400);
			return json_encode(
				array(
					"error" => general_get_lang('DASHBOARD_AJAX_ERROR'),
					"details" => general_get_lang('DASHBOARD_AJAX_ERROR'),
					"update" => "set_checked",
				)
			);

	}
}
