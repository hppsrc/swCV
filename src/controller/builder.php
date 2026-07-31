<?php

/*
	swCV builder.php file
	Hppsrc 2026
	Based on version 0.1.0-alpha
	? Build HTML structure
*/

// adds header
function builder_header(): void
{
	include "templates/header.php";
}

// adds body
function builder_body(string $v): void
{

	$p = "views/" . $v . ".php";

	echo "<body>";
	echo "<main id='$v'>";

	require "templates/notice.php";

	if (file_exists($p)) {
		include $p;
	} else {
		include "views/404.php";
	}

	echo "</main>";
	echo "</body>";

}

// add footer
function builder_footer(): void
{
	require "templates/footer.php";
}
