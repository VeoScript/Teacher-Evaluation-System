<?php include 'classes/db.php';?>
<?php include 'classes/Login.php';?>

<?php
    function isLoggedIn(){

        if(isset($_COOKIE['EVALUATION'])){

            if(DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['EVALUATION'])))){
                $user_id = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['EVALUATION'])))[0]['user_id'];
                
                if(isset($_COOKIE['EVALUATION_'])){
                    return $user_id;
                }
                else{
                    $cstrong = TRUE;
                    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                    DB::query('INSERT INTO login_tokens VALUES (:token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                    DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['EVALUATION'])));

                    setcookie("EVALUATION", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                    setcookie("EVALUATION_", '1', time() + 60 * 60 * 24 * 6, '/', NULL, NULL, TRUE);

                    return $user_id;
                }
                
            }
        }
        return False;
    }
    

    if(Login::isLoggedIn()){
        $fullname = Login::isLoggedIn();

        if(DB::query('SELECT IdNumber FROM student_account WHERE Fullname=:Fullname', array(':Fullname'=>$fullname))){
            header('Location:student_form.php');
        }
    }
    else{
        header('Location:login.php');
    }
?>

<!-- PHP Code for Logout -->
<?php
    if(!Login::isLoggedIn()){
        die("Not Logged In");
        header('Location:login.php');
    }

    if(isset($_POST['logout'])){
        DB::query('DELETE FROM login_tokens WHERE user_id=:user_id', array(':user_id'=>Login::isLoggedIn()));
        header('Location:index.php');
    }
?>

<!-- Navigation Bar Section -->

    <nav class="navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="index.php"><img src="logo/slsu.png" class="img-responsive"> SOUTHERN LEYTE STATE UNIVERSITY</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><span class="glyphicon glyphicon-home" id="icons"></span>&nbsp;&nbsp;Home</a></li>
                <!-- <li><a href="account_registration.php"><span class="glyphicon glyphicon-import"></span>&nbsp;&nbsp;Account Registration</a></li> -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="glyphicon glyphicon-barcode" id="icons"></span>&nbsp;&nbsp;Registration</a>
                    <ul class="dropdown-menu">
                    <li><a href="admin_registration.php"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;&nbsp;Admin Registration</a></li>
                    <li><a href="student_registration.php"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;&nbsp;Student Registration</a></li>
                    <li><a href="teacher_registration.php"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;&nbsp;Teacher Registration</a></li> 
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="glyphicon glyphicon-globe" id="icons"></span>&nbsp;&nbsp;Evaluation</a>
                    <ul class="dropdown-menu">
                    <li><a href="questions_registration.php"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;&nbsp;Questions Registration</a></li>
                    <li><a href="evaluation_center.php"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;&nbsp;Evaluation Results Center</a></li>
                    </ul>
                </li>
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="glyphicon glyphicon-search" id="icons"></span>&nbsp;&nbsp;Search</a>
                    <ul class="dropdown-menu">
                    <li><a href="#"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;&nbsp;Evaluation Results</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;&nbsp;Students</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;&nbsp;Teachers</a></li>
                    </ul>
                </li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#accountinfo"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $fullname?></a></li>
            </ul>
            </div>
        </div>
    </nav>

    <!-- Account Information Modal -->
    <div id="accountinfo" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Account Information</h4>
            </div>
            <div class="modal-body text-center">
                <img src="logo/back3.jpg" class="img-circle" width="50" height="50">
                <p class="fullname"><?php echo $fullname;?></p>
                <p class="account">ADMIN</p>
                <form action="admin_header.php" method="post">
                    <div class="form-group">
                        <button type="submit" name="logout" class="btn btn-primary">Logout</button>
                    </div>
                </form>
            </div>  
            <div class="modal-footer">
                <div class="online"><img src="logo/online.png" width="10" height="10">&nbsp;Online</div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
    </div>