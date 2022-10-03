<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$DBname = "db";

$mysqli = new mysqli($servername, $username, $password, $DBname);

if ($mysqli -> connect_error) {
    printf("Bad connection: %s\n", $mysqli -> connect_error);
    exit();
}