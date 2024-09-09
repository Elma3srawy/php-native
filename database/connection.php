<?php

//Create connection
$connect = mysqli_connect(
    config('database.host_name'),
    config('database.username'),
    config('database.password'),
    config('database.database'),
);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// mysqli_close($connect);