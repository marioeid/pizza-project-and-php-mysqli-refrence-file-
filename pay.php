<?php
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
require 'start.php';
if (!isset($_GET['success'],$_GET['paymentId'],$_GET['PayerID']))
{
die();
}
if ((bool)$_GET['success']===false)
{
 die();
}
$paymentId=$_GET['paymentId'];
$payerid=$_GET['PayerID'];
$payment=Payment::get($paymentId,$paypal);

$execute=new PaymentExecution();
$execute->setPayerId($payerid); 
echo 'payment made';

try{
$result=$payment->execute($execute,$paypal);
}
catch(Exception $e)
{
$data=json_decode($e->getData());
var_dump($data);
print_r($data);
die();
}
?>