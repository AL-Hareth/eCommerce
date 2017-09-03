<?php
	session_start();
	if( isset( $_SESSION['Username'] ) ) {
		header('Location: dashboard.php'); // Redirect To Dashboard Page
	}
	$noNavbar = '';
	$pageTitle = 'Admin Login';
	include 'init.php'; 
	
	// Check If User Comming From HTTP Post Request

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$username = $_POST['user'];
		$password = $_POST['pass'];

		$hashedPass = sha1($password);

		// Check If The User Exist In Database

		$stmt = $con->prepare(" SELECT
									UserID, Username, Password
								FROM 
									users 
								WHERE 
									Username = ? 
								AND 
									Password = ?
								AND 
									GroupID = 1
								LIMIT 1");

		$stmt->execute(array($username, $hashedPass));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		// If Count > 0 This Mean The Database Contain Information Record About This Username

		if ($count > 0) {
			$_SESSION['Username'] = $username; // Register Session Name
			$_SESSION['ID'] = $row['UserID'];  // Register Session ID
			header('Location: dashboard.php'); // Redirect To Dashboard Page
			exit();
		}

	} 
?>
	
	<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<h4 class="text-center"><?php echo lang('ADMIN_LOGIN') ?></h4>
		<input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off" />
		<input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new-password" />
		<input class="btn btn-primary btn-block" type="submit" value="login" />
	</form>

<?php include $tpl . 'footer.php'; ?>