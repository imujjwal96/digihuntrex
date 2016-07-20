<?php
    
    /********************************************************
    * login.php                                             *
    * Logging in a User                                     *
    * Rendering Login Page                                  *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
        
    // Configuration
    require("../includes/config.php"); 
    
    // Checking if the user opens it via URL 
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(!isset($_SESSION["id"]))
        {
        	$err = "";
        	render("login_form.php", ["title" => "Login"]);
        }
        else
        {
        	redirect("/index.php");
        }
    }
    else
    {
        // The values Received via POST given local scope with variables
        $uname = htmlspecialchars($_POST["username"]);
        $pass = htmlspecialchars($_POST["pass"]);
        // Checks if the form is completely filled or not
        if(!empty($uname) && !empty($pass))
        {
            $pass_hash = md5($pass);
            $result = query("SELECT * FROM info WHERE username = ? AND pass = ?", $uname, $pass_hash);
            // When no row is returned
            if(count($result) == 0)
            {
                $err = "Invalid Username or Password ";
                render("login_form.php", ["err" => $err, "title" => "Login"]);
            }
            else
            {
                if($result[0]["verified"] == 0)
                {
                    $email = $result[0]["email"];
                    $name = $result[0]["name"];
                    render("activate.php", ["name" => $name, "email" => $email, 
                                            "title" => "Activation Required"]);
                }
                else
                {
                    $_SESSION["id"] = $result[0]["id"];
                    redirect("index.php");
                }
            }
        }
        else
        {
            $err = "Enter Credentials";
            render("login_form.php", ["err" => $err, "title" => "Login"]);
        }   
    }

