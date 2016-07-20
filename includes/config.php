<?php
    
    /********************************************************
    * config.php                                            *
    * Configures Pages                                      *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
    
    ini_set("display_errors", false);
    error_reporting(0);
    
    // Requiring Constants
    require("/constants.php");
  
    // Requiring phpMailer for Sending Mails
    require("../phpmailer/PHPMailerAutoload.php");

    //Requiring the functions
    require("/functions.php");

    // Enables the Session
    session_start();
    
    // Not allowing the user to access any pages except the one mentioned
    if (!in_array($_SERVER["PHP_SELF"], ["/login.php", "/logout.php", "/register.php",
         "/index.php", "/level.php", "/instruction.php", "/resend.php", 
         "/submission.php", "/lead.php", "/activate.php"]))
    {
        redirect("index.php");
    }
    
    // Not allowing anyone to access the pages mentioned when not logged in
    if(!isset($_SESSION["id"]))
    {
        if(in_array($_SERVER["PHP_SELF"], ["/level.php", "/submission.php", "/seriouslydude.php",
        "/download.php"]))
        {
            redirect("index.php");
        }      
    }
?>