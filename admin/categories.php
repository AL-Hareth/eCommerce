<?php

    ob_start(); // Output Buffering Start

    session_start();

    $pageTitle = 'Categories';

    if (isset($_SESSION['Username'])) {

        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        if ($do == 'Manage') { // Manage Categories Page

            echo "Manage";
            echo "<a href='categories.php?do=Add'>Go To Add Categories</a>";

        } elseif ($do == 'Add') { // Add Categories Page ?>


            <h1 class="text-center"><?php echo lang("CAT_ADD") ?></h1>
            <div class="container">
            <form class="form-horizontal" action="?do=Insert" method="POST">
                <!-- Start Username Field -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label"><?php echo lang("CAT_NAME") ?></label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="username" value="<?php echo null; ?>" class="form-control" autocomplete="off" required="required" placeholder="" />
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

        <?php

        } elseif ($do == 'Insert') { // Insert Categories Page

            echo "Insert";

        } elseif ($do == 'Edit') { // Edit Categories Page

        } elseif ($do == 'Update') { // Update Categories Page

        } elseif ($do == 'Delete') { // Delete Categories Page

        }

        include $tpl . 'footer.php';

    } else {

        header('Location: index.php');

        exit();

    }

    ob_end_flush(); // Release The Output