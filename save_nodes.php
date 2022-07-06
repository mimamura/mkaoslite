<?php

// save current nodes to database

require 'conn.php';

$p = $_REQUEST['p'];

if (!empty($p)) {
    
    $sql="update network set nodes= '$p' where soskey='' ";

    if ( $conn->query($sql) ) {
        echo 'ok';
    } else {
        echo 'Error saving nodes.';
    }

}
