<?php

/*
	swCV router.php file
	Hppsrc 2026
	Based on version 0.1.0-alpha
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

	builder_header();

	user_is_admin_setup();

	general_check_router();

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['a'])) {

		$action = $_GET['a'];

		switch ($action) {
			case 'setup':
				app_setup();
				break;

		}

	}

	// set route if not found
	$path = isset($_GET['v']) && !empty($_GET['v']) ? $_GET['v'] : general_redir("?v=main");

	general_get_alert();

	// routing
	switch ($path) {

		case 'setup':
			builder_body("setup");
			break;

		case 'welcome':
			builder_body("welcome");
			break;

		case 'main':
			builder_body("main");
			break;

		// 404
		default:
			builder_body("404");
			break;
	}

	// add footer
	builder_footer();

	ob_end_flush();

} catch (Throwable $th) {
	ob_end_clean();
	builder_header();
	general_print_catch_and_exit($th);
}

