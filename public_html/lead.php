<?php
    
    /********************************************************
    * lead.php                                              *
    * Rendering Leaderboard                                 *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
    
    // Configuration
    require("../includes/config.php");
    
    render("lead_table.php", ["title" => "Leaderboard"]);     
?>
