<?php

/*
	swCV client.php file
	Hppsrc 2026
	Based on version 0.0.1
	? General MySQL PDO client
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$_swCV_conn = null;
$_swCV_db_host = get_env("host");
$_swCV_db_user = get_env("user");
$_swCV_db_pass = get_env("pass");
$_swCV_db_name = get_env("name");
$_swCV_db_gen_error = get_env("sql_generic_error");
$_swCV_db_gen_error_msg = get_env("sql_generic_error_msg");

function create_conn()
{
	try {
		global $_swCV_db_host, $_swCV_db_user, $_swCV_db_pass, $_swCV_db_name, $_swCV_conn;
		$_swCV_conn = mysqli_connect($_swCV_db_host, $_swCV_db_user, $_swCV_db_pass, $_swCV_db_name);
		return $_swCV_conn;
	} catch (mysqli_sql_exception $e) {
		throw new Exception(get_error($e, "create_conn()"), 1);
	}
}

function get_conn()
{
	try {
		global $_swCV_conn;
		if (!$_swCV_conn) {
			create_conn();
		}
		return $_swCV_conn;
	} catch (mysqli_sql_exception $e) {
		throw new Exception(get_error($e, "get_conn()"), 1);
	}
}

function transaction($callback)
{
	try {
		$conn = get_conn();
		mysqli_begin_transaction($conn);
		$callback();
		mysqli_commit($conn);
	} catch (mysqli_sql_exception $e) {
		mysqli_rollback($conn);
		throw new Exception(get_error($e, "transaction()"), 1);
	}
}

function rollback()
{
	try {
		$conn = get_conn();
		mysqli_rollback($conn);
	} catch (mysqli_sql_exception $e) {
		throw new Exception(get_error($e, "rollback()"), 1);
	}
}

function commit()
{
	try {
		$conn = get_conn();
		mysqli_commit($conn);
	} catch (mysqli_sql_exception $e) {
		throw new Exception(get_error($e, "commit()"), 1);
	}
}

function UNSECURE_sql($query)
{
	try {
		$conn = get_conn();
		return mysqli_query($conn, $query);
	} catch (mysqli_sql_exception $e) {
		throw new Exception(get_error($e, "UNSECURE_sql()"), 1);
	}
}

function sql($query, array $params = [], string $types = "")
{
	try {
		$conn = get_conn();
		if (empty($params)) {
			return mysqli_query($conn, $query);
		}

		$stmt = mysqli_prepare($conn, $query);
		if ($stmt === false) {
			throw new Exception(mysqli_error($conn));
		}

		mysqli_stmt_bind_param($stmt, $types, ...$params);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		if ($result === false) {
			return true;
		}
		return $result;
	} catch (mysqli_sql_exception $e) {
		throw new Exception(get_error($e, "sql()"), 1);
	}
}

function UNSECURE_select($query)
{
	try {
		$conn = get_conn();
		$result = mysqli_query($conn, $query);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
	} catch (mysqli_sql_exception $e) {
		throw new Exception(get_error($e, "UNSECURE_select()"), 1);
	}
}

function select($query, array $params = [], string $types = "")
{
	try {
		$conn = get_conn();
		if (empty($params)) {
			$result = mysqli_query($conn, $query);
		} else {
			$stmt = mysqli_prepare($conn, $query);
			if ($stmt === false) {
				throw new Exception(mysqli_error($conn));
			}
			mysqli_stmt_bind_param($stmt, $types, ...$params);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
		}

		if ($result === false) {
			return [];
		}
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
	} catch (mysqli_sql_exception $e) {
		throw new Exception(get_error($e, "select()"), 1);
	}
}

function disconn()
{
	global $_swCV_conn;
	if ($_swCV_conn) {
		mysqli_close($_swCV_conn);
		$_swCV_conn = null;
	}
}

function get_error($e = null, $where = "unknown")
{
	global $_swCV_conn, $_swCV_db_gen_error, $_swCV_db_gen_error_msg;

	if ($e instanceof mysqli_sql_exception) {
		if ($_swCV_db_gen_error) {
			return "Error: " . $where . " -> " . $_swCV_db_gen_error_msg;
		} else {
			return "Error: " . $where . " -> " . $e->getMessage() . " (Error " . (int) $e->getCode() . ")";
		}
	}

	if (!$_swCV_conn) {
		return mysqli_connect_error();
	}
	return mysqli_error($_swCV_conn);
}
