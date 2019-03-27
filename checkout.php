<?php
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
require 'paypal.php';

if (!isset($_GET['product'], $_GET['price'])) {
  echo "set get prodcut and get price product";
  die;
}
$product=$_GET['product'];
$price=$_GET['price'];
$shipping=2.00;
$total=$price+$shipping;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setName($product)
->setCurrency('GBP')
->setQuantity(1)
->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]);

$details= new Details();
$details->setShipping($shipping)
->setSubtotal($price);

$amount= new Amount();
$amount->setCurrency('GBP')
->setTotal($total)
->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
->setItemList($itemList)
->setDescription('NGS')
->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls;
$redirectUrls->setReturnUrl('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'/public/succesfulCheckout.php')
->setCancelUrl('http://'. $_SERVER['HTTP_HOST'].'/myphp/public/failedCheckout.php');

$payment = new Payment();
$payment->setIntent('sale')
->setPayer($payer)
->setRedirectUrls($redirectUrls)
->setTransactions([$transaction]);
try {
  $payment->create($paypal);
} catch (\Exception $e) {
  die($e);
}

$approvalUrl =$payment->getApprovalLink();
header("Location: {$approvalUrl}");
