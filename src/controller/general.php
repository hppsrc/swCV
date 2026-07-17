<?php

/*
	swCV general.php file
	Hppsrc 2026
	Based on version 0.0.1
	? General usage anywhere on app
*/

// simple redirection
function general_check_router()
{
	if (basename($_SERVER['SCRIPT_FILENAME']) != "index.php") {
		file_exists("index.php") ? header("location: index.php") : header("location: ..");
	}
}

// catch exception, print and exit
function general_print_catch_and_exit(Throwable $e)
{
	echo "<h1 class='error_font'>" . $e->getMessage() . "</h1>";
	exit();
}

// ! UNUSED
// remove any temporal value, usually $_SESSION
function general_read_and_unset(string $v)
{
	if (isset($v)) {
		echo $v;
		unset($v);
	}
}

// get text from lang
function general_print_lang($id): void
{
	global $lang;

	if (isset($lang[$id])) {
		echo $lang[$id];
	} else {
		throw new Exception("CATASTROPHIC ERROR: Text \"$id\" not found. Your installation might be broken or the \"$id\" text is not defined. Please reinstall swCV from GitHub.", 1);
	}
}

?>