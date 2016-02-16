<?php
$host= "Localhost";
$user = "chen0529";
$pwd = "40809656";
$db = "chen0529";
$connect = mysqli_connect( $host, $user, $pwd ) or die("Couldn't connect!" );
mysqli_select_db( $connect, $db ) or die ( "Couldn't find database!" );

?>
