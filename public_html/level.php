<?php

    /********************************************************
    * register.php                                          *
    * Opening the Current Level                             *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
    
    // Configuration
    require("../includes/config.php");
    
    // If the user is Logged in
    if(isset($_SESSION["id"]))
    {
	    $ik = htmlspecialchars($_SESSION["id"]);        
	    $result = query("SELECT `level` FROM `info` WHERE id = ?", $ik); 
        $level = $result[0]["level"];
        
        // If a user is banned from participating
        if($level == -1)
        {
            render("failure.php", ["title" => "Banned"]); 
            return false;       
        }
        else
        {
            $_SESSION["level"] = $level; 
            render("/lvl.php", ["level" => $level, "title" => "Level $level"]);           
        }
    }
    else 
    {
        redirect("/login.php");    
    }
?>
