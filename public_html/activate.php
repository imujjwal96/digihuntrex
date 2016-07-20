<?php

    /********************************************************
    * activate.php                                          *
    * Verifying a User                                      *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
    
    // Configuration
    require("../includes/config.php"); 
    
    // If the user reached the page via GET
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_GET['k']))
        {
	    	$hash = htmlspecialchars($_GET['k']);
			$query_acti = query("UPDATE `info` SET verified = 1 WHERE email_hash = ?", $hash);
			render("activated.php", ["title" => "Activation Completed"]);
		}
    }
	else
	{
		redirect("/index.php");
	}
?>
