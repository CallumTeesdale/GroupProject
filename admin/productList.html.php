<?php require '../database.php';
require '../classes/DatabaseTable.php'; 
$databaseTable = new \classes\DatabaseTable($pdo, 'games', 'id');

$product = $databaseTable->findAll();
$products=$product;
//var_dump($products[0]);


?>

<div class="productsWrapper">
    <div class="productsTextWrapper">
        <div class="productsText">
        <h2>Products</h2> <a  href="/admin/AddProduct.php">Add new Product</a><br><br>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
				<thead>
					<tr>
                        <th style="width: 5%"></th>
						<th style="width: 10%">Title</th>
						<th style="width: 10%">Price</th>
                        <th style="width: 10%">Platform</th>
                        <th style="width: 10%">Quantity</th>
                        <th style="width: 10%">Code</th>
						<th style="width: 5%">&nbsp;</th>
						<th style="width: 5%">&nbsp;</th>
                    </tr>
                    <?php
foreach ($products as $p) {
  ?>
						<tr>
                            <td><img src="data:image/jpeg;base64,<?= base64_encode($p->game_image) ?>" class="cart-item-image" /></td>
							<td>
								<?=$p->game_title?>
							</td>
							<td>£
								<?=$p->price?>
							</td>
							<td>
                                <?=$p->platform?>
                            </td>
                            <td>
                                <?=$p->quantity?>
                            </td>
                            <td>
                                <?=$p->code?>
							</td>
							<td style="text-align:center;"><a href="products.php?action=edit&id=<?=$p->game_id?>" class="btnRemoveAction"><img src="../public/img/edit.png" width="20" height="20" alt="Edit Item" /></a></td>
							<td style="text-align:center;"><a href="products.php?action=remove&id=<?=$p->game_id?>" class="btnRemoveAction"><img src="../public/img/icon-delete.png" alt="Remove Item" /></a></td>
						</tr>
						<?php
}
?>
				</thead>
			</table>
        </div>
    </div>

</div> 
<?php
if (!empty($_GET["action"])) {
	switch ($_GET["action"]) {
        case "remove":
        $databaseTable->delete($_GET['id']);
        break;
        case 'edit':
            header('Location: /admin/editProduct.php?id='.$_GET['id']);
            break;			
			}
            
        }
    