<?php
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
require '../paypal.php';
if (!isset($_GET['token'],$_GET['paymentId'],$_GET['PayerID'] )){
die;
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];
$token = $_GET['token'];

$payment = Payment::get($paymentId, $paypal);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try {
    $result = $payment->execute($execute, $paypal);
} catch (Exception $e) {
    die;
}
echo "payment made";
?>
<div class="succesfulCheckoutWrapper">
    <div class="succesfulImageWrapper">
        <img src="../public/img/succesfulCheckout.png" class="succesfulImage">
    </div>
    <div class="succesfulTextWrapper">
        <div class="succesfulText">
            <h1>Invoice</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>
</div> 

