<?php

// Create connection

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//check connection
if(mysqli_connect_errno()) {
    // Connection failed
    echo 'Failed to connect to mysql '.mysqli_connect_errno();
}