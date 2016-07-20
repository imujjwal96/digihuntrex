<!DOCTYPE HTML>
<html>
    <head>
        <title><?= htmlspecialchars($title); ?> - Quiz</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1, maximum-scale = 1">
        <meta name="Description" content="" />
        <meta name="Keywords" content="" />
        <meta name="Author" content="" />
        
        <!--    Facebook Open Graph Tags    -->
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:site_name" content="" />
        <meta property="og:description" content="" />
        <meta property="og:image" content="" />
        
        <link href="Content/bootstrap.min.css" rel="stylesheet" />
        <link href="Content/main.css" rel="stylesheet" />
        <link href="Content/styles.css" rel="stylesheet" />
        <link rel="shortcut icon" href="img/favicon.png" />
    </head>
    <body>
        <!-- Header of the Page-->
        <nav class="navbar navbar-default" role="navigation" style = "background-color:#020003">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <img class = "img-responsive" width = "175em" src = "img/banner.png" alt = "Huntrex" />
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php
                            $page = $_SERVER["PHP_SELF"];
                            if(strcmp($page, "/instruction.php") == 0)
                            {
                                echo '<li class = "active"><a href = "instruction.php">Instructions</a></li>';
                            }
                            else
                            {
                                echo '<li><a href = "instruction.php">Instructions</a></li>';                            
                            }
                            if(isset($_SESSION["id"]))
                            {
                                if(strcmp($page, "/level.php") == 0)
                                {
                                    echo '<li class = "active"><a href = "level.php">Level</a></li>';
                                }
                                else
                                {
                                    echo '<li><a href = "level.php">Level</a></li>';                            
                                }
                            }
                            if(strcmp($page, "/level.php") == 0)
                            {
                                echo '<li class = "active"><a href = "lead.php">Leaderboard</a></li>';
                            }
                            else
                            {
                                echo '<li><a href = "lead.php">Leaderboard</a></li>';                            
                            }                                        
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <?php
                            if(isset($_SESSION["id"]))
                            {
                                echo '<a href = "logout.php">Log Out</a>';   
                            }
                            else
                            {
                                echo '<a href = "login.php">Log In</a></li>';
                                echo '<li><a href = "register.php">Register</a>';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main Body -->
        <div class = "container">
            <div class = "jumbotron" style = "background-color: #f2f2f2; box-shadow: 0px 4px 2px rgba(0,0,0,0.5); text-align:center;">