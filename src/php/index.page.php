<?php

require_once('bootstrap.php');
require_once('smarty.inc.php');

$smarty->assign( 'Title', "The Last Consultant");
$smarty->assign( 'SubTitle', "Assignment Oracle");

$id = "";
if(array_key_exists( 'id', $_GET))
	$id = (string) $_GET['id'];

if($id == "") {
	$smarty->display( 'smarty/index.tpl.html');
} else {
	$smarty->assign( "HASH", $id);
	$smarty->display( 'smarty/answers.tpl.html');
}

?>
