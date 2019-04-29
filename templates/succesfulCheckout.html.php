<?php
session_start();
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
require '../paypal.php';
require '../database.php';

if (!isset($_GET['token'],$_GET['paymentId'],$_GET['PayerID'] )){
die;
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];
$token = $_GET['token'];

$payment = Payment::get($paymentId, $paypal);
//print_r($payment);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try {
    $result = $payment->execute($execute, $paypal);
} catch (Exception $e) {
    die;
}
$jsonResult = $result->toJSON();
$json = json_decode($jsonResult, true);
$name = $json['payer']['payer_info']['shipping_address']['recipient_name'];
$address = $json['payer']['payer_info']['shipping_address']['line1'];
$city = $json['payer']['payer_info']['shipping_address']['city'];
$postcode = $json['payer']['payer_info']['shipping_address']['postal_code'];
$total = $json['transactions'][0]['amount']['total'];
$subtotal = $json['transactions'][0]['amount']['details']['subtotal'];
$shipping = $json['transactions'][0]['amount']['details']['shipping'];
foreach ($_SESSION['cart_item'] as $item) {
    $game_codes_arr[] = array($item['code']);
}
$game_code_str = serialize($game_codes_arr);
//print_r(unserialize($game_code_str));

$stmt = $pdo->prepare('INSERT INTO orders (game_codes,customer_id,total,subtotal,shipping,delivery_name,delivery_address,delivery_city,delivery_postcode,paymentId,payerId,token,tracking) 
VALUES(:game_codes,:customer_id,:total,:subtotal,:shipping,:delivery_name,:delivery_address,:delivery_city,:delivery_postcode,:paymentId,:payerId,:token,:tracking)');
$criteria = [
    'game_codes' => $game_code_str,
    'customer_id' => $_SESSION['customer_id'],
    'total' => $total,
    'subtotal' => $subtotal,
    'shipping' => $shipping,
    'delivery_name' => $name,
    'delivery_address' => $address,
    'delivery_city' => $city,
    'delivery_postcode' => $postcode,
    'paymentId' => $paymentId,
    'payerId' => $payerId,
    'token' => $token,
    'tracking' => "Processing",
];
$stmt->execute($criteria);







?>
<div class="succesfulCheckoutWrapper">
    <div class="succesfulImageWrapper">
        <img src="../public/img/succesfulCheckout.png" class="succesfulImage">
    </div>
    <div class="succesfulTextWrapper">
        <div class="succesfulText">

            <h1>Invoice</h1>
            <div class="invAdd">
            <h1>Shipping Details</h1>
            <p><strong>Name: </strong><?=$name?></p>
            <p><strong>Address: </strong><?=$address?></p>
            <p><strong>City: </strong><?=$city?></p>
            <p><strong>Postcode: </strong><?=$postcode?></p>
            </div>
            <div class="invItems">
            <h1>Items</h1>
            <?php 
            foreach ($json['transactions'][0]['item_list']['items'] as $item): ?>
            <p><strong>Name: </strong><?=$item['name']?></p>
            <p><strong>Price: </strong><?=$item['price']?></p>
            <?php endforeach; ?>
            <p><strong>Subtotal: </strong><?=$subtotal?></p>
            <p><strong>Shipping: </strong><?=$shipping?></p>
            <p><strong>Total: </strong><?=$total?></p>
            </div>
        </div>
    </div>
</div> 
<?php 

?>
