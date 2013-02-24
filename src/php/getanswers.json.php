<?php

require_once("bootstrap.php");
require_once("smarty.php");

$json = "";
if(array_key_exists( 'json', $_POST))
	$json = json_decode( (string) $_POST['json']);

if($json == "") return;

$sa = new StoredAnswers();
$sa->setStoredAnswers($json);

$uniq = $sa->getId();

print json_encode(array("id" => $uniq));

?>
