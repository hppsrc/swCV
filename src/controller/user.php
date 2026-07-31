<?php

/*
	swCV user.php file
	Hppsrc 2026
	Based on version 0.1.0-alpha
	? Admin/User like based functions
*/

function user_is_setup(): bool
{

	$res = client_select(
		"SELECT * from `userinfo` LIMIT 1"
	);

	if (empty($res) || sizeof($res) == 0) {
		return false;
	} else {
		return true;
	}
}

function user_is_admin_setup(): void
{

	$res = client_select(
		"SELECT * from `general` LIMIT 1"
	);

	if (empty($res) || sizeof($res) == 0) {
		throw new Exception("
		IMPORTANT: Administrator credentials are not set in the database.
		If you are just installing swCV, then everything seems to be fine.
		Otherwise, something went INCREDIBLY WRONG and important configuration data was lost.
		<br> <br>
		In either case, you must run the <a href='installer/installer.html'>installer</a> again.
		If you continue to see THIS MESSAGE afterward, you must reinstall the entire swCV because there are corrupted or missing files,
		or some other issue.
		", 1);
	}
}

?>