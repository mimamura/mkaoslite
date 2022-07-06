<?php

// get and proccess next command in queue

require 'conn.php';

$c = array('cmd'=>'none');
$cmd = json_encode($c);

// cmds wating in queue
$sql="select * from network_cmd where status='queued' and soskey='' ";
$result = $conn->query($sql);

// send response
while ( $row = $result->fetch_assoc() ) {

    // recalc cmd
    $cmd = $row['cmd'];
    $id = $row['id_cmd'];

    // clear cmd
    $sql = "update network_cmd set status='done' where id_cmd=$id ";
    $conn->query($sql);
}

// send response
echo $cmd;
