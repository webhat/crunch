<?php

require_once('bootstrap.php');
require_once('smarty.inc.php');

$smarty->assign( 'Title', "The Last Consultant - Assignment Oracle - Lean and Lasting");

$smarty->display( 'smarty/index.tpl.html');

?>
