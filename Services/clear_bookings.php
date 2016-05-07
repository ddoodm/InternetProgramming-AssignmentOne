<?php
	require_once("../Include/stdinc.php");
	session_start();
	session_destroy();
	header("Location: ../" . Constants::$PAGE_URL_MY_BOOKINGS);
?>