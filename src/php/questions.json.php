<?php

if(!defined('phpunit')) {
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Content-type: application/x-javascript");
}

require_once('bootstrap.php');
require_once('smarty.inc.php');

$questions = "";
if(array_key_exists( 'id', $_GET))
	$questions = (string) $_GET['id'];

$callback = "";
if(array_key_exists( 'callback', $_GET))
	$callback = (string) $_GET['callback'];

$output = array();

if(!empty($questions)) {
	$q = new Questions();
	$output = $q->getQuestions($questions);
}

if( $callback == "")
	print json_encode($output);
else
	print $callback ."( ". json_encode($output) ." );";


?>
