<?php
    
    /********************************************************
    * register.php                                          *
    * Registering User                                      *
    * Rendering Register Page                               *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
    
    // Configuration
    require("../includes/config.php"); 
   
    // If the user reached the page via GET
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $err = "";
        render("register_form.php", ["title" => "Register"]);
    }
    // Else if the user reached the page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // The values Received via POST given local scope with variables
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $uname = htmlspecialchars($_POST["username"]);
        $pass = htmlspecialchars($_POST["pass"]);
        $pass2 = htmlspecialchars($_POST["pass2"]);
     
        // Checks if the form is completely filled or not
        if(!empty($name) && !empty($email) && !empty($uname) && !empty($pass) && !empty($pass2))
        {
            // Checks if the name is valid
            if(!preg_match("/^[a-zA-Z ]*$/",$name))
            {
                $err = "Name should contain only letters and whitespaces";
                render("register_form.php", ["err" => $err, "title" => "Register"]);
            }
            else
            // Checks if a valid email id is inputted
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $err = "Invalid email format";
                render("register_form.php", ["err" => $err, "title" => "Register"]);
            }
            else
            // Limiting username to a specific input limit
            if (!preg_match("/[A-Za-z0-9_~\-!@#\$%\^&\*\(\)]+$/",$uname))
            {
                $err = "Invalid Username Input";
                echo $uname;
                render("register_form.php", ["err" => $err, "title" => "Register"]);
            }
            else
            {
                // Checks if the username inputted doesn't already exist in the table
                $result=query("SELECT * FROM info WHERE username = ?", $uname);
     
                if(count($result) != 0)
                {
                    $err = "Username already taken";
                    render("register_form.php", ["err" => $err, "title" => "Register"]);
                }
                else
                {
                    // Checks if the email-id inputted doesn't already exist in the table                 
                    $result2=query("SELECT * FROM info WHERE email = ?", $email);
                    if(count($result2) != 0)
                    {
                        $err = "Email-id already registered";
                        render("register_form.php", ["err" => $err, "title" => "Register"]);
                    }
                    else
                    {
                        // Checks if the two passwords inputted are same
                        if(strcmp($pass,$pass2)!=0)
                        {
                            echo "The Password Doesn't Match!!!";
                        }
                        else
                        {
                            // Encrypting the password & email-id
                            $pass_hash = md5($pass);
                            $mail_hash = md5(sha1(md5(sha1($email))));
                            // Registering the User
                           
                            $query_ins = query("INSERT INTO `info` (id, name, email, email_hash, username, pass, level, verified) VALUES
                            (NULL, ?, ?, ?, ?, ?, 0, 0)", $name, $email, $mail_hash, $uname, $pass_hash);
                                // Register the user
                                activation($email, $name);
                                render("mail.php", ["title" => "Verify"]);
                           
                        } 
                    }
                }
            }
        }
        else
        {
            $err = "Please Fill Up the Form Completely";
            render("register_form.php", ["err" => $err, "title" => "Register"]);
        }    
    }
?>