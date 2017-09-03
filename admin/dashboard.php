<?php

	ob_start(); // Output Buffering Start

	session_start();
	
	if( isset( $_SESSION['Username'] ) ) {

		$pageTitle = 'Dashboard';

		include 'init.php';

		/* Start Dashboard Page */

		$latestUsers = 3; // The Latest Users 
		$theLatest = getLatest("Username", "users", "UserID", $latestUsers); // The Function Of Latest Users

		?>
		<div class="home-stats">
			<div class="container text-center">
				<h1>Dashboard</h1>
				<div class="row">
					<div class="col-md-3">
						<a href="members.php">
							<div class="stat st-members">
								<?php echo lang("TOTAL_MEMBERS"); ?>
								<span><?php echo countItems('UserID', 'users'); ?></span>
							</div>
						</a>
					</div>
					<div class="col-md-3">
						<div class="stat st-pending">
							<a href="members.php?do=Manage&page=Pending">
								<?php echo lang("PENDING_MEMBERS") ?>
								<span><?php echo checkItem("RegStatus", "users", "0"); ?></span>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<a href="#">
							<div class="stat st-items">
								<?php echo lang("TOTAL_ITEMS") ?>
								<span>1500</span>
							</div>
						</a>
					</div>
					<div class="col-md-3">
						<a href="#">
							<div class="stat st-comments">
								<?php echo lang("TOTAL_COMS") ?>
								<span>3500</span>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="latest">
			<div class="container ">
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-users"></i><?php  echo lang("LATEST") . ' ' . $latestUsers . ' ' . lang("REGISTERD_USERS"); ?> 
	 						</div>
	 						<div class="panel-body">
	 							<ul class="list-unstyled latest-users">
	 								<?php 
		 								foreach ($theLatest as $user) { 
		 									echo '<li>';
		 										echo $user['Username']; 
		 									echo "</li>";
		 								} 
	 								?>
	 							</ul>
	 						</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-tag"></i><?php echo lang("LATEST") . ' 3 ' . lang("ITEMS"); ?>
	 						</div>
	 						<div class="panel-body">
	 							Test
	 						</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php

		/* End Dashboard Page */

		include $tpl . 'footer.php';

	} else {
		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output