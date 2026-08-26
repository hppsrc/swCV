<?php

/*
	swCV index.php file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? Index and app entry point
*/

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once "router.php";

?>

<!-- ? Global overlay -->
<div id="overlay"></div>