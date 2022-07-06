<?php

// remote commands to the model

require 'conn.php';

// data in queue forms
$c= isset($_REQUEST['c'])     ? $_REQUEST['c']  : '';
$l= isset($_REQUEST['label']) ? $_REQUEST['label'] : '';

// browser props
$browser = getBrowser();
$t= $browser['name'] . ' ' . $browser['platform'];

$idc= isset($_REQUEST['idc']) ? $_REQUEST['idc'] : '';
$idm= isset($_REQUEST['idm']) ? $_REQUEST['idm'] : '';

$txt= isset($_REQUEST['txt']) ? $_REQUEST['txt'] : '';
$msg_type= isset($_REQUEST['msg_type']) ? $_REQUEST['msg_type'] : '';

// process cmd queue
if (!empty($c) ) {

    if ( $c =='create constituent' ) {

        $cmd = array(
            'cmd' => 'create constituent',
            'label' => $l,
            'title' => $t
        );

    } elseif ( $c =='create mission' ) {

        $cmd = array(
            'cmd' => 'create mission',
            'label' => $l,
            'title' => $t
        );

    } elseif ( $c =='message' ) {

        $cmd = array(
            'cmd' => 'message',
            'txt' => $txt,
            'msg_type' => $msg_type
        );
    }

    // save in queue
    $cmd_j = json_encode($cmd);
    $sql = "insert into network_cmd (cmd) values ('$cmd_j') ";
    try {
        $conn->query($sql);
    } catch (Exception $e) {
        echo $e->errorMessage();
    }

    echo $cmd_j . ' : na fila<br/>';
    
}

echo '<h2>Send remote commands to diagram</h2>';

echo '<form action= commands.php>';
echo '<input type=hidden name="c" value="create constituent">';
echo 'Create constituent system <input type=text name="label" placeholder="Choose a name"> ';
echo '<input type=submit value="Send command" >';
echo '</form>';

echo '<form action= commands.php>';
echo '<input type=hidden name="c" value="create mission">';
echo 'Create mission/capability <input type=text name="label" placeholder="Choose a name"> ';
echo '<input type=submit value="Send command" >';
echo '</form>';

echo '<form action= commands.php>';
echo 'Send message ';
echo '<input type=hidden name="c" value="message">';
echo '<input type=text name="txt" size=20 placeholder="Message to send"> ';
echo ' type <select name="msg_type">
  <option value="">Default</option>
  <option value="success">Success</option>
  <option value="warning">Warning</option>
  <option value="error">Eror</option>
</select> ';
echo '<input type=submit  value="Send command" >';
echo '</form>';

// diagram proc

echo '<br/><hr><h2>Diagram elements</h2>';
echo '<table border=1 width="400"><th>Nodes</th><th>Edges</th><tr><td>';

$sql="select * from network where id_network=1";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo '<pre>'.prettyprint( $row["nodes"] ) .'</pre>';
}

echo '</td><td valign="top">';

$sql="select * from network where id_network=1";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo '<pre>'.prettyprint($row["edges"]).'</pre>';
}

echo '</td></tr></table>';

// array with browser

function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  // First get the platform?

  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  }elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }

  // Next get the name of the useragent yes seperately and for good reason

  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
    $ub = "Netscape";
  }elseif(preg_match('/Edge/i',$u_agent)){
    $bname = 'Edge';
    $ub = "Edge";
  }elseif(preg_match('/Trident/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }

  // finally get the correct version number

  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
  }

  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $version= $matches['version'][0];
    }else {
        $version= $matches['version'][1];
    }
  }else {
    $version= $matches['version'][0];
  }

  // check if we have a number
  if ($version==null || $version=="") {$version="?";}

  return array(
    'userAgent' => $u_agent,
    'name'      => $bname,
    'version'   => $version,
    'platform'  => $platform,
    'pattern'    => $pattern
  );
} 
