<!--modal large-->
<div class="modal fade" id="instruct" tabindex="-1" role="dialog" aria-labelledby="myModal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModal-label"><strong>Validations</strong></h4>
            </div>
            <div class="modal-body" style = "text-align: left">
                <ol>
                    <li>Do I need to tell what can be wrong in a Name? And yes! If you've any special characters in your name, do ignore them.</li>
                    <li>An e-mail address is an e-mail address.</li>
                    <li>Username must contain only alphanumeric character.</li>
                    <li>Password should have a minimum length of 5. Why this? Because reasons.</li>
                    <li>Stating the obvious.... If you repeat something, it should match with the previous one.</li>                
                </ol>
            </div>
        </div>
    </div>
</div>

<form role = "form" class = "form-horizontal" action  = "register.php" method = "POST">
    <h2>Please Register</h2>
    <p style = "color:red;"><?php if(isset($err)) echo '*'.$err; ?></p>
    <div class = "form-group">
        <!-- Register Name -->
        <label for = "name" class = "control-label col-sm-4 hidden-xs hidden-sm">Name:</label>  
        <div class = "col-md-4 input-group col-xs-10 col-xs-push-1 col-md-push-0">
            <span class = "input-group-addon" id = "errn" data-toggle = "modal" data-target = "#instruct" style = "cursor:pointer;"><span class = "glyphicon glyphicon-home"></span></span>
            <input type = "text" placeholder = "Name" name = "name" class = "form-control" id = "name" required onkeyup = "return validatename()">
        </div>
    </div>
    <!-- Register Email -->
    <div class = "form-group">
        <label for = "email" class = "control-label col-sm-4 hidden-xs hidden-sm">E-Mail:</label>  
        <div class = "col-md-4 input-group col-xs-10 col-xs-push-1 col-md-push-0">
            <span class = "input-group-addon" id = "errm" data-toggle = "modal" data-target = "#instruct" style = "cursor:pointer;"><span class = "glyphicon glyphicon-envelope"></span></span>
            <input type = "mail" placeholder = "Email-Address" name = "email" class = "form-control" id = "email" required onkeyup = "return validatemail()">
        </div>
    </div>
    <!-- Register Username -->
    <div class = "form-group">
        <label for = "name" class = "control-label col-sm-4 hidden-xs hidden-sm">Username:</label>  
        <div class = "col-md-4 input-group col-xs-10 col-xs-push-1 col-md-push-0">
            <span class = "input-group-addon" id = "erru" data-toggle = "modal" data-target = "#instruct" style = "cursor:pointer;"><span class = "glyphicon glyphicon-user"></span></span>
            <input type = "text" placeholder = "Username" name = "username" class = "form-control" id = "uname" required onkeyup = "return validateuname()">
        </div>
    </div>
    <!-- Register Password -->
    <div class = "form-group">
        <label for = "password" class = "control-label col-sm-4 hidden-xs hidden-sm">Password:</label>  
        <div class = "col-md-4 input-group col-xs-10 col-xs-push-1 col-md-push-0">
            <span class = "input-group-addon" id = "errp" data-toggle = "modal" data-target = "#instruct" style = "cursor:pointer;"><span class = "glyphicon glyphicon-lock"></span></span>
            <input type = "password" placeholder = "Password" name = "pass" class = "form-control" id = "pass" required onkeyup = "return validatepass()">
        </div>
    </div>
    <!-- Register Password2 -->
    <div class = "form-group">
        <label for = "password" class = "control-label col-sm-4 hidden-xs hidden-sm">Password:</label>  
        <div class = "col-md-4 input-group col-xs-10 col-xs-push-1 col-md-push-0">
            <span class = "input-group-addon" id = "errp2" data-toggle = "modal" data-target = "#instruct" style = "cursor:pointer;"><span class = "glyphicon glyphicon-asterisk"></span></span>
            <input type = "password" placeholder = "Password (Repeat)" name = "pass2" class = "form-control" id = "pass2" required onkeyup = "return validatepass2()">
        </div>
    </div>
    <!-- Register -->
    <div class = "form-group">
        <div class = "form-group col-md-4 col-md-push-4 col-xs-10 col-xs-push-1" style = "padding-top: 20px;">
            <input type = "submit" name = "register" value = "Register" class = "form-control btn btn-primary" id = "submit" onClick = "return validator()">
        </div>
    </div>

</form>
<script>
    var n = false, m = false, u = false, p = false, p2 = false;
    var validatename = function() {
        n = false;
        validator();
        var errn = document.getElementById("errn");
        var name = document.getElementById("name");
        if(name.value === ""){
            errn.style.color = "red";
        }
        else
        if (/[^a-zA-Z ]/.test(name.value) == true) {
            errn.style.color = "red";
            return false;
        }
        else{
            errn.style.color = "green";
        }
        n = true;
    };
    
    var validatemail = function(){
        m = false;
        validator();
        var errm = document.getElementById("errm");
        var mail = document.getElementById("email");
        if (/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i.test(mail.value) !== true){
            errm.style.color = "red";
            return false;
        }
        else{
            errm.style.color = "green";
            m = true;
        }

    };
    
    var validateuname = function(){
        u = false;
        validator();
        var erru = document.getElementById("erru");
        var uname = document.getElementById("uname");
        if(uname.value === ""){
            erru.style.color = "red";
            return false;
        }
        else
        if (/[^a-zA-Z0-9]/.test(uname.value) == true){
            erru.style.color = "red";
            return false;
        }
        else{
            erru.style.color = "green";
        }
        u = true;
    };
    
    var validatepass = function(){
        p = false;
        validator();
        var errp = document.getElementById("errp");
        var pass = document.getElementById("pass");
        if(pass.value === ""){
            errp.style.color = "red";
            return false;
        }
        else
        if(pass.value.length < 5){
            errp.style.color = "red";
            return false;
        }
        else{
            errp.style.color = "green";
        }
        p = true;
    };
    
    var validatepass2 = function(){
        p2 = false;
        validator();
        var pass = document.getElementById("pass");
        var pass2 = document.getElementById("pass2");
        var errp2 = document.getElementById("errp2");
        if(pass.value !== pass2.value){
            errp2.style.color = "red";
            return false;
        }
        else{
            errp2.style.color = "green";
        }
        p2 = true;
    };
    
    var validator = function(){
        if(n === false || m === false || u === false || p === false || p2 === false)
        {
            return true;
        }
    };
</script>

