<?php
$host = 'localhost';
$dbname = 'blackcoffer';
$username = 'root'; 
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "error to connect " . mysqli_connect_error();
    exit();
} 
// else {
//     echo "Connection successful";
// }


?>
