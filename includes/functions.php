<?php

    /********************************************************
    * functions.php                                         *
    * Contains all the functions required                   *
    *                                                       *
    * Author :- Ujjwal Bhardwaj                             *
    ********************************************************/
 
    /****************************************************
    * Redirects user to a location                      *
    * which can be a URL or a relative path to a page   *
    * in the Website's directory                        *
    ****************************************************/
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /*******************************************************
    * Executes SQL statement                               *
    * taking the statement as an argument                  *
    * If it is a SELECT command, Fetch the output an store *
    * it in an associative array, else redirects           *
    *******************************************************/
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }
    
    /************************************************************
    * Renders a template if it exists, by including the header, *
    * footer and the template                                   *
    ************************************************************/
    function render($template, $values = [])
    {
        // Checking the file of the template exists
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // Include the header
            require("../templates/header.php");

            // Include the template
            require("../templates/$template");

            // Includet the footer
            require("../templates/footer.php");
        }

        // else show an error (temp)
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

    /********************************************
     * Renders an error to user with message.   *
     *******************************************/
    function error()
    {
        render("error.php", ["title" => "Error"]);
        exit;
    }

    /********************************************
     * Sends a verification mail to the user    *
     *******************************************/
    function activation($to, $name)
    {
        $hash = md5(sha1(md5(sha1($to))));
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = SMTP_NAME;                 // SMTP username
        $mail->Password = SMTP_PSWD;                           // SMTP password
        $mail->Port = SMTP_PORT;                                    // TCP port to connect to
        $mail->setFrom(/*'mail-id'*/, /*'Name'*/);
        $mail->addAddress($to, $name);     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = '';
        $mail->Body = "<html>
                        <body>
                            <p>Please click on the link below to verify:</p>
                            <p><a href = \"http://www.yourdomain.com/activate.php?k=$hash\">Verify</a></p>
                        </body>
                    </html>";
        $mail->AltBody = "Click on the link to verify. http://www.yourdomain.com/activate.php?k=$hash";
        $mail->send();
    }
?>
