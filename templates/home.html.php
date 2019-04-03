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
        <p><?= $game['game_description'] ?></p>
        <a href="game.php?code=<?=$game['code']?>">More</a>
        <form method="post" action="index.php?action=add&code=<?=$game['code']?>">
        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" hidden /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
    
    </form>
    </div>
    <?php endforeach; ?>
</div>


</div>

<?php
 //session_destroy();

if (!empty($_GET["action"])) {
  switch ($_GET["action"]) {
    case "add":
      if (!empty($_POST["quantity"])) {
        $stmt = $pdo->prepare("SELECT * FROM games WHERE code='" . $_GET["code"] . "'");
        $stmt->execute();
        $productByCode = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $itemArray = array($productByCode[0]["code"] => array('game_title' => $productByCode[0]["game_title"], 'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["game_image"], 'platform' => $productByCode[0]["platform"]));

        if (!empty($_SESSION["cart_item"])) {
          if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
              if ($productByCode[0]["code"] == $k) {
                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                  $_SESSION["cart_item"][$k]["quantity"] = 0;
                }
                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                //session_write_close();
              }
            }
          } else {
            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
            //session_write_close();
          }
        } else {
          $_SESSION["cart_item"] = $itemArray;
          //session_write_close();
        }
      }
      break;
  }
}
