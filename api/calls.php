<?php
	if(!isset($_REQUEST["action"])) die;

	require_once("../config.php"); 
	require_once("functions.php");

	$action = htmlspecialchars(addslashes($_REQUEST["action"]));

	switch($action) {
		case "fetchFacebookEvents":
			$pageId = (!isset($_REQUEST["pageId"])) ? die("Argument(s) missing.") : htmlspecialchars(addslashes($_REQUEST["pageId"]));
			print fetchFacebookEvents($pageId);
			break;
		case "getEvents":
			$category = (!isset($_REQUEST["category"])) ? "all" : htmlspecialchars(addslashes($_REQUEST["category"]));
			$searchQuery = (!isset($_REQUEST["query"])) ? false : htmlspecialchars(addslashes($_REQUEST["query"]));
			print json_encode(getEvents($category,$searchQuery));
			break;
		case "getCategories":
			print json_encode(getCategories());
			break;
		default:
			print "Unrecognized parameter(s).";
			break;
	}
?>