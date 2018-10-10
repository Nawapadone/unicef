<?php
$link = mysqli_connect("127.0.0.1", "root", "", "register");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

session_start();
// $_SESSION["qrcode"] = null;

if($_SESSION["qrcode"] != null){
    echo "inside if\n";
    // $_SESSION["qrcode"] = $_POST["qrcode"];
    // echo "qrcode :".$_SESSION["qrcode"]."; ";
    $sql = "SELECT firstname, lastname FROM member WHERE qrnumber = $_SESSION[qrcode]";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    echo "<br> Name: ". $row["firstname"]. " " . $row["lastname"] . "<br>";
    
    }

mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<form action="checkqrcode.php" method="post">
  QR-COCE: <input type="text" name="qrcode" autofocus><br>
  <input type="submit" value="Submit">
</form>




</body>
</html>
