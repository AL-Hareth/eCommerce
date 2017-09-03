<?php


	// Routes

	$lang = 'includes/languages/'; // Language Directory
	$tpl  = 'includes/templates/';// Language Directory
	$func = 'includes/functions/'; // Functions Directory
	$css  = 'layout/css/'; // CSS Directory
	$js   = 'layout/js/'; // JavaScript Directory

	// Include The Important Files

	include $lang . 'english.php';
	include $func . 'functions.php';
	include 'connect.php';
	include $tpl  . 'header.php';

	// Include Nacbar On All Pages Expect The One With $noNavbar Variable

	if (!isset($noNavbar)) { include $tpl . 'navbar.php'; }