<?php

// save current edges in model to database

require 'conn.php';

$p = $_REQUEST['p'];

if (!empty($p)) {

    // verifica se ha o SoS=''
    $sql = "select count(*) cnt from network where soskey='' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    // cria o registro se inexistente
    if ($row['cnt'] == 0 ) {
        $sql = "insert into network (soskey) values ('') ";
        $conn->query($sql);
    }

    // salva conteudo edges
    $sql="update network set edges= '$p' where soskey=''";

    if ( $conn->query($sql) ) {
        echo 'ok';
    } else {
        echo 'Error saving edges.';
    }

}
