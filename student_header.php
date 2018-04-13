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
        $student_fullname = Login::isLoggedIn();
    }
    else{
        header('Location:login.php');
    }
?>

<!-- PHP Code for Logout -->
<?php
    if(!Login::isLoggedIn()){
        die("Not Logged In");
    }

    if(isset($_POST['logout'])){
        DB::query('DELETE FROM login_tokens WHERE user_id=:user_id', array(':user_id'=>Login::isLoggedIn()));
        header('Location:index.php');
    }
?>

<!-- Navigation Bar Section -->

    <div class="container" id="container-student">
        <div class="panel panel-default">
            <div class="panel-body" id="panel-body-intro">
                <img id="logo" src="logo/slsu.png" width="100">
            </div>
            <div class="panel-body" id="panel-body-intro">
                <p class="text">Teacher Evaluation System</p>
                <p class="text2">The way to enhance a good teaching career.</p>
                <p class="text3">Designed & Developed by | V E O S C R I P T</p>
            </div>
            <div class="panel-footer text-right">
                <a href="#" class="btn btn-default" data-toggle="modal" data-target="#accountinfo"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $student_fullname?></a>
            </div>
        </div>
    </div>

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
                <p class="fullname"><?php echo $student_fullname;?></p>
                <p class="account">STUDENT</p>
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