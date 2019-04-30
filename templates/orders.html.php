<?php
require "../database.php"; 
require "../classes/DatabaseTable.php";
$databaseTableOrders = new \classes\DatabaseTable($pdo, 'orders', 'order_id');
$databaseTableGames = new \classes\DatabaseTable($pdo, 'games', 'game_id');



$games=[];
?>
 <?php if (isset($_SESSION['customer_id'])): $orders = $databaseTableOrders->find('customer_id',$_SESSION['customer_id']);?>
 <div class="game-wrapper">
<div class="game-accordion">
<?php foreach ($orders as $order):$codes=unserialize($order->game_codes); ?>

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
</div>
 <?php else:$orders = $databaseTableOrders->findAll();?>
 <div class="game-wrapper">
<div class="game-accordion">
<?php foreach ($orders as $order):$codes=unserialize($order->game_codes); ?>

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
                        <th style="width: 10%">PaymentID</th>
                        <th style="width: 10%">PayerID</th>
                        <th style="width: 10%">Tracking</th>
                        <th style="width: 5%"></th>
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
                            <td>
                                <?=$order->paymentId?>
                            </td>
                            <td>
                                <?=$order->payerId?>
                            </td>
                            <td>
                                <?=$order->tracking?>
                            </td> 
                            </tr>
                            
    </thead>
            </table>
            </div> 
            <?php endfor;?>
    
    
    <a href="../public/orders.php?action=update&id=<?=$order->order_id?>">Update Status</a>
      <div class="">
            <p>Delivering to: <?=$order->delivery_name?> </p><br>
            <p>Delivery Address: <?=$order->delivery_address?>, <?=$order->delivery_city?>,<?=$order->delivery_postcode?> </p><br>
          <p>Shipping: <?=$order->total?></p>
          <p>Total: <?=$order->total?></p>
    </div>
    </div>
    


    
                                                                                                        

<?php endforeach;?>
</div>
</div>
 <?php endif;?>
<?php 
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
      case "update":?>
    <form action="" method="POST">
    <input type="hidden" name="product[order_id]" value="<?=$_GET['id']?>" /><br><br>
	<label>Status:</label>
    <select name="product[tracking]" id="">
        <option value="Processing">Processing</option>
        <option value="Out For Delivery">Out For Delivery</option>
        <option value="Delivered">Delivered</option>        
    </select>
    <input type="submit" name="submit" value="Update" />
    </form>
      <?php 
      if(isset($_POST['product'])){
      $record=$_POST['product'];
      $databaseTableOrders->save($record);
      header('Location: /public/orders.php');
      }
      break;
    }
  }
?>
    






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