<?php

    /********************************************************
    * resend.php                                            *
    * Resending Activation Email                            *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
    
    // Configuration
    require("../includes/config.php"); 
   
    // If the user reached the page via GET
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
	redirect("/index.php");        
	return false;
    }
    // Else if the user reached the page via POST
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        activation($_POST["email"], $_POST["name"]);
        render("mail.php", ["title" => "Verify"]);
    }
?>
