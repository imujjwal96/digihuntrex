<form role = "form" class = "form-horizontal" action  = "login.php" method = "POST">
    <h2>Please Log In</h2>
    <p style = "color:red;"><?php if(isset($err)) echo '*'.$err; ?></p>
    <div class = "form-group">
        <label for = "username" class = "control-label col-sm-4 hidden-xs hidden-sm">Username:</label>  
        <div class = "col-md-4 input-group col-xs-10 col-xs-push-1 col-md-push-0" style="margin-bottom:10px">
            <span class = "input-group-addon"><span class = "glyphicon glyphicon-user"></span></span>
            <input type = "text" placeholder = "Username" name = "username" class = "form-control">
        </div>
        <label for = "password" class = "control-label col-sm-4 hidden-sm hidden-xs">Password:</label>  
        <div class = "col-md-4 input-group col-xs-10 col-xs-push-1 col-md-push-0" style="margin-bottom:10px">
            <span class = "input-group-addon"><span class = "glyphicon glyphicon-lock"></span></span>
            <input type = "password" placeholder = "Password" name = "pass" class = "form-control">
        </div>
        <div class = "form-group col-md-4 col-md-push-4 col-xs-10 col-xs-push-1" style = "padding-top: 20px;">
            <input type = "submit" name = "login" value = "Log In" class = "form-control btn btn-primary">
        </div>
    </div>
</form>

