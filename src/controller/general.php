<?php

/*
	swCV general.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? General usage anywhere on app
*/

// simple redirection
function general_redir(string $p): void
{
	header("location: $p");
	exit(); // fallback
}

// router redirection
function general_check_router(): void
{
	if (basename($_SERVER['SCRIPT_FILENAME']) != "index.php") {
		file_exists("index.php") ? general_redir("index.php") : general_redir("..");
	}
}

// catch exception, print and exit
function general_print_catch_and_exit(Throwable $e): void
{
	echo "<h1 class='error_font'>" . $e->getMessage() . "</h1>";
	exit();
}

// general sanitizer
function e(string $t): string
{
	$t = trim($t);
	$t = stripcslashes($t);
	return htmlspecialchars($t ?? '', ENT_QUOTES, 'UTF-8');
}

// get text from lang
// ? direct echo
function general_print_lang(string $id): void
{
	echo general_get_lang($id);
}


// get text from lang
// ? return echo for internal functions
function general_get_lang(string $id): string
{
	global $lang;

	if (empty($lang)) {
		app_load_lang();
	}

	if (isset($lang[$id])) {
		return $lang[$id];
	} else {
		return e($id);
	}
}

// set flash alert
function general_set_alert(string $t): void
{
	$_SESSION['general_alert'] = $t;
}

// get flash alert
function general_get_alert(): void
{
	if (isset($_SESSION['general_alert'])) {
		echo "<script> alert('" . e($_SESSION['general_alert']) . "')</script>";
		unset($_SESSION['general_alert']);
	}
}

function general_dashboard_tab_helper(): void
{

	if (!isset($_GET['tab'])) {
		general_redir("?v=dashboard&tab=#general");
	}
}

function general_dashboard_tab_serve(string $tab): void
{

	// only for logged admins
	if (!user_is_admin_logged()) {
		general_set_alert(general_get_lang('GENERAL_ADMIN_ERROR'));
		general_redir("?v=dashboard");
		exit();
	}

	user_check_admin_login();

	// sanitize and whitelist the partial file
	$tab = basename($tab);

	if (!preg_match('/^[a-z0-9_-]+$/i', $tab)) {
		$tab = "404";
	}

	$p = "views/dashboard/" . $tab . ".php";

	if (file_exists($p)) {
		include $p;
	} else {
		include "views/404.php";
	}

	ob_end_flush();
	exit;
}

function general_csrf_token(): string
{
	if (empty($_SESSION['csrf_token'])) {
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	}
	return $_SESSION['csrf_token'];
}

function general_csrf_check(?string $received = null): bool
{
	$received = $received ?? ($_POST['csrf_token'] ?? '');
	return !empty($_SESSION['csrf_token'])
		&& hash_equals($_SESSION['csrf_token'], $received);
}

function general_set_title(string $t): void
{
	$GLOBALS['page_title'] = $t;
}

function general_get_title(): string
{
	return $GLOBALS['page_title'] . " - swCV";
}

?>