<?php
session_start();
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
require 'paypal.php';

if (!isset($_SESSION['cart_item'])) {
  echo "set get prodcut and get price product";
  die;
}
$shipping=2.00;
$total=0;
$price=0;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$items = array();
$index = 0;
foreach ($_SESSION['cart_item'] as $item) {
   $index++;
   $items[$index] = new Item();
   $price = $price+$item['price'];
   $items[$index]->setName($item['game_title'])
                 ->setCurrency('GBP')
                 ->setQuantity($item['quantity'])
                 ->setPrice($item['price']);
}
$total=$price+$shipping;
$itemList = new ItemList();
$itemList->setItems($items);

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
$redirectUrls->setReturnUrl('http://localhost:8080/public/succesfulCheckout.php')
->setCancelUrl('http://localhost:8080/public/failedCheckout.php');

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
