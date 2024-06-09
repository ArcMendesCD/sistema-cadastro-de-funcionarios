<?php

require 'database.php';
$query = "select * from shipping";

if ($is_query_run = mysqli_query($conn, $query)) {
    $shippingData = [];
    while ($query_executed = mysqli_fetch_assoc($is_query_run)){
        $shippingData[] = $query_executed;
    }
}

else {
    echo "Error in execution!";
}

echo json_encode($shippingData);

?>