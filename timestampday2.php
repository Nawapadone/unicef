<?php
$link = mysqli_connect("127.0.0.1", "root", "", "register");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
// echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

session_start();
// $_SESSION["qrcode"] = null;

if(isset($_SESSION["qrcode"])){
    // echo "inside if\n";
    // $_SESSION["qrcode"] = $_POST["qrcode"];
    // echo "qrcode :".$_SESSION["qrcode"]."; ";
    $sql = "SELECT firstname, lastname FROM member WHERE qrnumber = $_SESSION[qrcode]";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    // echo "<br> Name: ". $row["firstname"]. " " . $row["lastname"] . "<br>";
    
    }

mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="main.js"></script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
    <body>
        <img class="background non-selectable" src="img/bg.svg" />

        <div class="main-container">
            <div class="sponsor-bar non-selectable">
                <img src="img/kmutt.svg" style="height: 59.2px"/>
                <img src="img/saturday-school.svg" style="height: 31.5px"/>
                <img src="img/unicef.svg" style="height: 50px"/>
            </div>
            <div class="body">
                <div class="flex-horizontal">
                    <div class="flex-vertical" style="padding-top: 10%">
                        <img src="img/title.svg" class="non-selectable" style="height: 133.9px;"/>

                        <div class="form1">

                            <form action="checkqrcode.php" method="post">
                                <!-- QR-COCE: <input type="text" name="qrcode" autofocus><br> -->

                                <div class="form-group">
                                    <input type="text" class="form-control" id="qrcode" name="qrcode" placeholder="QRCODE" autofocus>
                                </div>

                                <!-- <input type="submit" value="Submit"> -->
                                <button type="submit" class="btn btn-success text-right" style="margin-top: 8px; float: right;">Submit</button>

                                <br>
                                <br>
                                <?php
                                    if (isset($row["firstname"]) && isset($row["lastname"])) {
                                        echo "<div class='alert alert-warning' role='alert'>";
                                        echo "<br> Name: ". $row["firstname"]. " " . $row["lastname"] . "<br>";
                                        echo "</div>";
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                    <img src="img/gen-unlimited.svg" class="non-selectable" style="height: 382.5px"/>
                </div>
                
            </div>
        </div>
        
        <!-- REQUIRED SCRIPTS FOR BOOTSTAP -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
