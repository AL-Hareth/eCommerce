<?php

	/*
		Categories => [ Manage | Edit | Updata | Add | Insert | Delete | Stats ] 
	*/

	$do = '';

	if ( isset($_GET['do']) ) {
		$do = $_GET['do'];
	} else {
		$do = 'Manage';
	}

	// If The Page Is The Main Page

	if ($do == 'manage') {
		echo 'Welcome You Are In Manage Category Page';
	} elseif ($do == 'add') {
		echo 'Welcome You Are In Add Category Page';
	} elseif ($do == 'insert') {
		echo 'Welcome You Are In Insert Category Page';
	} else {
		echo 'Error There\'s No Page With This Name';
	}
	