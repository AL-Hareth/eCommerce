<?php
		// AL_ Is My Prefix
	function lang( $phrase ){
		 static $lang = array(

		 		// Global Words

		 		'YES'				=> 'Yes',
		 		'NO'				=> 'No',
		 		'CANT_DIRECT_BROWS' => 'Sorry You Can\'t Browse This Page Directly',
		 		'RECORDS_INSERTED' 	=> 'Record Inserted',
				'INSERT_HEADING' 	=> 'Insert Page',
				'RECORDS_DELETED' 	=> 'Reqord Deleted',
				'AL_DELETE'			=> 'Delete',
				'EDIT'				=> 'Edit',
				'ACTIVATE'			=> 'Activate',
				'EDIT_MEMBER' 		=> 'Edit Member',
				'USERNAME' 			=> 'Username',
				'PASSWORD' 			=> 'Password',
				'EMAIL' 			=> 'Email',
				'FULL_NAME' 		=> 'Full Name',
				'SAVE_BUTTON' 		=> 'Save',
				'NO_ID'				=> 'There Is No Such ID',
				'ADD_BUTTON' 		=> 'Add',
				'AL_UPDATE' 		=> 'Update',

		 		// Admin Login

		 		'ADMIN_LOGIN' 		=> 'Admin Login',

		 		// NavBar Links

				'HOME_ADMIN' 		=> 'Dashboard',
				'CATEGORIES' 		=> 'Categories',
				'ITEMS' 	 		=> 'Items',
				'MEMBERS'    		=> 'Members',
				'STATISTICS' 		=> 'Statistics',
				'LOGS' 		 		=> 'Logs',
				'EDIT_PROFILE' 		=> 'Edit Profile',
				'SETTING'			=> 'Setting',
				'LOGOUT' 			=> 'Logout',

				// Dashboard Page

				'TOTAL_MEMBERS'		=> 'Total Members',
				'PENDING_MEMBERS' 	=> 'Pending Members',
				'TOTAL_ITEMS' 		=> 'Total Items',
				'TOTAL_COMS' 		=> 'Total Comments',
				'REGISTERD_USERS'	=> 'Registerd Users',
				'LATEST'			=> 'Latest',
				'ITEMS'				=> 'Items',

				// Members Page

				# Manage Members Page

				'MANAGE_MEMBER' 	=> 'Manage Members',
				'ID' 				=> 'ID',
				'REG_DATE' 			=> 'Registerd Date',
				'CONTROL' 			=> 'Control',
				'GO_ADD_MEMBER' 	=> 'Go To Add Member Page',
				'' 					=> '',
				'' 					=> '',

				# Activate Members Page

				'ACTIVATE_MEMBER' 	=> 'Activate Members',
				'RECORDS_ACTIVATED' => 'Record Activated',

				# Delete Page 

				'RECORDS_DELETED' 	=> 'Reqord Deleted',
				'DELETE_MEMBER' 	=> 'Delete Member',
				'' 					=> '',
				'' 					=> '',

				# Edit Page

				'' 					=> '',
				'' 					=> '',
				'' 					=> '',
				'' 					=> '',

				# Update Page

				'UPDATE_HEADING'	=> 'Update Members',
				'RECORDS_UPDATE' 	=> 'Record Updated',

				# Add Page

				'ADD_MEMBER' 		=> 'Add Member',
				'ADD_MEMBER' 		=> 'Add New Member',

				# Insert Page

				'BACK_ADD'			=> 'Back To Add Member Page',
				''					=> '',
				''					=> '',
				''					=> '',
				''					=> '',

				// Categories Page

				# Manage Page

				'MANAGE_CATS' 		=> 'Manage Categories',

				# Delete Page 

				'DELETE_CAT' 		=> 'Delete Category',
				'' 					=> '',
				'' 					=> '',

				# Edit Page

				'CAT_EDIT' 			=> 'Edit Category',
				'' 					=> '',
				'' 					=> '',
				'' 					=> '',
				'' 					=> '',
				'' 					=> '',

				# Update Page

				'UPDATE_HEADING'	=> 'Update Members',
				'RECORDS_UPDATE' 	=> 'Record Updated',

				# Add Page

				'CAT_ADD' 			=> 'Add Category',
				'CAT_NAME'			=> 'Name',
				'CAT_DESC'			=> 'Description',
				'CAT_ORDER' 		=> 'Ordering',
				'CAT_VIS'			=> 'Visibile',
				'CAT_COMMENT'		=> 'Allow Commenting',
				'CAT_ADS'			=> 'Allow Ads',

				# Insert Page

				'RECORDS_INSERTED' 	=> 'Record Inserted',
				'CAT_UPDATE' 		=> 'Insert Category'

			);

		 	return $lang[$phrase];

	}
