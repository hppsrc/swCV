<?php

/*
	swCV user.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? Admin/User like based functions
*/

function user_is_setup(): bool
{

	$res = client_select(
		"SELECT * from `userinfo` LIMIT 1"
	);

	if (empty($res) || sizeof($res) == 0) {
		return false;
	} else {
		return true;
	}
}

function user_is_admin_setup(): void
{

	$res = client_select(
		"SELECT * from `general` LIMIT 1"
	);

	if (empty($res) || sizeof($res) == 0) {
		throw new Exception("
		IMPORTANT: Administrator credentials are not set in the database.
		If you are just installing swCV, then everything seems to be fine.
		Otherwise, something went INCREDIBLY WRONG and important configuration data was lost.
		<br> <br>
		In either case, you must run the <a href='installer/installer.html'>installer</a> again.
		If you continue to see THIS MESSAGE afterward, you must reinstall the entire swCV because there are corrupted or missing files,
		or some other issue.
		", 1);
	}
}

function user_login_admin(): void
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
		'user_access',
		'user_password'
	];

	foreach ($expected as $k) {
		$_POST[$k] = $_POST[$k] ?? null;
	}


	$user_access = _internal_return_value($_POST['user_access']);
	$user_password = _internal_return_value($_POST['user_password']);

	try {

		$res = client_select(
			"SELECT `user_access`, `user_password` FROM general WHERE `user_access` = ? LIMIT 1",
			[$user_access],
			"s"
		);

		if (empty($res) || sizeof($res) == 0) {
			general_set_alert(general_get_lang('GENERAL_ADMIN_ERROR'));
			general_redir("?v=dashboard");
			exit();
		}

		if (!password_verify($user_password, $res[0]["user_password"])) {
			general_set_alert(general_get_lang('GENERAL_ADMIN_ERROR'));
			general_redir("?v=dashboard");
			exit();
		}

		session_regenerate_id(true);

		$_SESSION["auth"] = [
			'token' => bin2hex(random_bytes(32)),
			"time" => time()
		];
		general_redir("?v=dashboard");
		exit();

	} catch (Throwable $th) {
		throw new Exception(client_get_error(), 1);
	}

}

function user_check_admin_login(): void
{

	if (empty($_SESSION['auth']) || empty($_SESSION['auth']['token'])) {
		user_admin_logout();
		exit();
	}

	if (time() - ($_SESSION['auth']['time'] ?? 0) > 1800) {
		user_admin_logout();
		exit();
	}
}

function user_is_admin_logged(): bool
{
	return isset($_SESSION["auth"]);
}

function user_admin_logout(): void
{
	unset($_SESSION["auth"]);
	general_redir("?v=dashboard");
	exit();
}

function user_get_username(): string
{

	$res = client_select(
		"SELECT `name` from `userinfo` LIMIT 1"
	);

	return $res[0]["name"];

}

?>