<?php

/*
	swCV user.php file
	Hppsrc 2026
	Based on version 0.0.1
*/

function user_is_setup()
{

	try {

		$res = sql("SELECT * from userinfo");

		if (mysqli_num_rows($res) == 0) {
			return false;
		} else {
			return true;
		}

	} catch (Throwable $th) {
		general_print_catch_and_exit($th);
	}
}

?>