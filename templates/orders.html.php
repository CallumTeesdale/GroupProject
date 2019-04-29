<?php
require "../database.php"; 
require "../classes/DatabaseTable.php";
$databaseTableOrders = new \classes\DatabaseTable($pdo, 'orders', 'order_id');
$databaseTableGames = new \classes\DatabaseTable($pdo, 'games', 'game_id');

$orders = $databaseTableOrders->find('customer_id',$_SESSION['customer_id']);
$iP=0;
$iD=0;
$iG=0;
$games=[];
?>
<div class="game-wrapper">
<?php foreach ($orders as $order):$codes=unserialize($order->game_codes); ?>
<div class="game-accordion">
    <button onclick="myFunction('<?=$order->order_id?>')" class="g-button block black"><?=$order->tracking?> - orderID <?=$order->order_id?></button>
    <div id="<?=$order->order_id?>" class="hide accordion-container">
    <?php for ($i=0; $i < count($codes); $i++):       
        $games=$databaseTableGames->find('code', $codes[$i]);?>
        <?php foreach ($games as $t):?>
        <?php endforeach;?>
        <div class="game-iamge">  
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
				<thead>
					<tr>
                        <th style="width: 5%"></th>
						<th style="width: 10%">Title</th>
						<th style="width: 10%">Price</th>
                        <th style="width: 10%">Platform</th>
                    </tr>
        <tr>
                            <td><img src="data:image/jpeg;base64,<?= base64_encode($t->game_image) ?>" class="cart-item-image" /></td>
							<td>
								<?=$t->game_title?>
							</td>
							<td>£
								<?=$t->price?>
							</td>
							<td>
                                <?=$t->platform?>
                            </td>
                            </tr>
                            
    </thead>
            </table>
            </div> 
            <?php endfor;?>
    
    
    
      <div class="">
            <p>Delivering to: <?=$order->delivery_name?> </p><br>
            <p>Delivery Address: <?=$order->delivery_address?>, <?=$order->delivery_city?>,<?=$order->delivery_postcode?> </p><br>
          <p>Shipping: <?=$order->total?></p>
          <p>Total: <?=$order->total?></p>
    </div>
    
    </div>
                                                                                                        

<?php endforeach;?>

</div>




<script>
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("accordion-show") == -1) {
            x.className += " accordion-show";
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace("black", "accordion-active");
        } else {
            x.className = x.className.replace(" accordion-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace("accordion-active", "black");
        }
    }
</script>