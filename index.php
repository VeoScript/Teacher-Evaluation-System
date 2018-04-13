<!DOCTYPE html>
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
    <title>Teacher Evaluation System</title>
</head>
<body>
    <?php include 'admin_header.php';?>
    <!-- Intro Section -->
    <div class="container" id="container-index">
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
    <!-- Table Ranks Section -->
    <div class="container" id="carousel-container">
        <div class="panel panel-default">
            <div class="panel-heading">The Developers</div>
            <div class="panel-body" id="panel-body-table">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                        <img src="photos/jerome.jpg" alt="Jerome">
                        <div class="carousel-caption">
                            <h3>Jerome Joseph R. Villaruel</h3>
                            <p>Back-End Developer</p>
                        </div>
                        </div>

                        <div class="item">
                        <img src="photos/mendez.jpg" alt="Mendez">
                        <div class="carousel-caption">
                            <h3>Jayson A. Mendez</h3>
                            <p>Font-End Developer</p>
                        </div>
                        </div>

                        <div class="item">
                        <img src="photos/alba.jpg" alt="ALba">
                        <div class="carousel-caption">
                            <h3>Stephanie N. Alba</h3>
                            <p>Researcher</p>
                        </div>
                        </div>

                        <div class="item">
                        <img src="photos/beronio.jpg" alt="Beronio">
                        <div class="carousel-caption">
                            <h3>Joseftt Beronio</h3>
                            <p>Front-End Developer</p>
                        </div>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
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