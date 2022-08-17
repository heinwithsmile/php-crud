<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "offerdb";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn) {
    die("connection failed: ".mysqli_connect_error());
}
