<?php
    include("config.php");
    session_start();
    $var_value = $_SESSION['varname'];
    if(isset($_POST['but_upload'])){
        $name = $_FILES["userfile"]["name"][0];
        //   $name2 = $_FILES["userfile"]["name"][1];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["userfile"]["name"][0]);
        //   $target_file = $target_dir . basename($_FILES["userfile"]["name"][1]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif","tif",'PNG');

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
        
            // Insert record
            // $modified_filename=$var_value.$name;
            // echo $modified_filename;
            $query = "insert into dm_plateform.file( user_id, file_data) values('".$_SESSION['varname']."','".$name."')";
            //  $query = "insert into images(name, file) values('".$name."','".$name2."')";
            pg_query($db,$query);
            
            // Upload file
            move_uploaded_file($_FILES['userfile']['tmp_name'][0],$target_dir.$name);
            //  move_uploaded_file($_FILES['userfile']['tmp_name'][1],$target_dir.$name2);
        }
        else{
            echo "<h4><center>Wrong file format</center></h4>";
        }
    }

?>





<html>
    <head>  
        <title> Insert and Display Images </title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head> 
    <body>
        <center><h1>Upload File</h1></center>
        <br /><br />  
        <div class="container" style="width:500px;">
            <?php
                //On page 2
                $var_value = $_SESSION['varname'];
                echo "<h4><center>Welcome id: ".$var_value."</center></h4>";
            ?>
            <a href="registration.php" style="float:right"><input type="button" value="logout"></a>
            <form method="post" action="" enctype='multipart/form-data'><br><br><br>
                <label>Select Image:</label><input type='file' multiple="multiple" name="userfile[]" /><br/><br/><br/>
                <!-- <label>Select File:</label> <input  type='file' multiple="multiple" name="userfile[]" /><br/><br/> -->
                <input type='submit' value='upload image' name='but_upload' class="btn btn-info">
                <input type='submit' value="retrieve image" name="display_list" class="btn btn-info">
                <?php
                    if(isset($_POST['but_upload'])){
                        echo "<p><center>file uploaded...</center></p>";   
                    }
                ?>
            </form>              
        </div>           
    </body>
</html>

<?php
    include("config.php");
    if(isset($_POST['display_list'])){
        $ID = 2;
        $sql = "select * from dm_plateform.file where user_id=2";
        $res = pg_query($sql);
            if ($ID > 0) {
                echo "<p><h3><b>List of file uploaded by user:</b> ". $_SESSION['varname']."</h3></p>";
            
                while($row = pg_fetch_array($res)){
                    echo "<p><b>file_id:</b>", $row['file_id'];
                    echo "&nbsp;&nbsp;<b>user_id:</b>", $row['user_id'];
                    echo "&nbsp;&nbsp;<b>file_name:</b> ", $row['file_data'], "</p>";
                }
                pg_close ($db);
            }
            
        }
?>


