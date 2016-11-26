<?php

echo "<link rel='stylesheet' type='text/css' href='/css/simpleStyle.css'>";

if (!empty($_POST["name"])) {
    $nameUpload = trim($_POST['name']);
} else echo "<script>alert('Please pass a name.')</script>";

if (!empty($_POST["date"])) {
    $dateUpload = trim($_POST['date']);
} else echo "<script>alert('Please pass a date.')</script>";

if (!empty($_POST["type"])) {
    $typeUpload = trim($_POST['type']);
} else echo "<script>alert('Please pass a type.')</script>";
    
if (!empty($_POST["color"])) {
    $colorUpload = trim($_POST['color']);
} else echo "<script>alert('Please pass a color.')</script>";



//capture search term and remove spaces at its both ends if the is any
$nameUpload = trim($_POST['name']);
$dateUpload = trim($_POST['date']);
$typeUpload = trim($_POST['type']);
$colorUpload = trim($_POST['color']);
$noteUpload = trim($_POST['notes']);

//database connection info

    $configs = include('config.php');

    $username = $configs.['username'];
    $password = $configs.['password'];
    $hostname = $configs.['host']; 
    $database = $configs.['databse'];
    
//connecting to server and creating link to database
$link = mysqli_connect($hostname, $username, $password, $database);

$escaped_name = mysqli_escape_string($link, $nameUpload);
$escaped_date = mysqli_escape_string($link, $dateUpload);
$escaped_type = mysqli_escape_string($link, $typeUpload);
$escaped_color = mysqli_escape_string($link, $colorUpload);
$escaped_note = mysqli_escape_string($link, $noteUpload);

$countQuery = "SELECT * FROM testTable";

$before = mysqli_query($link, $countQuery);

echo "Number of rows before insert: " . $before->num_rows . "<br><br>";

//Insert query
$insertQuery = "INSERT INTO testTable (`name`, `date`, `type`, `color`, `Notes`) VALUES ('$escaped_name','$escaped_date','$escaped_type','$escaped_color','$escaped_note')";

//Run the issert
$runInsert = mysqli_query($link, $insertQuery);

$after = mysqli_query($link, $countQuery);

echo "Number of rows after insert: " . $after->num_rows . "<br><br>";

if($after->num_rows > $before->num_rows){
    echo "Poo uploaded successfully!";
} else 
    echo "Something went wrong. Your poo was not uploaded.";
?>
