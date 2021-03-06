<?php
//connect to DB
$link = mysqli_connect("127.0.0.1", "root", "", "register");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

//timeStamp
$tz = 'Asia/Bangkok';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$today = $dt->format('Y-m-d g:i:s a');
// $today = date("d.m.Y, H:i:s"); 

echo $today;

$sql = "INSERT INTO member (firstname, lastname, tel, qrnumber, day1timestamp, day2timestamp, day3timestamp)
VALUES ('$_POST[F_name]', '$_POST[L_name]', '$_POST[tel]', '$_POST[qrcode]', '$today', '', '')";

session_start();
$_SESSION["status"] = true;
if ($link->query($sql) === TRUE) {
    //New record created successfully
    header('Location:index.php');
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

mysqli_close($link);
?>