<?php
$deviceToken = "015c5a2377ac146830f8ed09059b82bb91ed7190ebf74b633809bc2245da95bc";
$body = array("aps" => array("alert" => array('body'=>'测试来了','action-loc-key'=>'GO啦'), "badge" => 1, "sound" => 'received5.caf'));
$ctx = stream_context_create();
stream_context_set_option($ctx, "ssl", "local_cert", "ck.pem");
$fp = stream_socket_client("ssl://gateway.sandbox.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
if (!$fp) {
    print "Failed to connect $err $errstrn";
    return;
}
print "Connection OK<br/>";
$payload = json_encode($body);
$msg = chr(0) . pack("n",32) . pack("H*", $deviceToken) . pack("n",strlen($payload)) . $payload;
print "sending message :" . $payload . "\n";
fwrite($fp, $msg);
fclose($fp);
?>