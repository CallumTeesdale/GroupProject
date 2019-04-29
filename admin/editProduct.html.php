<?php

require '../database.php';
require '../classes/DatabaseTable.php';


$databaseTable = new \classes\DatabaseTable($pdo, 'games', 'game_id');
$product = $databaseTable->find('game_id', $_GET['id']);




if (isset($_POST['submit'])) {
  $date=date_create($_POST['product']['release_date']);
  $formated = date_format($date, "Y/m/d");
  $_POST['product']['release_date'] = $formated;
  if ($_FILES['game_image']["error"] == 0) {
    $image = file_get_contents($_FILES['game_image']['tmp_name']);
    $_POST['product']['game_image'] = $image; 
  }
 
  $product=$_POST['product'];
  $databaseTable->save($product);
  header('Location: /admin/products.php');

}
else {
?>

<div class="addFormWrapper">
  <div class="addFormTextWrapper">
    <div class="addForm">
<form action="editProduct.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="product[game_id]" value="<?=$product[0]->game_id?>" /><br><br>
	<label>Game Title:</label>
	<input type="text" name="product[game_title]" value="<?=$product[0]->game_title?>" /><br><br>

  <label>Game Description:</label>
  <textarea name="product[game_description]" rows="5" cols="40" ><?=$product[0]->game_description?></textarea><br><br>

  <label>Game Text:</label>
  <textarea name="product[game_text]" rows="5" cols="40"><?=$product[0]->game_text?></textarea><br><br>

  <label>Age Rating:</label>
  <input type="radio" name="product[age_rating]"
    <?php if (isset($product[0]->age_rating) && $product[0]->age_rating==="3+") echo "checked";?>
        value="3+">3+
  <input type="radio" name="product[age_rating]"
    <?php if (isset($product[0]->age_rating) && $product[0]->age_rating==="7+") echo "checked";?>
        value="7+">7+
  <input type="radio" name="product[age_rating]"
    <?php if (isset($product[0]->age_rating) && $product[0]->age_rating==="12+") echo "checked";?>
        value="12+">12+
  <input type="radio" name="product[age_rating]"
    <?php if (isset($product[0]->age_rating) && $product[0]->age_rating==="15+") echo "checked";?>
        value="18+">15+
  <input type="radio" name="product[age_rating]"
    <?php if (isset($product[0]->age_rating) && $product[0]->age_rating==="18+") echo "checked";?>
        value="18+">18+
<br><br>

<label>Price:</label>
<input type="text" name="product[price]"value="<?=$product[0]->price?>" /><br><br>

<label>Platform:</label>
<input type="text" name="product[platform]" value="<?=$product[0]->platform?>"/><br><br>

<label>Publisher:</label>
<input type="text" name="product[publisher]" value="<?=$product[0]->publisher?>"/><br><br>

<label>Developer:</label>
<input type="text" name="product[developer]" value="<?=$product[0]->developer?>"/><br><br>

<label>Release Date:</label>
<input type="date" id="start" name="product[release_date]"
        value="<?=$product[0]->release_date?>"
       min="2000-01-01" max="2022-12-31"><br><br>

<label>Metacritic Score:</label>
<input type="text" name="product[metacritic_score]" value="<?=$product[0]->metacritic_score?>" /><br><br>

<label>Quantity:</label>
<input type="text" name="product[quantity]" value="<?=$product[0]->quantity?>"/><br><br>

<label>Trailer Link:</label>
<input type="text" name="product[trailer_link]" value="<?=$product[0]->trailer_link?>"/><br><br>

<label>Unique Code:</label>
<input type="text" name="product[code]" value="<?=$product[0]->code?>"/><br><br>

<label>Product Image:</label>
<input type="file" name="game_image" accept="*/image" /><br><br>


<input type="submit" name="submit" value="Add" />
</form>
</div>
</div>
</div>
<?php
}
?>
