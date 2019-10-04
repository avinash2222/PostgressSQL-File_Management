
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
<body>
    <form name="insert" action="" method="POST">
        <?php
            include("config.php");
            session_start();
        ?>
        <div class="container">
            <center><h1>DronaMaps Register</h1></center>
            <label for="id"><b>id</b></label>
            <input type="text" placeholder="Enter ID" name="id" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <button type="submit" class="registerbtn" name='inserted'>Register</button>
        </div>
    </form>
</body>
</html>


<?php
    if(isset($_POST['inserted'])){
        // echo "hello.................";
        $db = pg_connect("host=localhost port=5432 dbname=DronaMaps user=postgres password=Avinash1!");
        // $query = "INSERT INTO dm_plateform.user_test(id, pass) select '$_POST[id]','$_POST[psw]' where not exists(select id from dm_plateform.user_test where id='$_POST[id]')";
        // $result = pg_query($query); 

        $check="SELECT * FROM dm_plateform.user_test WHERE id = '$_POST[id]'";
        $rs = pg_exec($db,$check);
        $numrows = pg_numrows($rs);
        $data[]=0;
        for($i = 0; $i < $numrows; $i++) 
        {
            $data = pg_fetch_array($rs, $i);
            echo "<p><center>Welcome id: ".$data["id"]."</center></p>";
        }
        //On page 1
        $_SESSION['varname'] = $data["id"];
        // $data = pg_fetch_array($rs,0, PGSQL_NUM);
        if($data[0] > 1) {
            header("Location:upload.php");
            exit();
            // echo "<p><center>User Already in Exists</center></p><br/>";
        }

        else
        {
            $newUser="INSERT INTO dm_plateform.user_test(id,pass) values('$_POST[id]','$_POST[psw]')";
            if (pg_query($db,$newUser))
            {
                header("Location:upload.php");
                exit();
                // echo "<p><center>You are now registered</center></p>";
            }
            else
            {
                echo "Error adding user in database<br/>";
            }
        }
    }
?>

















