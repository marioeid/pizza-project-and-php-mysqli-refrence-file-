<?php

require 'vendor/autoload.php';

define('SITE_URL','http://localhost/tuts/');
$paypal = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
'AfifdMCmK-Xz9kNTNfqn2SPvikWqycemUqvjDIxWlveYZWCguMowUyTbGmC2a1uGht0SWdk99yYDtD9Z',
'EKn1kA44m0Qr9IqaId9-zVzz3iW2VZbTqQ33p-7ZVuaKVcKPsenKvYd7WvKhhI4bVq8DNiF6ZTI49w0P')
);

?>