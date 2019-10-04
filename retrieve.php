

<?php
    include("config.php");
    $sql="select * from dm_plateform.file where user_id=2";
    $query=pg_query($sql);
    while($row=pg_fetch_array($query))
    {
    $image=$row ['file_data'];

    echo '<img src="upload/'.$image.'" width="360" height="150">';

    }
?>