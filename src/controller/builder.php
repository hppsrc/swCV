<?php

/*
	swCV builder.php file
	Hppsrc 2026
	Based on version 0.0.1
	? Build HTML structure
*/

function builder_header()
{
	include_once "templates/header.php";
}

function builder_body($view)
{
	echo "<main>";
	include_once "templates/notice.php";
	include_once "views/" . $view;
	echo "</main>";
}

function builder_footer()
{
	include_once "templates/footer.php";
}
