<div class="title">

    <h1> Welcome to Northampton Gaming</h1>

</div>
<?php 
require "../database.php";
$games = $pdo->prepare('SELECT * FROM games');
$games->execute();
//var_dump($_SESSION["cart_item"]);
?>
<div class="content">

    <?php foreach ($games as $game) : ?>
    <div class="index_games">
        <img src="data:image/jpeg;base64,<?= base64_encode($game['game_image']) ?>" width="200" height="200" alt="" class="logo" />
        <h4><?= $game['game_title'] ?></h4>
        <p>~300 characters of text</p>
        <form method="post" action="index.php?action=add&id=<?php echo $game['game_id']; ?>">
            <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
    </div>
    </form>
</div>

<?php endforeach; ?>
</div>

<?php
 //session_destroy();

if (!empty($_GET["action"])) {
  switch ($_GET["action"]) {
    case "add":
      if (!empty($_POST["quantity"])) {
        $stmt = $pdo->prepare('SELECT * FROM games WHERE game_id = ' . $_GET['id'] . '');
        $stmt->execute();
        $productByid = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $itemArray = array($productByid[0]["game_id"] => array('game_title' => $productByid[0]["game_title"], 'game_id' => $productByid[0]["game_id"], 'quantity' => $_POST["quantity"], 'price' => $productByid[0]["price"], 'image' => $productByid[0]["game_image"], 'platform' => $productByid[0]["platform"]));

        if (!empty($_SESSION["cart_item"])) {
          if (in_array($productByid[0]["game_id"], array_keys($_SESSION["cart_item"]))) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
              if ($productByid[0]["game_id"] == $k) {
                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                  $_SESSION["cart_item"][$k]["quantity"] = 0;
                }
                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                session_write_close();
              }
            }
          } else {
            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
            session_write_close();
          }
        } else {
          $_SESSION["cart_item"] = $itemArray;
          session_write_close();
        }
      }
      break;
  }
}
