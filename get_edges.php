<?php

// show saved edges structure in database

require 'conn.php';

$sql="select * from network where soskey=''";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo $row["edges"];
}
