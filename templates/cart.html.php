<div class="cartWrapper">
    <div class="cart" id="shopping-cart">
        <div class="txt-heading">
            <h1>Shopping Cart</h1>
        </div>


        <?php
 //var_dump($_SESSION["cart_item"]);
		if (isset($_SESSION["cart_item"])) {
			$total_quantity = 0;
			$total_price = 0;
			?>
        <a id="btnEmpty" href="cart.php?action=empty">
            <h2>Empty Cart</h2>
        </a>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th style="text-align:left;">Name</th>
                    <th style="text-align:left;">Platform</th>
                    <th style="text-align:left;">Code</th>
                    <th style="text-align:right;" width="5%">Quantity</th>
                    <th style="text-align:right;" width="10%">Unit Price</th>
                    <th style="text-align:right;" width="10%">Price</th>
                    <th style="text-align:center;" width="5%">Remove</th>
                </tr>
                <?php	
				foreach ($_SESSION["cart_item"] as $item) {
					$item_price = $item["quantity"] * $item["price"];
					?>
                <tr>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode($item['image']) ?>" class="cart-item-image" /><a href="game.php?code=<?=$item['code']?>"><?= $item["game_title"] ?></a></td>
                    <td style="text-align:right;"><?php echo $item["platform"]; ?></td>
                    <td><?php echo $item["code"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                    <td style="text-align:right;"><?php echo "£ " . $item["price"]; ?></td>
                    <td style="text-align:right;"><?php echo "£ " . number_format($item_price, 2); ?></td>
                    <td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="img/icon-delete.png" alt="Remove Item" /></a></td>
                </tr>
                <?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"] * $item["quantity"]);
			}
			?>

                <tr>
                    <td colspan="3" align="right">Total:</td>
                    <td align="right"><?php echo $total_quantity; ?></td>
                    <td align="right" colspan="2"><strong><?php echo "£ " . number_format($total_price, 2); ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <a id="btnCheckout" href="../checkout.php">
            <h2>Checkout</h2>
        </a>
        <?php

	} else {
		?>
        <div class="emptyCart">
            <h1>Your Cart is Empty</h1>
        </div>
        <?php 
	}
	?>
    </div>
</div>

<?php
//var_dump($_SESSION["cart_item"]);
if (!empty($_GET["action"])) {
	switch ($_GET["action"]) {
		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);	
                        header('location: cart.php');			
					if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                        header('location: cart.php');
					
				}
			}
			break;
		case "empty":
			unset($_SESSION["cart_item"]);
			header('location: cart.php');
			break;
	}
}
