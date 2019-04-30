<?php

require '../database.php';
require '../classes/DatabaseTable.php';


$databaseTable = new \classes\DatabaseTable($pdo, 'games', 'game_id');



if (isset($_POST['submit'])&& $_SESSION['is_staff']==true) {
  $date=date_create($_POST['product']['release_date']);
  $formated = date_format($date, "Y/m/d");
  $_POST['product']['release_date'] = $formated;
  $image = file_get_contents($_FILES['game_image']['tmp_name']);
  $_POST['product']['game_image'] = $image;
  $product=$_POST['product'];
  $databaseTable->save($product);
	header('Location: /admin/products.php');

}
else {
?>
<div class="addFormWrapper">
  <div class="addFormTextWrapper">
    <div class="addForm">
<form action="" method="POST" enctype="multipart/form-data">
	<label>Game Title:</label>
	<input type="text" name="product[game_title]" /><br><br>

  <label>Game Description:</label>
  <textarea name="product[game_description]" rows="5" cols="40"></textarea><br><br>

  <label>Game Text:</label>
  <textarea name="product[game_text]" rows="5" cols="40"></textarea><br><br>

  <label>Age Rating:</label>
  <input type="radio" name="product[age_rating]"
    <?php if (isset($age_rating) && $age_rating=="female") echo "checked";?>
        value="3+">3+
  <input type="radio" name="product[age_rating]"
    <?php if (isset($age_rating) && $age_rating=="male") echo "checked";?>
        value="7+">7+
  <input type="radio" name="product[age_rating]"
    <?php if (isset($age_rating) && $age_rating=="other") echo "checked";?>
        value="12+">12+
  <input type="radio" name="product[age_rating]"
    <?php if (isset($age_rating) && $age_rating=="other") echo "checked";?>
        value="18+">15+
  <input type="radio" name="product[age_rating]"
    <?php if (isset($age_rating) && $age_rating=="other") echo "checked";?>
        value="18+">18+
<br><br>

<label>Price:</label>
<input type="text" name="product[price]" /><br><br>

<label>Platform:</label>
<input type="text" name="product[platform]" /><br><br>

<label>Publisher:</label>
<input type="text" name="product[publisher]" /><br><br>

<label>Developer:</label>
<input type="text" name="product[developer]" /><br><br>

<label>Release Date:</label>
<input type="date" id="start" name="product[release_date]"
       value="2019-01-01"
       min="2000-01-01" max="2022-12-31"><br><br>

<label>Metacritic Score:</label>
<input type="text" name="product[metacritic_score]" /><br><br>

<label>Quantity:</label>
<input type="text" name="product[quantity]" /><br><br>

<label>Trailer Link:</label>
<input type="text" name="product[trailer_link]" /><br><br>

<label>Unique Code:</label>
<input type="text" name="product[code]" /><br><br>

<label>Product Image:</label>
<input type="file" name="game_image" accept="*/image" />


	<input type="submit" name="submit" value="Add" />
</form>
</div>
</div>
</div>
<?php
}
?>
