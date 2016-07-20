<?php
    
   /*********************************************************
    * logout.php                                            *
    * Logging out a User                                    *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
    
    // Configuration
    require("../includes/config.php");
    
    // unset any session variables
    $_SESSION = [];

    // expire cookie
    if (!empty($_COOKIE[session_name()]))
    {
        setcookie(session_name(), "", time() - 42000);
    }

    // destroy session
    session_destroy();
    
    // Go back to homepage
    redirect("/index.php");
?>
