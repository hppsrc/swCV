<?php

/*
	swCV app.php file
	Hppsrc 2026
	Based on version 0.0.1
	? General app server checks, mostly single checks or loads on running
*/

// check for critial envs
function app_check_env()
{
	if (
		!isset($_ENV['host']) ||
		!isset($_ENV['name']) ||
		!isset($_ENV['user']) ||
		!isset($_ENV['pass']) ||
		!isset($_ENV['sql_generic_error']) ||
		!isset($_ENV['sql_generic_error_msg']) ||
		!isset($_ENV['version']) ||
		!isset($_ENV['lang'])
	) {
		throw new Exception("CATASTROPHIC ERROR: Critical variables from .env are missing. Please check you .env file.");
	}
}

// load app language
function app_load_lang()
{
	global $lang;
	$file = "lang/" . get_env("lang") . ".php";

	try {
		if (file_exists($file)) {
			$lang = include $file;
		} else {
			throw new Exception("CATASTROPHIC ERROR: $file file not found. Your installation might be broken. Please reinstall swCV from GitHub.", 1);
		}
	} catch (Throwable $th) {
		general_print_catch_and_exit($th);
	}
}


// check if display welcome screen or not
function app_show_welcome()
{

	$res = sql("SELECT * from general");
	$row = mysqli_fetch_assoc($res);

	if (mysqli_num_rows($res) == 0) {
		throw new Exception("CATASTROPHIC ERROR: No data found in the 'show_welcome' column. Your installation might be broken. Please reinstall swCV from GitHub.", 1);
	} else {
		return $row['show_welcome'];
	}
}
