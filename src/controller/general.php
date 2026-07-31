<?php

/*
	swCV general.php file
	Hppsrc 2026
	Based on version 0.1.0-alpha
	? General usage anywhere on app
*/

// simple redirection
function general_redir(string $p): void
{
	header("location: $p");
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
		try {
			$file = "lang/en.php";
			if (file_exists($file)) {
				$lang = include $file;
			}
		} catch (Throwable $e) {
			// Ignore emergency load failure
		}
	}

	if (isset($lang[$id])) {
		return $lang[$id];
	} else {
		return htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
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
		echo e($_SESSION['general_alert']);
		unset($_SESSION['general_alert']);
	}
}

?>