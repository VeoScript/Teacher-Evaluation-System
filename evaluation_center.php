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
    <title>Evaluation Center</title>
</head>
<body>
    <?php include 'admin_header.php';?>

    <!-- PHP Code for searching the Teachers Evaluated Information -->
    <?php
        if(isset($_POST['btnsearch'])){
            $txtsearch = $_POST['txtsearch'];

            if(!DB::query('SELECT TeacherID FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))){
                //$warning = 'No records found!';
            }
            else{
                $teacherid = DB::query('SELECT TeacherID FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))[0]['TeacherID'];
                $teachername = DB::query('SELECT Fullname FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))[0]['Fullname'];
                $department = DB::query('SELECT Department FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))[0]['Department'];
                $score = DB::query('SELECT Ratings FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))[0]['Ratings'];
                $rating = DB::query('SELECT FinalRatings FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))[0]['FinalRatings'];
            }

            if(!DB::query('SELECT Fullname FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))){
                //$warning = 'No records found!';
            }
            else{
                $teacherid = DB::query('SELECT TeacherID FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))[0]['TeacherID'];
                $teachername = DB::query('SELECT Fullname FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))[0]['Fullname'];
                $department = DB::query('SELECT Department FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))[0]['Department'];
                $score = DB::query('SELECT Ratings FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))[0]['Ratings'];
                $rating = DB::query('SELECT FinalRatings FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))[0]['FinalRatings'];
            }
        }
    ?>
    <div class="container text-center">    
        <div class="row">
            <div class="col-sm-13">
                <div class="panel panel-default text-left">
                <div class="panel-body">
                    <!-- <p contenteditable="true">Status: Feeling Blue</p>
                    <button type="button" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-thumbs-up"></span> Like
                    </button>      -->
                    <p class="text-center" id="ownTitle">EVALUATION RESULTS CENTER</p>
                </div>
                </div>
            </div>
        </div>

        <?php
                if(isset($warning)){
                    echo '
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger">
                                    <strong>Message!</strong> &nbsp;'. $warning .'
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
                <div class="col-sm-12">
                    <div class="well">
                        <form class="form-inline" action="evaluation_center.php" method="post">
                                <label for="txtsearch">Search Teacher's</label>&nbsp;
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtsearch" placeholder="Name | ID Number" value="<?php if(isset($teacherid)){echo $teacherid;}?>" required>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="submit" name="btnsearch">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div>
                        </form>
                     </div>
                </div>
            </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading" id="panel-heading-eval">TEACHER'S INFORMATION</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="lblID">ID</label>
                            <input class="form-control text-center" type="text" name="tID" id="lblID" value="<?php if(isset($teacherid)){echo $teacherid;}?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="lblname">Name</label>
                            <input class="form-control text-center" type="text" name="tname" id="lblname" value="<?php if(isset($teachername)){echo $teachername;}?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="lbldept">Department</label>
                            <input class="form-control text-center" type="text" name="tdept" id="lbldept" value="<?php if(isset($department)){echo $department;}?>" disabled>
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-sm-7">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-left">
                            <p class="text-left">Evaluation Results</p>
                        </div>
                        <div class="panel-body text-left">
                            <div class="table-responsive">
                                <table class="table table-condensed text-left">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Score</th>
                                            <th>Ratings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											    if ($_SERVER['REQUEST_METHOD'] == 'POST')
											    {
												    if (isset($_POST['btnsearch'])) { //user registering
																			
													    // Escape email to protect against SQL injections
														$txtsearch = $mysqli->escape_string($_POST['txtsearch']);

														$results = $mysqli->query("SELECT Student, Ratings, FinalRatings FROM teacher_registration WHERE TeacherID='$txtsearch' ORDER BY Ratings DESC");
															
														if ( $results->num_rows == 0 ){ // User doesn't exist
														    $message = "Sorry no records found! Try again.";
														}
														else{
														    while($user = $results->fetch_assoc()){
															    echo "
                                                                    <tr>
                                                                        <td>" . $user['Student'] . "</td>
                                                                        <td>" . $user['Ratings'] . "</td>
                                                                        <td>" . $user['FinalRatings'] . "</td>
																	</tr>";
																}
														}
													}
												}
										?>
                                        <?php
											    if ($_SERVER['REQUEST_METHOD'] == 'POST')
											    {
												    if (isset($_POST['btnsearch'])) { //user registering
																			
													    // Escape email to protect against SQL injections
														$txtsearch1 = $mysqli->escape_string($_POST['txtsearch']);

														$results2 = $mysqli->query("SELECT Student, Ratings, FinalRatings FROM teacher_registration WHERE Fullname='$txtsearch1' ORDER BY Ratings DESC");
															
														if ( $results2->num_rows == 0 ){ // User doesn't exist
														    $message = "Sorry no records found! Try again.";
														}
														else{
														    while($user = $results2->fetch_assoc()){
															    echo "
                                                                    <tr>
                                                                        <td>" . $user['Student'] . "</td>
                                                                        <td>" . $user['Ratings'] . "</td>
                                                                        <td>" . $user['FinalRatings'] . "</td>
																	</tr>";
																}
														}
													}
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
                <p class="ctxt">Register | Create a questions?</p>
                <a href="questions_registration.php" role="button">Questions Registration Center</a>
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