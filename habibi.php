
<?php
header("Content-Type: text/html; charset=utf-8");
$obj = $_GET["x"];

error_reporting(E_ALL);
    
/* Get the port for the WWW service. */
$service_port = 5002;

/* Get the IP address for the target host. */
$address = '163.25.101.53';

/* Create a TCP/IP socket. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
} else {
}


$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
} else {
}


$obj = urlencode($obj);
$in = "GET /get?msg=".$obj." HTTP/1.1\r\n";
$in .= $address."\r\n";
$in .= "Connection: Close\r\n\r\n";
$out = '';

socket_write($socket, $in, strlen($in));

$reply = "";
while( $out = socket_read($socket, 2048)) {
    $reply = $out;
};
//$reply = urldecode($reply)
$string = str_replace(array("\n","\r"), '', $reply);
preg_match('/GMT(.*)/', $string, $match);
echo ($match[1]);

socket_close($socket);

?>
