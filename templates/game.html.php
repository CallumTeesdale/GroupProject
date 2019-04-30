<?php
require "../database.php";
$games = $pdo->prepare("SELECT * FROM games WHERE code='" . $_GET["code"] . "'");
$games->execute();
?>
<div class="game-wrapper">
    <?php foreach ($games as $game) : ?>
        <div class="game-accordion">
            <h1><?= $game['game_title'] ?></h1>
            <div class="game-image">
                <img src="data:image/jpeg;base64,<?= base64_encode($game['game_image']) ?>" />
                                                </div>
                                                <div class="game-right">
                                                    <div class="game-text">
                                                        <p><?= $game['game_text'] ?></p>
                                                        
                                                </div>
                                            </div>
                                            <form method="post" action="game.php?action=add&code=<?= $game['code'] ?>">
                                                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" hidden /><input type="submit" value="Add to Cart" class="btnAddAction" />

                                            <button onclick="myFunction('More')" class="g-button block black">More</button>
                                            <div id="More" class="hide accordion-container">
                                                <div class="game-image">
                                                    <iframe id="ytplayer" type="text/html" width="640" height="360" src="https://www.youtube.com/embed/<?= $game['trailer_link'] ?>?autoplay=0" frameborder="0"></iframe>
                                                                                                                    </div>

                                                                                                                    <div class="game-right">
                                                                                                                        <div class="game-more">
                                                                                                                            <p><strong>Age: </strong><?= $game['age_rating'] ?></p>
                                                                                                                            <p><strong>Platform: </strong><?= $game['platform'] ?></p>
                                                                                                                            <p><strong>Release Date: </strong><?= $game['release_date'] ?></p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>

                                            <button onclick="myFunction('Specifics')" class="g-button block black">Specifics</button>
                                            <div id="Specifics" class="hide accordion-container">
                                            <p><strong>Publisher: </strong><?= $game['publisher'] ?></p>   
                                            <p><strong>Publisher: </strong><?= $game['developer'] ?></p>                                                           
                                            </div>

                                             </div>
                                             
                                                                                                                                                                                                        <?php endforeach; ?>
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