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
        <table>
				<thead>
					<tr>
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
							<td><a style="float: right" href="/admin/editProduct.php?id=<?=$p->game_id?>">Edit</a></td>
							<td><a style="float: right" href="/admin/deleteProduct.php?id=<?=$p->game_id?>">Delete</a></td>
						</tr>
						<?php
}
?>
				</thead>
			</table>
        </div>
    </div>

</div> 