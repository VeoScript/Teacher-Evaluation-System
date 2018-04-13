<!DOCTYPE html>
<?php include '/classes/mysqli.php';?>
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
    <title>Questions Registration</title>
</head>

<body>
    <?php include 'admin_header.php';?>
    
    <?php
        if(isset($_POST['create'])){
            $question = $_POST['question'];
            $schoolyear = $_POST['schoolyear'];

            if(!DB::query('SELECT question FROM question_registration WHERE question=:question', array(':question'=>$question))){

                DB::query('INSERT INTO question_registration(question, SchoolYear) VALUES (:question, :SchoolYear)', array(':question'=>$question, ':SchoolYear'=>$schoolyear));
                $success = "Question Created | Registered Successfully!";
                               
            } 
            else{
                $warning = 'This Evaluating Question is already exist! Create New.';
            }
        }
    ?>

    <?php
        if(isset($_POST['delete'])){
            $tblquestion = $_POST['tblquestion'];

            DB::query('DELETE FROM question_registration WHERE question=:question', array(':question'=>$tblquestion));
            $warning = "Question | Deleted Successfully!";
        }
    ?>

    <?php
        if(isset($_POST['update'])){
            $tblquestion = $_POST['tblquestion'];
            $tblid = $_POST['tblid'];

            DB::query('UPDATE question_registration SET question=:question WHERE id=:id', array(':question'=>$tblquestion, ':id'=>$tblid));
            $success = "Question | Updated Successfully!";
        }
    ?>

    <div class="container text-center"> 

        <?php
            if(isset($warning)){
                echo '
                    <div class="row">
                        <div class="col-sm-13">
                            <div class="alert alert-warning">
                                <strong>Message!</strong> &nbsp;'. $warning .'
                            </div>
                        </div>
                    </div> 
                ';
            }

            if(isset($success)){
                echo '
                    <div class="row">
                        <div class="col-sm-13">
                            <div class="alert alert-success">
                                <strong>Success!</strong> &nbsp;'. $success .'
                            </div>
                        </div>
                    </div> 
                ';
            }
        ?>   

        <div class="row">

        <div class="col-sm-10">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default text-left">
                        <div class="panel-body">
                        <!-- <p contenteditable="true">Status: Feeling Blue</p>
                        <button type="button" class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-thumbs-up"></span> Like
                        </button>      -->
                        <p class="text-center" id="ownTitle">QUESTION REGISTRATION CENTER</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-left">
                            <p class="text-left">Register | Create Questions</p>
                        </div>
                        <div class="panel-body text-left">
                           <form class="form" action="questions_registration.php" method="post">
                               <div class="input-group">
                                   <label for="schoolyear">School Year</label>
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
                                   <br><label for="question">Question</label>
                                   <textarea class="form-control" name="question" id="question" cols="10" rows="2" placeholder="Create Evaluation Question..." required></textarea>
                               </div>
                               <div class="form-group">
                                    <button type="submit" name="create" class="btn btn-primary">Register | Create</button>
                               </div>
                           </form>
                        </div>
                    </div>

                    <div class="col-sm-13">
                        <div class="panel panel-default">
                            <div class="panel-heading text-left">
                                Registered Evaluation Questions
                                <!-- <form class="form-inline text-right" action="questions_registration" method="post">
                                    <label class="lbl" for="schoolyear">School Year</label>
                                    <div class="input-group">
                                        <select class="form-control" name="schoolyear" id="schoolyear" required>
                                            <option value=""></option>
                                            <option value="2018-2019">2018-2019</option>
                                            <option value="2019-2020">2019-2020</option>
                                            <option value="2020-2021">2020-2021</option>
                                            <option value="2021-2022">2021-2022</option>
                                            <option value="2022-2023">2022-2023</option>
                                        </select>
                                        <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" name="search_question">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                        </span>
                                    </div>
                                </form> -->
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed text-left">
                                        <thead>
                                            <tr>
                                                <th>Question ID</th>
                                                <th>Registered Question</th>
                                                <th>School Year</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $questresult = $mysqli->query("SELECT id, question, SchoolYear FROM question_registration ORDER BY SchoolYear ASC");
                                                                
                                                while($user = $questresult->fetch_assoc()){
                                                    echo "
                                                    <tr>
                                                        <form class='form-inline' action='questions_registration' method='post'>
                                                            <td>
                                                                <input type='text' name='tblid' id='tblid' class='form-control' value=". $user['id'] ." readonly>
                                                            </td>
                                                            <td>
                                                                <textarea class='form-control' name='tblquestion' id='question' cols='10' rows='1' required>". $user['question'] ."</textarea>
                                                            </td>
                                                            <td>
                                                                <select class='form-control' name='tblschoolyear' id='schoolyear'>
                                                                    <option value=". $user['SchoolYear'] .">". $user['SchoolYear'] ."</option>
                                                                    <option value='2018-2019'>2018-2019</option>
                                                                    <option value='2019-2020'>2019-2020</option>
                                                                    <option value='2020-2021'>2020-2021</option>
                                                                    <option value='2021-2022'>2021-2022</option>
                                                                    <option value='2022-2023'>2022-2023</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type='submit' name='update' value='UPDATE' class='btn btn-success'>
                                                                <input type='submit' name='delete' value='DELETE' class='btn btn-danger'>
                                                            </td>
                                                        </form>
                                                    </tr>";
                                                }
                                            ?>
                                            
                                            <?php
                                                // if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                                //     {
                                                //         if (isset($_POST['search_question'])) { //user registering
                                                                                
                                                //             // Escape email to protect against SQL injections
                                                //             $schoolyear = $mysqli->escape_string($_POST['schoolyear']);

                                                //             $question = $mysqli->query("SELECT question, SchoolYear FROM `question_registration` WHERE Schoolyear='$schoolyear' ORDER BY Schoolyear ASC");
                                                                
                                                //             if ( $question->num_rows == 0 ){ // User doesn't exist
                                                //                 $message = "Sorry no records found! Try again.";
                                                //             }
                                                //             else{
                                                //                 while($user = $question->fetch_assoc()){
                                                //                     echo "
                                                //                         <tr>
                                                //                             <form class='form-inline' action='questions_registration'>
                                                //                                 <td>
                                                //                                     <input type='text' name='quest' value=". $user['question'] ." class='btn btn-warning'>
                                                //                                 </td>
                                                //                                 <td>
                                                //                                     <input type='text' name='quest' value=". $user['SchoolYear'] ." class='btn btn-warning'>
                                                //                                 </td>
                                                //                                 <td>
                                                //                                     <input type='submit' name='delete' value='DELETE' class='btn btn-warning'>
                                                //                                 </td>
                                                //                             </form>
                                                //                         </tr>";
                                                //                     }
                                                //             }
                                                //         }
                                                //     }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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