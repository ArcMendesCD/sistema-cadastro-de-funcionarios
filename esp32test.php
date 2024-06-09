<?php

if(isset($_GET["coordinates"])) {
   $temperature = $_GET["coordinates"]; // get temperature value from HTTP GET

   $servername = "168.121.216.20";
   $username = "rodoapp";
   $password = "rodoapp";
   $database_name = "antaresdb";

   // Create MySQL connection fom PHP to MySQL server
   $connection = new mysqli($servername, $username, $password, $database_name);
   // Check connection
   if ($connection->connect_error) {
      die("MySQL connection failed: " . $connection->connect_error);
   }

   $sql = "INSERT INTO  (teste) VALUES ($coordinates)";

   if ($connection->query($sql) === TRUE) {
      echo "New record created successfully";
   } else {
      echo "Error: " . $sql . " => " . $connection->error;
   }

   $connection->close();
} else {
   echo "coordinates is not set in the HTTP request";
}
?>
