<?php
    $conn = new mysqli("localhost", "root", "", "tes_arka");
    if($conn-> connect_error){
        die("Connect Failed".$conn->connect_error);
    }
?>