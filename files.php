<?php

require 'database.php';
$query = "select * from files";

if ($is_query_run = mysqli_query($conn, $query)) {
    $filesData = [];
    while ($query_executed = mysqli_fetch_assoc($is_query_run)){
        $filesData[] = $query_executed;
    }
}

else {
    echo "Error in execution!";
}

echo json_encode($filesData);

?>