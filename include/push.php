<?php 

sendPushNotification();
 function sendPushNotification() {

	  $deviceToken = "401ffc10d0b8f919f2782eb4efa0acb4e5402149f537daf2d3fae42c60bdc859";
      $message = "Hello from server";
      $badge = 1;
      $sound = "default";

      // Construct the notification payload
      $body = array();
      $body['aps'] = array('alert' => $message);

      if ($badge)
            $body['aps']['badge'] = $badge;
      if ($sound)
            $body['aps']['sound'] = $sound;

      /* End of Configurable Items */
      $ctx = stream_context_create();
      stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
	stream_context_set_option($ctx, 'ssl', 'passphrase', '1234');

      $fp = stream_socket_client("ssl://gateway.sandbox.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

      if (!$fp) {
            print "Failed to connect $err $errstrn";
            return;
      } else {
            print "Connection OK\n";
      }

      $payload = json_encode($body);
      $msg = chr(0) . pack("n",32) . pack("H*", str_replace(" ", "", $deviceToken)) . pack("n",strlen($payload)) . $payload;
      print "sending message :" . $payload . "\n";
      fwrite($fp, $msg);
      fclose($fp);
    }
	?>
