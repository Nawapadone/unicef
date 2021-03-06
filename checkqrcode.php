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

//timeStamp
$tz = 'Asia/Bangkok';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$today = $dt->format('Y-m-d g:i:s a');
// $today = date("d.m.Y, H:i:s");

//timeStamp show web
$time = $dt->format('g:i:s a');


echo $today;
session_start();

if($_POST["c_day"] == 'day2'){
    $day = 'day2timestamp';
    $linkto = 'timestampday2.php';
}
else if($_POST["c_day"] == 'day3'){
    $day = 'day3timestamp';
    $linkto = 'timestampday3.php';
}

$_SESSION["qrcode"] = $_POST["qrcode"];
$_SESSION["time"] = $time;

$sql = "UPDATE member SET  $day ='$today' WHERE qrnumber=$_POST[qrcode] ";

if ($link->query($sql) === TRUE) {
    //Record updated successfully
    header('Location:'.$linkto);
} else {
    echo "Error updating record: " . $link->error;
}

mysqli_close($link);
?>