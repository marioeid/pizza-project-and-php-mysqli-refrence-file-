<?php
require 'start.php';
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;



if (isset($_POST['submit']))
{
    if (!isset($_POST['price'])||!isset($_POST['product']))
{
    die();
}

$prodcut=$_POST['product'];
$price=$_POST['price'];
$shipping=2;
$total=$price+$shipping;

$payer=new Payer();
$payer->setPaymentMethod('paypal');

$item= new Item();
$item->setName($prodcut)
     ->setCurrency('GBP')
     ->setQuantity(1)
     ->setPrice($price);

$itemList=new ItemList();
$itemList->setItems([$item]);
$details= new Details();
$details->setShipping($shipping)
        ->setSubtotal($price);

$amount=new Amount();
$amount->setCurrency('GBP')
       ->setTotal($total)
       ->setDetails($details)
       ;

$transaction=new Transaction();
$transaction->setAmount($amount)
           ->setItemList($itemList)
           ->setDescription('PayForSomething Payment')
           ->setInvoiceNumber(uniqid());
           
$redirect_urls= new RedirectUrls();
$redirect_urls->setReturnUrl(SITE_URL.'pay.php?success=true')
              ->setCancelUrl(SITE_URL.'pay.php?success=false');

$payment=new Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirect_urls)
        ->setTransactions([$transaction]);

try
{
 $payment->create($paypal); 
}
catch(Exception $e)
{
die($e);
}
echo $approvalUrl=$payment->getApprovalLink();
header("Location:{$approvalUrl}");
 }
?>