<?php
	session_start();
	include("../config.php");
	include("../api/functions.php");

	$p = (!isset($_GET["p"])) ? "login" : htmlspecialchars(addslashes($_GET["p"]));

	if(!isset($_SESSION["logged"])) $p = "login";

	include($p . ".php");
?>