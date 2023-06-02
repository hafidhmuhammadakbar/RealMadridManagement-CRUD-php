<?php 

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "realmadrid";

try {    
    //create PDO connection 
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}

?>