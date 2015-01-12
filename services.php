<?php
include_once(dirname(__FILE__).'/../../g2-private/src/wp/includes.php');
include_once(dirname(__FILE__).'/../../g2-private/src/shared/includes.php');

$api = ApplicationApi::getInstance();
$api->init();
if (@$_GET['debug'] != "") {
	$api->headerHTML();	
} else {
	$api->headerJSON();	
}
$api->startServiceController();
?>