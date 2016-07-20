<h3>We tried to log you in. But it Failed. This can be because you've not 
    yet verified your account. Please check for an Email from us and verify    
</h3>
<p>Just in case you haven't received the mail.... 
    <form role = "form" class = "form-horizontal" action  = "resend.php" method = "POST">
        <input type = "hidden" value = "<?= $name ?>" name = "name">
        <input type = "hidden" value = "<?= $email ?>" name = "email">
        <input type = "submit" value = "Resend" class = "form-control btn btn-primary">
    </form>
</p>

