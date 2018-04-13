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
    <title>Evaluation Process</title>

    <script>
        $(document).ready(function(e){
            $("select").change(function(){
                var toplan = 0;
                $("select[name=rate]").each(function(){
                    toplan = toplan + parseInt($(this).val());
                });
                $("input[name=ratings]").val(toplan);
            });
        });
    </script>
    
    <script>
        function generate(){
            var cors = document.getElementById("ratings").value;
            var fincors = document.getElementById("final_ratings").value;
            
            if(cors <= 5){
                document.getElementById("final_ratings").value = "POOR";
            }
            else if(cors > 5 && cors <= 10){
                document.getElementById("final_ratings").value = "FAIR";
            }
            else if(cors > 10 && cors <= 15){
                document.getElementById("final_ratings").value = "GOOD";
            }
            else if(cors > 15 && cors <= 20){
                document.getElementById("final_ratings").value = "VERY GOOD";
            }
            else{
                document.getElementById("final_ratings").value = "EXCELLENT";
            }
        }
    </script>
</head>
<body>
    <?php include 'student_header.php';?>

            <!-- PHP Code for searching the teacher -->
            <?php
                if(isset($_POST['search_question'])){
                    $txtsearch = $_POST['txtsearch'];

                    if(!DB::query('SELECT TeacherID FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))){
                        //$warning = 'No records found!';
                    }
                    else{

                        $id = DB::query('SELECT TeacherID FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))[0]['TeacherID'];
                        $fullname = DB::query('SELECT Fullname FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))[0]['Fullname'];
                        $department = DB::query('SELECT Department FROM teacher_registration WHERE TeacherID=:TeacherID', array(':TeacherID'=>$txtsearch))[0]['Department'];                    
                    }  

                    if(!DB::query('SELECT Fullname FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))){
                        //$warning = 'No records found!';
                    }
                    else{

                        $id = DB::query('SELECT TeacherID FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))[0]['TeacherID'];
                        $fullname = DB::query('SELECT Fullname FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))[0]['Fullname'];
                        $department = DB::query('SELECT Department FROM teacher_registration WHERE Fullname=:Fullname', array(':Fullname'=>$txtsearch))[0]['Department'];                    
                    }  
                }
            ?>

            <!-- PHP Code for saving the Evaluation Form -->
            <?php
                if(isset($_POST['save'])){
                    $ratings = $_POST['ratings'];
                    $final_ratings = $_POST['final_ratings'];
                    $teacherid = $_POST['teacherid'];
                    $student = $_POST['student'];

                    // DB::query('UPDATE teacher_registration SET Ratings=:Ratings, FinalRatings=:FinalRatings WHERE TeacherID=:TeacherID', array(':Ratings'=>$ratings, ':FinalRatings'=>$final_ratings, ':TeacherID'=>$teacherid));
                    // $success = "Evaluation Successfully Saved!";

                    if(strlen($final_ratings) >= 1){
                       if(strlen($ratings) >= 1){
                            DB::query('INSERT INTO teacher_registration(TeacherID, Student, Ratings, FinalRatings) VALUES(:TeacherID, :Student, :Ratings, :FinalRatings)', array(':TeacherID'=>$teacherid, ':Student'=>$student, ':Ratings'=>$ratings, ':FinalRatings'=>$final_ratings));
                            $success = "Evaluation Successfully Saved!";
                       }
                       else{
                           $warning = "Empty Ratings!";
                       }
                    }
                    else{
                        $warning = "Click Generate button first!";
                    }
                }
            ?>
        <div class="container text-center"> 
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
                        <form class="form-inline" action="student_form.php" method="post">
                            <label for="txtsearch">Search Teacher's</label>&nbsp;
                            <div class="form-group">
                                <input type="text" class="form-control" name="txtsearch" placeholder="Name | ID Number" value='<?php if(isset($id)){echo $id;}?>' required>
                                <!-- <span class="input-group-btn">
                                  <button class="btn btn-default" type="submit" name="search">
                                    <span class="glyphicon glyphicon-search"></span>
                                  </button>
                                </span> -->
                            </div>

                            <label for="schoolyear">Questions SY</label>&nbsp;
                            <div class="form-group">
                                <select class="form-control" name="schoolyear" id="schoolyear" required>
                                    <option value=""></option>
                                    <option value="2018-2019">2018-2019</option>
                                    <option value="2019-2020">2019-2020</option>
                                    <option value="2020-2021">2020-2021</option>
                                    <option value="2021-2022">2021-2022</option>
                                    <option value="2022-2023">2022-2023</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default" type="submit" name="search_question">
                                    <span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Search
                                </button>                                
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
                        ?>
                        <div class="form-group">
                            <label for="lblID">ID</label>
                            <input class="form-control text-center" type="text" name="tID" id="lblID" value="<?php if(isset($id)){echo $id;}?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="lblname">Name</label>
                            <input class="form-control text-center" type="text" name="tname" id="lblname" value="<?php if(isset($fullname)){echo $fullname;}?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="lbldept">Department</label>
                            <input class="form-control text-center" type="text" name="tdept" id="lbldept" value="<?php if(isset($department)){echo $department;}?>" disabled>
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default text-left">
                        <div class="panel-body">
                        <!-- <p contenteditable="true">Status: Feeling Blue</p>
                        <button type="button" class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-thumbs-up"></span> Like
                        </button>      -->
                        <p class="text-center" id="ownTitle">EVALUATION PROCESS</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-left">
                            Questions Lists
                            <p class="text-right ins">Rate 1-5 only</p>
                        </div>
                        <div class="panel-body text-left">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Questions</th>
                                            <th>Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											// $quest = $mysqli->query("SELECT question FROM question_registration ORDER BY question ASC");
															
                                            // while($user = $quest->fetch_assoc()){
                                            //     echo "
                                            //         <tr>
                                            //             <td>" . $user['question'] . "</td>
                                            //             <td> 
                                            //                 <input type='text' id='txtrating' value='0' class='form-control' name='rate' placeholder='Rate 1-5'>
                                            //             </td>
                                            //         </tr>
                                            //     ";
                                            // }
									    ?>

                                        <?php
											if ($_SERVER['REQUEST_METHOD'] == 'POST')
											    {
												    if (isset($_POST['search_question'])) { //user registering
																			
													    // Escape email to protect against SQL injections
														$schoolyear = $mysqli->escape_string($_POST['schoolyear']);

														$question = $mysqli->query("SELECT question FROM `question_registration` WHERE Schoolyear='$schoolyear' ORDER BY question ASC");
															
														if ( $question->num_rows == 0 ){ // User doesn't exist
														    $message = "Sorry no records found! Try again.";
														}
														else{
														    while($user = $question->fetch_assoc()){
															    echo "
                                                                    <tr>
                                                                        <td>" . $user['question'] . "</td>
                                                                        <td>
                                                                            <select class='form-control' id='txtrating' name='rate'>
                                                                                <option value='0'>0</option>
                                                                                <option value='1'>1</option>
                                                                                <option value='2'>2</option>
                                                                                <option value='3'>3</option>
                                                                                <option value='4'>4</option>
                                                                                <option value='5'>5</option>
                                                                            </select>
                                                                        </td>
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
                        <div class="panel-footer text-left">
                        
                            <div class="form-group text-center">
                                <button class="btn btn-info" type="button" id="generate" onclick="generate()">Generate</button>
                            </div>
                            
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">Summary</div>
                                <div class="panel-body">
                                    <form class="form-inline text-center" action="student_form.php" method="post">
                                        <div class="form-group">
                                            <select class="form-control" name="student" id="student" required>
                                                <option value="<?php if(isset($student_fullname)){echo $student_fullname;}?>"><?php if(isset($student_fullname)){echo $student_fullname;}?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="teacherid" id="teacherid" required>
                                                <option value="<?php if(isset($id)){echo $id;}?>"><?php if(isset($id)){echo $id;}?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="ratings" class="form-control text-center" name="ratings" placeholder="Ratings..." readonly>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="final_ratings" class="form-control text-center" name="final_ratings" placeholder="Final Ratings..." readonly>
                                        </div>
                                        <button type="submit" name="save" id="save" class="btn btn-primary">SAVE</button>
                                        <!-- <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-primary">SAVE</button>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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