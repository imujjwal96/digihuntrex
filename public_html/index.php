<?php

    /********************************************************
    * index.php                                             *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
    
    // configuration
    require("../includes/config.php"); 
    if(isset($_SESSION["id"]))
    {
        
        	redirect("level.php");
    }
    else
    {
        redirect("login.php");
    }

?>
