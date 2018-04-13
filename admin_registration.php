<!DOCTYPE html>
<?php include 'classes/mysqli.php';?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="bootstrap-3.3.7/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="logo/slsu.png" type="image/x-icon">
    <title>Admin Registration</title>
</head>

<body>
    <?php include 'admin_header.php';?>

    <?php
        if(isset($_POST['register'])){
            
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];

            if(!DB::query('SELECT Fullname FROM account WHERE Fullname=:Fullname', array(':Fullname'=>$fullname))){

                if($password === $repassword){

                    DB::query('INSERT INTO account VALUES (:Fullname, :Username, :Password)', array(':Fullname'=>$fullname, ':Username'=>$username, ':Password'=>password_hash($password, PASSWORD_BCRYPT)));
                    $success = "Registered Successfully!";
                }
                else{
                    $warning = 'Your password did not match! Try again.';
                }
            } 
            else{
                $warning = 'Account is already registered!';
            }
        }
    ?>
    
    <div class="container text-center">  
        <?php
            if(isset($warning)){
                echo '
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-warning">
                                <strong>Warning!</strong> &nbsp;'. $warning .'
                            </div>
                        </div>
                    </div> 
                ';
            }

            if(isset($success)){
                echo '
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <strong>Success!</strong> &nbsp;'. $success .'
                            </div>
                        </div>
                    </div> 
                ';
            }
        ?> 
        <div class="row">
                <div class="col-sm-14">
                    <div class="panel panel-default text-left">
                        <div class="panel-body">
                        <!-- <p contenteditable="true">Status: Feeling Blue</p>
                        <button type="button" class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-thumbs-up"></span> Like
                        </button>      -->
                        <p class="text-center" id="ownTitle">ADMIN REGISTRATION</p>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-sm-3 well">
                <p class="txt">ADD ADMIN ACCOUNT</p>

                <form class="form" action="admin_registration.php" method="post">
                    <div class="form-group">
                        <label for="fullname" id="lbltop">Fullname</label>
                        <input class="form-control" type="text" name="fullname" id="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="repassword">Re-type Password</label>
                        <input class="form-control" type="password" name="repassword" id="repassword" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="register">Register</button>
                    </div>
                </form>
            </div>

        <div class="col-sm-7">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-left">Registered Admin Accounts List</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table text-left">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$adminresult = $mysqli->query("SELECT Fullname, Username FROM account ORDER BY Fullname ASC");
															
                                            while($user = $adminresult->fetch_assoc()){
                                                echo "
                                                    <tr>
                                                        <td>" . $user['Fullname'] . "</td>
                                                        <td>" . $user['Username'] . "</td>
                                                    </tr>
                                                ";
                                            }
									    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </div>

        <div class="col-sm-2 well">
            <div class="thumbnail">
                <p><strong>Teacher Evaluation System</strong></p>
                <p class="ctxt">See evaluated results?</p>
                <a href="evaluation_center.php" role="button">Evaluation Results Center</a>
            </div>      
            <div class="well">
                <p class="dtxt">Southern Leyte State University</p>
                <img src="logo/slsu.png" alt="slsu" width="50">
            </div>
            <div class="well">
                <p class="dtxt">Designed and Developed by</p>
                <img src="logo/veoofficial.png" alt="Veoscript" width="100">
            </div>
            </div>
        </div>
    </div>

    <footer class="container-fluid text-center">
        <p>Designed and Developed by VEOSCRIPT | Villaruel Jerome</p>
        <p class="sub">Final Project in DATABASE MANGEMENT SYSTEM 2 (PHP)</p>
        <p class="sub2">MEMBERS</p>
        <p class="grp">Jerome R. Villaruel | Joseftt Beronio | Jayson A. Mendez | Stephanie Alba</p>
    </footer>
</body>
</html>