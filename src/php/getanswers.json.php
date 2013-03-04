<?php

require_once("bootstrap.php");

$json = "";
if(array_key_exists( 'json', $_POST))
	$json = json_decode( (string) $_POST['json']);

if($json == "") return;

$sa = new StoreAnswers();
$sa->setStoredAnswers($json);

$uniq = $sa->getId();

$mail = new Mail();
$message = array(
		"name" => $json->pname,
		"mail" => $json->mail,
		"hash" => $uniq
		);
$mail->send($message);

print json_encode(array("id" => $uniq));

?>
