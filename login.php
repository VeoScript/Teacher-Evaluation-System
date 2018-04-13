<!DOCTYPE html>
<html lang="en">
<?php include 'classes/db.php';?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="bootstrap-3.3.7/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="logo/slsu.png" type="image/x-icon">
    <title>Teacher Evalutaion System / Login</title>
</head>

<!-- Login for ADMIN -->
<?php
     if(isset($_POST['admin'])){

        $admin_username = $_POST['admin_username'];
        $admin_password = $_POST['admin_password'];

        if(DB::query('SELECT Username FROM account WHERE Username=:Username', array(':Username'=>$admin_username))){

            if(password_verify($admin_password, DB::query('SELECT Password FROM account WHERE Username=:Username', array(':Username'=>$admin_username))[0]['Password'])){

                $cstrong = TRUE;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                $user_id = DB::query('SELECT Fullname FROM account WHERE Username=:Username', array(':Username'=>$admin_username))[0]['Fullname'];
                
                DB::query('INSERT INTO login_tokens VALUES (:token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
 
                setcookie("EVALUATION", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                setcookie("EVALUATION_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

                header('Location:index.php');
            }
            else{
                $admin = 'Your password is incorrect!';
            }

        }
        else{
            $admin =  "Admin account doesn't exist!";
        }

     }
?>

<!-- Login for STUDENT -->
<?php
     if(isset($_POST['student'])){

        $student_username = $_POST['student_username'];
        $student_password = $_POST['student_password'];

        if(DB::query('SELECT IdNumber FROM student_account WHERE IdNumber=:IdNumber', array(':IdNumber'=>$student_username))){

            if(password_verify($student_password, DB::query('SELECT Password FROM student_account WHERE IdNumber=:IdNumber', array(':IdNumber'=>$student_username))[0]['Password'])){

                $cstrong = TRUE;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                $user_id = DB::query('SELECT Fullname FROM student_account WHERE IdNumber=:IdNumber', array(':IdNumber'=>$student_username))[0]['Fullname'];
                
                DB::query('INSERT INTO login_tokens VALUES (:token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
 
                setcookie("EVALUATION", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                setcookie("EVALUATION_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

                header('Location:student_form.php');
            }
            else{
                $student = 'Your password is incorrect!';
            }

        }
        else{
            $student =  "Student account doesn't exist!";
        }

     }
?>

<body>
    <!-- Intro Section -->
    <div class="container" id="container-login">
        <div class="panel panel-default">
            <div class="panel-body" id="panel-body-intro">
                <img id="logo" src="logo/slsu.png" width="100">
            </div>
            <div class="panel-body" id="panel-body-intro">
                <p class="text">Teacher Evaluation System</p>
                <p class="text2">The way to enhance a good teaching career.</p>
                <p class="text3">Designed & Developed by | V E O S C R I P T</p>
            </div>
        </div>
    </div>
    <div class="container" id="container-login-box">
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading admin">Login | ADMIN</div>
                    <div class="panel-body">

                        <?php
                            if(isset($admin)){
                                echo '
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-warning">
                                                <strong>Warning!</strong> &nbsp;'. $admin .'
                                            </div>
                                        </div>
                                    </div> 
                                ';
                            }
                        ?> 

                        <form class="form-horizontal" role="form" action="login.php" method="post">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control" name="admin_username" id="focusedInput" type="text" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control" name="admin_password" id="focusedInput" type="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary" name="admin" value="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading student">Login | STUDENT</div>
                    <div class="panel-body">
                        <?php
                            if(isset($student)){
                                echo '
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-warning">
                                                <strong>Warning!</strong> &nbsp;'. $student .'
                                            </div>
                                        </div>
                                    </div> 
                                ';
                            }
                        ?> 
                        <form class="form-horizontal" role="form" action="login.php" method="post">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control" name="student_username"  id="focusedInput" type="text" placeholder="ID Number" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control"  name="student_password" type="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" name="student" value="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

            <footer class="container-fluid text-center navbar-fixed-top">
                <p class="web_title">TEACHER EVALUATION SYSTEM 2018</p>
                <p>Designed and Developed by VEOSCRIPT | Villaruel Jerome</p>
                <p class="sub">Final Project in DATABASE MANGEMENT SYSTEM 2 (PHP)</p>
                <p class="sub2">MEMBERS</p>
                <p class="grp">Jerome R. Villaruel | Joseftt Beronio | Jayson A. Mendez | Stephanie Alba</p>
            </footer>
</body>
</html>