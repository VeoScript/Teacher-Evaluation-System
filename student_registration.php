<?php include_once 'developer_sign.php';?>
<!DOCTYPE html>
<html lang="en">
<?php include 'classes/mysqli.php';?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="bootstrap-3.3.7/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="logo/slsu.png" type="image/x-icon">
    <title>Student Registration</title>
</head>

<body>
    <?php include 'admin_header.php';?>
    
    <?php
        if(isset($_POST['register'])){
            
            $idnumber = $_POST['idnumber'];
            $fullname = $_POST['fullname'];
            $gender = $_POST['gender'];
            $course = $_POST['course'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];

            if(!DB::query('SELECT IdNumber FROM student_account WHERE IdNumber=:IdNumber', array(':IdNumber'=>$idnumber))){

                if($password === $repassword){

                    DB::query('INSERT INTO student_account VALUES (:IdNumber, :Fullname, :Gender, :Course, :Password)', array(':IdNumber'=>$idnumber, ':Fullname'=>$fullname, ':Gender'=>$gender, ':Course'=>$course, ':Password'=>password_hash($password, PASSWORD_BCRYPT)));
                    $success = "Student Registered Successfully!";
                }
                else{
                    $warning = 'Your password did not match! Try again.';
                }
            } 
            else{
                $warning = 'Student is already registered!';
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
                    <p class="text-center" id="ownTitle">STUDENT REGISTRATION</p>
                    </div>
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-sm-3 well">
                 <p class="txt">ADD STUDENT ACCOUNT</p>
                    <!-- <img src="logo/back3.jpg" class="img-circle" height="100" width="100" alt="Profile Picture"> -->
                    <form action="student_registration.php" method="post">
                        <div class="form-group">
                            <label for="idnumber" id="lbltop" class="form">ID Number</label>
                            <input type="text" name="idnumber" id="idnumber" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname" class="form">Fullname</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="form">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course" class="form">Course</label>
                            <select name="course" id="course" class="form-control" required>
                                <option value=""></option>
                                <option value="BS InfoTech">BS InfoTech</option>
                                <option value="BS HRTM">BS HRTM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="repassword" class="form">Re-Enter Password</label>
                            <input type="password" name="repassword" id="repassword" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="register" class="btn btn-primary">Register</button>
                        </div>
                    </form>
            </div>

        <div class="col-sm-7">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-left">Registered Students List</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table text-left">
                                    <thead>
                                        <tr>
                                            <th>ID Number</th>
                                            <th>Student Name</th>
                                            <th>Gender</th>
                                            <th>Course</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$studentresult = $mysqli->query("SELECT IdNumber, Fullname, Gender, Course FROM student_account ORDER BY Fullname ASC");
															
                                            while($user = $studentresult->fetch_assoc()){
                                                echo "
                                                    <tr>
                                                        <td>" . $user['IdNumber'] . "</td>
                                                        <td>" . $user['Fullname'] . "</td>
                                                        <td>" . $user['Gender'] . "</td>
                                                        <td>" . $user['Course'] . "</td>
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