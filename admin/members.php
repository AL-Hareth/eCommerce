<?php

/* 

|===========================================|
|**** Manage Members Page                   |
|											|
|**** You Can Edit | Add | Delete From Here |
|===========================================|

*/

	session_start();
	$pageTitle = 'Members';
	if( isset( $_SESSION['Username'] ) ) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if ($do == 'Manage') { // Manage Page 

			$query = '';
			@$pageRequest = $_GET['page'];
			if (isset($pageRequest) && $pageRequest == 'Pending') {

				$query = 'AND RegStatus = 0';

			}

			// Select All Users Except Admin

			$stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query");

			// Execute The Statment

			$stmt->execute();

			// Assign To Variable

			$rows = $stmt->fetchAll();

			?>

				<h1 class="text-center"><?php echo lang('MANAGE_MEMBER') ?></h1>
				<div class="members-table">
					<div class="container">
						<div class="table-responaive">
							<table class="text-center main-table table table-bordered">
								<tr>
									<td><?php echo lang("ID"); ?></td>
									<td><?php echo lang("USERNAME"); ?></td>
									<td><?php echo lang("EMAIL"); ?></td>
									<td><?php echo lang("FULL_NAME"); ?></td>
									<td><?php echo lang("REG_DATE") ?></td>
									<td><?php echo lang("CONTROL") ?></td>
								</tr>

								<?php

									foreach ($rows as $row) {
										echo '<tr>';
											echo '<td>' . $row['UserID'] . '</td>';
											echo '<td>' . $row['Username'] . '</td>';
											echo '<td>' . $row['Email'] . '</td>';
											echo '<td>' . $row['FullName'] . '</td>';
											echo '<td>' . $row['Date'] . '</td>';
											echo '<td>';
													echo '<a href="members.php?do=Edit&userid=' . $row['UserID'] . '" class="btn btn-success"><i class="fa fa-edit fa-lg" style="margin-right: 5px;"></i>' . lang("EDIT") . '</a>';
													echo ' <a href="members.php?do=Delete&userid=' . $row['UserID'] . '" class="btn btn-danger confirm"><i class="fa fa-remove fa-lg" style="margin-right: 5px;"></i>' . lang("AL_DELETE") . '</a>';
											
														if ($row['RegStatus'] == 0) { echo '<a href="members.php?do=Activate&userid='. $row['UserID'] .'" class="btn btn-info"><i class="fa fa-check"></i>' . lang("ACTIVATE") . '</a>'; }

											echo '</td>';
										echo '</tr>';
									}

								?>
							</table>
						</div>
						<a href="members.php?do=Add" class="btn btn-warning"><i class="fa fa-plus fa-lg" style="margin-right: 5px;"></i><?php echo lang('GO_ADD_MEMBER') ?></a>
					</div>
				</div>

 		<?php
		} elseif ($do == 'Add') { // Add Members Page ?>
		
			<h1 class="text-center"><?php echo lang("ADD_MEMBER") ?></h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Insert" method="POST">
					<!-- Start Username Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label"><?php echo lang("USERNAME") ?></label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="username" class="form-control" autocomplete="off" required="required" placeholder="Username To Login Into Shop" />
						</div>

					</div>
					<!-- End Username Field -->
					<!-- Start Password Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label"><?php echo lang("PASSWORD") ?></label>
						<div class="col-sm-10 col-md-6">
							<input type="password" name="password" class="password form-control" required="required" autocomplete="new-password" placeholder="Password Must Be Hard & Complex" />
							<i class="show-pass fa fa-eye fa-2x"></i>
						</div>
					</div>
					<!-- End Password Field -->
					<!-- Start Email Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label"><?php echo lang("EMAIL") ?></label>
						<div class="col-sm-10 col-md-6">
							<input type="email" name="email" class="form-control" required="required" placeholder="Email Must Be Valid" />
						</div>
					</div>
					<!-- End Email Field -->
					<!-- Start Full Name Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label"><?php echo lang("FULL_NAME") ?></label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="full" class="form-control" required="required" placeholder="Full Name Appear In Your Profile Page" />
						</div>
					</div>
					<!-- End Full Name Field -->
					<!-- Start Submit Field -->
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" value="<?php echo lang("ADD_BUTTON"); ?>" class="btn btn-primary btn-lg col-md-2" />
						</div>
					</div>
					<!-- End Submit Field -->
				</form>
</div>
		<?php
		} elseif ($do == 'Insert') { // Insert Members Page

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			echo '<h1 class="text-center">' . lang('INSERT_HEADING') . '</h1>';
			echo '<div class="container">';

			// Get Variables From The Form

			$user 	= $_POST['username'];
			$pass 	= $_POST['password'];
			$email 	= $_POST['email'];
			$name 	= $_POST['full'];

			$hashPass = sha1($pass);

			// Validate The Form 

			$formErrors = array();

			if (empty($user)) {
				$formErrors[] = 'Username Can\'t Be <b>Empty</b>';
			}

			if (strlen($user) > 10) {
				$formErrors[] = 'Username Can\'t Be <b>More Than 10 Characters</b>';
			}

			if (empty($pass)) {
				$formErrors[] = 'Password Can\'t Be <b>Empty</b>';
			}

			if (strlen($pass) < 3) {
				$formErrors[] = 'Password Must Be <b>More Than 3 Characters</b>';
			}

			if (empty($name)) {
				$formErrors[] = 'Full Name Can\'t Be <b>Empty</b>';
			}

			if (empty($email)) {
				$formErrors[] = 'Email Can\'t Be <b>Empty</b>';
			}

			// Loop Into Errors Array And Echo It

			foreach ($formErrors as $error) {
				echo '<div class="alert alert-danger">' . $error . '</div>';
			}
			if (!empty($formErrors)) { echo '<a href="members.php?do=Add" class="btn btn-warning">' . lang("BACK_ADD") . '</a>'; }

			// Check If There's No Errors Proceed The Update Operation

			if (empty($formErrors)) {
				
				// Check If User Exist In Database

				$check = checkItem("Username", "users", $user);

				if ($check == 1) {

					$theMsg = '<div class="alert alert-danger">Sorry This User Is <b>Exist</b></div>';

					redirectHome($theMsg);

				} else {

					// Insert User Info In Database

					$stmt = $con->prepare("INSERT INTO 
												users(Username, Password, Email, FullName, RegStatus, Date) 
										   VALUES(:zuser, :zpass, :zmail, :zname, 1, now()) ");
					
					$stmt->execute(array(
						'zuser' => $user,
						'zpass' => $hashPass,
						'zmail' => $email,
						'zname' => $name
					));
					
					// Echo Seccess Message

					$theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . ' ' . lang("RECORDS_INSERTED") . '</div>';

					redirectHome($theMsg);

				}
			}

			

		} else {

			echo '<div class="container" style="margin-top: 50px;">';

			$theMsg = '<div class="alert alert-danger">' . lang("CANT_DIRECT_BROWS") . '</div>';

			redirectHome($theMsg, 'back');

			echo '</div>';

		}

		} elseif($do == 'Edit') { // Edit Page 

			// Check If The Request userid Is Numeric & Get The Integer Value Of It

			$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? LIMIT 1");

			// Execute Query

			$stmt->execute(array($userid));

			// The Row Count

			$row = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>
			
				<h1 class="text-center"><?php echo lang('EDIT_MEMBER') ?></h1>
				<div class="container">
					<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="userid" value="<?php echo $userid; ?>">
						<!-- Start Username Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label"><?php echo lang('USERNAME') ?></label>
							<div class="col-sm-10 col-md-6">
								<input class="form-control" type="text" value="<?php echo $row['Username']; ?>" name="username"><span class="edit-astrisk">*</span>
							</div>
						</div>
						<!-- End Username Field -->

						<!-- Start Password Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label"><?php echo lang('PASSWORD') ?></label>
							<div class="col-sm-10 col-md-6">
								<input type="hidden" name="oldpassword" value="<?php echo $row['Password']; ?>">
								<input class="form-control" type="password" name="newpassword" autocomplete="new-password" placeholder="Lave Blank If You Don't Want To Change">
							</div>
						</div>
						<!-- End Password Field -->

						<!-- Start Email Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label"><?php echo lang('EMAIL') ?></label>
							<div class="col-sm-10 col-md-6">
								<input class="form-control" type="email" value="<?php echo $row['Email']; ?>" name="email"><span class="edit-astrisk">*</span>
							</div>
						</div>
						<!-- End Email Field -->

						<!-- Start Full Name Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label"><?php echo lang('FULL_NAME') ?></label>
							<div class="col-sm-10 col-md-6">
								<input class="form-control" type="text" value="<?php echo $row['FullName']; ?>" name="full"><span class="edit-astrisk">*</span>
							</div>
						</div>
						<!-- End Full Name Field -->

						<!-- Start Submit Button -->
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10 col-md-6">
								<input class="btn btn-primary btn-block btn-lg col-md-4" type="submit" value="<?php echo lang('SAVE_BUTTON') ?>">
							</div>
						</div>
						<!-- End Submit Button -->
					</form>
				</div>

	<?php
		
		} else {

			echo '<div class="container" style="margin-top: 50px;">';

			$theMsg = '<div class="alert alert-danger">' . lang("NO_ID") . '</div>';

			redirectHome($theMsg);

			echo '</div>';

		}

	} elseif ($do == 'Update') { // Update Page

		
		echo '<div class="container">';

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			echo '<h1 class="text-center">' . lang('UPDATE_HEADING') . '</h1>';

			// Get Variables From The Form

			$id 	= $_POST['userid'];
			$user 	= $_POST['username'];
			$email 	= $_POST['email'];
			$name 	= $_POST['full'];

			// Password Trick

			$pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

			// Validate The Form 

			$formErrors = array();

			if (empty($user)) {
				$formErrors[] = 'Username Can\'t Be <b>Empty</b>';
			}

			if (strlen($user) > 10) {
				$formErrors[] = '<div class="alert alert-danger">Username Can\'t Be <b>More Than 10 Characters</b>';
			}

			if (empty($name)) {
				$formErrors[] = 'Full Name Can\'t Be <b>Empty</b>';
			}

			if (empty($email)) {
				$formErrors[] = 'Email Can\'t Be <b>Empty</b>';
			}

			// Loop Into Errors Array And Echo It

			foreach ($formErrors as $error) {
				echo '<div class="alert alert-danger">' . $error . '</div>';
			}

			// Check If There's No Errors Proceed The Update Operation

			if (empty($formErrors)) {
				// Update The Database With This Info

				$stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");

				$stmt->execute(array($user, $email, $name, $pass, $id));

				// Echo Seccess Message

				$theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . ' ' . lang('RECORDS_UPDATE') . '</div>';
				
				redirectHome($theMsg, 'back');

			}

			

		} else {

			$theMsg = '<div class="alert alert-danger" style="margin-top: 50px;">' . lang("CANT_DIRECT_BROWS") . '</div>';

			redirectHome($theMsg, 'back');

		}
		
		echo '</div>';

	} elseif ($do == 'Delete') {// Delete Member page

			echo '<h1 class="text-center">' . lang("DELETE_MEMBER") . '</h1>';
			echo '<div class="container">';

				// Check If The Request userid Is Numeric & Get The Integer Value Of It

				$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

				// Select All Data Depend On This ID

				$stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? LIMIT 1");

				$check = checkItem('userid', 'users', $userid);

				if ( $check > 0 ) { 

					$stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");

					$stmt->bindParam(":zuser", $userid);

					$stmt->execute();

					$theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . ' ' . lang('RECORDS_DELETED') . '</div>';

					redirectHome($theMsg, 'back', 2);

				} else {

					echo '<div class="container">';

					$theMsg = '<div class="alert alert-danger">' . lang("NO_ID") . '</div>';

					redirectHome($theMsg);

					echo '</div>';

				}

			echo '</div>';

		}  elseif ($do == 'Activate') { // Activate Page
			
			echo '<h1 class="text-center">' . lang("ACTIVATE_MEMBER") . '</h1>';
			echo '<div class="container">';

				// Check If The Request userid Is Numeric & Get The Integer Value Of It

				$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

				// Select All Data Depend On This ID

				$stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? LIMIT 1");

				$check = checkItem('userid', 'users', $userid);

				if ( $check > 0 ) { 

					$stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");

					$stmt->execute(array($userid));

					$theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . ' ' . lang('RECORDS_ACTIVATED') . '</div>';

					redirectHome($theMsg, 'back', 2);

				} else {

					echo '<div class="container">';

					$theMsg = '<div class="alert alert-danger">' . lang("NO_ID") . '</div>';

					redirectHome($theMsg);

					echo '</div>';

				}

			echo '</div>';

		}
		

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();

	}