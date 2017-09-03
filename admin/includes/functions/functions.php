<?php

	/*
	** Title Function V1.0
	**	Title Function That Echo The Page Title In Case The Page
	**	Has The Variable $pageTitle And Echo Default Title For Other Pages
	*/

	function getTitle() {

		global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;

		} else {

			echo 'Default';

		}

	}

	/*
	** Home Redirect Function V2.0
	** This Function Accept Parameters
	** $theMsg 	= Echo The Message [ Error | Succes | Warning ]
	** $url 	= Kink You Want To Redirect To
	** $seconds = Seconds Before Redirecting
	*/

	function redirectHome($theMsg, $url = NULL, $seconds = 4) {

		if ($url === null) {

			$url = 'index.php';

			$link = 'Homepage';

		} else {

			if( isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ) {

				$url = $_SERVER['HTTP_REFERER'];

				$link = 'Previous Page';

			} else {

				$url = 'index.php';

				$link = 'Homepage';

			}

		}

		echo $theMsg;

		echo '<div class="alert alert-info">You Will Be Redirected To ' . $link . ' After ' . $seconds . ' Seconds</div>';

		header("refresh:$seconds;url=$url");

		exit();

	}

	/*
	** Check Item Function V1.0
	** Function To Check Items In Database [ Accept Parameter ]
	** $select = The Item To Selece [ Example: Username, Item, Category ]
	** $from   = The Table To Select From [ Example: Users, Items, Categories ]
	** $value  = The value Of Select [ Example: Alhareth, Box, Electronics ]
	*/

	function checkItem($select, $from, $value) {

		global $con;

		$statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

		$statement->execute(array($value));

		$count = $statement->rowCount();

		return $count;

	}

	/*
	** Count Number Of Items Function V1.0
	** Function To Count Items Rows
	** $item  = The Item To Count
	** $table = The Table To Choose From
	*/

	function countItems($item, $table) {

		global $con;

		$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

		$stmt2->execute();

		return $stmt2->fetchColumn();

	}

	/*
	** Get Latest Records Function V1.0
	** Function To Get Latest Items From Database [ Users, Items, Comments ]
	** $select = Field To Select
	** $table = The Table For Choose From
	** 
	*/

	function getLatest($select, $table, $order, $limit = 5) {

		global $con;

		$getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

		$getStmt->execute();

		$rows = $getStmt->fetchAll();

		return $rows;

	}