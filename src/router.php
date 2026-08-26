<?php

/*
	swCV router.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? Simple routing for index and views including
*/

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

ob_start();

// import constants
require_once "constants/constants.php";

// import meta and envs
require_once "utils/env_parser.php";

// import general controllers
require_once "controller/app.php";
require_once "controller/general.php";
require_once "controller/user.php";
require_once "controller/builder.php";

try {

	load_env();
	app_check_env();

	// import client controller after css and envs
	require_once "controller/client.php";

	app_load_lang();

	user_is_admin_setup();

	app_check_db_version();

	general_check_router();

	// dashboard tab loader
	if (
		($_GET['v'] ?? '') === 'dashboard'
		&& ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest'
		&& isset($_GET['tab'])
	) {
		general_dashboard_tab_serve($_GET['tab']);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['a'])) {

		$action = $_GET['a'];
		$request = $_GET['r'];
		$data = ($_GET['d'] ?? "") == "true";

		switch ($action) {
			case 'setup':
				app_setup();
				break;

			case 'dashboard_login':
				user_login_admin();
				break;

			case 'ajax':

				if (!user_is_admin_logged()) {
					http_response_code(403);
					general_set_alert(general_get_lang('GENERAL_NOT_ALLOWED'));
					return;
				}

				header("Content-Type: application/json");

				echo app_ajax_handler($_GET['r'] ?? '', (bool) $data);
				exit;

		}

	}

	// set route if not found
	$path = isset($_GET['v']) && !empty($_GET['v']) ? $_GET['v'] : general_redir("?v=main");

	general_get_alert();

	$titles = [
		'main' => user_get_username(),
		'setup' => general_get_lang('TITLE_SETUP'),
		'welcome' => general_get_lang('TITLE_WELCOME'),
		'dashboard' => 'Dashboard',
		'private' => general_get_lang('TITLE_PRIVATE'),
	];

	general_set_title($titles[$path] ?? null);

	builder_header();

	// routing
	switch ($path) {

		case 'setup':
			builder_body("setup");
			break;

		case 'welcome':
			builder_body("welcome");
			break;

		case 'dashboard':
			builder_body("dashboard");
			break;

		case 'private':
			builder_body("private");
			break;

		case 'main':
			builder_body("main");
			break;

		case 'api':
			http_response_code(403);
			builder_body("403");
			break;

		case '':
			general_redir("?v=main");
			break;

		// 404
		default:
			http_response_code(404);
			builder_body("404");
			break;
	}

	// add footer
	builder_footer();

	// closes any sql conn
	client_disconn();

	ob_end_flush();

} catch (Throwable $th) {
	ob_end_clean();
	builder_header();
	general_print_catch_and_exit($th);
}

