<?php

$server = "localhost";
$uname = "root";
$password = "";
$db = "tugas_crud_1303190065";

$conn = mysqli_connect($server, $uname, $password, $db);

if (!$conn) {
    echo "Connection Failed!";
}
