<?php

$servername="localhost";
$uname="root";
$pass="";
$db="pso_inventory";

$conn=mysqli_connect($servername,$uname,$pass,$db);

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT * FROM members WHERE status ='Active'";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?>