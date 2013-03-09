<?php

//if(defined('phpunit')) {
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Content-type: application/x-javascript");
//}

require_once('bootstrap.php');
require_once('smarty.inc.php');

$questions = "";
if(array_key_exists( 'id', $_GET))
	$questions = (string) $_GET['id'];

$user = "";
if(array_key_exists( 'user', $_GET))
	$user = (string) $_GET['user'];

$callback = "";
if(array_key_exists( 'callback', $_GET))
	$callback = (string) $_GET['callback'];

$output = array();

$sa = new StoreAnswers();
$sa->setId($user);
$storedAnswers = $sa->getStoredAnswers();
$stordedAnswers = ksort($storedAnswers);

$as = new AnswerSieve($questions);
foreach( $storedAnswers as $key => $val) {
	$as->setAnswerId($key);
	$sieve = $as->getAnswerSieve();

	$oxey = substr( $key, 0, -1);
	if(array_key_exists( $oxey, $output)) {
		foreach($sieve[$output[$oxey]] as $skey => $sval) {
			if(array_key_exists( $val, $sval)) {
				$output[$oxey] = $sieve[$output[$oxey]][$skey][$val];
			}
		}
	} else {
		if( is_array($sieve[$val]))
			$output[$oxey] = $val;
		else
			$output[$oxey] = $sieve[$val];
	}
}


if( $callback == "")
	print json_encode($output);
else
	print "var answers = ". json_encode($storedAnswers) .";". $callback ."( ". json_encode($output) ." );";


?>
