<h1 id = "lev">This is Level <?= $level?></h1>
<?php
    $xml=simplexml_load_file("../includes/levels.xml");
    foreach($xml->xpath("/levels/level[@id='$level']") as $level)
    {
        echo '<p>'.$level->quote.'</p>';
        if(isset($level->photo))
            echo '<img src ="'.$level->photo.'" class="img-responsive" style="margin:0 auto;">';
        echo '<p>'.$level->question.'</p>';
    }
?>
    <form role = "form" class = "form-horizontal" action = "submission.php" method = "POST">
    <p style = "color:red;"><?php if(isset($err)) echo '*'.$err; ?></p>
    <div class = "form-group">
        <div class = "col-md-4 input-group col-md-push-4 col-xs-10 col-xs-push-1">
            <input type = "text" name = "input" class = "form-control">
            <span class = "input-group-addon" style = "background-color: #008cba;">
                <input type = "submit" name = "level" value = "Submit" 
                style = "border:none; background-color: #008cba; color:white">
            </span>
        </div>
    </div>
</form>
    

