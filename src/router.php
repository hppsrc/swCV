<?php

/*
	swCV router.php file
	Hppsrc 2026
	Based on version 0.0.1
	? Simple routing for index and views including
*/

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

ob_start();

include_once "constants/constants.php";

// import meta and envs
include_once "utils/env_parser.php";

// import general controllers
include_once "controller/app.php";
include_once "controller/general.php";
include_once "controller/user.php";
include_once "controller/builder.php";

try {

	load_env();
	app_check_env();
	app_load_lang();

	// import client controller after css and envs
	include_once "controller/client.php";

	general_check_router();

	// add header
	builder_header();

	// set route if not found
	$path = isset($_GET['v']) && !empty($_GET['v']) ? $_GET['v'] : 'setup';

	// routing
	switch ($path) {
		case 'setup':
			builder_body("setup.php");
			break;
		default:
			builder_body("404.php");
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

