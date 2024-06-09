<?php

$connection = mysqli_connect("localhost", "antaresadm","2024#antaresADM0403","antaresdb");

if(!$connection)
    die("could not connect".mysqli_connect_error());
else
 echo 'Connection estabilished';
?>