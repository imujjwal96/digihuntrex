<table class = "table table-hover" id = "leadtab">
    <thead>
        <tr>
            <th style = "text-align: center">Rank</th>
            <th style = "text-align: center">Name</th>
            <th style = "text-align: center">Level</th>
        </tr>
    </thead>
    <tbody>
<?php
    $results = query("SELECT * FROM `info` ORDER BY level DESC, datetime ASC");

    $i = 1;
    if (is_array($results) || is_object($results))
    {
        foreach($results as $result)
        {
            if($result["level"] != -1)
            {
                echo '<tr>
                          <td>'.$i.'</td>
                          <td>'.$result["name"].'</td>
                          <td>'.$result["level"].'</td>
                      </tr>';
                $i++;
            }
            else
            {
                echo '<tr>
                          <td>'.$i.'</td>
                          <td>'.$result["name"].'</td>
                          <td>Banned</td>
                      </tr>';
                $i++;
            }
        }
    }

?>
    </tbody>
</table>
