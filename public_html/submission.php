<?php

    /********************************************************
    * submission.php                                        *
    * Answer Submission Check                               *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
    
    // Configuration
    require("../includes/config.php");
    
    $m = $_SESSION["id"];
    $levels = query("SELECT * FROM info where id = ?", $m);
    $level = $levels[0]["level"];
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        redirect("/index.php");
    }
    else
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_SESSION["id"]))
        {
            $id = htmlspecialchars($_SESSION["id"]);
            if($level <= -1)
            {
                render("failure.php", ["title" => "Hacked"]);
                return false;
            }
            else
            {
                // Loading the levels.xml file
                $xml=simplexml_load_file("../includes/levels.xml");
                
                foreach($xml->xpath("/levels/level[@id='$level']") as $level)
                {
                    $answer =  $level->answer;
                }
                // Hashing the answer to be checked with value in levels.xml
                $input = sha1(htmlspecialchars($_POST["input"]));
                
                // Checking answers
                if(@strcasecmp($input, $answer) == 0)
                {
                    $success = sprintf("UPDATE `info` SET level = level + 1 WHERE id = $id");
                    $result = query($success);
                    $time = sprintf("UPDATE `info` SET datetime = NOW()  WHERE id = $id");
                    $res_time = query($time);
                    redirect("/level.php");
                }
                else
                {
                    error();
                }
            }
        }
        else
        {
            redirect("/index.php");
        }
    }
?>