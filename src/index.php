<?php

/*
	swCV index.php file
	Hppsrc 2026
	Based on version 0.0.1
	? Index and app entry point
*/

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once "router.php";
